<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

/**
 * Pure-PHP Native OpenXML (.xlsx) Exporter — zero external dependencies & zero PHP zip-extension requirement.
 * Produces spec-compliant .xlsx files that open cleanly as formatted tables in Microsoft Excel,
 * WPS Office Spreadsheets, LibreOffice Calc, and Google Sheets (no CSV delimiter issues).
 */
class SimpleXlsxExporter
{
    /**
     * Stream a styled native .xlsx workbook as a download response.
     *
     * @param  string  $filename  Output filename (e.g. GAT_Simulator_Leads_20261124.xlsx)
     * @param  string  $sheetTitle  Worksheet tab name (max 31 chars)
     * @param  string  $reportTitle  Top banner title
     * @param  string  $reportSubtitle  Secondary metadata line (export time, count, filters)
     * @param  array<int, array{label: string, width: float, type?: 'string'|'number'|'currency', align?: 'left'|'center'|'right'}>  $columns
     * @param  array<int, array<int, mixed>>  $rows
     * @param  array<int, mixed>|null  $summaryRow  Optional bold summary/total footer row
     */
    public static function download(
        string $filename,
        string $sheetTitle,
        string $reportTitle,
        string $reportSubtitle,
        array $columns,
        array $rows,
        ?array $summaryRow = null
    ): Response {
        return self::downloadMultiSheet($filename, [[
            'sheetTitle' => $sheetTitle,
            'reportTitle' => $reportTitle,
            'reportSubtitle' => $reportSubtitle,
            'columns' => $columns,
            'rows' => $rows,
            'summaryRows' => $summaryRow ? [$summaryRow] : [],
        ]]);
    }

