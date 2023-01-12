const mix = require('laravel-mix');
const path = require('path');

/**
 * Admin SPA
 */
mix.ts('admin/app.tsx', 'public/js/admin/')
  .react()
  .postCss('admin/admin.css', 'public/css')
  .alias({
    'admin': path.join(__dirname, 'admin'),
  });

/**
 * Site assets
 */
mix.js('resources/js/app.js', 'public/js').postCss(
  'resources/css/app.css',
  'public/css'
);
