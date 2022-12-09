<div id="identification-mark" class="content" role="tabpanel" aria-labelledby="identification-mark-trigger">
  <div class="content-header mb-2">
    <h2 class="fw-bolder mb-75">{{lang('Recruitment identification mark')}}</h2>
    <span>{{lang('Recruitment id information')}}</span>
  </div>
  
  
  <div class="row">
    <div class="col-md-4 mb-1">
      <label class="form-label"> PASSPORT <span class="text-danger">*</span></label>
      <div class="form-control">
        PASSPORT
      </div>
    </div>
    
    <div class="col-md-4 mb-1">
      <label class="form-label" for="passport_number">{{lang('Recruitment passport number')}} <span class="text-danger">*</span></label>
      <input type="number" value="{{old("passport_number")}}" name="pasport_number" id="passport_number" class="form-control" placeholder="{{lang('Recruitment passport number')}}" />
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="passport_validity">{{lang('Recruitment validity period')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("passport_validity")}}" name="passport_validity" id="passport_validity" class="form-control" placeholder="{{lang('Recruitment validity period')}}" />
    </div>
  </div>

  <div class="row">
  
    <div class="col-md-4 mb-1">
      <label class="form-label">{{lang("Recruitment driver's license")}} <span class="text-danger">*</span></label>
      <select class="form-control select2" name="drivers_license">
        <option value="A" {{(old("blood_group") == 'A')? 'selected':''}}>A</option>
        <option value="B" {{(old("blood_group") == 'B')? 'selected':''}}>B</option>
        <option value="C" {{(old("blood_group") == 'C')? 'selected':''}}>C</option>
      </select>
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="identity_card_number_sim">{{lang('Recruitment identity card number')}} <span class="text-danger">*</span></label>
      <input type="number" value="{{old("identity_card_number_sim")}}" name="identity_card_number_sim" id="identity_card_number_sim" class="form-control" placeholder="{{lang('Recruitment identity card number')}}" />
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="validity_period_sim">{{lang('Recruitment validity period')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("validity_period_sim")}}" name="validity_period_sim" id="validity_period_sim" class="form-control" placeholder="{{lang('Recruitment validity period')}}" />
    </div>

  </div>


  <div class="row">
    <div class="col-md-4 mb-1">
      <label class="form-label"> BPJS NAKER <span class="text-danger">*</span></label>
      <div class="form-control">
        BPJS NAKER
      </div>
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="identity_card_number_bpjs_naker">{{lang('Recruitment identity card number')}} <span class="text-danger">*</span></label>
      <input type="number" value="{{old("identity_card_number_bpjs_naker")}}" name="identity_card_number_bpjs_naker" id="identity_card_number_bpjs_naker" class="form-control" placeholder="{{lang('Recruitment identity card number')}}" />
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="validity_period_bpjs_naker">{{lang('Recruitment validity period')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("validity_period_bpjs_naker")}}" name="validity_period_bpjs_naker" id="validity_period_bpjs_naker" class="form-control" placeholder="{{lang('Recruitment validity period')}}" />
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 mb-1">
      <label class="form-label"> BPJS KESEHATAN <span class="text-danger">*</span></label>
      <div class="form-control">
        BPJS KESEHATAN
      </div>
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="identity_card_number_bpjs_kesehatan">{{lang('Recruitment identity card number')}} <span class="text-danger">*</span></label>
      <input type="number" value="{{old("identity_card_number_bpjs_kesehatan")}}" name="identity_card_number_bpjs_kesehatan" id="identity_card_number_bpjs_kesehatan" class="form-control" placeholder="{{lang('Recruitment identity card number')}}" />
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="validity_period_bpjs_kesehatan">{{lang('Recruitment validity period')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("validity_period_bpjs_kesehatan")}}" name="validity_period_bpjs_kesehatan" id="validity_period_bpjs_kesehatan" class="form-control" placeholder="{{lang('Recruitment validity period')}}" />
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 mb-1">
      <label class="form-label"> NPWP <span class="text-danger">*</span></label>
      <div class="form-control">
        NPWP
      </div>
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="identity_card_number_npwp">{{lang('Recruitment identity card number')}} <span class="text-danger">*</span></label>
      <input type="number" value="{{old("identity_card_number_npwp")}}" name="identity_card_number_npwp" id="identity_card_number_npwp" class="form-control" placeholder="{{lang('Recruitment identity card number')}}" />
    </div>

    <div class="col-md-4 mb-1">
      <label class="form-label" for="validity_period_npwp">{{lang('Recruitment validity period')}} <span class="text-danger">*</span></label>
      <input type="text" value="{{old("validity_period_npwp")}}" name="validity_period_npwp" id="validity_period_npwp" class="form-control" placeholder="{{lang('Recruitment validity period')}}" />
    </div>
  </div>
      
  <div class="d-flex justify-content-between align-items-end mt-2">
    <button type="button" class="btn btn-outline-primary btn-prev">
      <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
      <span class="align-middle d-sm-inline-block d-none">{{lang('Recruitment previous')}}</span>
    </button>
    <button type="button" class="btn btn-primary btn-validata" target="form_tanda_pengenal" step="2" next="#btn-next2">
      <span class="align-middle d-sm-inline-block d-none">{{lang('Recruitment next')}}</span>
      <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
    </button>
    <button type="button" id="btn-next2" style="display: none" class="btn-next"></button>
  </div>

  </div>