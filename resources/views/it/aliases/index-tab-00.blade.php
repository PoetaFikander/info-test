{{--@dump($aliases)--}}

<div class="container mt-1 p-2">


    <div class="row align-items-center mt-2">

        <div class="col-3">
            <div class="input-group input-group-sm">
                <label class="input-group-text">Alias</label>
                <input type="search" class="form-control" name="pAddress" value="" placeholder="wpisz fragment aliasu">
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-sm">
                <label class="input-group-text">Odbiorcy</label>
                <input type="search" class="form-control" name="pGoto" value="" placeholder="wpisz fragment adresu odbiorcy">
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-sm">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="aActive" id="aActive" checked>
                    <label class="form-check-label form-check-label-sm" for="aActive">Aliasy aktywne</label>
                </div>
                <div class="form-check form-check-inline ms-3">
                    <input class="form-check-input" type="checkbox" name="aInactive" id="aInactive">
                    <label class="form-check-label form-check-label-sm" for="aInactive">Aliasy nieaktywne</label>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-sm _justify-content-center">
                <button type="button" class="btn btn-secondary" name="btn-search"><i class="bi bi-search"></i>&nbsp;Szukaj</button>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col p-0">
            <hr class="my-2">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered table-hover table-vvsm _pointer" data-name="table-alias-list">
                <thead>
                <tr>
                    <th scope="col">Alias</th>
                    <th scope="col">Odbiorcy</th>
                    <th scope="col">Aktywny</th>
                </tr>
                </thead>
                <tbody class="table-group-divider"></tbody>
            </table>
        </div>
    </div>

</div>
