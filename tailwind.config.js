module.exports = {
    content: require('fast-glob').sync([
        './index.php',
        './header.php',
        './footer.php',
        './page-*.php',
        './single-*.php',
    ]),
    theme: {
        extend: {
            colors: {
                ams: {
                   yellow: 'rgb(255, 189, 16)',
                }
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
