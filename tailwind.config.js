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
                    yellow: 'rgb(247, 200, 12)',
                    grey: 'rgb(247, 247, 247)',
                    dark: 'rgb(16, 20, 48)',
                    blue: 'rgb(0, 182, 203)',


                }
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
