<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
        <tr>
            <td rowspan="3" style="text-align: center;">LOGO</td>
            <td rowspan="3" style="text-align: center;">FORMULIR LAMARAN KERJA</td>
            <td style="border-right:0; padding-left:10px">No Dokumen</td>
            <td style="border-left:0"> : FR – SDM – 1 / 1 / 03 / 01</td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px">Revisi</td>
            <td style="border-left:0"> : 1 </td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px">Tgl. Berlaku</td>
            <td style="border-left:0"> : 18 Juli 2022</td>
        </tr>
    </table>
    <table style="width:100%;margin-top:20px">
        <tr>
            <td> Nama Lengkap</td>
            <td> : {{$data->fullname}} </td>
            <td rowspan="3">
                (
                    @if ($data->gender->id == 16)
                    L / <del>P</del>
                    @else
                    <del>L</del> / P                        
                    @endif
                )*	
            </td>
            <td rowspan="3" style="width:100px">
                <div  style="width: 100px; height: 150px;border:double 1px black;position:absolute;background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;background-image:url({{$data->photos[0]->public_path}})"></div>
            </td>
        </tr>
        <tr>
            <td>Tempat,Tanggal Lahir</td>
            <td> : {{$data->place_of_birth. ', '. $data->date_of_birth}} </td>
        </tr>
        <tr>
            <td>Posisi yang Dilamar</td>
            <td>: {{$data->posisi_dilamar}}</td>
        </tr>
    </table>

    <table style="width:100%;margin-top:100px"  cellspacing="0" cellpadding="0" border="1">
        <tr style="background-color: rgb(153, 153, 153)">
            <th>Alamat KTP</th>
            <th>Alamat Domisili</th>
            <th colspan="2">Telepon & E-mail</th>
        </tr>
        <tr>
            <td style="text-align: center" rowspan="3"> {{$data->id_card_address}} </td>
            <td style="text-align: center" rowspan="3"> {{$data->residence_address}} </td>
            <td style="border-right:0; padding-left:10px;width:50px">HP</td>
            <td style="border-left: 0">: {{$data->mobile_phone_number}}</td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px;width:50px">Tlp</td>
            <td style="border-left: 0">: {{$data->phone_number}}</td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px;width:50px">Email</td>
            <td style="border-left: 0">: {{$data->email}}</td>
        </tr>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <tr style="background-color: rgb(153, 153, 153)">
            <th>Tanda Pengenal</th>
            <th>Nomor</th>
            <th>Masa Berlaku</th>
        </tr>
        <tr>
            <td style="padding-left: 10px">KTP</td>
            <td style="padding-left: 10px">{{$data->nik}}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        @foreach ($data->card as $item)
            <tr>
                <td style="padding-left: 10px"> {{ ($item->is_drivers_license == '1') ? 'SIM '.$item->type : $item->type}} </td>
                <td style="padding-left: 10px"> {{$item->card_number}} </td>
                <td style="text-align:center"> {{$item->validity_period}} </td>
            </tr>
        @endforeach
    </table>

    <table style="width: 100%;margin-top:20px">
        <tr>
            <td style="width:33.3333%;padding-right: 20px">
                <div>Agama</div>
                <div style="border:solid 1px black;padding:2px 5px;">{{($data->religion) ? $data->religion->name : ''}}</div>
            </td>
            <td style="width:33.3333%;padding: 0 20px">
                <div>Suku Bangsa</div>
                <div style="border:solid 1px black;padding:2px 5px;">{{$data->tribes}}</div>
            </td>
            <td style="width:33.3333%;padding-left: 20px">
                <div>Kewarganegaraan</div>
                <div style="border:solid 1px black;padding:2px 5px;"> {!!($data->citizenship == 'WNI') ? 'WNI / <del>Keturunan</del>' : '<del>WNI</del> / Keturunan'!!} *</div>
            </td>
        </tr>
    </table>

    <table style="width: 100%;margin-top:20px">
        <tr>
            <td style="width:33.3333%;padding-right: 20px">
                <div>Golongan Darah</div>
                <table style="width: 100%" cellspacing="0" cellpadding="0" border="1">
                    <tr>
                        <td style="text-align:center;width: 25%"> {!! ($data->blood_group->name == 'A') ? 'A' : '<del>A</del>' !!}</td>
                        <td style="text-align:center;width: 25%"> {!! ($data->blood_group->name == 'B') ? 'B' : '<del>B</del>' !!}</td>
                        <td style="text-align:center;width: 25%"> {!! ($data->blood_group->name == 'AB') ? 'AB' : '<del>AB</del>' !!}</td>
                        <td style="text-align:center;width: 25%"> {!! ($data->blood_group->name == 'O') ? 'O' : '<del>O</del>' !!}</td>
                    </tr>
                </table>
            </td>
            <td style="width:33.3333%;padding: 0 20px">
                <div>Tinggi & Berat Badan</div>
                <table style="width: 100%" cellspacing="0" cellpadding="0" border="1">
                    <tr>
                        <td style="text-align:center;width: 50%"> {{$data->width}} cm</td>
                        <td style="text-align:center;width: 50%"> {{$data->height}} kg</td>
                    </tr>
                </table>
            </td>
            <td style="width:33.3333%;padding-left: 20px">
                <div>Kacamata *</div>
                <table style="width: 100%" cellspacing="0" cellpadding="0" border="1">
                    <tr>
                        <td style="text-align:center;width: 50%"> {!! ($data->glasses == 'n') ? 'Ya' : '<del>Ya</del>' !!} </td>
                        <td style="text-align:center;width: 50%"> {!! ($data->glasses == 'y') ? 'Ya' : '<del>Tidak</del>' !!} </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="5" border="1">
        <tr>
            <td style="width: 50%">
                Pernahkah Saudara sakit keras / operasi / kecelakaan berat ? Jika Pernah, bilamana dan apa akibat yang dirasakan hingga sekarang ?
            </td>
            <td style="width: 50%"> {{$data->question1}} </td>
        </tr>
        <tr>
            <td style="width: 50%">Sebutkan jika Saudara memiliki cacad fisik / gangguan kesehatan</td>
            <td style="width: 50%">{{$data->question2}}</td>
        </tr>
    </table>

    <div style="margin-top: 20px">Susunan Keluarga (termasuk diri Saudara)</div>
    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
              <th rowspan="2">Hubungan Keluarga </th>
              <th rowspan="2">Nama Lengkap</th>
              <th rowspan="2">L/P</th>
              <th rowspan="2">Usia(th)</th>
              <th rowspan="2">Pendidikan</th>
              <th colspan="2" class="text-center">Pekerjaan Terakhir</th>
            </tr>
            <tr>
              <th>Jabatan</th>
              <th>Perusahaan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data->family as $item)
                @if ($item->structure == 'father' || $item->structure == 'mother' || $item->structure == 'sibling')
                    <tr>
                        @php
                            $structure = ['father' => 'Ayah','mother' => 'Ibu','sibling' => 'Saudara','child' => 'Anak', 'husband' => 'Suami', 'wife' => 'Istri'];
                        @endphp
                        <td style="padding-left: 10px"> {{$structure[$item->structure]}} </td>
                        <td style="padding-left: 10px"> {{$item->name}} </td>
                        <td style="padding-left: 10px"> {{($item->lp->name == 'male') ? 'L' : 'P'}} </td>
                        <td style="padding-left: 10px"> {{$item->age}} </td>
                        <td style="padding-left: 10px"> {{ ($item->pendidikan) ? $item->pendidikan->name : ''}} </td>
                        <td style="padding-left: 10px"> {{$item->position}} </td>
                        <td style="padding-left: 10px"> {{$item->company}} </td>
                    </tr>
                @endif
            @endforeach
        </tbody>

    </table>
    <div style="page-break-after:always">&nbsp;</div> 

    <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
        <tr>
            <td rowspan="3" style="text-align: center;">LOGO</td>
            <td rowspan="3" style="text-align: center;">FORMULIR LAMARAN KERJA</td>
            <td style="border-right:0; padding-left:10px">No Dokumen</td>
            <td style="border-left:0"> : FR – SDM – 1 / 1 / 03 / 01</td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px">Revisi</td>
            <td style="border-left:0"> : 1 </td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px">Tgl. Berlaku</td>
            <td style="border-left:0"> : 18 Juli 2022</td>
        </tr>
    </table>

    <div style="margin-top: 20px"> Status Perkawinan : Belum Kawin / Kawin / Duda / Janda * </div>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
              <th rowspan="2">Hubungan Keluarga </th>
              <th rowspan="2">Nama Lengkap</th>
              <th rowspan="2">L/P</th>
              <th rowspan="2">Usia(th)</th>
              <th rowspan="2">Pendidikan</th>
              <th colspan="2" class="text-center">Pekerjaan Terakhir</th>
            </tr>
            <tr>
              <th>Jabatan</th>
              <th>Perusahaan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data->family as $item)
                @if ($item->structure == 'child' || $item->structure == 'husband' || $item->structure == 'wife')
                    <tr>
                        @php
                            $structure = ['father' => 'Ayah','mother' => 'Ibu','sibling' => 'Saudara','child' => 'Anak', 'husband' => 'Suami', 'wife' => 'Istri'];
                        @endphp
                        <td style="padding-left: 10px"> {{$structure[$item->structure]}} </td>
                        <td style="padding-left: 10px"> {{$item->name}} </td>
                        <td style="padding-left: 10px"> {{($item->lp->name == 'male') ? 'L' : 'P'}} </td>
                        <td style="padding-left: 10px"> {{$item->age}} </td>
                        <td style="padding-left: 10px"> {{ ($item->pendidikan) ? $item->pendidikan->name : ''}} </td>
                        <td style="padding-left: 10px"> {{$item->position}} </td>
                        <td style="padding-left: 10px"> {{$item->company}} </td>
                    </tr>
                @endif
            @endforeach
        </tbody>

    </table>

    

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
              <th colspan="6" class="table-secondary align-bottom py-1">PENDIDIKAN FORMAL</th>
            </tr>
            <tr class="table-bordered">
              <th class="align-bottom" rowspan="2">Tingkat</th>
              <th class="align-bottom" rowspan="2">Nama Sekolah<br>(Fakultas/Jurusan)</th>
              <th class="align-bottom" rowspan="2">Tempat / Kota</th>
              <th class="align-bottom text-center" colspan="2">Tahun</th>
              <th class="align-bottom" rowspan="2">Lulus/Tidak</th>
            </tr>
            <tr>
              <th class="align-bottom">Mulai</th>
              <th class="align-bottom">Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->education as $item)
                <tr>
                    <td style="padding-left:10px"> {{ ($item->tingkat) ? $item->tingkat->name : ''}} </td>
                    <td style="padding-left:10px"> {{$item->school_name}} </td>
                    <td style="padding-left:10px"> {{$item->city}} </td>
                    <td style="padding-left:10px"> {{$item->start}} </td>
                    <td style="padding-left:10px"> {{$item->finish}} </td>
                    <td style="padding-left:10px"> {{($item->graduated == 'y') ? 'Lulus' : 'Tidak'}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
                <th colspan="5">KURSUS / PELATIHAN</th>
            </tr>
            <tr>
                <th>Bidang / Jenis</th>
                <th>Penyelenggara</th>
                <th>Tempat / Kota</th>
                <th>Waktu</th>
                <th>Dibiayai Oleh <br> (Sertifikat/Tidak)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->training as $item)
                <tr>
                    <td style="padding-left: 10px"> {{$item->field}} </td>
                    <td style="padding-left: 10px"> {{$item->organizer}} </td>
                    <td style="padding-left: 10px"> {{$item->city}} </td>
                    <td style="padding-left: 10px"> {{$item->times}} </td>
                    <td style="padding-left: 10px"> {{$item->funded_by}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
                <th colspan="5">SERTIFIKASI</th>
            </tr>
            <tr>
                <th>Bidang / Jenis</th>
                <th>Penyelenggara</th>
                <th>Tempat / Kota</th>
                <th>Masa Berlaku</th>
                <th>Dibiayai Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->certificate as $item)
                <tr>
                    <td style="padding-left: 10px"> {{$item->field}} </td>
                    <td style="padding-left: 10px"> {{$item->organizer}} </td>
                    <td style="padding-left: 10px"> {{$item->city}} </td>
                    <td style="padding-left: 10px"> {{$item->start . " - ". $item->finish}} </td>
                    <td style="padding-left: 10px"> {{$item->funded_by}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
                <th colspan="5">KEMAMPUAN BAHASA (Diisi dengan : Baik Sekali, Baik, Cukup)</th>
            </tr>
            <tr>
                <th>Macam Bahasa</th>
                <th>Mendengar</th>
                <th>Membaca</th>
                <th>Menulis</th>
                <th>Berbicara</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->language as $item)
                <tr>
                    <td style="padding-left: 10px"> {{$item->language}} </td>
                    <td style="padding-left: 10px"> {{strtoupper($item->hear)}} </td>
                    <td style="padding-left: 10px"> {{strtoupper($item->read)}} </td>
                    <td style="padding-left: 10px"> {{strtoupper($item->write)}} </td>
                    <td style="padding-left: 10px"> {{strtoupper($item->speak)}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
                <th rowspan="2">Kegiatan Sosial / Organisasi</th>
                <th rowspan="2">Jabatan</th>
                <th rowspan="2">Kota</th>
                <th colspan="2">Lamanya</th>
            </tr>
            <tr>
                <th> Mulai </th>
                <th> Selesai </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->social as $item)
                <tr>
                    <td style="padding-left: 10px"> {{$item->field}} </td>
                    <td style="padding-left: 10px"> {{$item->organizer}} </td>
                    <td style="padding-left: 10px"> {{$item->city}} </td>
                    <td style="padding-left: 10px"> {{$item->start}} </td>
                    <td style="padding-left: 10px"> {{$item->finish}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
        <thead style="background-color: rgb(153, 153, 153)">
            <tr>
                <th>Kegiatan Di Waktu Luang : Jenis Kegiatan</th>
                <th>Aktif</th>
                <th>Pasif</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->leisure as $item)
                <tr>
                    <td style="padding-left: 10px"> {{$item->leisure_activities}} </td>
                    <td style="padding-left: 10px"> {{$item->active}} </td>
                    <td style="padding-left: 10px"> {{$item->passive}} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $a = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    @endphp

    @foreach ($data->history as $key => $item)
        <table style="width:100%;margin-top:20px"  cellspacing="0" cellpadding="0" border="1">
            <thead style="background-color: rgb(153, 153, 153)">
                <tr>
                    <th rowspan="2" class="text-center align-middle"><span>{{$a[$key]}}</span></th>
                    <th colspan="2" class="text-center align-middle">Masa Kerja</th>
                    <th rowspan="2" class="text-center align-middle">Gaji</th>
                    <th rowspan="2" class="text-center align-middle">Tunjangan</th>
                    <th rowspan="2" class="text-center align-middle">Position/position</th>
                </tr>
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color: rgb(153, 153, 153)"><b>Mulai</b></td>
                    <td style="padding-left: 10px"> {{$item->tgl_start->name}} </td>
                    <td style="padding-left: 10px"> {{$item->start_year}} </td>
                    <td style="padding-left: 10px"> Rp. {{rp($item->start_salary)}} </td>
                    <td style="padding-left: 10px"> Rp. {{rp($item->start_subsidy)}} </td>
                    <td style="padding-left: 10px"> {{$item->start_position}} </td>
                </tr>
                <tr>
                    <td style="background-color: rgb(153, 153, 153)"><b>Selesai</b></td>
                    <td style="padding-left: 10px"> {{$item->tgl_end->name}} </td>
                    <td style="padding-left: 10px"> {{$item->finish_year}} </td>
                    <td style="padding-left: 10px"> Rp. {{rp($item->finish_salary)}} </td>
                    <td style="padding-left: 10px"> Rp. {{rp($item->finish_subsidy)}} </td>
                    <td style="padding-left: 10px"> {{$item->finish_position}} </td>
                </tr>
            </tbody>
        </table>
        <div>
            <div colspan="6">Nama, Alamat & Telepon Perusahaan :</div>
        </div>
        <div>
            <div colspan="6"> {{$item->company_name_and_address}} </div>
        </div>
        <div>
            <div colspan="6">Jenis Usaha : {{$item->type_of_business}} </div>
        </div>
        <div>
            <div colspan="6">Alasan Berhenti : {{$item->reason_to_stop}} </div>
        </div>
        <div>
            <div colspan="6">Gambaran Singkat Mengenai Tugas, Tanggung Jawab & Wewenang pada Jabatan Terakhir :</div>
        </div>
        <table style="width:100%;"  cellspacing="0" cellpadding="0" border="1">
            <tr>
                <td style="width: 50% ; padding-left:10px">
                    {{$item->brief_overview}}
                </td>
                <td style="width: 50% ; padding-left:10px">
                    <div>Posisi Jabatan pada Struktur Organisasi : </div>
                    <div> {{$item->position_struktur_organisasi}} </div>
                </td>
            </tr>
        </table>
    @endforeach
    
    <div style="page-break-after:always">&nbsp;</div> 
    <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
        <tr>
            <td rowspan="3" style="text-align: center;">LOGO</td>
            <td rowspan="3" style="text-align: center;">FORMULIR LAMARAN KERJA</td>
            <td style="border-right:0; padding-left:10px">No Dokumen</td>
            <td style="border-left:0"> : FR – SDM – 1 / 1 / 03 / 01</td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px">Revisi</td>
            <td style="border-left:0"> : 1 </td>
        </tr>
        <tr>
            <td style="border-right:0; padding-left:10px">Tgl. Berlaku</td>
            <td style="border-left:0"> : 18 Juli 2022</td>
        </tr>
    </table>

    <div style="margin-top: 20px"> Gaji awal yang diharapkan : Rp. {{rp($data->salary->gaji)}} /bulan</div>
    <table  style="width: 100%;" cellspacing="0" cellpadding="5" border="1">
        <tr>
            <td style="width: 50%">Apakah saat ini Saudara mempunyai pekerjaan sampingan/part time ?Dimana ? dan sebagai apa ?</td>
            <td>
                {{$data->salary->question3}}
            </td>
        </tr>
    </table>

    <div style="margin-top: 20px"> Sebutkan kelebihan & kekurangan Saudara yang berhubungan penyelesaian tugas/pekerjaan</div>
    <table  style="width: 100%;" cellspacing="0" cellpadding="5" border="1">
        <tr>
            <td>
                {{$data->salary->question4}}
            </td>
        </tr>
    </table>

    @foreach ($data->referensi as $item)
        
        @if ($item->pekerjaan_pendidikan)
                <table style="width: 100%;margin-top:20px" cellspacing="0" cellpadding="0" border="1">
                    <tr>
                        <th colspan="3" style="background-color: rgb(153, 153, 153)">{{$item->deskripsi}}</th>
                    </tr>
                    <tr>
                        <td style="width:30%;padding-left:10px" rowspan="2">
                            <div>Hubungan : </div>
                            <div>{{$item->hubungan}}</div>
                        </td>
                        <td style="width:35%;padding-left:10px">
                            <div>
                                <div> Nama : </div>
                                <div> {{$item->nama}} </div>
                            </div>
                        </td>
                        <td style="width:35%;padding-left:10px">
                            <div>
                                <div> Telp : </div>
                                <div> {{$item->telp}} </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px">
                            <div>
                                <div> Alamat : </div>
                                <div> {{$item->alamat}} </div>
                            </div>
                        </td>
                    
                        <td style="padding-left:10px">
                            <div>
                                <div> Pekerjaan/Pendidikan : </div>
                                <div> {{$item->pekerjaan_pendidikan}} </div>
                            </div>
                        </td>
                    </tr>
                </table>
        @else
                <table style="width: 100%;margin-top:20px" cellspacing="0" cellpadding="0" border="1">
                    <tr>
                        <th colspan="2" style="background-color: rgb(153, 153, 153)">{{$item->deskripsi}}</th>
                    </tr>
                    <tr>
                        <td style="width: 50%;padding-left:10px">
                            <div> Nama : </div>
                            <div> {{$item->nama}} </div>
                        </td>
                        <td style="padding-left:10px">
                            <div>Hubungan : </div>
                            <div>{{$item->hubungan}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px">
                            <div> Alamat : </div>
                            <div> {{$item->alamat}} </div>
                        </td>
                        <td style="padding-left:10px">
                            <div> Telp : </div>
                            <div> {{$item->telp}} </div>
                        </td>
                    </tr>
                </table>
        @endif
        
    @endforeach

    <div style="margin-top: 20px">Dengan ini Saya menyatakan bahwa keterangan yang Saya tuliskan diatas, dapat dipertanggungjawabkan kebenarannya. Apabila saya diterima bekerja, dan dikemudian hari ditemukan hal-hal yang bertentangan dengan keterangan tersebut diatas, maka Saya bersedia menerima sanksi sesuai dengan ketentuan yang berlaku</div>
    <div style="text-align: right;margin-top: 10px">Jakarta, ……………………………………20</div>
    <div style="text-align: right;margin-top: 100px">(
        {{$data->fullname}}
        {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
        )</div>
    

</body>
</html>