const mix = require('laravel-mix');

mix.browserSync({
    proxy: {
        target: 'http://vu-ams.test',
        ws: true,
        middleware: function (req, res, next) {
            res.setHeader('Access-Control-Allow-Origin', '*');
            next();
        },
    },
    files: [
        'index.php',
        'header.php',
        'footer.php',
        'page-*.php',
        'search.php',
        'single-*.php',
        'build/css/app.css',
        'build/scripts/app.js',
    ],
    watch: true,
    open: 'local',
    https: false,
    online: true,
    cors: true,
    browser: ["microsoft edge"],
    injectChanges: true,
    logLevel: 'debug',
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
        children: true
    }
});
