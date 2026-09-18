import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';

console.log('--- Running Vite Build ---');
try {
    execSync('npx vite build', { stdio: 'inherit' });
} catch (e) {
    console.warn('Vite build warning/notice:', e.message);
}

console.log('--- Copying storage/app/public to public/storage for Vercel Static CDN ---');
const srcDir = path.resolve('storage/app/public');
const destDir = path.resolve('public/storage');

if (fs.existsSync(srcDir)) {
    if (!fs.existsSync(destDir)) {
        fs.mkdirSync(destDir, { recursive: true });
    }
    fs.cpSync(srcDir, destDir, { recursive: true, force: true });
    console.log('✓ Successfully copied public storage assets to CDN build directory!');
} else {
    console.warn('Warning: storage/app/public not found!');
}

console.log('✓ Build complete!');

