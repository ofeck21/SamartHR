@extends('layouts/contentLayoutMaster')

@section('title', lang("Menu Job Level Facility"))

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{asset('css/base/pages/ui-feather.css')}}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
    <!-- Basic table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <input type="hidden" id="job_level_id" value="{{$jobLevel->id}}">
                        <h4>{{$jobLevel->name ?? ''}} @ {{$jobLevel->jobPosition->name ?? ''}}</h4>
                        <h4>{{$jobLevel->company->name ?? ''}}</h4>
                    </div>
                </div>
                <div class="card">
                    @can('create job_level')
                        <div class="card-header border-bottom p-1">
                            <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecord">
                                <i data-feather="plus"></i> {{lang('General.Add New')}}
                            </button>
                        </div>
                    @endcan
                    <div class="card-body">
                        <table class="datatables-basic table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{lang('General.Name')}}</th>
                                <th>{{lang('General.Type')}}</th>
                                <th>{{lang('General.Nominal')}}</th>
                                <th>{{lang('General.Actions')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to add new record -->
        <div class="modal fade text-start" id="addNewRecord" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addNewRecordLabel">{{lang('General.Add Facility')}}</h4>
                        <h4 class="modal-title" id="editRecordLabel" style="display: none">{{lang('General.Edit Facility')}}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formNewRecord">
                        <div class="modal-body">
                            <input type="hidden" id="item_id">
                            <div class="row mb-2">
                                <div class="col">
                                    <label class="form-label">{{lang('General.Type')}} <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-select select2">
                                        <option value="">{{lang('General.Select')}}</option>
                                        <option value="salary">{{lang('General.Salary')}}</option>
                                        <option value="allowance">{{lang('General.Allowance')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2" id="select_facility" style="display: none">
                                <div class="col">
                                    <label for="">{{lang('General.Select')}} {{lang('General.Facility')}}</label>
                                    <div id="select_salary" style="display: none">
                                        <select name="salary" id="salary"></select>
                                    </div>
                                    <div id="select_allowance" style="display: none">
                                        <select name="allowance" id="allowance"></select>
                                    </div>
                                </div>
                            </div>
                            <div id="detail_facility" style="display: none">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="form-label">{{lang('General.Nominal')}} </label>
                                        <input type="text" class="form-control" id="nominal" name="nominal" readonly disabled>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="company" id="company" value="{{$jobLevel->company_id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
                            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic table -->
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
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
    <script>
        let token = "{{ csrf_token() }}"
    </script>
    <script src="{{ asset(mix('js/scripts/apps/job_level_facility.js')) }}"></script>
@endsection
