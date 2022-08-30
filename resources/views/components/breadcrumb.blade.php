@if (Request::is('admin/home'))
    <ul class="breadcrumbs">
        @for ($i = 0; $i < sizeof(session('history')); $i++)
            <li class="nav-home">
                <a href="{{ session('history')[$i]['route'] }}" class="text-white">
                    {{ session('history')[$i]['name'] }}
                </a>
            </li>
            @if ($i != sizeof(session('history')) - 1)
                <li class="separator">
                    <i class="flaticon-right-arrow text-white"></i>
                </li>
            @endif
        @endfor
    </ul>
@else
    <ul class="breadcrumbs">
        @for ($i = 0; $i < sizeof(session('history')); $i++)
            <li class="nav-home">
                <a href="{{ session('history')[$i]['route'] }}">
                    {{ session('history')[$i]['name'] }}
                </a>
            </li>
            @if ($i != sizeof(session('history')) - 1)
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
            @endif
        @endfor
    </ul>
@endif
