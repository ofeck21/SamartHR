<div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
  <div class="content-header mb-2">
    <h2 class="fw-bolder mb-75">{{lang('Recruitment personal_data')}}</h2>
    <span>{{lang('Recruitment personal_information')}}</span>
  </div>
  <input type="hidden" name="step" value="1">


  <div class="row photo">
    <div class="col-md-3 mb-1">

      <label class="form-label"> Pas Foto 4 x 6</label>
      <div class="input-group input-group-merge">
        <span style="cursor: pointer" class="input-group-text add-photo text-info" id="basic-addon5"> + Add Photo </span>
        <input type="file" name="photo[]" id="photo" class="form-control numeral-mask" placeholder="10,000">
      </div>

      <div class="err err-photo text-danger"></div>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-3 mb-1">
      <label class="form-label" for="full_name">{{lang('Recruitment first name')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("full_name")}}" name="full_name" id="full_name" class="form-control" placeholder="{{lang('Recruitment first name')}}" />
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label" for="posisi_yang_dilamar">{{lang('Recruitment posisi yang dilamar')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("posisi_yang_dilamar")}}" name="posisi_yang_dilamar" id="posisi_yang_dilamar" class="form-control" placeholder="{{lang('Recruitment posisi yang dilamar')}}" />
    </div>

    <div class="col-md-3 mb-1">
      <div class="row">
        <div class="col-md-6">
          <label class="form-label" for="place_of_birth">{{lang('Recruitment place of birth')}} <span class="text-danger">*</span></label>
          <input type="text" value="{{old("place_of_birth")}}" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="{{lang('Recruitment place of birth')}}" />
        </div>
        <div class="col-md-6">
          <label class="form-label" for="date_of_birth">{{lang('Recruitment date of birth')}} <span class="text-danger">*</span></label>
          <input type="date" value="{{old("date_of_birth")}}" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="{{lang('Recruitment date of birth')}}" />
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label" for="gender">{{lang('Recruitment gender')}} <span class="text-danger">*</span></label>
      <select class="form-control select2" name="gender">
        @foreach ($option as $item)
            @if ($item->group == 'gender')
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endif
        @endforeach
      </select>
    </div>
    
    <div class="col-md-3 mb-1">
      <label class="form-label" for="mobile_phone_number">{{lang('Recruitment mobile phone number')}} <span class="text-danger">*</span></label>        
      <input type="number" value="{{old("mobile_phone_number")}}" name="mobile_phone_number" id="mobile_phone_number" class="form-control phone_numbers" placeholder="{{lang('Recruitment mobile phone number')}}" />
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label" for="phone_number">{{lang('Recruitment phone number')}} <span class="text-danger">*</span></label>
      <input type="number" value="{{old("phone_number")}}" name="phone_number" id="phone_number" class="form-control" placeholder="{{lang('Recruitment phone number')}}" />
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label" for="email">{{lang('Recruitment email')}} <span class="text-danger">*</span></label>
      <input type="email" value="{{old("email")}}" name="email" id="email" class="form-control" placeholder="{{lang('Recruitment email')}}" />
    </div>
  
    <div class="col-md-3 mb-1">
      <label class="form-label" for="religion">{{lang('Recruitment religion')}} <span class="text-danger">*</span></label>
      <select class="form-control select2" name="religion">
        @foreach ($option as $item)
            @if ($item->group == 'religion')
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label" for="tribes">{{lang('Recruitment tribes')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("tribes")}}" name="tribes" id="tribes" class="form-control" placeholder="{{lang('Recruitment tribes')}}" />
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label" for="citizenship">{{lang('Recruitment citizenship')}} <span class="text-danger">*</span></label>
      <select class="form-control select2" name="citizenship">
        <option value="WNI" {{(old("citizenship") == 'WNI')? 'selected':''}}>{{lang('Recruitment WNI')}}</option>
        <option value="Keturunan" {{(old("citizenship") == 'Keturunan')? 'selected':''}}>{{lang('Recruitment Keturunan')}}*</option>
      </select>
    </div>

    <div class="col-md-3 mb-1">
      <div class="row">
        <div class="col-md-6">
          <label class="form-label">{{lang("Recruitment blood group")}} <span class="text-danger">*</span></label>
          <select class="form-control select2" name="blood_group">
            @foreach ($option as $item)
                @if ($item->group == 'blood_group')
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endif
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">{{lang("Recruitment kacamata")}} <span class="text-danger">*</span></label>
          <select class="form-control select2" name="kacamata">
            <option value="y" {{(old("kacamata") == 'y')? 'selected':''}}>{{lang('Recruitment y')}}</option>
            <option value="n" {{(old("kacamata") == 'n')? 'selected':''}}>{{lang('Recruitment n')}}</option>
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-1">
      <label class="form-label">{{lang("Recruitment height and weight")}} <span class="text-danger">*</span></label>
      
      <div class="input-group">
        <input type="number" name="height" class="form-control" placeholder="height" aria-label="height">
        <span class="input-group-text" style="padding: 0 5px">cm</span>
        <input type="number" name="width" class="form-control" placeholder="width" aria-label="width">
        <span class="input-group-text" style="padding: 0 5px">Kg</span>
      </div>
    </div>



  </div>
          
  <hr>

  <div class="row">
    <div class="col-md-4">
      <div class="mb-1">
        <label class="form-label" for="nik">{{lang('Recruitment Nik')}} <span class="text-danger">*</span></label>
        <input type="text" value="{{old("nik")}}" name="nik" id="nik" class="form-control" placeholder="{{lang('Recruitment Nik')}}" />
      </div>
      <div class="mb-1">
        <label for="file_nik" class="form-label">{{lang('Recruitment Upload Nik')}} <span class="text-danger">*</span> </label>
        <input class="form-control" type="file" id="file_nik" name="file_nik" aria-invalid="false">
      </div>
    </div>

    <div class="col-md-4">
      <div class="mb-1">
        <label class="form-label" for="no_kk">{{lang('Recruitment No KK')}} <span class="text-danger">*</span></label>
        <input type="text" value="{{old("no_kk")}}" name="no_kk" id="no_kk" class="form-control" placeholder="{{lang('Recruitment No KK')}}" />
      </div>
      <div class="mb-1">
        <label for="file_no_kk" class="form-label">{{lang('Recruitment Upload No KK')}} <span class="text-danger">*</span> </label>
        <input class="form-control" type="file" id="file_no_kk" name="file_no_kk" aria-invalid="false">
      </div>
    </div>

    <div class="col-md-4">
      <div class="mb-1">
        <label class="form-label" for="no_skck">{{lang('Recruitment SKCK')}} <span class="text-danger">*</span></label>
        <input type="text" value="{{old("no_skck")}}" name="no_skck" id="no_skck" class="form-control" placeholder="{{lang('Recruitment SKCK')}}" />
      </div>
      <div class="mb-1">
        <label for="file_no_skck" class="form-label">{{lang('Recruitment Upload No SKCK')}} <span class="text-danger">*</span> </label>
        <input class="form-control" type="file" id="file_no_skck" name="file_no_skck" aria-invalid="false">
      </div>
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-md-6 mb-1">
      <label class="form-label" for="id_card_address">{{lang('Recruitment ID card address')}} <span class="text-danger">*</span></label>
      <textarea value="{{old("id_card_address")}}" name="id_card_address" id="id_card_address" class="form-control" rows="2" placeholder="{{lang('Recruitment ID card address')}}"></textarea>
    </div>

    <div class="col-md-6 mb-1">
      <label class="form-label" for="residence_address">{{lang('Recruitment residence address')}} <span class="text-danger">*</span></label>
      <textarea value="{{old("residence_address")}}" name="residence_address" id="residence_address" class="form-control" rows="2" placeholder="{{lang('Recruitment residence address')}}"></textarea>
    </div>

    <div class="col-md-6 mb-1">
      <label for="">Question</label>
      <textarea name="question1" id="question1" class="form-control" rows="2"></textarea>
      <small class="text-muted">Pernahkah Saudara sakit keras / operasi / kecelakaan berat ? Jika Pernah, bilamana dan apa akibat yang dirasakan hingga sekarang ?</small>
    </div>

    <div class="col-md-6 mb-1">
      <label for="">Question</label>
      <textarea name="question2" id="question2" class="form-control" rows="2" ></textarea>
      <small class="text-muted">Sebutkan jika Saudara memiliki cacad fisik / gangguan kesehatan</small>
    </div>
  </div>

  




  <div class="d-flex justify-content-between mt-2">
    <div></div>
    <button type="button" class="btn btn-primary btn-validata" target="form_personal_data" step="1" next="#btn-next1">
      <span class="align-middle d-sm-inline-block d-none">{{lang('Recruitment next')}}</span>
      <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
    </button>
    <button type="button" id="btn-next1" style="display: none" class="btn-next"></button>
  </div>

</div>