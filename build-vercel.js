import { execSync } from 'child_process';

console.log('--- Running Vite Build ---');
execSync('npx vite build', { stdio: 'inherit' });
console.log('✓ Build complete!');
