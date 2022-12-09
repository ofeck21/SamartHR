<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLevelFacility extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

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

    public function component()
    {
        return $this->belongsTo(SalaryComponent::class, 'salary_component_id', 'id');
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
}
