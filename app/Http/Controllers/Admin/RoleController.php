<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        abort_if(Gate::denies("role_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.roles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("role_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $permissions = Permission::all();
        return view("pages.admin.roles.create", compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        abort_if(Gate::denies("role_create"), Response::HTTP_FORBIDDEN, "Forbidden");

        $role = Role::create(["name" => strtolower($request->name)]);
        $role->permissions()->sync($request->input("permissions", []));

        return redirect()->route("admin.roles.index")->withSuccess("Data peran berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies("role_edit"), Response::HTTP_FORBIDDEN, "Forbidden");

        $permissions = Permission::all();
        return view("pages.admin.roles.edit", compact("role", "permissions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        abort_if(Gate::denies("role_update"), Response::HTTP_FORBIDDEN, "Forbidden");

        $role->update(["name" => strtolower($request->name)]);
        $role->permissions()->sync($request->input("permissions", []));

        return redirect()->route("admin.roles.index")->withSuccess("Data peran berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies("role_delete"), Response::HTTP_FORBIDDEN, "Forbidden");

        if ($role->users()->count() > 0) {
            alert()->error("Role tidak bisa dihapus, karena berelasi dengan data user.");
            return;
        }
        $role->permissions()->detach();
        $role->delete();
        return redirect()->route("admin.roles.index")->withSuccess("Data peran berhasil dihapus.");
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        abort_if(Gate::denies("role_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $roles = Role::whereIn("id", request("ids"))->get();
        foreach ($roles as $role) {
            if ($role->id === 1) {
                return response("Peran administrator tidak bisa dihapus.", 500);
            }
            $role->permissions()->detach();
            $role->delete();
        }
        return redirect()->route("admin.roles.index")->withSuccess("Data-data peran berhasil dihapus.");
    }
}
