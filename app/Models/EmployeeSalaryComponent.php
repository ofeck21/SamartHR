<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryComponent extends Model
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

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function salary_component()
    {
        return $this->belongsTo(SalaryComponent::class);
    }
    
    public function salaryComponent()
    {
        return $this->belongsTo(SalaryComponent::class);
    }
}
