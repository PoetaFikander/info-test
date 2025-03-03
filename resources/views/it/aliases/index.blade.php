@extends('layouts.app')
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <div class="card-header">Aliasy</div>
            <div class="card-body">
                <div class="container-fluid px-0" data-name="tabs" id="tabs">
                    <!-- nav-tab -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#default" class="nav-link active" data-bs-toggle="tab">Lista</a>
                        </li>
                        <li class="nav-item">
                            <a href="#modify" class="nav-link" data-bs-toggle="tab">Modyfikacja</a>
                        </li>
                    </ul>
                    <!-- end nav-tab -->
                    <!-- tab-content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="default">
                            <section data-name="filters-tab-00">
                                @include('it.aliases.index-tab-00')
                            </section>
                        </div>
                        <div class="tab-pane fade" id="modify">
                            @include('it.aliases.index-tab-01')
                        </div>
                    </div>
                    <!-- end tab-content -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/it/it.js') }}" type="module"></script>
@endsection
