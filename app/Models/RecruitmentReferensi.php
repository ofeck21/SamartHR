<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentReferensi extends Model
{
    use HasFactory;
    protected $table = 'recruitment_referensi';
    protected $primaryKey = 'id';

    protected $guarded = [];

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
