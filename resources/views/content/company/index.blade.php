@extends('layouts/contentLayoutMaster')

@section('title', lang('General.Company'))

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
        @can('create company')
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
                <th>{{lang('General.Email')}}</th>
                <th>{{lang('General.Phone')}}</th>
                <th>{{lang('General.Status')}}</th>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordLabel">{{lang('General.Add New Company')}}</h4>
          <h4 class="modal-title" id="editRecordLabel" style="display: none  ">{{lang('General.Edit Company')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecord">
          <div class="modal-body">
            <input type="hidden" id="company_id">
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Company Name')}} <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="company_name" placeholder="{{lang('General.Company Name')}}" name="company_name">
              </div>
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Company Type')}} <span class="text-danger">*</span></label>
                  <select name="company_type" id="company_type" class="form-select select2">
                      <option value="">{{lang('General.Select')}}</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{lang('Option.'.$category->name)}}</option>
                      @endforeach
                  </select>
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.NPWP')}}</label>
                  <input type="text" class="form-control" id="npwp" placeholder="{{lang('General.NPWP')}}" name="npwp">
              </div>
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.TDP')}}</label>
                  <input type="text" class="form-control" id="tdp" placeholder="{{lang('General.TDP')}}" name="tdp">
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.SIUP')}}</label>
                  <input type="text" class="form-control" id="siup" placeholder="{{lang('General.SIUP')}}" name="siup">
              </div>
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Phone')}}</label>
                  <input type="text" class="form-control" id="phone" placeholder="{{lang('General.Phone')}}" name="phone">
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Email')}}</label>
                  <input type="text" class="form-control" id="email" placeholder="{{lang('General.Email')}}" name="email">
              </div>
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Website')}}</label>
                  <input type="text" class="form-control" id="website" placeholder="{{lang('General.Website')}}" name="website">
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Longitude')}}</label>
                  <input type="text" class="form-control" id="longitude" placeholder="{{lang('General.Longitude')}}" name="longitude">
              </div>
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Latitude')}}</label>
                  <input type="text" class="form-control" id="latitude" placeholder="{{lang('General.Latitude')}}" name="latitude">
              </div>
            </div>
            <div class="row mb-1">
              <div class="col">
                  <label class="form-label">{{lang('General.Address')}} <span class="text-danger">*</span></label>
                  <textarea name="address" class="form-control" id="address" rows="1"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Note')}}</label>
                  <textarea name="note" class="form-control" id="note" rows="1"></textarea>
              </div>
              <div class="col-md-6" id="company_status" style="display: none;">
                  <label class="form-label">{{lang('General.status')}}</label>
                  <select name="status" id="status" class="form-select select2">
                      <option value="">{{lang('General.Select')}}</option>
                      <option value="active">{{lang('General.Active')}}</option>
                      <option value="non-active">{{lang('General.Non Active')}}</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> {{lang('General.Close')}}</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> {{lang('General.Save')}}</button>
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
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script> --}}
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script> --}}
  <script src="{{ asset(mix('js/scripts/apps/company.js')) }}"></script>
@endsection
