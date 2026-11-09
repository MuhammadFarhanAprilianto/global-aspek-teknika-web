#!/usr/bin/env bash
# =========================================================================
# Script Pemasangan Otomatis Website & WhatsApp Gateway PT Global Aspek Teknologi
# Target OS: Ubuntu 22.04 LTS / 24.04 LTS
# =========================================================================

set -e

echo "=== 1. Memperbarui Paket Sistem VPS ==="
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl git unzip software-properties-common nginx certbot python3-certbot-nginx

echo "=== 2. Memasang Node.js v20 LTS & PM2 ==="
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
sudo npm install -g pm2

echo "=== 3. Memasang PHP 8.3 & Ekstensi ==="
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3-fpm php8.3-cli php8.3-mysql php8.3-mbstring php8.3-xml php8.3-zip php8.3-curl php8.3-gd

echo "=== 4. Memasang Composer ==="
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

echo "=== 5. Menyiapkan Folder Proyek ==="
PROJECT_DIR="/var/www/gat-website"

if [ -d "$PROJECT_DIR" ]; then
    cd "$PROJECT_DIR"
    echo "Menjalankan instalasi dependency Laravel..."
    composer install --optimize-autoloader --no-dev --no-interaction
    
    echo "Menyetel izin folder storage & bootstrap..."
    sudo chown -R www-data:www-data "$PROJECT_DIR/storage" "$PROJECT_DIR/bootstrap/cache"
    sudo chmod -R 775 "$PROJECT_DIR/storage" "$PROJECT_DIR/bootstrap/cache"

    echo "Menjalankan migrasi database..."
    php artisan migrate --force
    php artisan storage:link || true
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    echo "Menyiapkan WhatsApp Gateway Mandiri..."
    cd "$PROJECT_DIR/whatsapp-gateway"
    npm install --production
    pm2 delete gat-whatsapp-gateway || true
    pm2 start ecosystem.config.js
    pm2 save
    pm2 startup systemd -u $USER --hp $HOME || true
fi

echo "=== 6. Menyiapkan Konfigurasi Nginx ==="
if [ -f "$PROJECT_DIR/deploy/nginx-gat.conf" ]; then
    sudo cp "$PROJECT_DIR/deploy/nginx-gat.conf" /etc/nginx/sites-available/gat-website
    sudo ln -sf /etc/nginx/sites-available/gat-website /etc/nginx/sites-enabled/
    sudo nginx -t
    sudo systemctl reload nginx
fi

echo "========================================================================="
echo " SUKSES! Website & WhatsApp Gateway Mandiri Telah Terpasang & Berjalan!"
echo " Akses Dashboard WhatsApp Anda di browser untuk Scan QR."
echo "========================================================================="

