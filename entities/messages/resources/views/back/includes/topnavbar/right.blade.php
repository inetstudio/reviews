@inject('messagesService', 'InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract')

@php
    $unreadBadge = $messagesService->getUnreadMessagesCount();
@endphp

<li class="dropdown">
    <a class="count-info" href="{{ route('back.reviews.messages.index') }}">
        <i class="fa fa-lg fa-comment"></i>  <span class="label label-primary">{{ $unreadBadge }}</span>
    </a>
</li>
