<table class="pkp-datatable table">
    <thead>
        <tr>
            <th>#</th>
            <th>From</th>
            <th>Until</th>
            <th>Rate</th>
            <th>Description</th>
            @can('edit bpjs_pph21')
            <th>Action</th>
            @endcan
        </tr>
    </thead>
</table>

<!-- Modal to editPkp -->
<div class="modal fade text-start" id="editPkp" tabindex="-1" aria-labelledby="editPkp" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="editPkpLabel">Edit PPH21 PKP</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formEditPkp">
            <div class="modal-body">
                <input type="hidden" id="pkp_id">
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">From<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="from" placeholder="0" name="from">
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Until<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="until" placeholder="0" name="until">
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Rate<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="rate" placeholder="0" name="rate">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="description" placeholder="Description" name="description">
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