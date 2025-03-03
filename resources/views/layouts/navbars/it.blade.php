<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">IT</a>
    <ul class="dropdown-menu shadow">

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Poczta</a>
            <ul class="dropdown-menu shadow">
                <li><a class="dropdown-item" href="{{ route('it.aliases') }}">Aliasy</a></li>
                <li><a class="dropdown-item" href="#">Białe listy</a></li>
            </ul>
        </li>

        {{--        @if (Auth::user()->hasRole('Super Admin'))--}}
        {{--            <li class="dropend">--}}
        {{--                <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Kadry</a>--}}
        {{--                <ul class="dropdown-menu dropdown-submenu shadow">--}}
        {{--                    --}}{{--                @canany(['create-user', 'edit-user', 'delete-user'])--}}
        {{--                    <li><a class="dropdown-item" href="{{ route('employees.index') }}">Procownicy</a></li>--}}
        {{--                    --}}{{--                @endcanany--}}
        {{--                    <li><a class="dropdown-item" href="{{ route('sections.index') }}">Działy</a></li>--}}
        {{--                    <li><a class="dropdown-item" href="{{ route('workplaces.index') }}">Stanowiska</a></li>--}}
        {{--                </ul>--}}
        {{--            </li>--}}
        {{--        @endif--}}

        {{--        @canany(['create-product', 'edit-product', 'delete-product'])--}}
        {{--            <li><a class="dropdown-item" href="{{ route('products.index') }}">Produkty</a></li>--}}
        {{--        @endcanany--}}

        {{--        --}}{{--        <li class="dropend">--}}
        {{--        --}}{{--            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Struktura</a>--}}
        {{--        --}}{{--            <ul class="dropdown-menu shadow">--}}
        {{--        --}}{{--            </ul>--}}
        {{--        --}}{{--        </li>--}}

        {{--        <li>--}}
        {{--            <hr class="dropdown-divider">--}}
        {{--        </li>--}}
{{--        <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
    </ul>
</li>
