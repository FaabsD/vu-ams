// start script when site/page is loaded
$(document).ready(function () {
	// get the teampage body
	const teamPage = $('.page-template-page-team');

	// check is the page is the teampage using "teamPage" const
	if (teamPage) {

		// get all the team members on the team page
		const teamMemberCards = teamPage.find('.team .role .role__members .member');

		if (teamMemberCards) {

			// loop trough all the team members
			teamMemberCards.each(function (index) {

				//get the container containing the team members description text
				let textContainer = $(this).find('.member__text-section .member__text');
				console.log("scrollheight = " + textContainer.prop('scrollHeight'));
				console.log("clientheight = " + textContainer.prop('offsetHeight'));

				if (textContainer) {

					// check if the text container is overflowing by comparing the scrollHeight against the clientHeight
					if (textContainer.prop('scrollHeight') > textContainer.prop("clientHeight")) {

						// add a has_read_more class to the text container if it is indeed overflowing
						// textContainer.css("background-color", "red");
						textContainer.addClass('has_read_more');

						console.log(textContainer);
						console.log("scrollheight = " + textContainer.prop('scrollHeight'));
						console.log("clientheight = " + textContainer.prop('offsetHeight'));

						/* little fix on screen widths starting from 1536 remove the class when difference in scrollHeight and 
						clientHeight is equal or less then 5 then it is not actually overflowing.
						*/
						if (window.innerWidth >= 1536) {

							if (textContainer.prop("scrollHeight") - textContainer.prop("clientHeight") <= 5) {

								console.log("don't add a readmore button to this one");

								// textContainer.css("background-color", "unset");
								textContainer.removeClass('has_read_more');
							}
						}
					}
				}

				if (textContainer.hasClass("has_read_more")) {
					// $(this).css("background-color", "lime");

					// get .member__text-section
					let teamMemberTextSection = $(this).find(".member__text-section");
					if (teamMemberTextSection) {
						// create a read more button
						let readMore = document.createElement('button');
						readMore.innerHTML = "Read more";
						readMore.classList.add('member__read-more');

						// add read more button to the .member__text-section
						teamMemberTextSection.append(readMore);
					}

					//get added read more button
					let readMoreBtn = textContainer.siblings('.member__read-more');

					/* it should only find one read more button per team member that has it but just to be sure 
					check for a present read more button and if it is only one */
					if (readMoreBtn && readMoreBtn.length === 1 ) {
						console.log(readMoreBtn);
						
						// add a click event to the read more button
						readMoreBtn.on("click", function(event) {
							textContainer.toggleClass('member__text--opened');
						}) 
					}
				}

			})
		}
	}
});