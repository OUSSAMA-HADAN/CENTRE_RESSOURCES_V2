import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // Force absolute URLs for production
            buildDirectory: 'build',
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery',
        },
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: process.env.VITE_HMR_HOST || '192.168.1.20',
            port: parseInt(process.env.VITE_HMR_PORT) || 5173,
        },
    },
    build: {
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    if (id.includes('node_modules')) {
                        if (id.includes('bootstrap') || id.includes('jquery')) {
                            return 'vendor';
                        }
                        if (id.includes('swiper')) {
                            return 'swiper';
                        }
                        if (id.includes('fontawesome')) {
                            return 'fontawesome';
                        }
                        return 'vendor';
                    }
                },
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const ext = info[info.length - 1];
                    if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) {
                        return `assets/fonts/[name]-[hash][extname]`;
                    }
                    return `assets/[name]-[hash][extname]`;
                },
            },
        },
        cssCodeSplit: true,
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
    },
    assetsInclude: ['**/*.woff2', '**/*.woff', '**/*.ttf', '**/*.eot'],
    css: {
        devSourcemap: true,
    },
});
