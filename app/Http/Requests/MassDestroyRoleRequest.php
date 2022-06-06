<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $role = new Role();
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:' . $role->getTable() . ',id'
        ];
    }

    public function messages()
    {
        return [
            "ids.required" => "Id tidak boleh kosong",
            "ids.array" => "Id harus berupa array, karena ini delete massal",
            "ids.*.exists" => "Satu atau lebih id peran tidak ditemukan di database"
        ];
    }
}
