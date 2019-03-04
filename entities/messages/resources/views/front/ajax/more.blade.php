@foreach ($messages['items'] as $messageItem)
    @include('admin.module.reviews.messages::front.list_item', [
        'messageItem' => $messageItem,
    ])
@endforeach

@if ($messages['stop'])[end]@endif
