<div class="modal modal-type-1" tabindex="-1" data-bs-keyboard="false" id="my-modal-id" data-name="modal" aria-labelledby="modal-label" aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog _modal-dialog-centered _modal-xxl">
        <!-- content -->
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header p-2">
                <div class="row">
                    <h5 class="modal-title"></h5>
                </div>
                <button type="button" class="btn-close btn-sm me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- end header -->
            <!-- body -->
            <div class="modal-body">
                <section data-name="filters">

                    <input type="hidden" name="column_name" value="">

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text label-min-width-120" for="current-value">Aktualna wartość</label>
                        <input type="text" class="form-control" id="current-value" name="current_value_txt" disabled>
                    </div>

                    <div class="input-group input-group-sm">
                        <label class="input-group-text label-min-width-120" for="new-value">Nowa wartość</label>
                        <input type="text" class="form-control" id="new_value" name="new_value">
                    </div>

                </section>
            </div>
            <!-- end body -->
            <!-- footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-name="btn-save">Zapisz zmiany</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Zamknij</button>
            </div>
            <!-- end footer -->
        </div>
        <!-- end content -->
    </div>
    <!-- end dialog -->
</div>
