@extends('layouts.app')
{{--@dump($patrons)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <section data-name="filters">
{{--                <input type="hidden" name="patron_altum_id" id="patron_altum_id" value="0">--}}

                <div class="card-header">
                    <div class="row">
                        <div class="col-2">Koszty i zyski&nbsp;&nbsp;&nbsp;</div>
                        <div class="col-8">
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>

                <div class="card-body">

                </div>

            </section>
        </div>

    </div>

@endsection
@section('js')
{{--    <script src="{{ asset('js/reports/reports.js') }}" type="module"></script>--}}
@endsection
