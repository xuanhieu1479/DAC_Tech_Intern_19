<?php
include "./inc/header.php";
include "./inc/footer.php";
include_once "./inc/global_var.php";

use Illuminate\Support\Facades\Input;

$category_names = Config::get('category_names');
$maxItemsPerLine = 5;
$filter_category = Input::get('category');
if (isset($filter_category)) {
  $products = DB::table('product')
        ->join('category', 'product.category_id', '=', 'category.category_id')
        ->where('category.category_name', $filter_category)
        ->select('product.*', 'category.category_name')
        ->get();
} else {
  $products = DB::table('product')
        ->join('category', 'product.category_id', '=', 'category.category_id')
        ->select('product.*', 'category.category_name')
        ->get();
}
?>
@include('home.category_filter')
@include('home.product_table')
<?php
if ($products->isEmpty() && isset($filter_category)) {
  echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto; margin-top: 50px">';
  if (DB::table('category')->where('category_name', $filter_category)->get()->isEmpty())
    echo 'Category <strong>' . $filter_category . '</strong> does not exist.';
  else echo 'There is no product within <strong>' . $filter_category . '</strong> category. Please choose another one.';
  echo '</div>';
}
?>