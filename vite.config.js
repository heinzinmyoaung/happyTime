import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path'
export default defineConfig({
    plugins: [
        vue({
            template:{
                base: null,
                includeAbsolute: false,
            }
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            ziggy: path.resolve('./vendor/tightenco/ziggy/dist/vue.es.js')
        }
    }
});
