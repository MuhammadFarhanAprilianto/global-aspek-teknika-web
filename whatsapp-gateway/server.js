import express from 'express';
import multer from 'multer';
import pino from 'pino';
import QRCode from 'qrcode';
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import makeWASocket, {
    DisconnectReason,
    fetchLatestBaileysVersion,
    jidNormalizedUser,
    useMultiFileAuthState,
} from '@whiskeysockets/baileys';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const PORT = Number(process.env.WA_GATEWAY_PORT || 3001);
const HOST = process.env.WA_GATEWAY_HOST || '127.0.0.1';
const GATEWAY_SECRET = process.env.WA_GATEWAY_SECRET || 'gat-internal-wa-secret-2026';
const AUTH_DIR = path.join(__dirname, 'auth_info');

const app = express();
const upload = multer({
    storage: multer.memoryStorage(),
    limits: { fileSize: 15 * 1024 * 1024 },
});

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

let sock = null;
let connectionState = 'connecting'; // 'connecting' | 'qr_ready' | 'connected' | 'disconnected'
let latestQrDataUrl = null;
let connectedPhone = null;
let reconnectTimer = null;

function cleanAuthDir() {
    try {
        if (fs.existsSync(AUTH_DIR)) {
            fs.rmSync(AUTH_DIR, { recursive: true, force: true });
        }
    } catch (err) {
        console.error('[WA-Gateway] Failed cleaning auth_info:', err.message);
    }
}

async function startWhatsApp() {
    if (reconnectTimer) {
        clearTimeout(reconnectTimer);
        reconnectTimer = null;
    }

    fs.mkdirSync(AUTH_DIR, { recursive: true });
    const { state, saveCreds } = await useMultiFileAuthState(AUTH_DIR);

    let version = [2, 3000, 1015901307];
    try {
        const latest = await fetchLatestBaileysVersion();
        if (latest?.version) {
            version = latest.version;
        }
    } catch {
        // Fallback to default version if offline
    }

    connectionState = 'connecting';

    sock = makeWASocket({
        version,
        auth: state,
        logger: pino({ level: 'silent' }),
        browser: ['PT Global Aspek Teknologi', 'Chrome', '122.0.0'],
        syncFullHistory: false,
        markOnlineOnConnect: false,
    });

    sock.ev.on('creds.update', saveCreds);

    sock.ev.on('connection.update', async (update) => {
        const { connection, lastDisconnect, qr } = update;

        if (qr) {
            try {
                latestQrDataUrl = await QRCode.toDataURL(qr, {
                    width: 280,
                    margin: 2,
                    color: { dark: '#111827', light: '#ffffff' },
                });
                connectionState = 'qr_ready';
                console.log('[WA-Gateway] QR Code siap di-scan pada http://' + HOST + ':' + PORT);
            } catch (err) {
                console.error('[WA-Gateway] QR generation error:', err.message);
            }
        }

        if (connection === 'open') {
            connectionState = 'connected';
            latestQrDataUrl = null;
            const rawId = sock?.user?.id || '';
            connectedPhone = jidNormalizedUser(rawId).split('@')[0] || rawId;
            console.log('[WA-Gateway] WhatsApp Terhubung sebagai:', connectedPhone);
        }

        if (connection === 'close') {
            const statusCode = lastDisconnect?.error?.output?.statusCode;
            const isLoggedOut = statusCode === DisconnectReason.loggedOut;

            connectedPhone = null;
            latestQrDataUrl = null;
            connectionState = 'disconnected';

            console.log('[WA-Gateway] Koneksi tertutup (code:', statusCode, '). LoggedOut:', isLoggedOut);

            if (isLoggedOut) {
                cleanAuthDir();
                reconnectTimer = setTimeout(() => startWhatsApp(), 1500);
            } else {
                reconnectTimer = setTimeout(() => startWhatsApp(), 2500);
            }
        }
    });
}

function normalizePhone(raw) {
    let digits = String(raw || '').replace(/\D+/g, '');
    if (digits.startsWith('0')) {
        digits = '62' + digits.slice(1);
    }
    return digits;
}

