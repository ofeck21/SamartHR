
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">

                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($data->photos as $key => $item)
                                <li class="nav-item">
                                    <a class="nav-link {{($key == 0) ? 'active' : ''}}" id="tabs-{{$item->id}}-tab" data-bs-toggle="tab" href="#tabs-{{$item->id}}" aria-controls="tabs-{{$item->id}}" role="tab" aria-selected="true">Photo {{$key + 1}} </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($data->photos as $key => $item)
                                <div class="tab-pane {{($key == 0) ? 'active' : ''}}" id="tabs-{{$item->id}}" aria-labelledby="tabs-{{$item->id}}-tab" role="tabpanel">
                                    <img src="{{$item->path}}" width="100%" alt="" srcset="">
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="col-md-9">
        
                        <table class="table table-sm">
                            <tr>
                                <td style="width:300px"> {{lang('Recruitment full name')}} </td>
                                <td> : {{$data->fullname}}</td>
                            </tr>
                            <tr>
                                <td style="width:200px"> {{lang('Recruitment posisi dilamar')}} </td>
                                <td> : {{$data->posisi_dilamar}}</td>
                            </tr>
                            
                            <tr>
                                <td> {{lang('Recruitment place of birth')}} </td>
                                <td> : {{$data->place_of_birth}}</td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment date of birth')}} </td>
                                <td> : {{$data->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment gender')}} </td>
                                <td> : {{$data->gender->name}}</td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment mobile phone number')}} </td>
                                <td> : <a target="_blank" href="https://wa.me/{{wa($data->mobile_phone_number)}}"> {{$data->mobile_phone_number}} </a></td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment phone number')}} </td>
                                <td> : {{$data->phone_number}}</td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment Nik')}} </td>
                                <td> : <a target="_blank" href="{{$data->file_nik}}"> <i data-feather='download-cloud'></i> {{$data->nik}} </a> </td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment No KK')}}  </td>
                                <td> : <a target="_blank" href="{{$data->file_no_kk}}"> <i data-feather='download-cloud'></i> {{$data->no_kk}} </a> </td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment SKCK')}} </td>
                                <td> : <a target="_blank" href="{{$data->file_no_skck}}"> <i data-feather='download-cloud'></i> {{$data->no_skck}} </a> </td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment email')}} </td>
                                <td> : {{$data->email}}</td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment ID card address')}} </td>
                                <td> : {{$data->id_card_address}}</td>
                            </tr>
                            <tr>
                                <td> {{lang('Recruitment residence address')}} </td>
                                <td> : {{$data->residence_address}}</td>
                            </tr>

                            <tr>
                                <td>{{lang('Recruitment Religion')}}</td>
                                <td> : {{ ($data->religion) ? $data->religion->name : ''}} </td>
                            </tr>
                            <tr>
                                <td>{{lang('Recruitment Tribes')}}</td>
                                <td> : {{$data->tribes}} </td>
                            </tr>
                            <tr>
                                <td>{{lang('Recruitment Citizenship')}}</td>
                                <td> : {{$data->citizenship}} </td>
                            </tr>
                            <tr>
                                <td>{{lang('Recruitment blood group')}}</td>
                                <td> : {{ ($data->blood_group) ? $data->blood_group->name : ''}} </td>
                            </tr>
                            <tr>
                                <td>{{lang('Recruitment height')}}</td>
                                <td> : {{$data->height}} Cm </td>
                            </tr>
                            <tr>
                                <td>{{lang('Recruitment width')}}</td>
                                <td> : {{$data->width}} Kg </td>
                            </tr>
                            <tr>
                                <td>{{lang('Recruitment glasses')}}</td>
                                <td> : {{($data->glasses == 'n') ? 'Tidak' : 'Ya'}} </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
