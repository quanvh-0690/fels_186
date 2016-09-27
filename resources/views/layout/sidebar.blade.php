<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        @if (!Auth::user()->isAdmin())
            <li class="current"><a href=""><i class="glyphicon glyphicon-home"></i> {{ trans('layout.sidebar.home') }} </a></li>
            <li><a href=""><i class="glyphicon glyphicon-list-alt"></i> {{ trans('layout.sidebar.word_list') }}</a></li>
            <li><a href=""><i class="glyphicon glyphicon-pencil"></i> {{ trans('layout.sidebar.start_lesson') }}</a></li>
        @else
            <li class="current"><a href=""><i class="fa fa-home"></i> {{ trans('layout.sidebar.home') }} </a></li>
            <li class="submenu">
                <a href="#">
                    <i class="fa fa-list"></i> {{ trans('layout.sidebar.categories') }}
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li><a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus"></i> {{ trans('layout.sidebar.add_category') }}</a></li>
                    <li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-list-alt"></i> {{ trans('layout.sidebar.list_categories') }}</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">
                    <i class="fa fa-book"></i> {{ trans('layout.sidebar.lessons') }}
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li><a href="{{ route('admin.lessons.create') }}"><i class="fa fa-plus"></i> {{ trans('layout.sidebar.add_lesson') }}</a></li>
                    <li><a href="{{ route('admin.lessons.index') }}"><i class="fa fa-list-alt"></i> {{ trans('layout.sidebar.list_lessons') }}</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">
                    <i class="fa fa-user-md"></i> {{ trans('layout.sidebar.users') }}
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li><a href="#"><i class="fa fa-user-plus"></i> {{ trans('layout.sidebar.add_user') }}</a></li>
                    <li><a href="#"><i class="fa fa-users"></i> {{ trans('layout.sidebar.list_users') }}</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>