import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js'
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '$': path.resolve(__dirname, 'node_modules/jquery/dist/jquery.min.js'),
      'jquery': path.resolve(__dirname, 'node_modules/jquery/dist/jquery.min.js'),
      '@fortawesome': path.resolve(__dirname, 'node_modules/@fortawesome'),
      'flowbite': path.resolve(__dirname, 'node_modules/flowbite'),
    }
  },
  optimizeDeps: {
    include: [
      'jquery',
      'alpinejs',
      'flowbite',
    ],
    exclude: [
      '@fortawesome/fontawesome-free'
    ]
  },
  build: {
    commonjsOptions: {
      include: [
        /node_modules/,
      ],
    }
  }
});
