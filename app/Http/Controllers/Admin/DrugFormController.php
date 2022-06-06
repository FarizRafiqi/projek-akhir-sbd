<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DrugFormDataTable;
use App\Models\DrugForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDrugFormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DrugFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DrugFormDataTable $dataTable)
    {
        abort_if(Gate::denies("drug_form_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.drug-forms.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("drug_form_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.drug-forms.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies("drug_form_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $request->validate([
            'form' => 'required|max:255'
        ]);
        DrugForm::create($request->all());
        return back()->withSuccess("Data bentuk obat berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugForm  $drugForm
     * @return \Illuminate\Http\Response
     */
    public function show(DrugForm $drugForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugForm  $drugForm
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugForm $drugForm)
    {
        abort_if(Gate::denies("drug_form_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.drug-forms.edit", compact('drugForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DrugForm  $drugForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrugForm $drugForm)
    {
        abort_if(Gate::denies("drug_form_update"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drugForm->update($request->all());
        return redirect()->route('admin.drug-forms.index')->withSuccess("Data bentuk obat berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugForm  $drugForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugForm $drugForm)
    {
        abort_if(Gate::denies("drug_type_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        if($drugForm->drugs()->count() > 0) {
            alert()->error("Bentuk obat tidak bisa dihapus, karena mempunyai relasi dengan data obat");
            return back();
        }
        $drugForm->delete();
        return back()->withSuccess("Data bentuk obat berhasil dihapus.");
    }

    public function massDestroy(MassDestroyDrugFormRequest $request)
    {
        abort_if(Gate::denies("drug_form_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $drugForms = DrugForm::whereIn('id', request('ids'))->get();
        foreach ($drugForms as $drugForm) {
            if($drugForm->drugs()->count() > 0) {
                alert()->error("Satu atau lebih bentuk obat tidak bisa dihapus, karena ada yang mempunyai relasi dengan data obat");
                return back();
            }
            $drugForm->delete();
        }

        return redirect()->route('admin.drug-forms.index')->withSuccess('Data bentuk obat berhasil dihapus.');
    }
}
