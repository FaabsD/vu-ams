const plugin = require('tailwindcss/plugin');

module.exports = {
	content: require('fast-glob').sync([
		'./index.php',
		'./header.php',
		'./footer.php',
		'./page-*.php',
		'./single-*.php',
		'./search.php',
		'./404.php',
	]),
	theme: {
		extend: {
			colors: {
				ams: {
					yellow: 'rgb(247, 200, 12)',
					grey: 'rgb(247, 247, 247)',
					dark: 'rgb(16, 20, 48)',
					cyan: 'rgb(0, 182, 203)',
					strong_cyan: '#00b0d5',
					text_light: '#8989A2',


				}
			},
			fontFamily: {
				'heebo': ["Heebo", 'sans-serif'],
			},
			screens: {
				'1.5xl': '1440px',
			}
		},
	},
	plugins: [
		require('@tailwindcss/typography'),
		require('@tailwindcss/forms'),
		require('@tailwindcss/line-clamp'),
		plugin(function ({ addVariant }) {
			addVariant('odd-of-type', '&:nth-of-type(odd)')
			addVariant('even-of-type', '&:nth-of-type(even)')
		})
	],
}
