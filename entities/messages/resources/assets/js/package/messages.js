let messages = {};

messages.init = function () {
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
                let $ratingEl = $(this),
                    rating = $ratingEl.prev().val();
                $ratingEl.rateYo('option', 'rating', rating);
            });
        }

        $('#message_modal').on('hidden.bs.modal', function (e) {
            let modal = $(this);

            modal.find('.form-group').removeClass('has-error');
            modal.find('span.help-block').remove();

            modal.find('.modal-header h1').text('Создание отзыва');
            modal.find('form').attr('action', route('back.reviews.messages.store'));
            modal.find('input[name=_method]').val('POST');
            modal.find('input[name=message_id]').val('');
            modal.find('select[name=site_id]').val(null).trigger('change');
            modal.find('input[name=title]').val('');
            modal.find('input[name=user_name]').val('');
            modal.find('input[name=user_link]').val('');
            modal.find('input[name=link]').val('');
            modal.find('input[name=rating]').val(0);
            modal.find('.rating').rateYo('option', 'rating', 0);
            window.tinymce.get('modal_message').setContent('');
            modal.find('[name=is_active][value=1]').iCheck('check');
        });

        $('#messages_list_modal').on('hidden.bs.modal', function (e) {
            let modal = $(this);

            modal.find('.messages-list tr[class!=message-tr-template]').remove();
        });
    });
};

module.exports = messages;
