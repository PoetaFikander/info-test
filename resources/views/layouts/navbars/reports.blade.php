<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Raporty</a>
    <ul class="dropdown-menu shadow">

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">MIF</a>
            <ul class="dropdown-menu shadow">

                @if (Auth::user()->hasRole('Super Admin'))
                    <li><a class="dropdown-item" href="{{ route('reports.mif.basic-full') }}">Podstawowy full</a></li>
                    <li><a class="dropdown-item" href="{{ route('reports.mif.basic-limited') }}">Podstawowy limit</a></li>
                @else
                    @canany(['show-mif-full'])
                        <li><a class="dropdown-item" href="{{ route('reports.mif.basic-full') }}">Podstawowy</a></li>
                    @endcanany
                    @canany(['show-mif-limited'])
                        <li><a class="dropdown-item" href="{{ route('reports.mif.basic-limited') }}">Podstawowy</a></li>
                    @endcanany
                @endif


                {{--                    <li><a class="dropdown-item" href="#">Inny</a></li>--}}
                {{--                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Role</a></li>--}}
                {{--                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Użytkownicy</a></li>--}}
                {{--                    <li><a class="dropdown-item" href="{{ route('products.index') }}">Produkty</a></li>--}}
            </ul>
        </li>

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Umowy</a>
            <ul class="dropdown-menu shadow">
{{--                <li><a class="dropdown-item" href="{{ route('reports.agr.cap-full') }}">Koszty i zyski - full</a></li>--}}
            </ul>
        </li>

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Kontrahenci</a>
            <ul class="dropdown-menu shadow">
                <li><a class="dropdown-item" href="{{ route('reports.cust') }}">Lista</a></li>
{{--                <li><a class="dropdown-item" href="{{ route('reports.cust.cap-full') }}">Koszty i zyski - full</a></li>--}}
            </ul>
        </li>

    </ul>
</li>
