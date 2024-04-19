/*
Infinite scroll for news articles page
 */

// Load News articles on scroll, start with three articles showing
function inifinteScroll() {
    let showInitial = 3;
    let newsArticles = jQuery('.ancr_custom_news div.et_pb_media_alignment_center');

    newsArticles.hide();

    // show only the number set
    newsArticles.slice(0, showInitial).show();

    jQuery(window).scroll(function() {
        // On scroll, if page is 50 pixels from the bottom, show the next article
        if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 50) {

            if (newsArticles.length > showInitial) {
                newsArticles.slice(showInitial, showInitial + 1).delay(800).show();
                showInitial++;
            } else if (newsArticles.length === showInitial) {
                newsArticles.slice(showInitial, showInitial).delay(800).show();
            } else {

            }

        }
    });
}

// Document Ready
jQuery(function() {

    inifinteScroll();

});