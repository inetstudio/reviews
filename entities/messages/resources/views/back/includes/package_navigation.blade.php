@inject('messagesService', 'InetStudio\Reviews\Messages\Contracts\Services\Back\ItemsServiceContract')

@php
    $unreadBadge = $messagesService->getUnreadMessagesCount();
@endphp

<li class="{{ isActiveRoute('back.reviews.messages.*') }}">
    <a href="{{ route('back.reviews.messages.index') }}">Сообщения<span class="label label-primary float-right">{{ $unreadBadge }}</span></a>
</li>