async function resolveTargetJid(phoneDigits) {
    const ownNormalized = sock?.user?.id ? jidNormalizedUser(sock.user.id) : '';
    const ownDigits = ownNormalized ? ownNormalized.split('@')[0] : '';

    if (ownDigits && phoneDigits === ownDigits) {
        return ownNormalized;
    }

    try {
        const check = await sock.onWhatsApp(phoneDigits);
        if (Array.isArray(check) && check.length > 0 && check[0]?.exists && check[0]?.jid) {
            return check[0].jid;
        }
    } catch {
        // Fallback to standard JID format
    }

    return `${phoneDigits}@s.whatsapp.net`;
}

// Halaman Dashboard Koneksi QR Lokal (Putih Bersih Korporat)
app.get(['/', '/qr'], (_req, res) => {
    res.setHeader('Content-Type', 'text/html; charset=utf-8');
    res.send(`<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Gateway Lokal — PT Global Aspek Teknologi</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: #f9fafb;
            color: #111827;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            max-width: 440px;
            width: 100%;
            padding: 32px 28px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
            text-align: center;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 14px;
        }
        .badge-wait { background: #fef3c7; color: #92400e; }
        .badge-ok { background: #d1fae5; color: #065f46; }
        h1 { font-size: 19px; font-weight: 700; margin-bottom: 6px; }
        p.sub { font-size: 13px; color: #6b7280; line-height: 1.5; margin-bottom: 20px; }
        .qr-box {
            width: 280px;
            height: 280px;
            margin: 0 auto 18px;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            overflow: hidden;
        }
        .qr-box img { width: 100%; height: 100%; object-fit: contain; }
        .steps {
            text-align: left;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 12.5px;
            color: #374151;
            line-height: 1.65;
        }
        .btn-logout {
            margin-top: 18px;
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #dc2626;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-logout:hover { background: #fef2f2; }
    </style>
</head>
<body>
    <div class="card">
        <div id="status-badge" class="badge badge-wait">Memuat Status...</div>
        <h1>WhatsApp Gateway Mandiri</h1>
        <p class="sub">PT Global Aspek Teknologi — Pengiriman File PDF Sales Quote Gratis &amp; Tanpa Watermark</p>

        <div id="qr-section">
            <div class="qr-box" id="qr-container">
                <span style="font-size:13px;color:#9ca3af;">Menyiapkan QR Code...</span>
            </div>
            <div class="steps">
                <strong>Cara Menghubungkan (Cukup 1x Scan):</strong><br>
                1. Buka WhatsApp di HP Admin (<code>085732021121</code>).<br>
                2. Pilih menu <strong>Perangkat Tertaut (Linked Devices)</strong>.<br>
                3. Ketuk <strong>Tautkan Perangkat</strong> lalu arahkan kamera ke QR di atas.
            </div>
        </div>

        <div id="connected-section" style="display:none;">
            <div class="steps" style="text-align:center; background:#ecfdf5; border-color:#a7f3d0; color:#065f46;">
                <strong>WhatsApp Aktif &amp; Siap Mengirim PDF!</strong><br>
                Nomor Terhubung: <strong id="connected-number">-</strong><br>
                <span style="font-size:11.5px;color:#047857;">Silakan kembali ke halaman Sales Quote website dan klik tombol Konfirmasi Pesanan ke Admin.</span>
            </div>
            <button type="button" class="btn-logout" onclick="logoutDevice()">Putuskan / Ganti Nomor WA</button>
        </div>
    </div>

    <script>
        async function pollStatus() {
            try {
                const res = await fetch('/status');
                const data = await res.json();
                const badge = document.getElementById('status-badge');
                const qrSec = document.getElementById('qr-section');
                const connSec = document.getElementById('connected-section');
                const qrBox = document.getElementById('qr-container');

                if (data.device_status === 'connect') {
                    badge.className = 'badge badge-ok';
                    badge.textContent = '● Terhubung (Connected)';
                    qrSec.style.display = 'none';
                    connSec.style.display = 'block';
                    document.getElementById('connected-number').textContent = data.device || '-';
                } else {
                    badge.className = 'badge badge-wait';
                    badge.textContent = data.qr ? '● Menunggu Scan QR' : '● Menyiapkan Koneksi...';
                    qrSec.style.display = 'block';
                    connSec.style.display = 'none';
                    if (data.qr) {
                        qrBox.innerHTML = '<img src="' + data.qr + '" alt="WhatsApp QR Code">';
                    } else {
                        qrBox.innerHTML = '<span style="font-size:13px;color:#9ca3af;">Sedang memuat QR Code baru...</span>';
                    }
                }
            } catch (e) {}
        }

        async function logoutDevice() {
            if (!confirm('Putuskan koneksi nomor WhatsApp saat ini?')) return;
            await fetch('/logout', { method: 'POST' });
            setTimeout(pollStatus, 1000);
        }

        pollStatus();
        setInterval(pollStatus, 2000);
    </script>
</body>
</html>`);
});

