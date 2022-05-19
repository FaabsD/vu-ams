const mix = require('laravel-mix');

mix.browserSync({
    proxy: {
        target: 'https://vu-ams.test',
        ws: true,
    },
    files: [
        'index.php',
        'header.php',
        'footer.php',
        'page-*.php',
        'single-*.php',
        'build/css/app.css',
        'build/scripts/app.js',
    ],
    watch: true,
    open: 'local',
    https: false,
    online: true,
    cors: false,
    browser: ["microsoft edge", "firefox developer edition"],
    injectChanges: false,
});

mix.postCss('resources/assets/css/style.css', 'build/css/app.css', [
    require('postcss-import'),
    require('tailwindcss/nesting'),
    require('tailwindcss'),
    require('autoprefixer'),
]).options({
    processCssUrls: false
});
mix.js('resources/assets/scripts/app.js', 'build/scripts/app.js');
mix.webpackConfig({
    stats: {
        children: false
    }
});
