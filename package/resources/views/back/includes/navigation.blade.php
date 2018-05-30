<li class="{{ isActiveRoute('back.reviews.*') }}">
    <a href="#"><i class="fa fa-comment-o"></i> <span class="nav-label">Отзывы</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        @include('admin.module.reviews.sites::back.includes.package_navigation')
        @include('admin.module.reviews.messages::back.includes.package_navigation')
    </ul>
</li>
