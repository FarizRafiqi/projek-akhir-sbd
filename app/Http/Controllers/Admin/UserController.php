<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDrugRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        abort_if(Gate::denies("user_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render("pages.admin.users.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("user_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $roles = Role::all();
        return view('pages.admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        abort_if(Gate::denies("user_create"), Response::HTTP_FORBIDDEN, "Forbidden");

        $data = $request->except("image");
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);

        if ($image = $request->file("image")) {
            $data["image"] = date("YmdHis_");
            $data["image"] .= str_replace(" ", "", trim($image->getClientOriginalName()));

            $folder = "img/avatar/" . $user->id . "/";
            $image->storeAs($folder, $data["image"], "public");
            $user->update(["image" => $data["image"]]);
        }

        return redirect()->route("admin.users.index")->withSuccess("Data user berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(Gate::denies("user_show"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies("user_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        $roles = Role::all();
        return view("pages.admin.users.edit", compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        abort_if(Gate::denies("user_update"), Response::HTTP_FORBIDDEN, "Forbidden");

        $data = $request->except(["image", "password"]);

        if ($image = $request->file("image")) {
            $data["image"] = date("YmdHis_");
            $data["image"] .= str_replace(" ", "", trim($image->getClientOriginalName()));

            $folder = "img/avatar/" . $user->id . "/";
            $image->storeAs($folder, $data["image"], "public");
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($data["password"]);
        }

        $user->update($data);
        return redirect()->route("admin.users.index")->withSuccess("Data user berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies("user_delete"), Response::HTTP_FORBIDDEN, "Forbidden");

        if ($user->purchases()->count() > 0) {
            alert()->error("Data user tidak dapat dihapus, karena mempunyai relasi dengan data pembelian.");
            return back();
        }

        Storage::disk("public")->deleteDirectory("img/avatar/" . $user->id);
        $user->delete();
        return redirect()->route("admin.users.index")->withSuccess("Data user berhasil dihapus.");
    }

    public function massDestroy(MassDestroyDrugRequest $request)
    {
        abort_if(Gate::denies("drug_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $users = User::whereIn('id', request('ids'))->get();
        foreach ($users as $user) {
            if ($user->purchases()->count() > 0) {
                return response("Data user tidak dapat dihapus, karena mempunyai relasi dengan data pembelian.", 500);
            }
            Storage::disk("public")->deleteDirectory("img/avatar/" . $user->id);
            $user->delete();
        }

        return redirect()->route('admin.drugs.index')->withSuccess('Data user berhasil dihapus.');
    }
}
