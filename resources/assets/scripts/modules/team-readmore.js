$(document).ready(function () {

	const teamPage = $('.page-template-page-team');

	if (teamPage) {
		const teamMemberCards = teamPage.find('.team .role .role__members .member');

		if (teamMemberCards) {
			teamMemberCards.each(function (index) {
				let textContainer = $(this).find('.member__text-section .member__text');
				console.log("scrollheight = " + textContainer.prop('scrollHeight'));
				console.log("clientheight = " + textContainer.prop('offsetHeight'));
				if (textContainer) {
					if (textContainer.prop('scrollHeight') > textContainer.prop("clientHeight")) {
						textContainer.css("background-color", "red");
						console.log($(this) + "is overflowing");
						console.log(textContainer);
						console.log("scrollheight = " + textContainer.prop('scrollHeight'));
						console.log("clientheight = " + textContainer.prop('offsetHeight'));
					}
				}


			})
		}
	}
});