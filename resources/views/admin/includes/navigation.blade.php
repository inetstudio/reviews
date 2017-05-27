<li class="{{ isActiveMatch('reviews') }}">
    <a href="#"><i class="fa fa-comment-o"></i> <span class="nav-label">Пользовательские отзывы </span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ isActiveMatch('reviews/reviews') }}">
            <a href="{{ route('back.reviews.feedbacks.index') }}">Отзывы</a>
        </li>
        <li class="{{ isActiveMatch('reviews/sites') }}">
            <a href="{{ route('back.reviews.sites.index') }}">Сайты с отзывами</a>
        </li>
    </ul>
</li>