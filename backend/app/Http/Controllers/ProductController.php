<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getProducts(){
        $products=Product::orderby('id','DESC')->get();
        return response()->json($products);
    }
    public function getProduct($barcode){
        $product=Product::where('id',$barcode)->first();
        if(!$product){
            throw new Exception("Barang TIdak Ditemukan");
        }
        return response()->json($product);
    }

    public function saveProducts(SubmitProductRequest $request){
       
        $product=Product::create(
            [
                "nama_product"=>request("nama_product"),
                "harga"=>request("harga")
            ]
        );
        return response()->json($product);
    }
}
