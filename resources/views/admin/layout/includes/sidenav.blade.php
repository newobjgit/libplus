{{-- Side Navigation --}}
<div class="col-md-2">
    <div class="sidebar content-box" style="display: block;">
        <ul class="nav">
            <!-- Main menu -->
            <li class="sub-menu"><a href="{{route('admin')}}"><i class="glyphicon glyphicon-home"></i>
                    Головна панель</a></li>
            <li class="sub-menu"><a href="{{route('register')}}"><i class="glyphicon glyphicon-user"></i>Зареєструвати </a> </li>
            <li class="sub-menu"><a href="{{route('create')}}"><i class="glyphicon glyphicon-plus"></i>Додати документ</a> </li>
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i>Налаштування
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li class="sub-menu"><a href="{{route('user.index')}}"><i class="glyphicon glyphicon-pencil"></i>
                            Користувачі</a></li>
                </ul>
                <!-- Sub menu -->
                <ul>
                    <li class="sub-menu"><a href="{{route('role.index')}}"><i class="glyphicon glyphicon-pencil"></i>
                            Ролі</a></li>
                </ul>

                <ul>
                    <li class="sub-menu"><a href="{{route('addForm')}}"><i class="glyphicon glyphicon-pencil"></i>
                            Змінити структуру меню</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div> <!-- ADMIN SIDE NAV-->