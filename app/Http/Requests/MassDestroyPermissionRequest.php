<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $permission = new Permission();
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:' . $permission->getTable() . ',id'
        ];
    }

    public function messages()
    {
        return [
            "ids.required" => "Id tidak boleh kosong",
            "ids.array" => "Id harus berupa array, karena ini delete massal",
            "ids.*.exists" => "Satu atau lebih id hak akses tidak ditemukan di database"
        ];
    }
}
