<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesFamilyStructure extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function familyStatus()
    {
        return $this->hasOne(Option::class, 'id', 'structure');
    }

    public function jenisKelamin()
    {
        return $this->hasOne(Option::class, 'id', 'gender');
    }

    public function pendidikan()
    {
        return $this->hasOne(Option::class, 'id', 'education');
    }

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
