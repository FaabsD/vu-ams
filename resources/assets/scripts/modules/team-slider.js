$(document).ready(function () {

    $('.meet-the-team__members').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1,
                }
            }

        ]
    });
})