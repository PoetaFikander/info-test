<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">BOK</a>
    <ul class="dropdown-menu shadow">

{{--        <li class="dropend">--}}
{{--            <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Kontrahenci</a>--}}
{{--            <ul class="dropdown-menu shadow">--}}
{{--                @canany(['show-device', 'edit-device', 'export-device'])--}}
{{--                    <li><a class="dropdown-item" href="{{ route('reports.dev') }}">Lista</a></li>--}}
{{--                @endcanany--}}
{{--            </ul>--}}
{{--        </li>--}}


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

    </ul>
</li>
