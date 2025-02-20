import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import ViteSassPlugin from 'vite-plugin-sass';

export default defineConfig({
  plugins: [
   [ViteSassPlugin()],
    laravel({
      input: [
        'resources/sass/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
});

