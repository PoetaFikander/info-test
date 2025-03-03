<div class="row mt-2">
    <div class="col">
        <section data-name="filters">

            <div class="row">
                <fieldset class="border rounded-2 border-1 pb-2">
                    <legend class="float-none w-auto px-3 mb-1" data-name="inst-addr-legend">
                        <span>Adres instalacji</span>&nbsp;-&nbsp;<span data-name="inst-addr-status"></span>
                    </legend>
                    <div class="input-group">
                        <label class="input-group-text label-min-width-120">Adres</label>
                        <input type="text" class="form-control form-control-sm" name="ai_installation_address" data-value-type="select"
                               data-label="Adres instalacji" readonly/>
                        <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                    </div>
                    <div class="input-group mt-1">
                        <label class="input-group-text label-min-width-120">Uzupełnienie</label>
                        <input type="text" class="form-control form-control-sm" name="ai_installation_address_add_data" data-value-type="text"
                               data-label="Adres instalacji - uzupełnienie" readonly/>
                        <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                    </div>
                </fieldset>
            </div>

            <div class="row mt-2">
                <fieldset class="border rounded-2 border-1 pb-2">
                    <legend class="float-none w-auto px-3 mb-1" data-name="toner-addr-legend">
                        <span>Adres dostawy tonerów</span>&nbsp;-&nbsp;<span data-name="toner-addr-status"></span>
                    </legend>
                    <div class="input-group">
                        <label class="input-group-text label-min-width-120">Adres</label>
                        <input type="text" class="form-control form-control-sm" name="ai_toner_address" data-value-type="select"
                               data-label="Adres dostawy tonerów" readonly/>
                        <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                    </div>
                    <div class="input-group mt-1">
                        <label class="input-group-text label-min-width-120">Uzupełnienie</label>
                        <input type="text" class="form-control form-control-sm" name="ai_toner_address_add_data" data-value-type="text"
                               data-label="Adres dostawy tonerów - uzupełnienie" readonly/>
                        <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                    </div>
                </fieldset>
            </div>

            <div class="row mt-2">
                <fieldset class="border rounded-2 border-1 pb-2">
                    <legend class="float-none w-auto px-3 mb-1">Stawki</legend>
                    <table class="table table-striped table-sm table-hover" data-name="table-rates">
                        <thead>
                        <tr>
                            <th scope="col">Lp</th>
                            <th scope="col">Kod usługi</th>
                            <th scope="col">Cena</th>
                            <th scope="col">Liczba kopii w CNU</th>
                            <th scope="col">Odliczaj liczniki</th>
                            <th scope="col">Centrum</th>
                            <th scope="col">Dane dodatkowe</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider"></tbody>
                    </table>
                </fieldset>
            </div>

            <div class="row mt-2">
                <fieldset class="border rounded-2 border-1 pb-2">
                    <legend class="float-none w-auto px-3 mb-1">Dodatkowe ustalenia z klientem</legend>
                    <div class="input-group">
                        <textarea class="form-control" name="ai_description" spellcheck="false" data-value-type="textarea"
                                  data-label="Dodatkowe ustalenia z klientem" disabled></textarea>
                        <span class="input-group-text">
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai">
                                <i class="bi-pencil-square"></i>
                            </button>
                        </span>
                    </div>
                </fieldset>
            </div>

        </section>
    </div>
</div>
