
// Pause Carousel header and logos on mouseover

function pauseCarousel() {
    jQuery('.ds-carousel-section-container').on({
        mouseenter: function () {
            jQuery('.ds-image-carousel > .et-last-child').addClass('paused');
            jQuery('.sponsors-header').addClass('paused');
            jQuery('.members-header').addClass('paused');
        },
        mouseleave: function () {
            jQuery('.ds-image-carousel > .et-last-child').removeClass('paused');
            jQuery('.sponsors-header').removeClass('paused');
            jQuery('.members-header').removeClass('paused');
        }
    });
}

// Document Ready
jQuery(function() {

    pauseCarousel();

});
