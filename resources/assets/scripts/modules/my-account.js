$(document).ready(() => {

	const myAccContainer = document.querySelector('.page-template-page-my_account .content .woocommerce');

	if (myAccContainer) {

		if (!myAccContainer.querySelector('.woocommerce-MyAccount-navigation') || !myAccContainer.querySelector('.woocommerce-MyAccount-content')) {
			// console.log('No Account data and or content found in dom');

			myAccContainer.classList.add('woocommerce__login');
		}
	}
})