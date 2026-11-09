@echo off
title PT Global Aspek Teknologi - WhatsApp Gateway Mandiri
cd /d "%~dp0whatsapp-gateway"
echo Menjalankan WhatsApp Gateway Lokal pada http://127.0.0.1:3001 ...
node server.js
pause

