<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sales Quote - {{ $order->company_name }}</title>
    <style>
        @page {
            margin: 34px 42px 48px 42px;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.45;
            color: #000000;
            margin: 0;
            padding: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        p {
            margin: 0 0 2px 0;
        }
        .slate-bar {
            background-color: #788595;
            color: #ffffff;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .bold {
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: -24px;
            left: 0;
            right: 0;
            font-size: 10px;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <!-- Bottom Fixed Footer -->
    <div class="footer">
        <table>
            <tr>
                <td class="text-left">Sales Quote</td>
                <td class="text-right">Page 1 of 1</td>
            </tr>
        </table>
    </div>

    <!-- 1. Official Company Letterhead -->
    <table style="margin-bottom: 32px;">
        <tr>
            <td style="width: 44%; vertical-align: top; padding-top: 2px;">
                @if (!empty($logoBase64))
                    <img src="{{ $logoBase64 }}" alt="PT Global Aspek Teknologi" style="width: 175px; height: auto;">
                @else
                    <span class="bold" style="font-size: 15px;">PT Global Aspek Teknologi</span>
                @endif
            </td>
            <td style="width: 56%; vertical-align: top; font-size: 11.5px; line-height: 1.48;">
                <p class="bold" style="font-size: 12.5px; margin-bottom: 2px;">PT Global Aspek Teknologi</p>
                <p>Cibis Nine Building Lantai 11</p>
                <p>Jl. TB Simatupang No.2 RT:001/RW:005 Kel. Cilandak Timur, Kec.</p>
                <p>Ps. Minggu - Kota Jakarta Selatan, 12560</p>
                <p>globalaspektek84@gmail.com</p>
            </td>
        </tr>
    </table>

    <!-- 2. BILL TO (Left) & Quote Heading + DATE / EXPIRED DATE Bars (Right) -->
    <table style="margin-bottom: 28px;">
        <tr>
            <td style="width: 56%; vertical-align: top; padding-right: 16px;">
                <p style="text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 8px;">BILL TO</p>
                <p>{{ $order->pic_name }}</p>
                <p style="margin-bottom: 5px;">{{ $order->company_name }}</p>
                @if ($order->company_address)
                    <p style="margin-bottom: 4px;">{!! nl2br(e($order->company_address)) !!}</p>
                @endif
                <p>{{ $order->company_email }}</p>
                <p>{{ $order->company_phone }}</p>
                @if ($order->npwp && $order->npwp !== '-')
                    <p style="margin-top: 2px;">NPWP: {{ $order->npwp }}</p>
                @endif
            </td>
            <td style="width: 44%; vertical-align: top;">
                <div class="text-right bold" style="font-size: 24px; line-height: 1; margin-bottom: 10px;">
                    Quote
                </div>
                <table style="width: 100%; font-size: 10.5px;">
                    <tr class="slate-bar">
                        <td style="width: 48%; padding: 5px 10px;">DATE</td>
                        <td style="width: 52%; padding: 5px 10px;">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr><td colspan="2" style="height: 3px; background-color: #ffffff;"></td></tr>
                    <tr class="slate-bar">
                        <td style="width: 48%; padding: 5px 10px;">EXPIRED DATE</td>
                        <td style="width: 52%; padding: 5px 10px;">{{ optional($order->expires_at)->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- 3. Line Items Table -->
    <table style="margin-bottom: 24px; font-size: 11px;">
        <thead>
            <tr class="slate-bar">
                <th class="text-left" style="width: 46%; padding: 7px 10px;">Description</th>
                <th class="text-center" style="width: 10%; padding: 7px 6px;">Qty</th>
                <th class="text-right" style="width: 12%; padding: 7px 6px;">Discount</th>
                <th class="text-right" style="width: 16%; padding: 7px 6px;">Price (Rp.)</th>
                <th class="text-right" style="width: 16%; padding: 7px 10px;">Amount (Rp.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr style="border-bottom: 1px solid #9aa4b2;">
                    <td style="padding: 9px 10px; vertical-align: top;">
                        <p class="bold" style="margin-bottom: 3px;">{{ $item->product_name }}</p>
                        <p>- SKU: {{ $item->sku }}</p>
                        @foreach ($item->resolvedSpecifications() as $specKey => $specVal)
                            <p>- {{ is_string($specKey) ? $specKey . ': ' . $specVal : $specVal }}</p>
                        @endforeach
                    </td>
                    <td class="text-center" style="padding: 9px 6px; vertical-align: top;">
                        <div>{{ $item->quantity }}</div>
                        <div>SET</div>
                    </td>
                    <td class="text-right" style="padding: 9px 6px; vertical-align: top;">
                        0.0%
                    </td>
                    <td class="text-right" style="padding: 9px 6px; vertical-align: top;">
                        {{ number_format((float) $item->unit_price, 2, ',', '.') }}
                    </td>
                    <td class="text-right" style="padding: 9px 10px; vertical-align: top;">
                        {{ number_format((float) $item->line_total, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 4. Totals Summary (SUBTOTAL + PPN 11% - PPh 23 2.0% = TOTAL) -->
    <table>
        <tr>
            <td style="width: 48%; vertical-align: top; padding-right: 16px; font-size: 10px;">
                @if ($order->notes)
                    <p class="bold" style="margin-bottom: 2px;">Urgensi / Kebutuhan Pesanan:</p>
                    <p style="margin-bottom: 8px;">{!! nl2br(e($order->notes)) !!}</p>
                @endif

                @if (! empty($qrCodeDataUri))
                    <!-- Keamanan: Digital Verification QR Code (Anti-Pemalsuan Fisik Dokumen) -->
                    <table style="width: 100%; border: 1px solid #cbd5e1; background-color: #f8fafc; padding: 6px; border-radius: 4px;">
                        <tr>
                            <td style="width: 54px; vertical-align: middle; text-align: center;">
                                <img src="{{ $qrCodeDataUri }}" width="50" height="50" style="display: block; margin: 0 auto;" alt="QR Code Verifikasi" />
                            </td>
                            <td style="vertical-align: middle; padding-left: 8px; font-size: 7.8px; line-height: 1.3; color: #475467;">
                                <div class="bold" style="color: #0f172a; font-size: 8.5px; margin-bottom: 1px;">VERIFIKASI KEASLIAN DIGITAL</div>
                                <div>Pindai (Scan) QR Code dengan kamera ponsel untuk memvalidasi keaslian dokumen Sales Quote ini langsung pada portal web resmi PT Global Aspek Teknologi.</div>
                                <div style="font-family: monospace; color: #64748b; font-size: 7.5px; margin-top: 1px;">SEC-HASH: {{ $shortHash ?? strtoupper(substr($order->verification_hash, 0, 16)) }}</div>
                            </td>
                        </tr>
                    </table>
                @endif
            </td>
            <td style="width: 52%; vertical-align: top;">
                <table style="width: 100%; font-size: 11px;">
                    <tr>
                        <td style="padding: 5px 10px;">SUBTOTAL</td>
                        <td class="text-right" style="padding: 5px 10px;">{{ number_format((float) $order->subtotal, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">PPN {{ number_format((float) $order->tax_rate, 0) }}% &nbsp;&nbsp; {{ number_format((float) $order->tax_rate, 1) }}%</td>
                        <td class="text-right" style="padding: 5px 10px;">{{ number_format((float) $order->tax_amount, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">PPh 23 &nbsp;&nbsp; {{ number_format((float) ($order->pph23_rate ?? 2), 1) }}%</td>
                        <td class="text-right" style="padding: 5px 10px;">( {{ number_format((float) $order->pph23_amount, 2, ',', '.') }})</td>
                    </tr>
                    <tr class="slate-bar">
                        <td style="padding: 7px 10px;">TOTAL</td>
                        <td class="text-right" style="padding: 7px 10px;">{{ number_format((float) $order->grand_total, 2, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>

