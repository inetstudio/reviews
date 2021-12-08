<li class="{{ isActiveRoute('back.reviews.*', 'mm-active') }}">
    <a href="#" aria-expanded="false"><i class="fa fa-comment"></i> <span class="nav-label">Отзывы</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        @include('admin.module.reviews.sites::back.includes.package_navigation')
        @include('admin.module.reviews.messages::back.includes.package_navigation')
    </ul>
</li>
