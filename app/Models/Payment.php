<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    function payment_details(){
        return $this->hasMany(PaymentDetail::class);
    }

    public function payroll()
    {
        return $this->hasOne(PayrollJob::class, 'id', 'payroll_job_id');
    }
}
