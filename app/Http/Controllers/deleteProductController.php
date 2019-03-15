<?php

namespace App\Http\Controllers;

include_once "./inc/function_helper.php";

use Illuminate\Http\Request;
use DB;

class deleteProductController extends Controller
{
    public function deleteProduct(Request $request) {
        if (!isAdminOrOwnerOrLeaderOfOwnerOfProduct(Auth::user()->user_name)) redirect('/');
        
        $product_id = $request->input('product_id');
        DB::table('product')->where('product_id', $product_id)->delete();
        return redirect('/');
    }
}
