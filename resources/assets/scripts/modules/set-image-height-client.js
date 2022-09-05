const shopThumbs = document.querySelectorAll('.products .product .woocommerce-loop-product__link .attachment-woocommerce_thumbnail');
const shopPlaceholders = document.querySelectorAll('.products .product .woocommerce-loop-product__link .woocommerce-placeholder');

const handPickedProductsContainer = $('.wp-block-handpicked-products , .wc-block-handpicked-products');

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

    if (handPickedProductsContainer) {
        console.log("SHOW HAND PICKED PRODUCTS INFO");
        console.log(handPickedProductsContainer);
        console.log("SHOW HANDPICKED PRODUCTS CONTAINER CHILDREN");

        const handPickedProductsInner = handPickedProductsContainer.children(0);
        console.log(handPickedProductsInner);

        console.log('LOOP THROUGH EVERY PRODUCT IN THE INNER CONTAINER');
        handPickedProductsInner.children().each(function (index) {
            console.log('FIND THE THUMBNAIL OR PLACEHOLDER OF THE PRODUCT');
            let productThumb = $(this).find('.wc-block-grid__product-link .wc-block-grid__product-image .attachment-woocommerce_thumbnail , .wc-block-grid__product-link .wc-block-grid__product-image .woocommerce-placeholder');

            if (productThumb.length >= 1) {
                // equalize_image_height_to_width(productThumb);
                console.log("PRODUCT THUMBNAIL DATA");
                console.log(productThumb);

                equalize_image_height_to_width(productThumb.get(0));
            }
        })
    }

});

function equalize_image_height_to_width(image) {
    let measurements = image.getBoundingClientRect();
    let width = Math.round(measurements.width * 10) / 10;
    image.style.height = width + "px";
}