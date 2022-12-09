@extends('layouts/contentLayoutMaster')

@section('title', 'BPJS & PPH21')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
  <style>
    .btn_set { display: none;}
  </style>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">BPJS & PPH21</h4>
                <button class="btn btn-outline-primary btn_set" id="set_bpjs">Set BPJS</button>
                <button class="btn btn-outline-primary btn_set" id="set_ptkp">Set PPH21 PTKP</button>
                <button class="btn btn-outline-primary btn_set" id="set_pkp">Set PPH21 PKP</button>
            </div>
            <div class="card-body border-top pt-2">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="tabVerticalLeft1-bpjs"
                                data-bs-toggle="tab"
                                aria-controls="bpjs"
                                href="#bpjs"
                                role="tab"
                                aria-selected="true"
                                >BPJS</a
                            >
                            </li>
                            <li class="nav-item">
                            <a
                                class="nav-link"
                                id="baseVerticalLeft-pph21"
                                data-bs-toggle="tab"
                                aria-controls="pph21"
                                href="#pph21"
                                role="tab"
                                aria-selected="false"
                                >PPH21 PTKP</a
                            >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="baseVerticalLeft-pkp"
                                    data-bs-toggle="tab"
                                    aria-controls="pkp"
                                    href="#pkp"
                                    role="tab"
                                    aria-selected="false"
                                    >PPH21 PKP</a
                                >
                                </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <select name="filter_company" id="filter_company" class="form-control">
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="tab-content">
                            <div class="tab-pane active" id="bpjs" role="tabpanel" aria-labelledby="baseVerticalLeft-bpjs">
                                @include('content/settings/bpjs')
                            </div>
                            <div class="tab-pane" id="pph21" role="tabpanel" aria-labelledby="baseVerticalLeft-pph21">
                                @include('content/settings/pph21')
                            </div>
                            <div class="tab-pane" id="pkp" role="tabpanel" aria-labelledby="baseVerticalLeft-pkp">
                                @include('content/settings/pph21-pkp')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal to set -->
<div class="modal fade text-start" id="setModal" aria-labelledby="set" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="setLabel"></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formSet">
            <div class="modal-body">
                <input type="hidden" name="" id="set_id">
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label">Select Company<span class="text-danger">*</span></label>
                        <select name="set_company" id="set_company" class="form-control select2">
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
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
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/apps/bpjs_pph21.js')) }}"></script>
@endsection