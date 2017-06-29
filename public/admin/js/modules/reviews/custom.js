/** global: tinymce */

$(document).ready(function(){

    if ($('.rating').length > 0) {
        $('.rating').rateYo({
            rating: 0,
            ratedFill: '#1ab394',
            fullStar: true,
            onChange: function (rating) {
                $(this).prev().val(rating);
            }
        });

        $('.rating').each(function () {
            var $ratingEl = $(this);
            var rating = $ratingEl.prev().val();
            $ratingEl.rateYo('option', 'rating', rating);
        });
    }
});
