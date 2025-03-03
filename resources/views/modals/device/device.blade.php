<div class="modal modal-type-1" tabindex="-1" id="my-modal-id" data-name="modal" aria-labelledby="modal-label" aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog modal-xxl">
        <!-- content -->
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header p-2">
                <div class="row">
                    <div class="modal-title">
                        <h4 class="me-4 dev_no"></h4><h6 class="status"></h6>
                    </div>
                </div>
                <button type="button" class="btn-close btn-sm me-4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- end header -->
            <!-- body -->
            <div class="modal-body">
                <div class="container-fluid" data-name="tabs" id="tabs">
                    <!-- nav-tab -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#default" class="nav-link active" data-bs-toggle="tab">Parametry podstawowe</a>
                        </li>
                        <li class="nav-item">
                            <a href="#counters" class="nav-link" data-bs-toggle="tab">Liczniki</a>
                        </li>
                        <li class="nav-item">
                            <a href="#workCards" class="nav-link" data-bs-toggle="tab">Zlecenia</a>
                        </li>
                        <li class="nav-item" data-is-agreement="yes">
                            <a href="#agrHeader" class="nav-link" data-bs-toggle="tab">Aktualna umowa</a>
                        </li>
                        <li class="nav-item" data-is-agreement="yes">
                            <a href="#agrParameters" class="nav-link" data-bs-toggle="tab">Parametry umowy</a>
                        </li>
                        <li class="nav-item" data-is-agreement="yes">
                            <a href="#devAddresses" class="nav-link" data-bs-toggle="tab">Adresy, stawki, ustalenia</a>
                        </li>
                    </ul>
                    <!-- end nav-tab -->
                    <!-- tab-content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="default">
                            @include('modals.device.device-tab-00')
                        </div>
                        <div class="tab-pane fade" id="counters">
                            @include('modals.device.device-tab-03')
                        </div>
                        <div class="tab-pane fade" id="workCards">
                            @include('modals.device.device-tab-04')
                        </div>
                        <div class="tab-pane fade" id="agrHeader">
                            @include('modals.device.device-tab-01')
                        </div>
                        <div class="tab-pane fade" id="agrParameters">
                            @include('modals.device.device-tab-02')
                        </div>
                        <div class="tab-pane fade" id="devAddresses">
                            @include('modals.device.device-tab-05')
                        </div>
                    </div>
                    <!-- end tab-content -->
                </div>
            </div>
            <!-- end body -->
            <!-- footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Zamknij</button>
            </div>
            <!-- end footer -->
        </div>
        <!-- end content -->
    </div>
    <!-- end dialog -->
</div>
