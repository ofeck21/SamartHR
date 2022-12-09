<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentSocialActivities extends Model
{
    use HasFactory;
    protected $table = 'recruitment_social_activities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recruitment_id',
        'field',
        'organizer',
        'city',
        'start',
        'finish',
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
