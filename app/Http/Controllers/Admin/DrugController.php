<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drug;
use App\Models\DrugType;
use App\Models\DrugForm;
use App\DataTables\DrugDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DrugRequest;
use App\Http\Requests\MassDestroyDrugRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DrugDataTable $dataTable)
    {
        abort_if(Gate::denies("drug_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.drugs.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("drug_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drug_types = DrugType::all();
        $drug_forms = DrugForm::all();
        $drug_brands = Brand::all();
        return view("pages.admin.drugs.create", compact("drug_types", "drug_forms", "drug_brands"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrugRequest $request)
    {
        $data = $request->except("image");
        if ($image = $request->file("image")) {
            $data["image"] = str_replace(" ", "", trim($image->getClientOriginalName()));
            $image->storeAs("img/drugs/uploaded", $data["image"], "public");
        }
        Drug::create($data);
        return back()->withSuccess("Data obat berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        abort_if(Gate::denies("drug_show"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.drugs.show", compact("drug"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        abort_if(Gate::denies("drug_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drug_types = DrugType::all();
        $drug_forms = DrugForm::all();
        $drug_brands = Brand::all();
        return view("pages.admin.drugs.edit", compact("drug", "drug_types", "drug_forms", "drug_brands"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DrugRequest  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(DrugRequest $request, Drug $drug)
    {
        abort_if(Gate::denies("drug_update"), Response::HTTP_FORBIDDEN, "Forbidden");
        $data = $request->except("image");
        if ($image = $request->file("image")) {
            $data["image"] = str_replace(" ", "", trim($image->getClientOriginalName()));
            $image->storeAs("img/drugs/", $data["image"], "public");
        }

        $drug->update($data);
        return back()->withSuccess("Data obat " . $drug->name . " berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        abort_if(Gate::denies("drug_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        Storage::disk("public")->delete("img/drugs/" . $drug->image);
        $drug->delete();
        return redirect()->back()->withSuccess("Data obat berhasil dihapus!");
    }

    public function massDestroy(MassDestroyDrugRequest $request)
    {
        abort_if(Gate::denies("drug_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drugs = Drug::whereIn('id', request('ids'))->get();
        foreach ($drugs as $drug) {
            Storage::disk("public")->delete("img/drugs/" . $drug->image);
            $drug->delete();
        }

        return redirect()->route('admin.drugs.index')->withSuccess('Data obat berhasil dihapus!');
    }
}
