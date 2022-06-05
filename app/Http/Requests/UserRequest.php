<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $role = new Role();
        return [
            "role_id" => "required|exists:" . $role->getTable() . ",id|not_in:1",
            "image" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
            "name" => "required|string|max:255",
            "email" => [
                "required",
                "email",
                Rule::unique("users")->ignore($this->request->get("id")),
            ],
            "address" => "nullable|string",
            "phone_num" => "nullable|digits_between:0,14",
            "sex" => "nullable|in:male,female",
            "password" => "nullable|min:6",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Nama tidak boleh kosong.",
            "name.string" => "Nama harus berupa karakter.",
            "name.max" => ["string" => "Nama tidak boleh lebih dari :max karakter"],
            "role_id.required" => "Role tidak boleh kosong.",
            "role_id.exists" => "Role tidak ada di database.",
            "role_id.not_in" => "Role admin sudah ada",
            "image.image" => "File harus berupa gambar.",
            "image.mimes" => "Gambar harus berupa file dengan tipe: :values.",
            "image.max" => ["file" => "Ukuran gambar tidak boleh lebih dari :max KB"],
            "email.required" => "Email tidak boleh kosong.",
            "email.email" => "Email harus merupakan alamat email yang valid.",
            "email.unique" => "Email sudah terdaftar.",
            "address.string" => "Alamat harus berupa string.",
            "phone_num.digits_between" => "No. telepon harus berada diantara :min dan :max digit.",
            "sex.in" => "Jenis kelamin yang dipilih tidak valid.",
            "password.min" => "Password minimal terdiri dari :min karakter.",
        ];
    }
}
