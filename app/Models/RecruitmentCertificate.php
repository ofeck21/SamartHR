<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentCertificate extends Model
{
    use HasFactory;
    protected $table = 'recruitment_certificate';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recruitment_id',
        'field',
        'organizer',
        'city',
        'start',
        'finish',
        'funded_by',
    ];

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
