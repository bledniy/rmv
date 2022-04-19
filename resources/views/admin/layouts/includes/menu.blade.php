<?php /** @var $item \App\Models\Admin\AdminMenu */ ?>
<ul class="nav pb-5 sidebar-menu dropdownMenu">
    @if($menu ?? false)
        @foreach($menu as $item)
            @include('admin.layouts.includes.admin-menu-nested')
        @endforeach
    @endif

    <li class="nav-item mt-3 text-center">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary">
                <b>{{ __('Выйти') }}</b>
            </button>
        </form>
    </li>
</ul>
