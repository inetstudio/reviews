@inject('messagesService', 'InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract')

@php
    $unreadBadge = $messagesService->getUnreadMessagesCount();
@endphp

<li class="{{ isActiveRoute('back.reviews.messages.*') }}">
    <a href="{{ route('back.reviews.messages.index') }}"><span class="nav-label">Сообщения</span><span class="label label-primary pull-right">{{ $unreadBadge }}</span></a>
</li>
