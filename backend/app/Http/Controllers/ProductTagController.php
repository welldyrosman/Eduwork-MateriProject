<?php

namespace App\Http\Controllers;

use App\Models\ProductTag;
use Illuminate\Http\Request;

class ProductTagController extends Controller
{
    public function removetag($product_id,$tag_id){
        ProductTag::where('product_id',$product_id)->where('tag_id',$tag_id)->delete();
        return response()->json(["status"=>"OK"]);
    }
    public function removetag2(Request $request,$product_id){
        $tag_id=request('tag_id');
        ProductTag::where('product_id',$product_id)->where('tag_id',$tag_id)->delete();
        return response()->json(["status"=>"OK"]);
    }
    public function removetag3(Request $request){
        $tag_id=request('tag_id');
        $product_id=request('product_id');
        ProductTag::where('product_id',$product_id)->where('tag_id',$tag_id)->delete();
        return response()->json(["status"=>"OK"]);
    }
    public function removetag4($producttag_id){
        $profuct=ProductTag::find($producttag_id);
        $profuct->delete();
        return response()->json(["status"=>"OK"]);
    }
}
