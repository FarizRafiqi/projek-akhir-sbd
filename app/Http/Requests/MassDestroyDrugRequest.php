<?php

namespace App\Http\Requests;

use App\Models\Drug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDrugRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('drug_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $drug = new Drug();
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:' . $drug->getTable() . ',id'
        ];
    }

    public function messages()
    {
        return [
            "ids.required" => "Id tidak boleh kosong",
            "ids.array" => "Id harus berupa array, karena ini delete massal",
            "ids.*.exists" => "Satu atau lebih id obat tidak ditemukan di database"
        ];
    }
}