app.get('/status', (_req, res) => {
    res.json({
        status: true,
        device_status: connectionState === 'connected' ? 'connect' : 'disconnect',
        device: connectedPhone,
        state: connectionState,
        attachment: true,
        package: 'Self-Hosted Unlimited (No Watermark)',
        qr: latestQrDataUrl,
    });
});

app.post('/logout', async (_req, res) => {
    try {
        if (sock) {
            await sock.logout();
        }
    } catch {
        // Ignore if already closed
    }
    cleanAuthDir();
    connectedPhone = null;
    latestQrDataUrl = null;
    connectionState = 'disconnected';
    setTimeout(() => startWhatsApp(), 800);
    res.json({ status: true });
});

// Endpoint pengiriman dokumen PDF + caption 1 bubble (Kompatibel penuh dengan Laravel Service)
app.post('/send', upload.single('file'), async (req, res) => {
    const authHeader = String(req.headers['authorization'] || '').trim();
    if (GATEWAY_SECRET && authHeader !== GATEWAY_SECRET) {
        return res.status(401).json({
            status: false,
            reason: 'Token otorisasi WhatsApp Gateway lokal tidak sesuai.',
        });
    }

    if (!sock || connectionState !== 'connected') {
        return res.status(200).json({
            status: false,
            reason: 'disconnected — silakan scan QR terlebih dahulu di http://' + HOST + ':' + PORT,
        });
    }

    const targetDigits = normalizePhone(req.body?.target);
    if (!targetDigits) {
        return res.status(400).json({
            status: false,
            reason: 'Nomor tujuan (target) tidak valid.',
        });
    }

    const caption = String(req.body?.message || '');
    const customFilename = String(req.body?.filename || '').trim();

    try {
        const jid = await resolveTargetJid(targetDigits);

        if (req.file && req.file.buffer && req.file.buffer.length > 0) {
            const finalFilename = customFilename || req.file.originalname || 'Sales_Quote.pdf';
            const mime = finalFilename.toLowerCase().endsWith('.pdf')
                ? 'application/pdf'
                : (req.file.mimetype || 'application/octet-stream');

            await sock.sendMessage(jid, {
                document: req.file.buffer,
                mimetype: mime,
                fileName: finalFilename,
                caption,
            });
        } else {
            await sock.sendMessage(jid, {
                text: caption,
            });
        }

        return res.json({
            status: true,
            detail: 'Dokumen PDF & pesan berhasil dikirim tanpa watermark.',
        });
    } catch (err) {
        console.error('[WA-Gateway] Send error:', err);
        return res.status(200).json({
            status: false,
            reason: err?.message || 'Gagal mengirim pesan ke WhatsApp.',
        });
    }
});

app.listen(PORT, HOST, () => {
    console.log(`[WA-Gateway] Server berjalan di http://${HOST}:${PORT}`);
    startWhatsApp().catch((err) => {
        console.error('[WA-Gateway] Startup error:', err);
    });
});

