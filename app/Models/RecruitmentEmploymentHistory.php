<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentEmploymentHistory extends Model
{
    use HasFactory;
    protected $table = 'recruitment_employment_history';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recruitment_id',
        "start_month",
        "start_year",
        "start_salary",
        "start_subsidy",
        "start_position",
        "finish_month",
        "finish_year",
        "finish_salary",
        "finish_subsidy",
        "finish_position",
        "company_name_and_address",
        "type_of_business",
        "reason_to_stop",
        "brief_overview",
        "position_struktur_organisasi",
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now()->toDateTimeString();
        });

        static::updating(function($model) {
            $model->updated_at = Carbon::now()->toDateTimeString();
        });
    }

    public function tgl_start()
    {
        return $this->hasOne(Option::class, 'id', 'start_month');
    }

    public function tgl_end()
    {
        return $this->hasOne(Option::class, 'id', 'finish_month');
    }
}
