<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentTraining extends Model
{
    use HasFactory;
    protected $table = 'recruitment_training';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recruitment_id',
        'field',
        'organizer',
        'city',
        'times',
        'funded_by',
    ];

    public function payloadInsert($request)
    {
        $payload = [
            'field'                         => $request->course_training_jenis,
            'organizer'                     => $request->course_training_penyelenggara,
            'city'                          => $request->course_training_tempat,
            'times'                         => $request->course_training_waktu,
            'funded_by'                     => $request->course_training_dibiayai
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
}
