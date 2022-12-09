@extends('layouts/contentLayoutMaster')

@section('title', lang('Menu Recruitment'))

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

        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>#</th>
              <th>{{lang('Recruitment Nik')}}</th>
              <th>{{lang('Recruitment Name')}}</th>
              <th>{{lang('Recruitment Contact')}}</th>
              <th>{{lang('Recruitment Status')}}</th>
              <th>{{lang('Recruitment Option')}}</th>
            </tr>
          </thead>
        </table>
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
  {{-- <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script> --}}
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  @endsection
  @section('page-script')
  {{-- Page js files --}}
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script> --}}
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script> --}}
  <script>
    let token = "{{ csrf_token() }}"
  </script>
  <script src="{{ asset(mix('js/scripts/apps/recruitment.js')) }}"></script>



  <script>
function edit(e){
  const $id = $(e).attr('data_id');
  const $status = $(e).attr('status');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: !0,
      buttonsStyling: !1,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, approve it!',
      denyButtonText: 'Yes, reject it',
      cancelButtonText: 'Close',
      showDenyButton: true,
      showCancelButton: true,
      customClass: {
        actions: 'my-actions',
        confirmButton: ' btn btn-primary order-1 right-gap',
        denyButton: 'btn btn-warning mx-1 order-2 right-gap',
        cancelButton: ' btn btn-danger order-3 left-gap',
      }
    }).then(function (t) {
      if(t.isDenied){
        $.ajax({
          url: '/recruitments/'+$id,
          type: 'post',
          data: {status : 'reject'},
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
                text: response.message,
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
        })
      }

      if(t.isConfirmed){
        // console.log($status);

        if ($status == 1) {
          Swal.fire({
            icon: 'error',
            title: 'Ooops...',
            text: 'It is not allowed to agree twice!',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
        } else {
          Swal.fire({
            title: 'Yes, approve it!',
            html: `
            

            <div class="row">
              <div class="col-md-12 mb-1 text-start">
                <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="employee id">  
              </div>
              <div class="col-md-12 mb-1 text-start">
                <input type="text" name="id_card" id="id_card" class="form-control" placeholder="id card">  
              </div>

              <div class="col-md-12 mb-1 text-start">
                <input type="text" name="employee_id_number" id="employee_id_number" class="form-control" placeholder="employee id number">
              </div>
              <div class="col-md-12 mb-1 text-start">
                <select name="country_id" id="country_id" class="form-control">
                  @foreach ($country as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mb-1 text-start">
                <input type="text" name="province" id="province" class="form-control" placeholder="province">
              </div>
              <div class="col-md-12 mb-1 text-start">
                <input type="text" name="city" id="city" class="form-control" placeholder="city">
              </div>

              <div class="col-md-12 mb-1 text-start">
                <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="zip code">
              </div>
              <div class="col-md-12 mb-1 text-start">
                <select name="job_level" id="job_level" class="form-control">
                  @foreach ($job_level as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mb-1 text-start">
                <select name="job_position_id" id="job_position_id" class="form-control">
                  @foreach ($position as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>         
              </div>
              <div class="col-md-12 mb-1 text-start">
                <select name="department_id" id="department_id" class="form-control">
                  @foreach ($departement as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mb-1 text-start">
                <select name="company_id" id="company_id" class="form-control">
                  @foreach ($company as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-1 text-start">
                <select name="employee_work_status_id" id="employee_work_status_id" class="form-control">
                  @foreach ($status as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>   
              </div>

              <div class="col-md-12 mb-1 text-start">
                <select name="employee_status_id" id="employee_status_id" class="form-control">
                  @foreach ($options as $item)
                    @if($item->group == 'employee_status')
                      <option value="{{$item->id}}"> {{$item->name}} </option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-1 text-start">
                <select name="employment_status_id" id="employment_status_id" class="form-control">
                  @foreach ($options as $item)
                    @if($item->group == 'employment_status')
                      <option value="{{$item->id}}"> {{$item->name}} </option>
                    @endif
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mb-1 text-start">
                <select name="employee_category_id" id="employee_category_id" class="form-control">
                  @foreach ($category as $item)
                    <option value="{{$item->id}}"> {{$item->name}} </option>
                  @endforeach
                </select>
              </div>
            </div>
            `,
            confirmButtonText: 'Yes, approve it!',

            showCancelButton: !0,
            buttonsStyling: !1,
            cancelButtonColor: '#d33',
            cancelButtonText: 'Close',
            showCancelButton: true,
            customClass: {
              confirmButton: ' btn btn-primary order-1 right-gap',
              cancelButton: ' btn btn-danger order-3 left-gap ms-1',
            },
            focusConfirm: false,
            preConfirm: () => {
              $('.errs').html('');
              $('.form-control').removeClass('is-invalid');
              const employee_id = Swal.getPopup().querySelector("#employee_id").value
              const id_card = Swal.getPopup().querySelector("#id_card").value
              const employee_id_number  = Swal.getPopup().querySelector("#employee_id_number").value
              const country_id = Swal.getPopup().querySelector('#country_id').value
              const province = Swal.getPopup().querySelector('#province').value
              const city = Swal.getPopup().querySelector('#city').value
              const zip_code = Swal.getPopup().querySelector('#zip_code').value
              const job_level = Swal.getPopup().querySelector('#job_level').value
              const job_position_id = Swal.getPopup().querySelector('#job_position_id').value
              const department_id = Swal.getPopup().querySelector('#department_id').value
              const company_id = Swal.getPopup().querySelector('#company_id').value
              const employee_work_status_id = Swal.getPopup().querySelector('#employee_work_status_id').value
              const employee_status_id = Swal.getPopup().querySelector('#employee_status_id').value
              const employment_status_id = Swal.getPopup().querySelector('#employment_status_id').value
              const employee_category_id = Swal.getPopup().querySelector('#employee_category_id').value
              
              const $form = {
                status : 'approve',
                employee_id : employee_id,
                id_card : id_card,
                employee_id_number  : employee_id_number,
                country_id : country_id,
                province : province,
                city : city,
                zip_code : zip_code,
                job_level : job_level,
                job_position_id : job_position_id,
                department_id : department_id,
                company_id : company_id,
                employee_work_status_id : employee_work_status_id,
                employee_status_id : employee_status_id,
                employment_status_id : employment_status_id,
                employee_category_id : employee_category_id,
              }

              var result = function(){
                let resp = null; 
                $.ajax({
                  url: '/recruitments/'+$id,
                  type: 'post',
                  data: $form,
                  async: false,
                  error : function(err){
                    Swal.showValidationMessage(`The all field is required`)
  
                    var errs = err.responseJSON.errors
                    Object.keys(errs).forEach(key => {
                      
  
                      var result = key.split('.');
                      if(1 in result){
  
                        var errclass = document.getElementsByClassName('err-'+result[0])[result[1]];
                        $(errclass).html('<small>'+errs[result[0]+'.'+result[1]][0].replace(key, 'Field')+'</small>')
                      }else{
                        $('[name='+key+']').addClass('is-invalid')
                        $('[name='+key+']').parent().append('<div class="text-danger errs err-'+key+'"> <small> '+errs[key][0]+' </small> </div>');
                      }
  
                    });
                  },
                  success : function(res){
                    resp = res;
                    if (res.status == false) {
                      Swal.showValidationMessage(res.message)
                    }
                  }
                });

                return resp;
              }();

              if(result.status) return true;
              
              return false;
            }
          }).then((result) => {
            // return true;
            if (result.isConfirmed) {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Yes, approve it !',
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
            }

          })


        }
      }


    });
}
  </script>
  {{-- <script src="{{ asset(mix('js/scripts/apps/departement.js')) }}"></script> --}}
@endsection
