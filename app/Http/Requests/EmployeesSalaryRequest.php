<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'salary_id'         => ['required'],
            'month'             => ['required'],
            'nominal'           => ['required'],
        ];
    }

    
    public function messages()
    {
        return [
            'required'  => lang('The :attribute field is required'),
            'email'     => lang('The :attribute must be a valid email address'),
            'numeric'   => lang('The :attribute must be a number'),
            'unique'    => lang('The :attribute has already been taken')
        ];
    }
}
