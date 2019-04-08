<ul class="article-comments_list">
    @foreach ($messages['items'] as $messageItem)
        @include('admin.module.reviews.messages::front.list_item', [
            'messageItem' => $messageItem,
        ])
    @endforeach
</ul>

@if (! $messages['stop'])
    <div class="skin-btn-wrap">
        <a class="skin-btn skin-btn-reg ajax-loader" data-target=".article-comments_list"
           href="{{ route('front.reviews.messages.get', ['type' => $type, 'id' => $id]) }}">Больше отзывов</a>
    </div>
@endif
