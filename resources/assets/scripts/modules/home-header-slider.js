$(document).ready(function () {
    const headerSlides = document.querySelectorAll('.slider__img');

    const headerSliderNavBtns = document.querySelectorAll('.nav__thumb');

    headerSliderNavBtns.forEach((thumb, index) => {
        thumb.addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target == headerSliderNavBtns[0]) {
                headerSliderNavBtns[0].classList.remove('nav__thumb--inactive');
                headerSliderNavBtns[1].classList.add('nav__thumb--inactive');

                headerSlides[0].classList.remove('slider__img--hidden');
                headerSlides[1].classList.add('slider__img--hidden');
            } else {
                headerSliderNavBtns[1].classList.remove('nav__thumb--inactive');
                headerSliderNavBtns[0].classList.add('nav__thumb--inactive');

                headerSlides[1].classList.remove('slider__img--hidden');
                headerSlides[0].classList.add('slider__img--hidden');
            }
        })
    });
});