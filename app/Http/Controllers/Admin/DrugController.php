<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drug;
use App\Models\DrugType;
use App\Models\DrugForm;
use Illuminate\Http\Request;
use App\DataTables\DrugDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
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
        abort_if(Gate::denies('drug_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return $dataTable->render("pages.admin.drugs.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('drug_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return view("pages.admin.drugs.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Drug::create($request->all());
        return back()->withSuccess('Data obat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        abort_if(Gate::denies('drug_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return view("pages.admin.drugs.show", compact('drug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        abort_if(Gate::denies('drug_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $drug_types = DrugType::all();
        $drug_forms = DrugForm::all();
        return view("pages.admin.drugs.edit", compact("drug", "drug_types", "drug_forms"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        abort_if(Gate::denies('drug_update'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $data = $request->except('image');
        if ($image = $request->file('image')) {
            $data['image'] = str_replace(" ", "", trim($image->getClientOriginalName()));
            $image->storeAs('img/drugs/' . auth()->id, $data["image"], "public");
        }

        $drug->update($data);
        return back()->withSuccess('Data obat ' . $drug->name . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        abort_if(Gate::denies('drug_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
    }
}
