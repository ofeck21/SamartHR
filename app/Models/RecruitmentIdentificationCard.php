<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentIdentificationCard extends Model
{
    use HasFactory;
    protected $table = 'recruitment_identification_card';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // protected $fillable = [
    //     'recruitment_id',
    //     // 'identity_card',
    //     // 'identity_card_number_card',
    //     // 'validity_period_card',
    //     'drivers_license',
    //     'identity_card_number_drivers',
    //     'validity_period_drivers',
    //     'religion',
    //     'tribes',
    //     'citizenship',
    //     'blood_group',
    //     'height',
    //     'width',
    //     'glasses',
    //     'pasport_number',
    //     'passport_validity',
    //     // 'question1',
    //     // 'question2',
    // ];

    // public function payloadInsert($request)
    // {
    //     $payload = [
    //         // 'identity_card'                 => $request->identity_card,
    //         // 'identity_card_number_card'     => $request->identity_card_number_ktp,
    //         // 'validity_period_card'          => $request->validity_period_ktp,
    //         'drivers_license'               => $request->drivers_license,
    //         'identity_card_number_drivers'  => $request->identity_card_number_sim,
    //         'validity_period_drivers'       => $request->validity_period_sim,
    //         'religion'                      => $request->religion,
    //         'tribes'                        => $request->tribes,
    //         'citizenship'                   => $request->citizenship,
    //         'blood_group'                   => $request->blood_group,
    //         'height'                        => $request->height,
    //         'width'                         => $request->width,
    //         'glasses'                       => $request->kacamata,
    //         'pasport_number'                => $request->pasport_number,
    //         'passport_validity'             => $request->passport_validity,
    //         // 'question1'                     => $request->question1,
    //         // 'question2'                     => $request->question2,
    //     ];
    //     return $payload;
    // }


    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now()->toDateTimeString();
        });

        static::updating(function($model) {
            $model->updated_at = Carbon::now()->toDateTimeString();
        });
    }


}
