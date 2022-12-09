
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        
                        <table class="table ">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Nomber</th>
                                <th>Period</th>
                            </tr>
                            
                            @foreach ($data->card as $key => $item)
                                <tr>
                                    <td> {{$key + 1}} </td>
                                    <td> {{ ($item->is_drivers_license == '1') ? 'SIM '.$item->type : $item->type }} </td>
                                    <td> {{$item->card_number}} </td>
                                    <td> {{$item->validity_period}} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
