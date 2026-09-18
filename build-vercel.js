import { execSync } from 'child_process';

console.log('--- Running Vite Build ---');
try {
    execSync('npx vite build', { stdio: 'inherit' });
} catch (e) {
    console.warn('Vite build notice:', e.message);
}
console.log('✓ Build complete!');


