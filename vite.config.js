import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  build: {
    // Disable minification and sourcemaps in development for easier debugging
    minify: process.env.NODE_ENV === 'production' ? 'terser' : false,  // Minify only in production
    sourcemap: process.env.NODE_ENV === 'development',  // Enable sourcemaps only in development
  },
  server: {
    // Only run Vite in development mode locally, not in CI
    hmr: process.env.NODE_ENV === 'development',  // Enable Hot Module Replacement only in development
  },
});
