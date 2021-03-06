<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Drug;
use App\Models\DrugForm;
use App\Models\DrugType;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    /**
     * Untuk menampilkan semua obat
     */
    public function index(Request $request)
    {
        $drugTypes = DrugType::all();
        $drugForms = DrugForm::all();
        $brands = Brand::all();
        $drugs = Drug::all();

        if ($request->name) {
            $drugs = $drugs->filter(function ($item) use ($request) {
                return false !== stristr($item->name, $request->name);
            });
        }

        return view("pages.customer.products", compact("drugTypes", "drugForms", "brands", "drugs"));
    }

    /**
     * Untuk menampilkan obat-obat berdasarkan kategorinya
     */
    public function showByCategory(Request $request, DrugType $drugType)
    {
        $drugs = Drug::where("drug_type_id", $drugType->id)->get();
        $drugTypes = DrugType::all();
        $drugForms = DrugForm::all();
        $brands = Brand::all();
        return view("pages.customer.products", compact("drugType", "drugTypes", "drugForms", "brands", "drugs"));
    }

    public function searchProduct(Request $request)
    {
        $drugs = Drug::where(function ($query) use ($request) {
            $query->when(!empty($request->brands), function ($query) use ($request) {
                $query->whereIn("brand_id", $request->brands);
            })->when(!empty($request->drug_types), function ($query) use ($request) {
                $query->whereIn("drug_type_id", $request->drug_types);
            })->when(!empty($request->drug_forms), function ($query) use ($request) {
                $query->whereIn("drug_form_id", $request->drug_forms);
            })->when(!empty($request->price), function ($query) use ($request) {
                $query->whereBetween("price", [$request->price["min"], $request->price["max"]]);
            })->when(!empty($request->name), function ($query) use ($request) {
                $query->where("name", "like", "%" . $request->name . "%");
            });
        })->orderBy("name", $request->order_by ?? "asc")->get();

        if ($request->ajax()) {
            return response($drugs);
        }
    }

    public function detailProduct(Drug $drug)
    {
        return view("pages.customer.product-detail", compact("drug"));
    }
}
