@extends('layouts/contentLayoutMaster')

@section('title', lang('General.Detail Company'))

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
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header border-bottom">
                <strong>{{lang('General.Detail Company')}}</strong>
                <input type="hidden" id="company_id" value="{{$company->id}}">
            </div>
            <div class="card-body p-2">
                <table class="table table-hover">
                    <tr>
                        <td>{{lang('General.Name')}}</td>
                        <td>: <strong>{{$company->name}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Type')}}</td>
                        <td>: <strong>{{$company->type->name ?? ''}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.NPWP')}}</td>
                        <td>: <strong>{{$company->npwp}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.TDP')}}</td>
                        <td>: <strong>{{$company->tdp}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Siup')}}</td>
                        <td>: <strong>{{$company->siup}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Email')}}</td>
                        <td>: <strong>{{$company->email}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Phone')}}</td>
                        <td>: <strong>{{$company->phone}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Website')}}</td>
                        <td>: <strong>{{$company->website}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Address')}}</td>
                        <td>: <strong>{{$company->address}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Coordinate')}}</td>
                        <td>: <strong><a href="https://maps.google.com/?q={{$company->latitude}},{{$company->longitude}}" target="_blank">{{$company->latitude}}, {{$company->longitude}}</strong></a></td>
                    </tr>
                    <tr>
                        <td>{{lang('General.Note')}}</td>
                        <td>: <strong>{{$company->notes}}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>   
    <div class="col-md-4">
        <div class="card">
            <div class="card-header border-bottom">
                <strong>Logo</strong>
            </div>
            <div class="card-body p-1 text-center">
                <div class="card">
                    <img class="card-img-top w-50 me-auto ms-auto" id="bigLogo" src="{{asset('storage/images/company/'.$company->big_logo)}}" alt="Logo">
                    <span class="card-title">{{lang('General.Large Logo')}}</span>
                    <input type="file" name="large_logo" id="large_logo" onchange="return updateLargeLogo()" class="hidden" accept="image/*">
                    <button class="btn btn-sm btn-outline-primary w-50 me-auto ms-auto" id="change_large_logo">{{lang('General.Change')}}</button>
                </div>
                <hr>
                <div class="card">
                    <img class="card-img-top w-50 me-auto ms-auto" id="smallLogo" src="{{asset('storage/images/company/'.$company->smal_logo)}}" alt="Logo">
                    <div class="card-title">{{lang('General.Small Logo')}}</div>
                    <input type="file" name="small_logo" id="small_logo" onchange="return updateSmallLogo()" class="hidden" accept="image/*">
                    <button class="btn btn-sm btn-outline-primary w-50 me-auto ms-auto" id="change_small_logo">{{lang('General.Change')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-bottom p-1 pb-0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="tabVerticalLeft1-pic"
                        data-bs-toggle="tab"
                        aria-controls="pic"
                        href="#pic"
                        role="tab"
                        aria-selected="true"
                        ><i data-feather="user"></i> {{lang('General.PIC')}}</a
                    >
                    </li>
                    <li class="nav-item">
                    <a
                        class="nav-link"
                        id="baseVerticalLeft-file"
                        data-bs-toggle="tab"
                        aria-controls="file"
                        href="#file"
                        role="tab"
                        aria-selected="false"
                        ><i data-feather="file"></i> {{lang('General.File')}}</a
                    >
                    </li>
                </ul>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newPIC" id="addNewPIC"><i data-feather="plus"></i>{{lang('General.Add New')}} {{lang('General.PIC')}}</button>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newFile" id="addNewFile" style="display: none"><i data-feather="plus"></i>{{lang('General.Add New')}} {{lang('General.File')}}</button>
            </div>
            <div class="cad-body p-1">
                    <div class="tab-content">
                        <div class="tab-pane active" id="pic" role="tabpanel" aria-labelledby="baseVerticalLeft-pic">
                            <table class="table table-hover table-pic">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>{{lang('General.Name')}}</td>
                                        <td>{{lang('General.Phone')}}</td>
                                        <td>{{lang('General.Description')}}</td>
                                        <td>{{lang('General.Actions')}}</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane" id="file" role="tabpanel" aria-labelledby="baseVerticalLeft-file">
                            <table class="table table-hover table-file">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>{{lang('General.Name')}}</td>
                                        <td>{{lang('General.Description')}}</td>
                                        <td>{{lang('General.Actions')}}</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal to add new PIC -->
<div class="modal fade text-start" id="newPIC" tabindex="-1" aria-labelledby="addNewPIC" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewPICLabel">{{lang('General.Add New')}} {{lang('General.PIC')}}</h4>
          <h4 class="modal-title" id="editPICLabel" style="display: none">Edit {{lang('General.PIC')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formPIC">
          <div class="modal-body">
            <input type="hidden" id="pic_id">
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Name')}} <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="pic_name" placeholder="{{lang('General.Name')}}" name="pic_name">
              </div>
              <div class="col-md-6">
                <label class="form-label">{{lang('General.Phone')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pic_phone" placeholder="{{lang('General.Phone')}}" name="pic_phone">
              </div>
            </div>
            <div class="row">
              <div class="col">
                  <label class="form-label">{{lang('General.Description')}}</label>
                  <textarea name="pic_description" class="form-control" id="pic_description" rows="1"></textarea>
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

  <!-- Modal to add new File -->
<div class="modal fade text-start" id="newFile" tabindex="-1" aria-labelledby="addNewFile" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewFileLabel">{{lang('General.Add New')}} {{lang('General.File')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formFile">
          <div class="modal-body">
            <input type="hidden" id="file_id">
            <div class="row mb-1">
              <div class="col-md-6">
                  <label class="form-label">{{lang('General.Name')}} <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="file_name" placeholder="{{lang('General.Name')}}" name="file_name">
              </div>
              <div class="col-md-6">
                <label class="form-label">{{lang('General.File')}} <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="file" name="file">
              </div>
            </div>
            <div class="row">
              <div class="col">
                  <label class="form-label">{{lang('General.Description')}}</label>
                  <textarea name="file_description" class="form-control" id="file_description" rows="1"></textarea>
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
  <script src="{{ asset(mix('js/scripts/apps/company_detail.js')) }}"></script>
@endsection



