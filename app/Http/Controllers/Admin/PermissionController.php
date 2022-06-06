<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PermissionDataTable;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionDataTable $dataTable)
    {
        abort_if(Gate::denies("user_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.permissions.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("permission_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.permissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies("permission_create"), Response::HTTP_FORBIDDEN, "Forbidden");

        Validator::make($request->all(), [
            "title" => "required|string|max:255",
        ], [
            "title.required" => "Hak akses tidak boleh kosong.",
            "title.max" => "Hak akses maksimal :max karakter.",
            "title.string" => "Hak akses harus berupa string.",
        ])->validate();

        Permission::create($request->all());
        return redirect()->route("admin.permissions.index")->withSuccess("Data hak akses berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies("permission_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.permissions.edit", compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        abort_if(Gate::denies("permission_update"), Response::HTTP_FORBIDDEN, "Forbidden");

        Validator::make($request->all(), [
            "title" => "required|string|max:255",
        ], [
            "title.required" => "Hak akses tidak boleh kosong.",
            "title.max" => "Hak akses maksimal :max karakter.",
            "title.string" => "Hak akses harus berupa string.",
        ])->validate();

        $permission->update($request->all());
        return redirect()->route("admin.permissions.index")->withSuccess("Data hak akses berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $permission->roles()->detach();
        $permission->delete();
        return redirect()->route('admin.permissions.index')->withSuccess('Data hak akses berhasil dihapus.');
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $permissions = Permission::whereIn('id', request('ids'))->get();
        foreach ($permissions as $permission) {
            $permission->roles()->detach();
            $permission->delete();
        }
        return redirect()->route('admin.permissions.index')->withSuccess('Data hak akses berhasil dihapus.');
    }
}
