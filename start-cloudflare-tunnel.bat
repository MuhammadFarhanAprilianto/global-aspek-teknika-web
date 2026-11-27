@echo off
title PT Global Aspect Technology - Cloudflare Tunnel + Laravel + MySQL + WA Gateway
cd /d "%~dp0"

echo [1/4] Memastikan MySQL 8.4 aktif di port 3306...
powershell -NoProfile -Command "$s=New-Object System.Net.Sockets.TcpClient; try{$s.Connect('127.0.0.1',3306);$s.Close()}catch{Start-Process -FilePath 'C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqld.exe' -ArgumentList '--defaults-file=C:\laragon\bin\mysql\mysql-8.4.3-winx64\my.ini' -WindowStyle Hidden; Start-Sleep -Seconds 3}"

echo [2/4] Memastikan WhatsApp Gateway aktif di port 3001...
powershell -NoProfile -Command "$s=New-Object System.Net.Sockets.TcpClient; try{$s.Connect('127.0.0.1',3001);$s.Close()}catch{Start-Process -FilePath 'node' -ArgumentList 'server.js' -WorkingDirectory 'd:\Website\whatsapp-gateway' -WindowStyle Minimized}"

echo [3/4] Memastikan Server Laravel aktif di port 8000...
powershell -NoProfile -Command "$s=New-Object System.Net.Sockets.TcpClient; try{$s.Connect('127.0.0.1',8000);$s.Close()}catch{Start-Process -FilePath 'php' -ArgumentList 'artisan serve --host=127.0.0.1 --port=8000' -WorkingDirectory 'd:\Website' -WindowStyle Minimized; Start-Sleep -Seconds 2}"

echo [4/4] Menjalankan Cloudflare Tunnel (HTTPS publik)...
echo.
echo === SALIN LINK https://....trycloudflare.com YANG MUNCUL DI BAWAH ===
echo === JANGAN TUTUP JENDELA INI SELAMA WEBSITE SEDANG DIAKSES ===
echo.
"C:\Program Files (x86)\cloudflared\cloudflared.exe" tunnel --url http://127.0.0.1:8000 --no-autoupdate
pause
