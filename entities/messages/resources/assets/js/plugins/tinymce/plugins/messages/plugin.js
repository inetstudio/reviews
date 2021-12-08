import Swal from 'sweetalert2';

let messagesList = $('#messages_list_modal'),
    messageModal = $('#message_modal'),
    template = messagesList.find('.message-tr-template'),
    messagesWidgetID = '',
    contentEditor = undefined;

messagesList.find('.save').on('click', function (event) {
    event.preventDefault();

    let ids = _.compact(messagesList.find('input').map(function () {
            return $(this).val();
        }).get()),
        titles = _.compact(messagesList.find('.message-title span').map(function () {
            return $.trim($(this).text());
        }).get());

    if (ids.length !== 0) {
        window.Admin.modules.widgets.saveWidget(messagesWidgetID, {
            view: 'admin.module.reviews.messages::front.partials.content.messages_widget',
            params: {
                ids: ids
            },
            additional_info: {
                titles: titles
            }
        }, {
            editor: contentEditor,
            type: 'reviews.messages',
            alt: 'Виджет-отзывы'
        });
    }

    $('#messages_list_modal').modal('hide');
});

messagesList.find('.add_message').on('click', function (event) {
    event.preventDefault();

    $('#message_modal').modal();
});

messagesList.find('table').on('click', '.edit-message', function (event) {
    event.preventDefault();

    let messageID = $(this).parents('tr').find('input').first().val();

    $.ajax({
        url: route('back.reviews.messages.show', messageID),
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (typeof data.id !== 'undefined') {
                messageModal.find('.modal-header h1').text('Редактирование отзыва');
                messageModal.find('form').attr('action', route('back.reviews.messages.update', data.id));
                messageModal.find('input[name=_method]').val('PUT');
                messageModal.find('input[name=message_id]').val(data.id);
                messageModal.find('select[name=site_id]').val(data.site_id).trigger('change');
                messageModal.find('input[name=title]').val(data.title);
                messageModal.find('input[name=name]').val(data.name);
                messageModal.find('input[name=email]').val(data.email);
                messageModal.find('input[name=user_link]').val(data.user_link);
                messageModal.find('input[name=link]').val(data.link);
                messageModal.find('input[name=rating]').val(data.rating);
                messageModal.find('.rating').rateYo('option', 'rating', data.rating);
                window.tinymce.get('modal_message').setContent(data.message);
                messageModal.find('[name=is_active][value=' + data.is_active + ']').iCheck('check');

                $('#message_modal').modal();
            }
        },
        error: function () {
            Swal.fire({
                title: "Ошибка",
                text: "При получении отзыва произошла ошибка",
                icon: "error"
            });
        }
    });
});

messagesList.find('table').on('click', '.delete-message', function (event) {
    event.preventDefault();

    let button = $(this);

    button.parents('tr').remove();
});

messageModal.find('.save').on('click', function (event) {
    event.preventDefault();

    let form = messageModal.find('form'),
        data = form.serializeJSON();

    data.message.text = window.tinymce.get('modal_message').getContent();

    messageModal.find('.form-group').removeClass('has-error');
    messageModal.find('span.form-text').remove();

    $.ajax({
        'url': form.attr('action'),
        'type': form.attr('method'),
        'data': data,
        'dataType': 'json',
        'success': function (data) {
            if (data.success === true) {
                let existElement = messagesList.find('[data-id=' + data.id + ']');

                if (existElement.length > 0) {
                    existElement.find('.message-title span').text(data.title);
                } else {
                    addReviewToList(data);
                }

                $('#message_modal').modal('hide');
            }
        },
        'error': function (data) {
            for (let field in data.responseJSON.errors) {
                let fieldName = dotToArray(field);
                let input = messageModal.find('[name="' + fieldName + '"]');

                if (input.length > 0) {
                    input.parents('.form-group').addClass('has-error');

                    let errorMessages = data.responseJSON.errors[field];

                    errorMessages.forEach(function (errorMessage) {
                        let errorElement = $('<span class="form-text m-b-none">' + errorMessage + '</span>');

                        errorElement.insertAfter(input);
                    })
                }
            }
        }
    });
});

window.tinymce.PluginManager.add('reviews.messages', function (editor) {
    editor.addButton('add_messages_list', {
        title: 'Отзывы',
        icon: 'bubble',
        onclick: function () {
            let content = editor.selection.getContent();

            contentEditor = editor;

            if (content !== '' && !/<img class="content-widget".+data-type="reviews\.messages".+\/>/g.test(content)) {
                Swal.fire({
                    title: "Ошибка",
                    text: "Необходимо выбрать виджет-отзывы",
                    icon: "error"
                });

                return false;
            } else if (content !== '') {
                messagesWidgetID = $(content).attr('data-id');

                window.Admin.modules.widgets.getWidget(messagesWidgetID, function (widget) {
                    let titles = widget.additional_info.titles;

                    widget.params.ids.forEach(function (id, index) {
                        addReviewToList({
                            id: id,
                            title: titles[index]
                        });
                    })
                });
            } else {
                messagesWidgetID = '';
            }

            $('#messages_list_modal').modal();
        }
    })
});

function addReviewToList(data) {
    let element = template.clone();

    element.attr('data-id', data.id);
    element.removeClass('message-tr-template');
    element.removeAttr('style');
    element.find('.message-title span').text(data.title);
    element.find('input').val(data.id);
    element.appendTo(messagesList.find('.messages-list > tbody'));
}

function dotToArray(field) {
    let parts = field.split('.'),
        result = '';

    parts.forEach(function (part, index) {
        result += part;

        result += (index === 0) ? '[' : '][';
    });

    return result.substr(0, result.length - 1);
}
