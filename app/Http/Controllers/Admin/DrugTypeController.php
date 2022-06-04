<?php

namespace App\Http\Controllers\Admin;

use App\Models\DrugType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DrugTypeDataTable;
use App\Http\Requests\MassDestroyDrugTypeRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DrugTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DrugTypeDataTable $dataTable)
    {
        abort_if(Gate::denies("drug_type_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.drug-types.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("drug_type_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.drug-types.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies("drug_type_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $request->validate([
            'type' => 'required|max:255'
        ]);
        DrugType::create($request->all());
        return back()->withSuccess("Data tipe obat berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugType  $drugType
     * @return \Illuminate\Http\Response
     */
    public function show(DrugType $drugType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugType  $drugType
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugType $drugType)
    {
        abort_if(Gate::denies("drug_type_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.drug-types.edit", compact('drugType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DrugType  $drugType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrugType $drugType)
    {
        abort_if(Gate::denies("drug_type_update"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drugType->update($request->all());
        return redirect()->route('admin.drug-types.index')->withSuccess("Data tipe obat berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugType  $drugType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugType $drugType)
    {
        abort_if(Gate::denies("drug_type_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        if($drugType->drugs()->count() > 0) {
            alert()->error("Tipe obat tidak bisa dihapus, karena mempunyai relasi dengan data obat");
            return back();
        }
        $drugType->delete();
        return back()->withSuccess("Data tipe obat berhasil dihapus!");
    }

    public function massDestroy(MassDestroyDrugTypeRequest $request)
    {
        abort_if(Gate::denies("drug_type_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drugTypes = DrugType::whereIn('id', request('ids'))->get();
        foreach ($drugTypes as $drugType) {
            if($drugType->drugs()->count() > 0) {
                alert()->error("Satu atau lebih tipe obat tidak bisa dihapus, karena ada yang mempunyai relasi dengan data obat");
                return back();
            }
            $drugType->delete();
        }

        return redirect()->route('admin.drug-types.index')->withSuccess('Data tipe obat berhasil dihapus!');
    }
}
