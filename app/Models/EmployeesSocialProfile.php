<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesSocialProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user() ? auth()->user()->id : 1;
            $model->updated_by = auth()->user() ? auth()->user()->id : 1;
        });

        static::updating(function($model) {
            $model->updated_by = auth()->user() ? auth()->user()->id : 1;
        });
    }

}
