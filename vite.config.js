import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "build/assets/app-26f72382.css",
                "build/assets/app-800ca8d0.js"
            ],
            refresh: true,
        }),
    ],
});
