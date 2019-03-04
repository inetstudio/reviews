<li>
    @if (in_array('admin', $messageItem['user']['roles']))
        <span class="article-comments_list-name editor">Редакция <i class="icon-logo"></i></span>
    @else
        <span class="article-comments_list-name">{{ $messageItem['user']['name'] }}</span>
    @endif

    <span class="article-comments_list-time">{{ \Illuminate\Support\Carbon::formatTime($messageItem['datetime']) }}</span>
    <span class="article-comments_list-text">{{ $messageItem['message'] }}</span>
</li>
