<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentFamilyStructure extends Model
{
    use HasFactory;
    protected $table = 'recruitment_family_structure';
    protected $primaryKey = 'id';

    protected $guarded = [];
    // protected $fillable = [
    //     'recruitment_id',
    //     'structure',
    //     'name',
    //     'gender',
    //     'age',
    //     'education',
    //     'position',
    //     'company',
    // ];

    public function payloadInsert($request)
    {
        $payload = [
            'name'                          => $request->father,
            'gender'                        => $request->father_gender,
            'age'                           => $request->father_age,
            'education'                     => $request->father_education,
            'position'                      => $request->father_position,
            'company'                       => $request->father_company,
        ];
        return $payload;
    }


    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now()->toDateTimeString();
        });

        static::updating(function($model) {
            $model->updated_at = Carbon::now()->toDateTimeString();
        });
    }

    public function lp()
    {
        return $this->hasOne(Option::class, 'id', 'gender');
    }

    public function pendidikan()
    {
        return $this->hasOne(Option::class, 'id', 'education');

    }
}
