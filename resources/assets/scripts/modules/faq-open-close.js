const faqContainer = document.querySelector('.questions');



if (faqContainer) {
	const questions = faqContainer.querySelectorAll('.questions__col > .question');
	
	if (questions.length >= 1) {
		console.log(questions);

		questions.forEach(question => {
			question.addEventListener('click', function(e) {
				question.classList.toggle('question--opened');

				let openedQuestion = faqContainer.querySelector('.questions__col > .question--opened');
				if (openedQuestion && openedQuestion !== question) {
					openedQuestion.classList.remove('question--opened');
				}
			});
		})
	}
}