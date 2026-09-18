import fs from 'fs';
import path from 'path';
import { execSync } from 'child_process';

console.log('--- Preparing Vercel Build ---');

const srcDir = path.resolve('storage/app/public');
const destDir = path.resolve('public/storage');

try {
    if (fs.existsSync(srcDir)) {
        if (fs.existsSync(destDir)) {
            const stat = fs.lstatSync(destDir);
            if (stat.isSymbolicLink()) {
                fs.unlinkSync(destDir);
            }
        }
        if (!fs.existsSync(destDir)) {
            fs.cpSync(srcDir, destDir, { recursive: true });
            console.log('✓ Successfully copied storage assets to public/storage');
        }
    }
} catch (err) {
    console.warn('Notice while preparing storage directory:', err.message);
}

console.log('--- Running Vite Build ---');
execSync('npx vite build', { stdio: 'inherit' });
console.log('✓ Build complete!');
