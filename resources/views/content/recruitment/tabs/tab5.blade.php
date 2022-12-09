
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    @foreach ($data->history as $item)
                        <table class="table table-sm mb-3">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-middle"><span></span></th>
                                    <th colspan="2" class="text-center align-middle">{{lang('Recruitment Years of service')}}</th>
                                    <th rowspan="2" class="text-center align-middle">{{lang('Recruitment salary')}}</th>
                                    <th rowspan="2" class="text-center align-middle">{{lang('Recruitment subsidy')}}</th>
                                    <th rowspan="2" class="text-center align-middle">{{lang('Recruitment Position/position')}}</th>
                                </tr>
                                <tr>
                                    <th>{{lang('Recruitment Years of service month')}}</th>
                                    <th>{{lang('Recruitment Years of service year')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><b>{{lang('Recruitment start')}}</b></td>
                                    <td>{{($item->tgl_start) ? $item->tgl_start->name : ''}}</td>
                                    <td>{{$item->start_year}}</td>
                                    <td>{{$item->start_salary}}</td>
                                    <td>{{$item->start_subsidy}}</td>
                                    <td>{{$item->start_position}}</td>
                                </tr>
                                <tr>
                                    <td><b>{{lang('Recruitment finish')}}</b></td>
                                    <td>{{($item->tgl_end) ? $item->tgl_end->name : ''}}</td>
                                    <td>{{$item->finish_year}}</td>
                                    <td>{{$item->finish_salary}}</td>
                                    <td>{{$item->finish_subsidy}}</td>
                                    <td>{{$item->finish_position}}</td>
                                </tr>
                                <tr class="table-light">
                                    <th colspan="6">{{lang('Recruitment Company Name, Address & Telephone')}}</th>
                                </tr>
                                <tr>
                                    <td colspan="6">{{$item->company_name_and_address}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">{{lang('Recruitment Type of business')}}</td>
                                    <td colspan="4">{{$item->type_of_business}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">{{lang('Recruitment Reason to stop')}}</td>
                                    <td colspan="4">{{$item->reason_to_stop}}</td>
                                </tr>
                                <tr class="table-light">
                                    <th colspan="6">{{lang('Recruitment Brief Overview of Duties, Responsibilities & Authorities in Last Position')}}</th>
                                </tr>
                                <tr>
                                    <td colspan="4">{{$item->brief_overview}}</td>
                                </tr>
                                <tr class="table-light">
                                    <th colspan="6">{{lang('Recruitment Position in the Organizational Structure')}}</th>
                                </tr>
                                <tr>
                                    <td colspan="6">{{$item->position_struktur_organisasi}}</td>
                                </tr>
                                </tbody>
                        </table>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
