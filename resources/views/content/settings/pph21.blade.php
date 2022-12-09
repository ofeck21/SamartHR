<table class="pph21-datatable table">
    <thead>
        <tr>
            <th>#</th>
            <th>Class</th>
            <th>Code</th>
            <th>PTKP</th>
            <th>Description</th>
            @can('edit bpjs_pph21')
            <th>Action</th>
            @endcan
        </tr>
    </thead>
</table>

<!-- Modal to editPph21 -->
<div class="modal fade text-start" id="editPph21" tabindex="-1" aria-labelledby="editPph21" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="editPph21Label">Edit PPH21</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formEditPph21">
            <div class="modal-body">
                <input type="hidden" id="pph21_id">
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" id="pph21_code" placeholder="code" name="pph21_code" readonly disabled>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">PTKP<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="ptkp" placeholder="0" name="ptkp">
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