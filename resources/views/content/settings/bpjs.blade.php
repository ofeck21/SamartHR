<table class="bpjs-datatable table">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Employee</th>
            <th>Company</th>
            <th>Total</th>
            @can('edit bpjs_pph21')
            <th>Action</th>
            @endcan
        </tr>
    </thead>
</table>

<!-- Modal to editBpjs -->
<div class="modal fade text-start" id="editBpjs" tabindex="-1" aria-labelledby="editBpjs" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="editBpjsLabel">Edit BPJS</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formEditBpjs">
            <div class="modal-body">
                <input type="hidden" id="bpjs_id">
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Employee<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="employee" placeholder="0" name="employee">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Company<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="company" placeholder="0" name="company">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> Save</button>
            </div>
        </form>
        </div>
    </div>
</div>