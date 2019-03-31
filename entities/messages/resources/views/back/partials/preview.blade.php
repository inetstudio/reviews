@if ($item->hasMedia('files'))
    @php
        $media = $item->getMedia('files')
    @endphp
    @foreach ($media as $mediaItem)
        @if ($mediaItem->mime_type == 'image/jpeg')
            <a data-fancybox="carousel-{{ $item['id'] }}" href="{{ url($mediaItem->getUrl()) }}" {!! (! $loop->first) ? 'style="display: none"' : '' !!}>
                <img src="{{ url($mediaItem->getUrl('review_admin_'.$conversion)) }}" class=" m-b-md img-fluid" alt="post_image">
            </a>
        @else
            @php
                $coverId = $mediaItem->getCustomProperty('cover');
                $cover = \Spatie\MediaLibrary\Models\Media::find($coverId)->first();
            @endphp
            <a data-fancybox="carousel-{{ $item['id'] }}" data-width="640" data-height="360" href="{{ url($mediaItem->getUrl()) }}">
                <img class="card-img-top img-fluid" src="{{ url($cover->getUrl('cover_review_admin_'.$conversion)) }}" />
            </a>
        @endif
    @endforeach
@endif
