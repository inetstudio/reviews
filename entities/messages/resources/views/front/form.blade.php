<p class="article-comments_h">Оставьте <br>отзыв</p>
<form method="post" action="{{ route('front.reviews.messages.send', ['type' => $type, 'id' => $id]) }}">
    {{ csrf_field() }}
    <div class="form-row">
        <textarea name="message" class="skin-textarea start-watch" placeholder="Текст отзыва..."></textarea>
    </div>
    <div class="article-comments_user">
    @if (! \Auth::user())
        <div class="form-row split-row">
            <input type="text" name="name" class="bordered" placeholder="Ваше имя">
        </div>
        <div class="form-row split-row last">
            <input type="email" name="email" class="bordered" placeholder="Ваш email">
        </div>
        <div class="form-row recaptcha-place" id="recaptcha-place-{{$id}}">
            {!! Captcha::display() !!}
        </div>
    @endif
    <div class="skin-btn-wrap">
        <input type="submit" value="Отправить" class="skin-btn skin-btn-reg2 ajax-submit" data-prevent="false" data-msg="true" data-href="{{ route('front.reviews.messages.send', ['type' => $type, 'id' => $id]) }}" name="">
    </div>
    </div>
</form>
