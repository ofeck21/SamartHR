
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    
                    <div class="row">
                        <div class="col-md-12 mb-1">
                          <div class="mb-2">
                            Gaji awal yang diharapkan : Rp. {{rp($data->salary->gaji)}} /bulan
                          </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            Apakah saat ini Saudara mempunyai pekerjaan sampingan/part time ? Dimana ? dan sebagai apa ?
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        {{$data->salary->question3}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12 mb-1">
                            Sebutkan kelebihan & kekurangan Saudara yang berhubungan penyelesaian tugas/pekerjaan
                            <table class="table table-bordered">
                                <tr>
                                    <td>{{$data->salary->question4}}</td>
                                </tr>
                            </table>
                        </div>
                      </div>
                      
                      <div class="row mt-2">
                      @foreach ($data->referensi as $item)
                        
                        @if ($item->pekerjaan_pendidikan)
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered mb-2">
                                    <tr>
                                        <th colspan="3">{{$item->deskripsi}}</th>
                                    </tr>
                                    <tr>
                                        <td style="width:30%" rowspan="4">
                                            <div>Hubungan : </div>
                                            <div>{{$item->hubungan}}</div>
                                        </td>
                                        <td style="width:35%">
                                            <div class="mb-1">
                                                <div> Nama : </div>
                                                <div> {{$item->nama}} </div>
                                            </div>
                                        </td>
                                        <td style="width:35%">
                                            <div class="mb-1">
                                                <div> Telp : </div>
                                                <div> {{$item->telp}} </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <div> Alamat : </div>
                                                <div> {{$item->alamat}} </div>
                                            </div>
                                        </td>
                                    
                                        <td>
                                            <div>
                                                <div> Pekerjaan/Pendidikan : </div>
                                                <div> {{$item->pekerjaan_pendidikan}} </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered mb-2">
                                    <tr>
                                        <th colspan="2">{{$item->deskripsi}}</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%">
                                            <div> Nama : </div>
                                            <div> {{$item->nama}} </div>
                                        </td>
                                        <td>
                                            <div>Hubungan : </div>
                                            <div>{{$item->hubungan}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div> Alamat : </div>
                                            <div> {{$item->alamat}} </div>
                                        </td>
                                        <td>
                                            <div> Telp : </div>
                                            <div> {{$item->telp}} </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                      
                      @endforeach
                    
                    
                      </div>


                </div>

            </div>
        </div>
    </div>
</section>
