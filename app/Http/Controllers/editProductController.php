<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class editProductController extends Controller
{
    public function toEditProduct(Request $request) {
        return view('edit_product');
    }

    public function doEditProduct(Request $request) {
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $category_id = $request->input('category_id');

        try {
            DB::table('product')->where('product_id', $product_id)->update([
                'product_name' => $product_name,
                'category_id' => $category_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'failure');
        }
        
        return redirect('/');
    }
}
