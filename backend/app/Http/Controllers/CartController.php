<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends APIController
{
    public function addCart()
    {
        $product_id = request('product_id');
        $product = Product::find($product_id);
        Cart::create([
            "product_id" => $product->id,
            "qty" => 1,
            "harga" => $product->harga
        ]);
        return response()->json(Cart::all());
    }
    public function getall()
    {
        $carts = Cart::with('product')->get();
        return $this->response(true,$carts,"Query Berhasil");
    }
    public function checkout()
    {
        $carts = Cart::all();
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                "total" => 0
            ]);
            $sum = 0;
            foreach ($carts as $cart) {
                $sum += ($cart->qty * $cart->harga);
                TransactionDetail::create([
                    "transaction_id" => $transaction->id,
                    "product_id" => $cart->product_id,
                    "qty" => $cart->qty,
                    "harga" => $cart->harga,
                ]);
            }
            $transaction->fill(["total" => $sum]);
            $transaction->save();

            Cart::truncate();

            $finaltrans = Transaction::with('details')->find($transaction->id);
          //  DB::commit();
          
            return response()->json($finaltrans);
        } catch (Exception $e) {
           DB::rollBack();
            throw new Exception($e);
        }
    }
}

