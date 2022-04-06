module.exports = {
    content: require('fast-glob').sync([
        './index.php',
        './header.php',
        './footer.php',
        './page-*.php',
        './single-*.php',
    ]),
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
