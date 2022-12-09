<?php

namespace App\Models;

use App\Http\Requests\RecruitmentEmploymentHistoryRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    protected $table = 'recruitment';
    protected $primaryKey = 'id';

    protected $guarded = [];
    // protected $fillable = [
    //     'fullname',
    //     'place_of_birth',
    //     'date_of_birth',
    //     'gender',
    //     'mobile_phone_number',
    //     'phone_number',
    //     // 'photo',
    //     'email',
    //     'id_card_address',
    //     'residence_address',
    //     'marital_status',
    //     'first_name',
    //     'last_name',
    //     'nik',
    //     'file_nik',
    //     'no_kk',
    //     'file_no_kk',
    //     'no_skck',
    //     'file_no_skck',
    //     'status',
    // ];

    public function payloadInsert($request)
    {
        $payload = [
            'fullname'                      => $request->full_name,
            'place_of_birth'                => $request->place_of_birth,
            'date_of_birth'                 => $request->date_of_birth,
            'gender'                        => $request->gender,
            'mobile_phone_number'           => $request->mobile_phone_number,
            'phone_number'                  => $request->phone_number,

            'nik'                           => $request->nik,
            'file_nik'                      => $request->file_nik,
            'no_kk'                         => $request->no_kk,
            'file_no_kk'                    => $request->file_no_kk,
            'no_skck'                       => $request->no_skck,
            'file_no_skck'                  => $request->file_no_skck,

            // 'photo'                         => $request->photo,
            'email'                         => $request->email,
            'id_card_address'               => $request->id_card_address,
            'residence_address'             => $request->residence_address,
            'marital_status'                => $request->marital_status,

            'religion'                      => $request->religion,
            'tribes'                        => $request->tribes,
            'citizenship'                   => $request->citizenship,
            'blood_group'                   => $request->blood_group,
            'height'                        => $request->height,
            'width'                         => $request->width,
            'glasses'                       => $request->kacamata,
            'question1'                     => $request->question1,
            'question2'                     => $request->question2,
            'posisi_dilamar'                => $request->posisi_yang_dilamar,
        ];
        return $payload;
    }

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now()->toDateTimeString();
        });

        static::updating(function($model) {
            $model->updated_at = Carbon::now()->toDateTimeString();
        });
    }

    public function card()
    {
        return $this->hasMany(RecruitmentIdentificationCard::class, 'recruitment_id', 'id');
    }

    public function lp()
    {
        return $this->hasOne(Option::class, 'id', 'gender');
    }

    public function family()
    {
        return $this->hasMany(RecruitmentFamilyStructure::class,  'recruitment_id', 'id');
    }

    public function education()
    {
        return $this->hasMany(RecruitmentFormalEducation::class, 'recruitment_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(RecruitmentEmploymentHistory::class, 'recruitment_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(RecruitmentPhoto::class, 'recruitment_id', 'id');
    }

    public function training()
    {
        return $this->hasMany(RecruitmentTraining::class, 'recruitment_id', 'id');
    }

    public function certificate()
    {
        return $this->hasMany(RecruitmentCertificate::class, 'recruitment_id', 'id');
    }

    public function language()
    {
        return $this->hasMany(RecruitmentLanguage::class, 'recruitment_id', 'id');
    }

    public function social()
    {
        return $this->hasMany(RecruitmentSocialActivities::class, 'recruitment_id', 'id');
    }

    public function leisure()
    {
        return $this->hasMany(RecruitmentLeisureActivities::class, 'recruitment_id', 'id');
    }

    public function blood()
    {
        return $this->hasOne(Option::class, 'id', 'blood_group');
    }

    public function agama()
    {
        return $this->hasOne(Option::class, 'id', 'religion');
    }

    public function salary()
    {
        return $this->hasOne(RecruitmentSalary::class, 'recruitment_id', 'id');
    }

    public function referensi()
    {
        return $this->hasMany(RecruitmentReferensi::class, 'recruitment_id', 'id');
    }

    
}
