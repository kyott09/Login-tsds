<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'type_employee_id' => 'nullable|exists:type_employees,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'fecha_ingreso' => 'nullable|date',
            'skills' => 'nullable|string',
            'estado_laboral' => 'nullable|string|max:100',
            'fecha_inicio_licencia' => 'nullable|date',
            'fecha_fin_licencia' => 'nullable|date|after_or_equal:fecha_inicio_licencia',
        ];
    }
}
