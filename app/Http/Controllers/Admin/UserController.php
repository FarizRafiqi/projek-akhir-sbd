<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
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
        if ($image = $request->file("image")) {
            $data["image"] = date("YmdHis_");
            $data["image"] .= str_replace(" ", "", trim($image->getClientOriginalName()));

            $lastInsertedId = User::all()->last()->id + 1;
            $folder = "img/avatar/" . $lastInsertedId . "/";
            $image->storeAs($folder, $data["image"], "public");
        }
        
        $data["password"] = Hash::make($data["password"]);
        User::create($data);

        return redirect()->route("admin.users.index")->withSuccess("Data user berhasil ditambahkan!");
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
        return view("pages.admin.users.edit", compact("user"));
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

            $userId = auth()->user()->id;
            $folder = "img/avatar/" . $userId . "/";
            $image->storeAs($folder, $data["image"], "public");
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($data["password"]);
        }

        return redirect()->route("admin.users.index")->withSuccess("Data user berhasil diubah!");
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

        $user->delete();
        return redirect()->route("admin.users.index")->withSuccess("Data user berhasil dihapus!");
    }
}
