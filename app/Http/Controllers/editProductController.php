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

        if (DB::table('product')
            ->where('product_id', $product_id)
            ->where('product_name', $product_name)
            ->where('category_id', $category_id)->first()) {
                $error_message = '<div class="alert alert-danger" role="alert" style="text-align: center; width: 20%; margin-left: 20px;">';
                $error_message .= 'You did not change anything.';
                $error_message .= '</div>';
                return redirect()->back()->with('status', $error_message);
            }

        try {
            DB::table('product')->where('product_id', $product_id)->update([
                'product_name' => $product_name,
                'category_id' => $category_id,
            ]);
        } catch (\Exception $e) {
            $error_message = '<div class="alert alert-danger" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto;">';
            $error_message .= 'Something was wrong. I have no idea.';
            $error_message .= '</div>';
            return redirect()->back()->with('status', $error_message);
        }
        
        return redirect('/');
    }
}
