<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class addProductController extends Controller
{
    public function addProduct(Request $request)
    {
        try {
            $product_name = $request->input('product_name');
            $category_id = $request->input('category_id');
            $owner_name = Auth::user()->user_name;
            DB::table('product')->insert([
                'product_name' => $product_name,
                'category_id' => $category_id,
                'owner_name' => $owner_name,
            ]);
        } catch (\Exception $e) {
            return redirect('/profile')->with('status', 'failure')->with('from', 'product');
        }
        return redirect('/profile')->with('status', 'success')->with('from', 'product');
    }
}
