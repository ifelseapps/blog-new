const mix = require('laravel-mix');

mix.ts('resources/js/admin/app.tsx', 'public/js/admin/')
  .react()
  .postCss('resources/js/admin/admin.css', 'public/css');

mix.js('resources/js/app.js', 'public/js').postCss(
  'resources/css/app.css',
  'public/css'
);
