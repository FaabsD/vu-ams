const shopThumbs = document.querySelectorAll('.products .product .woocommerce-loop-product__link .attachment-woocommerce_thumbnail');
const shopPlaceholders = document.querySelectorAll('.products .product .woocommerce-loop-product__link .woocommerce-placeholder');

$(document).ready(function () {

    if (shopThumbs) {

        shopThumbs.forEach((thumb) => {
            equalize_image_height_to_width(thumb);
            console.log(thumb);
        })
    }

    if (shopPlaceholders) {

        shopPlaceholders.forEach((placeholder) => {
            equalize_image_height_to_width(placeholder);
        })
    }

    if (shopThumbs && shopPlaceholders) {
        window.addEventListener('resize', function (e) {
            shopThumbs.forEach((thumb) => {
                equalize_image_height_to_width(thumb);
            });

            shopPlaceholders.forEach((placeholder) => {
                equalize_image_height_to_width(placeholder);
            });
        });
    }

});

function equalize_image_height_to_width(image) {
    let measurements = image.getBoundingClientRect();
    let width = Math.round(measurements.width * 10) / 10;
    image.style.height = width + "px";
}