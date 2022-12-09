<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function type()
    {
        return $this->hasOne(Option::class, 'id', 'company_type_id');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', '%'.$keyword.'%')
                ->orWhereHas('type', function($q) use ($keyword){
                    $q->where('name', 'like', '%'.$keyword.'%');
                })
                ->orWhere('phone', 'like', '%'.$keyword.'%')
                ->orWhere('website', 'like', '%'.$keyword.'%')
                ->orWhere('address', 'like', '%'.$keyword.'%');
    }
}
