<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Serwis</a>
    <ul class="dropdown-menu shadow">

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Kontrahenci</a>
            <ul class="dropdown-menu shadow">
                @canany(['show-customer', 'edit-customer', 'export-customer'])
                    <li><a class="dropdown-item" href="{{ route('reports.cust') }}">Lista</a></li>
                @endcanany
            </ul>
        </li>

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Urządzenia</a>
            <ul class="dropdown-menu shadow">
                @canany(['show-device', 'edit-device', 'export-device'])
                    <li><a class="dropdown-item" href="{{ route('reports.dev') }}">Lista</a></li>
                @endcanany
            </ul>
        </li>

        <li class="dropend">
            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Zlecenia serwisowe</a>
            <ul class="dropdown-menu shadow">
                {{-- todo tymczasowe uprawnienia--}}
                @canany(['show-device', 'edit-device', 'export-device'])
                    <li><a class="dropdown-item" href="{{ route('reports.wc') }}">Lista</a></li>
                @endcanany
            </ul>
        </li>

{{--        <li class="dropend">--}}
{{--            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">Technicy</a>--}}
{{--            <ul class="dropdown-menu shadow">--}}
{{--                <li><a class="dropdown-item" href="#">Lista</a></li>--}}
{{--                --}}{{--                @if (Auth::user()->hasRole('Super Admin'))--}}
{{--                --}}{{--                    <li><a class="dropdown-item" href="{{ route('reports.mif.basic-full') }}">Podstawowy full</a></li>--}}
{{--                --}}{{--                    <li><a class="dropdown-item" href="{{ route('reports.mif.basic-limited') }}">Podstawowy limit</a></li>--}}
{{--                --}}{{--                @else--}}
{{--                --}}{{--                    @canany(['show-mif-full'])--}}
{{--                --}}{{--                        <li><a class="dropdown-item" href="{{ route('reports.mif.basic-full') }}">Podstawowy</a></li>--}}
{{--                --}}{{--                    @endcanany--}}
{{--                --}}{{--                    @canany(['show-mif-limited'])--}}
{{--                --}}{{--                        <li><a class="dropdown-item" href="{{ route('reports.mif.basic-limited') }}">Podstawowy</a></li>--}}
{{--                --}}{{--                    @endcanany--}}
{{--                --}}{{--                @endif--}}


{{--                --}}{{--                    <li><a class="dropdown-item" href="#">Inny</a></li>--}}
{{--                --}}{{--                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Role</a></li>--}}
{{--                --}}{{--                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Użytkownicy</a></li>--}}
{{--                --}}{{--                    <li><a class="dropdown-item" href="{{ route('products.index') }}">Produkty</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}


    </ul>
</li>
