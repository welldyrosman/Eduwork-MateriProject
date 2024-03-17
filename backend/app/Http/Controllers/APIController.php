<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function response($issucces=true,$data=null,$message=""){
        return response()->json([
            "status"=>$issucces?"success":"error",
            "data"=>$data,
            "message"=>$message
        ]);
    }
}
