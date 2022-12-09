
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-sm mb-1">
                    <thead>
                        <tr>
                            <th rowspan="2">{{lang('Recruitment school level')}}</th>
                            <th rowspan="2">{{lang('Recruitment school name (faculty/department)')}}</th>
                            <th rowspan="2">{{lang('Recruitment Place / City')}}</th>
                            <th class="text-center" colspan="2">{{lang('Recruitment year')}}</th>
                            <th rowspan="2">{{lang('Recruitment Graduated/Not')}}</th>
                        </tr>
                        <tr>
                            <th>{{lang('Recruitment start')}}</th>
                            <th>{{lang('Recruitment finish')}}</th>
                        </tr>
                    </thead>
                    @foreach ($data->education as $item)
                        <tr>
                            <td> {{$item->tingkat->name}} </td>
                            <td> {{$item->school_name}} </td>
                            <td> {{$item->city}} </td>
                            <td> {{$item->start}} Thn </td>
                            <td> {{$item->finish}} </td>
                            <td> {{($item->graduated == 'y') ? 'Lulus' : 'Tidak Lulus'}} </td>                     
                        </tr>
                    @endforeach
                </table>

                <div style="overflow-x:unset" class="card-datatable table-responsive pt-0">
                    <table id="table" class="table table-sm">
                      <thead>
                        <tr>
                          <th colspan="6" class="table-secondary py-1">{{lang('Recruitment course / training')}} <span class="text-danger">*</span></th>
                        </tr>
                        <tr>
                          <th>{{lang('Recruitment Field / Type')}}</th>
                          <th>{{lang('Recruitment Organizer')}}</th>
                          <th>{{lang('Recruitment Place / City')}}</th>
                          <th>{{lang('Recruitment time')}}</th>
                          <th colspan="2">{{lang('Recruitment Funded By (Certificate/Not)')}}</th>
                        </tr>
                      </thead>
                      <tbody id="course_training">
                        @foreach ($data->training as $item)
                            <tr>
                                <td> {{$item->field}} </td>
                                <td> {{$item->organizer}} </td>
                                <td> {{$item->city}} </td>
                                <td> {{$item->times}} </td>
                                <td> {{$item->funded_by}} </td>
                            </tr>
                        @endforeach
                      </tbody>
                      
                      <thead>
                        <tr>
                          <th colspan="6" class="table-secondary py-1">{{lang('Recruitment certificate')}} <span class="text-danger">*</span></th>
                        </tr>
                        <tr>
                          <th>{{lang('Recruitment Field / Type')}}</th>
                          <th>{{lang('Recruitment Organizer')}}</th>
                          <th>{{lang('Recruitment Place / City')}}</th>
                          <th colspan="2">{{lang('Recruitment Validity period')}}</th>
                          <th>{{lang('Recruitment Funded By')}}</th>
                        </tr>
                      </thead>
                      <tbody id="certificate">
                        @foreach ($data->certificate as $item)
                            <tr>
                                <td> {{$item->field}} </td>
                                <td> {{$item->organizer}} </td>
                                <td> {{$item->city}} </td>
                                <td> {{$item->start}} </td>
                                <td> {{$item->finish}} </td>
                                <td> {{$item->funded_by}} </td>
                            </tr>
                        @endforeach
                      </tbody>
                      
                      <thead>
                        <tr>
                          <th colspan="6" class="table-secondary py-1">{{lang('Recruitment language ability (Filled with : Very Good, Good, Enough)')}} <span class="text-danger">*</span></th>
                        </tr>
                        <tr>
                          <th>{{lang('Recruitment Kinds of Languages')}}</th>
                          <th>{{lang('Recruitment Hear')}}</th>
                          <th>{{lang('Recruitment Read')}}</th>
                          <th>{{lang('Recruitment Write')}}</th>
                          <th colspan="2">{{lang('Recruitment Speak')}}</th>
                        </tr>
                      </thead>
                      <tbody id="language_ability">
                        @foreach ($data->language as $item)
                            <tr>
                                <td> {{$item->language}} </td>
                                <td> {{$item->hear}} </td>
                                <td> {{$item->read}} </td>
                                <td> {{$item->write}} </td>
                                <td> {{$item->speak}} </td>
                            </tr>
                        @endforeach
                      </tbody>
                      
                      <thead>
                        <tr>
                          <th colspan="6" class="table-secondary py-1">{{lang('Recruitment Social Activities / Organizations')}} <span class="text-danger">*</span></th>
                        </tr>
                        <tr>
                          <th rowspan="2">{{lang('Recruitment Social Activities / Organizations')}}</th>
                          <th rowspan="2">{{lang('Recruitment position')}}</th>
                          <th rowspan="2">{{lang('Recruitment city')}}</th>
                          <th colspan="3" class="text-center">{{lang('Recruitment duration')}}</th>
                        </tr>
                      </thead>
                      <tbody id="Social_Activities">
                        @foreach ($data->social as $item)
                            <tr>
                                <td> {{ $item->field }} </td>
                                <td> {{ $item->organizer }} </td>
                                <td> {{ $item->city }} </td>
                                <td> {{ $item->start }} </td>
                                <td> {{ $item->finish }} </td>
                            </tr>
                        @endforeach
                      </tbody>
                      
                      <thead>
                        <tr>
                          <th colspan="6" class="table-secondary py-1">{{lang('Recruitment Leisure Activities: Types of Activities')}} <span class="text-danger">*</span></th>
                        </tr>
                        <tr>
                          <th>{{lang('Recruitment Leisure Activities: Types of Activities')}}</th>
                          <th colspan="2">{{lang('Recruitment active')}}</th>
                          <th colspan="3">{{lang('Recruitment Passive')}}</th>
                        </tr>
                      </thead>
                      <tbody id="Leisure_Activities">
                        @foreach ($data->leisure as $item)
                            <tr>
                                <td> {{ $item->leisure_activities }} </td>
                                <td> {{ $item->active }} </td>
                                <td> {{ $item->passive }} </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

            </div>
        </div>
    </div>
</section>
