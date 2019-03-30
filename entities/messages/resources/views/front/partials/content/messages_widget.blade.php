@inject('messagesService', 'InetStudio\Reviews\Messages\Contracts\Services\Front\ItemsServiceContract')

@php
    $messages = $messagesService->getItemById($ids, [
        'columns' => ['user_name'],
    ]);
    $messages = $messages->where('is_active', 1);
@endphp
