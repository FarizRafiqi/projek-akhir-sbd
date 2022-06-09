<?php

namespace App\Http\Controllers;

use App\DataTables\PurchaseDataTable;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PurchaseDataTable $dataTable)
    {
        $status = request()->status;
        $filter = null;
        if ($status) {
            if ($status == "all") {
                $filter = Purchase::where("user_id", auth()->id())->whereIn("status", config('const')['purchase_statuses']);
            } else {
                $filter = Purchase::where("user_id", auth()->id())->where("status", $status);
            }
        } else {
            $filter = Purchase::where("user_id", auth()->id())->where("status", "success");
        }

        /**
         * SELECT COUNT(*) AS jumlah_transaksi
         * FROM purchases
         * WHERE users.id = purchases.user_id AND status = 'success'
         */
        $count = $filter->get()->count();
        return $dataTable->with("filter", $filter)->render("pages.customer.profile", compact("count"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
