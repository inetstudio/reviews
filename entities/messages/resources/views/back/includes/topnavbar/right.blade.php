@inject('messagesService', 'InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesServiceContract')

@php
    $unreadBadge = $messagesService->getUnreadMessagesCount();
@endphp

<li>
    <a class="count-info" href="{{ route('back.reviews.messages.index') }}">
        <i class="fa fa-lg fa-comment"></i>  <span class="label label-primary">{{ $unreadBadge }}</span>
    </a>
</li>
