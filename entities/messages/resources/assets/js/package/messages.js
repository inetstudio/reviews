let messages = {};

messages.init = function () {
    let $table = $('#messages_table .dataTable');
    let $tableContent = $('#messages_table .ibox-content');

    $table.on('ifClicked', '#message_all', function () {
        $('.group-element').iCheck('toggle');
    });

    $('#messages_table .table-group-buttons a').on('click', function () {
        let $btn = $(this);

        let url = $btn.data('url');
        let data = $table.find('.group-element').serializeJSON();

        swal({
            title: "Вы уверены?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Отмена",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да"
        }).then((result) => {
            if (result.value) {
                $tableContent.toggleClass('sk-loading');

                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        $tableContent.toggleClass('sk-loading');
                        $('#message_all').iCheck('uncheck');

                        if (data.success === true) {
                            swal({
                                title: "Записи обновлены",
                                type: "success"
                            });
                            $table.DataTable().ajax.reload(null, false);
                        } else {
                            showError('При обновлении записей произошла ошибка');
                        }
                    },
                    error: function () {
                        $tableContent.toggleClass('sk-loading');
                        $('#message_all').iCheck('uncheck');

                        showError('При обновлении записей произошла ошибка');
                    }
                });
            }
        });
    });

    $table.on('draw.dt', function () {
        if ($('.i-checks').length > 0) {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        }

        let $switchers = $table.find('input.switchery');

        $switchers.each(function () {
            new Switchery($(this).get(0), {
                size: 'small'
            });
        });

        $switchers.on('change', function () {
            let $input = $(this);

            let url = $input.data('target');
            let val = $input.val();

            $tableContent.toggleClass('sk-loading');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: {
                    messages: [val]
                },
                success: function (data) {
                    $tableContent.toggleClass('sk-loading');

                    if (data.success === true) {
                        swal({
                            title: "Запись изменена",
                            type: "success"
                        });
                    } else {
                        showError('Произошла ошибка');
                    }
                },
                error: function () {
                    $tableContent.toggleClass('sk-loading');

                    showError('Произошла ошибка');
                }
            });
        });
    });

    function showError(text) {
        swal({
            title: "Ошибка",
            text: text,
            type: "error"
        });
    }
    
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
            modal.find('input[name=name]').val('');
            modal.find('input[name=email]').val('');
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
