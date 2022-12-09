<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesImmigration extends Model
{
    use HasFactory;
    protected $table = 'employees_immigration';
    protected $guarded = [];

    public function documentType()
    {
        return $this->hasOne(Option::class, 'id', 'document_type_id');
    }

    public function issueBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
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
