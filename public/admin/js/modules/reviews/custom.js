$(document).ready(function(){

    if ($('.tinymce').length > 0) {
        tinymce.init({
            selector: '.tinymce',
            height: 500,
            menubar: false,
            plugins: [
            ],
            toolbar: false,
        });
    }

    if ($('.select2').length > 0) {
        $('.select2').select2();
    }

    if ($('.rating').length > 0) {
        $('.rating').rateYo({
            rating: 0,
            ratedFill: '#1ab394',
            fullStar: true,
            onChange: function (rating, rateYoInstance) {
                $(this).prev().val(rating);
            }
        });

        $('.rating').each(function () {
            var $ratingEl = $(this);
            var rating = $ratingEl.prev().val();
            $ratingEl.rateYo('option', 'rating', rating);
        });
    }

    if ($('.fancybox-video-link').length > 0) {
        $('.fancybox-video-link').fancybox({
            onComplete: function() {
                this.$content.find('video').trigger('play')
                this.$content.find('video').on('ended', function() {
                    $.fancybox.close();
                });
            }
        });
    }

    $('.table').on('click', '.delete', function (event) {
        event.preventDefault();

        $button = $(this);

        swal({
            title: 'Вы уверены?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Отмена',
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Да, удалить',
            closeOnConfirm: true
        }, function () {
            $.ajax({
                url: $button.attr('data-url'),
                method: 'POST',
                dataType: 'json',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success == true) {
                        $button.closest('tr').remove();
                        swal({
                            title: 'Запись удалена',
                            type: 'success'
                        });
                    } else {
                        swal({
                            title: 'Ошибка',
                            text: 'При удалении произошла ошибка',
                            type: 'error'
                        });
                    }
                }
            });
        });
    });
});
