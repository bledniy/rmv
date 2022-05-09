<?php /** @var $faculty \App\Models\Faculty\Faculty[] */ ?>
<?php /** @var $department \App\Models\Department\Department[] */ ?>
<header class="header">
    <div class="container">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/Logo.jpg') }}" width="50" height="50">
                </a>
            </li>
            <li class="nav-item dropdown">
                <p class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">Склад ради</p>
                <div class="dropdown-menu">
                    @foreach($faculties as $faculty)
                        <a href="{{route('faculty.show', $faculty->getKey())}}"
                           class="dropdown-item">{{$faculty->getTitle()}}</a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <p class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">Відділи</p>
                <div class="dropdown-menu">
                    @foreach($departments as $department)
                        <a href="{{route('department.show', $department->getKey())}}"
                           class="dropdown-item">{{$department->getTitle()}}</a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Контакти</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Новини</a>
            </li>
        </ul>
    </div>
</header>