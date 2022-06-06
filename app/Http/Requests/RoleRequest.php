<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles',
            'permissions.*' => 'integer',
            'permissions' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama peran tidak boleh kosong',
            'name.string' => 'Nama peran harus berupa string',
            'name.unique' => 'Peran ' . $this->request->get('name') . ' sudah ada',
            'permissions.*.integer' => 'ID hak akses harus berupa angka',
            'permissions.required' => 'Hak akses tidak boleh kosong',
            'permissions.array' => 'Hak akses harus berupa array',
        ];
    }
}