    /**
     * Stream a styled multi-worksheet native .xlsx workbook as a download response.
     *
     * @param  array<int, array{
     *     sheetTitle: string,
     *     reportTitle: string,
     *     reportSubtitle: string,
     *     columns: array<int, array<string, mixed>>,
     *     rows: array<int, array<int, mixed>>,
     *     summaryRows?: array<int, array<int, mixed>>,
     *     headerStyle?: 'navy'|'soft_blue'
     * }>  $sheets
     */
    public static function downloadMultiSheet(string $filename, array $sheets): Response
    {
        $binary = self::buildMultiSheetXlsxBinary($sheets);

        return response($binary, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length' => (string) strlen($binary),
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }

    /**
     * Build the raw .xlsx binary package for a single worksheet.
     */
    public static function buildXlsxBinary(
        string $sheetTitle,
        string $reportTitle,
        string $reportSubtitle,
        array $columns,
        array $rows,
        ?array $summaryRow = null
    ): string {
        return self::buildMultiSheetXlsxBinary([[
            'sheetTitle' => $sheetTitle,
            'reportTitle' => $reportTitle,
            'reportSubtitle' => $reportSubtitle,
            'columns' => $columns,
            'rows' => $rows,
            'summaryRows' => $summaryRow ? [$summaryRow] : [],
        ]]);
    }

    /**
     * Build a multi-sheet OpenXML (.xlsx) package cleanly without external dependencies.
     */
    public static function buildMultiSheetXlsxBinary(array $sheets): string
    {
        $normalized = [];
        $usedNames = [];

        foreach ($sheets as $idx => $sheet) {
            $rawName = (string) ($sheet['sheetTitle'] ?? ('Sheet' . ($idx + 1)));
            $safeTab = preg_replace('/[\[\]\:\*\?\/\\\\]/', '', $rawName) ?: ('Sheet' . ($idx + 1));
            $safeTab = mb_substr(trim($safeTab), 0, 31);
            if (in_array(strtolower($safeTab), $usedNames, true)) {
                $safeTab = mb_substr($safeTab, 0, 28) . '_' . ($idx + 1);
            }
            $usedNames[] = strtolower($safeTab);

            $summaryRows = $sheet['summaryRows'] ?? [];
            if (empty($summaryRows) && ! empty($sheet['summaryRow']) && is_array($sheet['summaryRow'])) {
                $summaryRows = [$sheet['summaryRow']];
            }

            $normalized[] = [
                'sheetTitle' => $safeTab,
                'reportTitle' => (string) ($sheet['reportTitle'] ?? $safeTab),
                'reportSubtitle' => (string) ($sheet['reportSubtitle'] ?? ''),
                'columns' => $sheet['columns'] ?? [],
                'rows' => $sheet['rows'] ?? [],
                'summaryRows' => $summaryRows,
                'headerStyle' => $sheet['headerStyle'] ?? 'navy',
            ];
        }

        $count = count($normalized);
        $files = [
            '[Content_Types].xml' => self::contentTypesXml($count),
            '_rels/.rels' => self::rootRelsXml(),
            'xl/workbook.xml' => self::workbookXml(array_column($normalized, 'sheetTitle')),
            'xl/_rels/workbook.xml.rels' => self::workbookRelsXml($count),
            'xl/styles.xml' => self::stylesXml(),
        ];

        foreach ($normalized as $idx => $sheet) {
            $files['xl/worksheets/sheet' . ($idx + 1) . '.xml'] = self::worksheetXml(
                $sheet['reportTitle'],
                $sheet['reportSubtitle'],
                $sheet['columns'],
                $sheet['rows'],
                $sheet['summaryRows'],
                $idx === 0,
                $sheet['headerStyle']
            );
        }

        return self::createZipArchive($files);
    }

    private static function xmlEsc(mixed $value): string
    {
        $str = (string) ($value ?? '');
        // Remove invalid XML 1.0 control characters (keep \t, \n, \r)
        $str = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $str) ?? '';

        return htmlspecialchars($str, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }

    private static function colLetter(int $index): string
    {
        $letter = '';
        $n = $index;
        while ($n >= 0) {
            $letter = chr(($n % 26) + 65) . $letter;
            $n = intdiv($n, 26) - 1;
        }

        return $letter;
    }

    private static function contentTypesXml(int $sheetCount): string
    {
        $overrides = '';
        for ($i = 1; $i <= $sheetCount; $i++) {
            $overrides .= '<Override PartName="/xl/worksheets/sheet' . $i . '.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>';
        }

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n"
            . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            . '<Default Extension="xml" ContentType="application/xml"/>'
            . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            . $overrides
            . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            . '</Types>';
    }

    private static function rootRelsXml(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n"
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            . '</Relationships>';
    }

    /**
     * @param  array<int, string>  $sheetNames
     */
    private static function workbookXml(array $sheetNames): string
    {
        $sheetsXml = '';
        foreach ($sheetNames as $idx => $name) {
            $id = $idx + 1;
            $sheetsXml .= '<sheet name="' . self::xmlEsc($name) . '" sheetId="' . $id . '" r:id="rId' . $id . '"/>';
        }

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n"
            . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            . '<sheets>' . $sheetsXml . '</sheets>'
            . '</workbook>';
    }

    private static function workbookRelsXml(int $sheetCount): string
    {
        $rels = '';
        for ($i = 1; $i <= $sheetCount; $i++) {
            $rels .= '<Relationship Id="rId' . $i . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet' . $i . '.xml"/>';
        }
        $stylesRid = 'rId' . ($sheetCount + 1);

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n"
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . $rels
            . '<Relationship Id="' . $stylesRid . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
            . '</Relationships>';
    }

    /**
     * Style indices (cellXfs):
     * 0..11: Default, Title, Subtitle, Navy Header, White L/C/Cur, Zebra L/C/Cur, Summary L/Cur
     * 12: Soft Blue Website Table Header (#DCE9F8 bg, #0F172A bold text, thin #93C5FD border)
     * 13: White Row Right Text
     * 14: Zebra Row Right Text
     * 15: Summary Row Right Text (#E2EFFD bg, bold)
     */
    private static function stylesXml(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n"
            . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<numFmts count="1">'
            . '<numFmt numFmtId="164" formatCode="&quot;Rp &quot;#,##0"/>'
            . '</numFmts>'
            . '<fonts count="6">'
            . '<font><sz val="10"/><color rgb="FF1E293B"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="13"/><color rgb="FF244E81"/><name val="Calibri"/></font>'
            . '<font><sz val="9.5"/><color rgb="FF64748B"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="10"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="10"/><color rgb="FF244E81"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="10"/><color rgb="FF0F172A"/><name val="Calibri"/></font>'
            . '</fonts>'
            . '<fills count="6">'
            . '<fill><patternFill patternType="none"/></fill>'
            . '<fill><patternFill patternType="gray125"/></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FF244E81"/><bgColor indexed="64"/></patternFill></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FFF8FAFD"/><bgColor indexed="64"/></patternFill></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FFE2EFFD"/><bgColor indexed="64"/></patternFill></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FFDCE9F8"/><bgColor indexed="64"/></patternFill></fill>'
            . '</fills>'
            . '<borders count="4">'
            . '<border><left/><right/><top/><bottom/><diagonal/></border>'
            . '<border>'
            . '<left style="thin"><color rgb="FFCBD5E1"/></left>'
            . '<right style="thin"><color rgb="FFCBD5E1"/></right>'
            . '<top style="thin"><color rgb="FFCBD5E1"/></top>'
            . '<bottom style="thin"><color rgb="FFCBD5E1"/></bottom>'
            . '<diagonal/>'
            . '</border>'
            . '<border>'
            . '<left style="thin"><color rgb="FF244E81"/></left>'
            . '<right style="thin"><color rgb="FF244E81"/></right>'
            . '<top style="thin"><color rgb="FF244E81"/></top>'
            . '<bottom style="medium"><color rgb="FF244E81"/></bottom>'
            . '<diagonal/>'
            . '</border>'
            . '<border>'
            . '<left style="thin"><color rgb="FF93C5FD"/></left>'
            . '<right style="thin"><color rgb="FF93C5FD"/></right>'
            . '<top style="thin"><color rgb="FF93C5FD"/></top>'
            . '<bottom style="medium"><color rgb="FF93C5FD"/></bottom>'
            . '<diagonal/>'
            . '</border>'
            . '</borders>'
            . '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
            . '<cellXfs count="16">'
            // 0: Default
            . '<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
            // 1: Report Title
            . '<xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1" applyAlignment="1"><alignment horizontal="left" vertical="center"/></xf>'
            // 2: Report Subtitle
            . '<xf numFmtId="0" fontId="2" fillId="0" borderId="0" xfId="0" applyFont="1" applyAlignment="1"><alignment horizontal="left" vertical="center"/></xf>'
            // 3: Table Header (Navy)
            . '<xf numFmtId="0" fontId="3" fillId="2" borderId="2" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf>'
            // 4: White Row Left
            . '<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyFont="1" applyBorder="1" applyAlignment="1"><alignment horizontal="left" vertical="center" wrapText="1"/></xf>'
            // 5: White Row Center
            . '<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyFont="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf>'
            // 6: White Row Currency
            . '<xf numFmtId="164" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyFont="1" applyBorder="1" applyAlignment="1"><alignment horizontal="right" vertical="center"/></xf>'
            // 7: Zebra Row Left
            . '<xf numFmtId="0" fontId="0" fillId="3" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="left" vertical="center" wrapText="1"/></xf>'
            // 8: Zebra Row Center
            . '<xf numFmtId="0" fontId="0" fillId="3" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf>'
            // 9: Zebra Row Currency
            . '<xf numFmtId="164" fontId="0" fillId="3" borderId="1" xfId="0" applyNumberFormat="1" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="right" vertical="center"/></xf>'
            // 10: Summary Row Left
            . '<xf numFmtId="0" fontId="4" fillId="4" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="left" vertical="center" wrapText="1"/></xf>'
            // 11: Summary Row Currency
            . '<xf numFmtId="164" fontId="4" fillId="4" borderId="1" xfId="0" applyNumberFormat="1" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="right" vertical="center"/></xf>'
            // 12: Website Soft Blue Table Header (#DCE9F8)
            . '<xf numFmtId="0" fontId="5" fillId="5" borderId="3" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf>'
            // 13: White Row Right Text
            . '<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyFont="1" applyBorder="1" applyAlignment="1"><alignment horizontal="right" vertical="center" wrapText="1"/></xf>'
            // 14: Zebra Row Right Text
            . '<xf numFmtId="0" fontId="0" fillId="3" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="right" vertical="center" wrapText="1"/></xf>'
            // 15: Summary Row Right Text
            . '<xf numFmtId="0" fontId="5" fillId="4" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="right" vertical="center"/></xf>'
            . '</cellXfs>'
            . '</styleSheet>';
    }

    private static function worksheetXml(
        string $reportTitle,
        string $reportSubtitle,
        array $columns,
        array $rows,
        array $summaryRows,
        bool $isSelectedTab = true,
        string $headerStyle = 'navy'
    ): string {
        $colCount = max(1, count($columns));
        $lastCol = self::colLetter($colCount - 1);

        $colsXml = '<cols>';
        foreach ($columns as $idx => $col) {
            $colNum = $idx + 1;
            $width = (float) ($col['width'] ?? 18);
            $colsXml .= '<col min="' . $colNum . '" max="' . $colNum . '" width="' . number_format($width, 2, '.', '') . '" customWidth="1"/>';
        }
        $colsXml .= '</cols>';

        $sheetData = '<sheetData>';

        // Row 1: Report Title (merged across all columns)
        $sheetData .= '<row r="1" ht="26" customHeight="1">'
            . '<c r="A1" t="inlineStr" s="1"><is><t>' . self::xmlEsc($reportTitle) . '</t></is></c>'
            . '</row>';

        // Row 2: Subtitle / timestamp
        $sheetData .= '<row r="2" ht="18" customHeight="1">'
            . '<c r="A2" t="inlineStr" s="2"><is><t>' . self::xmlEsc($reportSubtitle) . '</t></is></c>'
            . '</row>';

        // Row 3: Blank spacer
        $sheetData .= '<row r="3" ht="8" customHeight="1"/>';

        // Row 4: Styled Table Header
        $headerStyleId = $headerStyle === 'soft_blue' ? '12' : '3';
        $sheetData .= '<row r="4" ht="28" customHeight="1">';
        foreach ($columns as $idx => $col) {
            $ref = self::colLetter($idx) . '4';
            $sheetData .= '<c r="' . $ref . '" t="inlineStr" s="' . $headerStyleId . '"><is><t>' . self::xmlEsc($col['label']) . '</t></is></c>';
        }
        $sheetData .= '</row>';

        // Row 5+: Data Rows
        $rowNum = 5;
        if (empty($rows)) {
            $sheetData .= '<row r="' . $rowNum . '" ht="24" customHeight="1">';
            for ($idx = 0; $idx < $colCount; $idx++) {
                $ref = self::colLetter($idx) . $rowNum;
                $text = $idx === 0 ? 'Belum ada data kalkulasi.' : '';
                $sheetData .= '<c r="' . $ref . '" t="inlineStr" s="5"><is><t>' . self::xmlEsc($text) . '</t></is></c>';
            }
            $sheetData .= '</row>';
            $rowNum++;
        } else {
            foreach ($rows as $rowIdx => $rowValues) {
                $isZebra = ($rowIdx % 2) === 1;
                $sheetData .= '<row r="' . $rowNum . '" ht="24" customHeight="1">';
                foreach ($columns as $idx => $col) {
                    $ref = self::colLetter($idx) . $rowNum;
                    $val = $rowValues[$idx] ?? '';
                    $type = $col['type'] ?? 'string';
                    $align = $col['align'] ?? 'left';

                    if ($type === 'currency' && is_numeric($val)) {
                        $style = $isZebra ? 9 : 6;
                        $sheetData .= '<c r="' . $ref . '" s="' . $style . '"><v>' . (float) $val . '</v></c>';
                    } elseif ($type === 'number' && is_numeric($val)) {
                        $style = $align === 'right'
                            ? ($isZebra ? 14 : 13)
                            : ($isZebra ? 8 : 5);
                        $sheetData .= '<c r="' . $ref . '" s="' . $style . '"><v>' . (0 + $val) . '</v></c>';
                    } else {
                        if ($align === 'right') {
                            $style = $isZebra ? 14 : 13;
                        } elseif ($align === 'center') {
                            $style = $isZebra ? 8 : 5;
                        } else {
                            $style = $isZebra ? 7 : 4;
                        }
                        $sheetData .= '<c r="' . $ref . '" t="inlineStr" s="' . $style . '"><is><t>' . self::xmlEsc($val) . '</t></is></c>';
                    }
                }
                $sheetData .= '</row>';
                $rowNum++;
            }
        }

        // Optional Summary / Total Footer Rows (supports 1 or multiple rows like Initial CapEx + Yearly OpEx)
        foreach ($summaryRows as $summaryRow) {
            if (! is_array($summaryRow) || empty($summaryRow)) {
                continue;
            }
            $sheetData .= '<row r="' . $rowNum . '" ht="26" customHeight="1">';
            foreach ($columns as $idx => $col) {
                $ref = self::colLetter($idx) . $rowNum;
                $val = $summaryRow[$idx] ?? '';
                $type = $col['type'] ?? 'string';
                $align = $col['align'] ?? 'left';

                if ($type === 'currency' && is_numeric($val)) {
                    $sheetData .= '<c r="' . $ref . '" s="11"><v>' . (float) $val . '</v></c>';
                } else {
                    $sumStyle = $align === 'right' ? '15' : '10';
                    $sheetData .= '<c r="' . $ref . '" t="inlineStr" s="' . $sumStyle . '"><is><t>' . self::xmlEsc($val) . '</t></is></c>';
                }
            }
            $sheetData .= '</row>';
            $rowNum++;
        }

        $sheetData .= '</sheetData>';

        $lastDataRow = max(4, $rowNum - 1);
        $autoFilter = '<autoFilter ref="A4:' . $lastCol . $lastDataRow . '"/>';

        $merges = '<mergeCells count="2">'
            . '<mergeCell ref="A1:' . $lastCol . '1"/>'
            . '<mergeCell ref="A2:' . $lastCol . '2"/>'
            . '</mergeCells>';

        // Freeze header rows (rows 1-4 stay visible while scrolling!)
        $tabAttr = $isSelectedTab ? ' tabSelected="1"' : '';
        $sheetViews = '<sheetViews><sheetView' . $tabAttr . ' workbookViewId="0">'
            . '<pane ySplit="4" topLeftCell="A5" activePane="bottomLeft" state="frozen"/>'
            . '</sheetView></sheetViews>';

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n"
            . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<dimension ref="A1:' . $lastCol . $lastDataRow . '"/>'
            . $sheetViews
            . '<sheetFormatPr defaultRowHeight="20"/>'
            . $colsXml
            . $sheetData
            . $autoFilter
            . $merges
            . '<pageSetup orientation="landscape" paperSize="9"/>'
            . '</worksheet>';
    }

    /**
     * Pack associative array [filename => bytes] into a valid PKZIP archive (Method 0 Stored).
     *
     * @param  array<string, string>  $files
     */
    private static function createZipArchive(array $files): string
    {
        $localData = '';
        $centralDir = '';
        $offset = 0;
        $count = 0;

        $dosTime = self::dosTime();
        $dosDate = self::dosDate();

        foreach ($files as $name => $content) {
            $nameBytes = str_replace('\\', '/', $name);
            $nameLen = strlen($nameBytes);
            $size = strlen($content);
            $crc = crc32($content) & 0xFFFFFFFF;

            // Local File Header (30 bytes + filename + data)
            $localHeader = pack(
                'VvvvvvVVVvv',
                0x04034B50, // Local file header signature
                20,         // Version needed to extract (2.0)
                0x0800,     // General purpose bit flag (UTF-8 filename)
                0,          // Compression method: 0 = STORE
                $dosTime,
                $dosDate,
                $crc,
                $size,
                $size,
                $nameLen,
                0           // Extra field length
            );

            $localData .= $localHeader . $nameBytes . $content;

            // Central Directory File Header (46 bytes + filename)
            $centralDir .= pack(
                'VvvvvvvVVVvvvvvVV',
                0x02014B50, // Central file header signature
                20,         // Version made by
                20,         // Version needed to extract
                0x0800,     // General purpose bit flag (UTF-8)
                0,          // Compression method: 0 = STORE
                $dosTime,
                $dosDate,
                $crc,
                $size,
                $size,
                $nameLen,
                0,          // Extra field length
                0,          // File comment length
                0,          // Disk number start
                0,          // Internal file attributes
                0,          // External file attributes
                $offset     // Relative offset of local header
            ) . $nameBytes;

            $offset += strlen($localHeader) + $nameLen + $size;
            $count++;
        }

        // End of Central Directory Record (22 bytes)
        $eocd = pack(
            'VvvvvVVv',
            0x06054B50,
            0,
            0,
            $count,
            $count,
            strlen($centralDir),
            $offset,
            0
        );

        return $localData . $centralDir . $eocd;
    }

    private static function dosTime(): int
    {
        $now = getdate();
        return (($now['hours'] & 0x1F) << 11) | (($now['minutes'] & 0x3F) << 5) | (($now['seconds'] >> 1) & 0x1F);
    }

    private static function dosDate(): int
    {
        $now = getdate();
        $year = max(1980, $now['year']);
        return ((($year - 1980) & 0x7F) << 9) | (($now['mon'] & 0x0F) << 5) | ($now['mday'] & 0x1F);
    }
}
