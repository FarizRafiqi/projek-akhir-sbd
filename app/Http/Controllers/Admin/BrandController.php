<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BrandDataTable;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBrandRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrandDataTable $dataTable)
    {
        abort_if(Gate::denies("brand_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.brands.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("brand_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.brands.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies("brand_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $request->validate([
            'name' => 'required|max:255'
        ]);
        Brand::create($request->all());
        return back()->withSuccess("Data merek berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        abort_if(Gate::denies("brand_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.brands.edit", compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        abort_if(Gate::denies("brand_update"), Response::HTTP_FORBIDDEN, "Forbidden");
        $brand->update($request->all());
        return redirect()->route('admin.brands.index')->withSuccess("Data merek berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        abort_if(Gate::denies("brand_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        if($brand->drugs()->count() > 0) {
            alert()->error("Merek obat tidak bisa dihapus, karena mempunyai relasi dengan data obat");
            return back();
        }
        $brand->delete();
        return back()->withSuccess("Data merek obat berhasil dihapus.");
    }

    public function massDestroy(MassDestroyBrandRequest $request)
    {
        abort_if(Gate::denies("brand_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $brands = Brand::whereIn('id', request('ids'))->get();
        foreach ($brands as $brand) {
            if($brand->drugs()->count() > 0) {
                alert()->error("Satu atau lebih merek obat tidak bisa dihapus, karena ada yang mempunyai relasi dengan data obat");
                return back();
            }
            $brand->delete();
        }

        return redirect()->route('admin.brands.index')->withSuccess('Data merek obat berhasil dihapus.');
    }
}
