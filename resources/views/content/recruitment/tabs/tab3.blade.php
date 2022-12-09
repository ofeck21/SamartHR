
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                
                <table class="table">
                    <thead>
                        <tr>
                          <th rowspan="2">{{lang('Recruitment connection family')}}</th>
                          <th rowspan="2">{{lang('Recruitment full name')}}</th>
                          <th rowspan="2">{{lang('Recruitment gander lp')}}</th>
                          <th rowspan="2">{{lang('Recruitment age in this year')}}</th>
                          <th rowspan="2">{{lang('Recruitment education')}}</th>
                          <th colspan="2" class="text-center">{{lang('Recruitment last job')}}</th>
                        </tr>
                        <tr>
                          <th>{{lang('Recruitment position')}}</th>
                          <th>{{lang('Recruitment company')}}</th>
                        </tr>
                    </thead>
                    @foreach ($data->family as $item)
                        @if ($item->structure == 'father' || $item->structure == 'mother' || $item->structure == 'sibling')
                            <tr>
                                <td> {{$item->structure}} </td>
                                <td> {{$item->name}} </td>
                                <td> {{($item->lp) ? $item->lp->name : ''}} </td>
                                <td> {{($item->age)? $item->age ." Tahun" : '-'}} </td>
                                <td> {{($item->pendidikan) ? $item->pendidikan->name : ''}} </td>
                                <td> {{$item->position}} </td>
                                <td> {{$item->company}} </td>                        
                            </tr>
                        @endif
                    @endforeach
                    <thead>
                        <tr>
                            <th colspan="2"> Status Perkawinan </th>
                            <th colspan="6">
                                @if ($data->marital_status == 8)
                                    <del>Belum Kawin</del> / <span class="text-success">Kawin</span> / <del>Duda</del> / <del>Janda</del> 
                                @endif

                                @if ($data->marital_status == 9)
                                    <span class="text-success"> Belum Kawin </span> / <del>Kawin</del> / <del>Duda</del> / <del>Janda</del> 
                                @endif

                                @if ($data->marital_status == 10)
                                    @if ($data->gender->id == 16)
                                        <del>Belum Kawin</del> / <del>Kawin</del> / <span class="text-success"> Duda </span>  / <del>Janda</del>                                     
                                    @else
                                        <del>Belum Kawin</del> / <del>Kawin</del> / <del>Duda</del> / <span class="text-success"> Janda </span>
                                    @endif
                                @endif

                                
                            </th>
                        </tr>
                    </thead>

                    @foreach ($data->family as $item)
                        @if ($item->structure == 'child' || $item->structure == 'husband' || $item->structure == 'wife')
                            <tr>
                                <td> {{$item->structure}} </td>
                                <td> {{$item->name}} </td>
                                <td> {{($item->lp) ? $item->lp->name : ''}} </td>
                                <td> {{($item->age)? $item->age ." Tahun" : '-'}} </td>
                                <td> {{($item->pendidikan) ? $item->pendidikan->name : ''}} </td>
                                <td> {{$item->position}} </td>
                                <td> {{$item->company}} </td>                        
                            </tr>
                        @endif
                    @endforeach
                </table>


            </div>
        </div>
    </div>
</section>
