<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesEducationProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'employees_education_profiles';
    
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

    public function schoolLevel()
    {
        return $this->hasOne(Option::class, 'id', 'school_level');
    }
}
