const faqContainer = document.querySelector('.questions');



if (faqContainer) {
	const questions = faqContainer.querySelectorAll('.questions__col > .question');

	if (questions.length >= 1) {
		// console.log(questions);

		questions.forEach(question => {
			question.addEventListener('click', function (e) {
				question.classList.toggle('question--opened');

				closeOtherFaqs(e.target, faqContainer);
			});
		})
	}
}

/**
 * Check for opened FAQ items and close them if it is not the same items as the one the visitor has clicked
 * @param {Node} clickTarget - The (click) event target
 * @param {Node} container - The container containing the FAQ items
 */
function closeOtherFaqs(clickTarget, container) {
	console.log(container);

	let containerCols = container.querySelectorAll('.questions__col');

	if (containerCols.length >= 1) {
		containerCols.forEach(faqCol => {
			console.log(faqCol);
			let checkQuestions = faqCol.querySelectorAll('.question');

			if (checkQuestions.length >= 1) {
				checkQuestions.forEach(checkQuestion => {
					if (checkQuestion.classList.contains('question--opened') && checkQuestion !== clickTarget) {
						console.log("===== this question =====");
						console.log(checkQuestion);
						console.log("Is opened");

						console.log("This question is not the click target");
						checkQuestion.classList.remove('question--opened');
					}
				});
			}
		})
	}

}