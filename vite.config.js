import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [
        vue(),
        symfonyPlugin(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './assets'),
        },
    },
    root: ".",
    base: "/build/",
    publicDir: false,
    build: {
        reportCompressedSize: true,
        manifest: true,
        emptyOutDir: true,
        assetsDir: "",
        outDir: "./public/build",
        rollupOptions: {
            input: {
                app: "./assets/app.ts"
            },
        },
    },
});
