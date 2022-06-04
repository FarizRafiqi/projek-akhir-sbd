<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\DrugForm;
use App\Models\DrugType;
use Illuminate\Foundation\Http\FormRequest;

class DrugRequest extends FormRequest
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
        $drugType = new DrugType();
        $drugForm = new DrugForm();
        $brand = new Brand();
        return [
            'name' => 'required',
            'drug_type_id' => 'required|exists:' . $drugType->getTable() . ',id',
            'drug_form_id' => 'required|exists:' . $drugForm->getTable() . ',id',
            'brand_id' => 'required|exists:' . $brand->getTable() . ',id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png|max:4096',
            'description' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama obat tidak boleh kosong!',
            'drug_type_id.required' => 'Tipe obat tidak boleh kosong!',
            'drug_form_id.required' => 'Bentuk obat tidak boleh kosong!',
            'brand_id.required' => 'Bentuk obat tidak boleh kosong!',
            'price.required' => 'Harga obat tidak boleh kosong!',
            'stock.required' => 'Stok obat tidak boleh kosong!',
            'description.string' => 'Deskripsi harus berupa karakter!',
            'price.numeric' => 'Harga harus berupa angka!',
            'stock.numeric' => 'Stok harus berupa angka!',
            'drug_type_id.exists' => 'Tipe obat tidak ada di database!',
            'drug_form_id.exists' => 'Bentuk obat tidak ada di database!',
            'brand_id.exists' => 'Merek obat tidak ada di database!',
            'price.min' => 'Harga tidak boleh minus!',
            'stock.min' => 'Stok tidak boleh minus!',
            'image.max' => ['file' => 'Ukuran gambar maksimal :max KB!'],
        ];
    }
}
