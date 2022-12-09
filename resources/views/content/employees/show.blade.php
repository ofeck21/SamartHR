@extends('layouts/contentLayoutMaster')

@section('title', lang('Employees'))

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
                    <a class="nav-link {{(request()->segment(3) == '')? 'active' : ''}}" href="{{route('employee.show', request()->segment(2))}}"><i data-feather="home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(3) == 'employee-salary')? 'active' : ''}}" href="{{url('employee/'.request()->segment(2).'/employee-salary')}}"><i data-feather="tool"></i> {{lang('Employees.Set Salary')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(3) == 'employee-shift')? 'active' : ''}}" href="{{url('employee/'.request()->segment(2).'/employee-shift')}}"><i data-feather="calendar"></i> {{lang('Employees.Shift')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#aboutIcon"><i data-feather='user-check'></i> Leave</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#aboutIcon"><i data-feather='file'></i> Payslip</a>
                </li>
              </ul>

              @if (isset( $list ))
                <div class="row">
                  <div class="col-md-3">
                    <ul class="nav list-group">              
                      @include($list)
                    </ul>
                  </div>
                  <div class="col-md-9">
                    @include($view)
                  </div>
                </div>
              @else
                <div class="row">
                  <div class="col-md-12">
                    @include($view)
                  </div>
                </div>
              @endif
              


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


<script>

  function priceFormat(nominal)
  {
    if (/\D/g.test(nominal)) nominal = nominal.replace(/\D/g,'')
      let value = parseFloat(nominal)
    return value.toLocaleString("id-ID")
  }
  $(document).ready(function(){

    $('.rp').on('keyup', function(){
      $('.rp').val(priceFormat(this.value))
    })

    $('#employee-immigration').DataTable()
    $('.employee-data-table').DataTable()


    $('.form-control').on('keyup change',function(){
      $(this).removeClass('is-invalid');
      $('.err-'+$(this).attr('name')).remove();
    })

    $('.data-submit').click(function(){
      $('.errs').remove();
      $('.form-control').removeClass('is-invalid');

      var targetForm = $(this).attr('targetForm')
      var targetUrl = $('#'+targetForm).attr('action')
      var formData = new FormData(document.getElementById(targetForm))

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url   : targetUrl,
        type  : 'POST',
        // type  : $('[name=_method]').val(),
        data  : formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        enctype: 'multipart/form-data',
        success: function(response){
          if(response.status){
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
              showConfirmButton: false,
              timer: 1000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            }).then(function(){
              window.location.reload();
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Ooops...',
              text: 'Something went wrong!',
              footer: '<span class="text-danger">'+response.message+'</span>',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            });
          }
        }
      }).fail( function(error){
        Swal.fire({
          icon: 'error',
          title: 'Ooops...',
          text: 'Something went wrong!',
          footer: '<span class="text-danger">'+error.responseJSON.message+'</span>',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        });
        var errs = error.responseJSON.errors
        Object.keys(errs).forEach(key => {
          $('[name='+key+']').addClass('is-invalid')
          $('[name='+key+']').parent().append('<div class="text-danger errs err-'+key+'"> <small> '+errs[key][0]+' </small> </div>');
        });
      })
    })

    $('.btn-delete').click(function() {
      var url = $(this).attr('target_url');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        buttonsStyling: !1,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-danger ms-1',
        }
      }).then(function (t) {
        if(t.value){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: url,
            type: 'delete',
            success: function(response){
              if(response.status){
                Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                }).then(function(){
                  window.location.reload();
                });
              }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops...',
                    text: 'Something went wrong!',
                    footer: '<span class="text-danger">'+response.message+'</span>',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  });
                }
            }
          }).fail(function(error){
            Swal.fire({
              icon: 'error',
              title: 'Ooops...',
              text: 'Something went wrong!',
              footer: '<span class="text-danger">'+error.responseJSON.message+'</span>',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            });
              
            console.log(error.responseJSON);
          })
        }
      });
    })




    $('.btn-formal').click(function(){
      $(this).addClass('btn-outline-success');
      $(this).removeClass('btn-outline-secondary');
      $('.btn-informal').removeClass('btn-outline-success');
      $('.btn-informal').addClass('btn-outline-secondary');
      $('.form-school-level').show();
      $('.type-education').val('formal');
      $('#addNewRecordEducationFormalLabel').html('{{lang("Employees.Add New Formal Education")}}');
    })
    
    $('.btn-informal').click(function(){
      $(this).addClass('btn-outline-success');
      $(this).removeClass('btn-outline-secondary');
      $('.btn-formal').removeClass('btn-outline-success');
      $('.btn-formal').addClass('btn-outline-secondary');
      $('.form-school-level').hide();
      $('.type-education').val('informal');
      $('#addNewRecordEducationFormalLabel').html('{{lang("Employees.Add New Informal Education")}}');
    })

    $('.btn-toggle-formal').click(function(){
      $(this).addClass('btn-outline-success');
      $(this).removeClass('btn-outline-secondary');

      $('.btn-toggle-informal').removeClass('btn-outline-success');
      $('.btn-toggle-informal').addClass('btn-outline-secondary');
      
      $('.table-formal').show();
      $('.table-informal').hide();
    })
    $('.btn-toggle-informal').click(function(){
      $(this).addClass('btn-outline-success');
      $(this).removeClass('btn-outline-secondary');

      $('.btn-toggle-formal').removeClass('btn-outline-success');
      $('.btn-toggle-formal').addClass('btn-outline-secondary');

      $('.table-formal').hide();
      $('.table-informal').show();
    })

  })


</script>


@if (\Session::has('status'))
<script>
  var title = '{{\Session::get("status")}}';
  var msg = '{{\Session::get("msg")}}';
  Swal.fire({
    icon: title,
    title: title,
    text: msg,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
</script>
@endif
  {{-- <script src="{{ asset(mix('js/scripts/apps/employees.js')) }}"></script> --}}
@endsection
