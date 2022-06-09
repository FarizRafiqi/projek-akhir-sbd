<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session('cart'));
        $cart = session('cart');

        if (!$cart) {
            return view('pages.customer.cart');
        }

        $subTotal = 0;
        foreach ($cart as $value) {
            $subTotal += $value["price"] * $value["quantity"];
        }

        $adminFee = 2500;
        $totalPayment = $subTotal + $adminFee;

        session(["detail" => ["admin_fee" => $adminFee, "sub_total" => $subTotal, "total_payment" => $totalPayment]]);
        return view('pages.customer.cart', compact("subTotal", "totalPayment", "adminFee"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = session()->get("cart", []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->id] = [
                "name" => $request->name,
                "quantity" => $request->quantity,
                "price" => $request->price,
                "image" => $request->image,
                "slug" => $request->slug,
            ];
        }

        session()->put('cart', $cart);
        return response("Produk berhasil ditambahkan ke keranjang.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
        return response("Produk berhasil diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return response("Produk berhasil dihapus.");
    }

    public function massDestroy(Request $request)
    {
        $cart = session()->get('cart');
        if ($request->has("selected_items") && !empty($request->selected_items)) {
            foreach ($request->selected_items as $id) {
                if (isset($cart[$id])) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
            }

            return response("Produk-produk berhasil dihapus dari keranjang");
        } else {
            if ((bool)$request->delete_all == true) {
                session()->forget('cart');
                return response("Keranjang berhasil dikosongkan.");
            } elseif ((bool)$request->delete_all == false && !$request->has("selected_items")) {
                return response("Tidak ada produk yang dihapus.");
            }
        }
    }
}
