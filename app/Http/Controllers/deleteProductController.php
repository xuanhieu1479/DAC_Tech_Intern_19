<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class deleteProductController extends Controller
{
    public function deleteProduct(Request $request) {
        $product_id = $request->input('product_id');
        DB::table('product')->where('product_id', $product_id)->delete();
        return redirect('/');
    }
}
