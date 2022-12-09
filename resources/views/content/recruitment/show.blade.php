@extends('layouts/contentLayoutMaster')

@section('title', lang('Menu Recruitment'))

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

  {{-- <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}"> --}}


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
    <div class="col-lg-12">
      <div class="card">
        
          <div class="card-body">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(3) == '')? 'active' : ''}}" href="{{url('recruitments/'.request()->segment(2))}}"><i data-feather="user"></i> {{lang('Recruitment personal_data')}} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(3) == 'tab2')? 'active' : ''}}" href="{{url('recruitments/'.request()->segment(2).'/tab2')}}"><i data-feather="credit-card"></i> {{lang('Recruitment identification mark')}} </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(3) == 'tab3')? 'active' : ''}}" href="{{url('recruitments/'.request()->segment(2).'/tab3')}}"><i data-feather='users'></i> {{lang('Recruitment family structure')}} </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link {{(request()->segment(3) == 'tab4')? 'active' : ''}}" href="{{url('recruitments/'.request()->segment(2).'/tab4')}}"><i data-feather='user-check'></i> {{lang('Recruitment formal education')}} </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link {{(request()->segment(3) == 'tab5')? 'active' : ''}}" href="{{url('recruitments/'.request()->segment(2).'/tab5')}}"><i data-feather='file'></i> {{lang('Recruitment Employment history')}} </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link {{(request()->segment(3) == 'tab6')? 'active' : ''}}" href="{{url('recruitments/'.request()->segment(2).'/tab6')}}"><i data-feather="dollar-sign"></i> {{lang('Recruitment Employment Salary')}} </a>
                </li>
              </ul>

               <div class="row">
                <div class="col-md-12">
                  @include($view)
                </div>
              </div>


          </div>
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
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script> --}}
  <script>
    let token = "{{ csrf_token() }}"
  </script>

  {{-- <script src="{{ asset(mix('js/scripts/apps/employees.js')) }}"></script> --}}
@endsection
