<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Drug;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view("pages.customer.checkout");
    }

    public function process(CheckoutRequest $request)
    {
        DB::transaction(function () use ($request) {
            $cart = session('cart');
            $change = $request->paid - session("detail.total_payment");
            $status = config('const')['purchase_statuses'][0];
        
            $purchase = Purchase::create([
                "user_id" => auth()->id(),
                "total_price" => session('detail.total_payment'),
                "buy_date" => date("Y-m-d H:i:s"),
                "paid" => $request->paid,
                "change" => $change,
                "status" => $status
            ]);

            foreach ($cart as $key => $value) {
                $drug = Drug::find($key);

                $purchase->details()->create([
                    "purchase_id" => $purchase->id,
                    "drug_id" => $drug->id,
                    "quantity" => $value["quantity"]
                ]);

                $drug->update(["stock" => $drug->stock - $value["quantity"]]);
            }

            // bersihkan keranjang
            session()->forget('cart');
        });

        return view("pages.customer.purchase-success");
    }
}
