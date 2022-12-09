<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentFormalEducation extends Model
{
    use HasFactory;
    protected $table = 'recruitment_formal_education';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recruitment_id',
        'school_level',
        'school_name',
        'city',
        'start',
        'finish',
        'graduated',
    ];

    public function payloadInsert($request)
    {
        $payload = [
            // 'school_level'                  => 'SD',
            'school_name'                   => $request->sd_nama_sekolah,
            'city'                          => $request->sd_tempat_kota,
            'start'                         => $request->sd_mulai,
            'finish'                        => $request->sd_selesai,
            'graduated'                     => $request->sd_lulus,
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

    public function schoolLevel()
    {
        return $this->hasOne(Option::class, 'id', 'school_level');
    }
}
