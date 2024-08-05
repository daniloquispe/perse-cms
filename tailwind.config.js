/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	theme: {
		extend: {
			colors: {
				palette: {
					orange: '#ff8300',
					pink: '#fcf2f5',
					purple: '#AD60BF',
					yellow: '#ffc629',
				}
			},
			screens: {
				"3xl": "1800px"
			},
			container: {
				"3xl": "1678px"
			}
		},
	},
	plugins: [],
}
