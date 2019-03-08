<?php

include "./inc/header.php";
include "./inc/footer.php";

use Illuminate\Support\Facades\Input;
$categories = DB::table('category')->select('category_name')->distinct()->get();
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

<div style="margin-top: 20px; margin-left: 20px">
<?php
if (!isset($filter_category)) echo '<h4 class="text-info">Filtered by</h4>';
else echo '<button type="button" class="btn btn-primary" style="margin-bottom: 10px;">
  <a href="/" style="text-decoration : none; color: black">Disable Filter</a></button>';
?>
</div>
<div style="width: 75%; float: left; margin-left: 35px; margin-bottom: 30px; padding-top: 20px; padding-left: 20px" class="border border-primary rounded">
<table class="table table-borderless">
  <tbody>
    <?php
      $i = 0;
      foreach ($categories as $category) {
        if ($i / $maxItemsPerLine == 0) echo '<tr>';
        echo '<th scope="col" style="width: 20%"><button type="button" class="btn btn-light">
          <a href="?category=' . $category->category_name . '"style="text-decoration : none; color: black">'
          . $category->category_name . '</a></button></th>';
        $i++;
        if (($i - $maxItemsPerLine) / $maxItemsPerLine == 0) echo '</tr>';        
      }
    ?>
  </tbody>
</table>
</div>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Category</th>      
      <th scope="col">Owner</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($products as $product) {
        $editButtonType = 'primary';
        $deleteButtonType = 'danger';
        $isDisabled = ' ';
        if (!Auth::check()) {
          $isDisabled .= ' disabled';
          $editButtonType = 'secondary';
          $deleteButtonType = 'secondary';
        } else {
          $currentUser = Auth::user();
          if (
            $currentUser->user_name != $product->owner_name
            && $currentUser->isAdmin != 1
            //Disable edit and delete function if logged user is not the leader of the group of the owner of the product.
            //Yeah I know there are many "of" since I'm shit at literature.
            && (DB::table('ug')->where('user_name', $currentUser->user_name)->where('isLeader', 1)->whereIn('group_name',
              DB::table('ug')->where('user_name', $product->owner_name)->pluck('group_name')
            )->get()->isEmpty())) {
            $isDisabled .= ' disabled';
            $editButtonType = 'secondary';
            $deleteButtonType = 'secondary';
          }
        }
        echo '<tr>';
        echo '<th scope="col" style="width: 5%;">' . $product->product_id . '</th>';
        echo '<th scope="col" style="width: 25%">' . $product->product_name . '</th>';
        echo '<th scope="col" style="width: 25%">' . $product->category_name . '</th>';
        echo '<th scope="col" style="width: 25%">' . $product->owner_name . '</th>';
        echo '<th scope="col" style="width: 10%">'
            . '<form method="get" action="/product/edit">'
            . '<input type="hidden" name="product_id" value="' . $product->product_id . '">'
            . '<input type="hidden" name="product_name" value="' . $product->product_name . '">'
            . '<input type="hidden" name="category_id" value="' . $product->category_id . '">'
            . '<input type="hidden" name="owner_name" value="' . $product->owner_name . '">'
            . '<button class="btn btn-' . $editButtonType . '"' . $isDisabled . '>Edit</button>'
            . '</form>';
        echo '<th scope="col" style="width: 10%">'
            . '<form method="post" action="/product/delete"' . $product->product_id .'>'
            . '<input type="hidden" name="_token" value="' . csrf_token() . '">'
            . '<input type="hidden" name="product_id" value="' . $product->product_id . '">'
            . '<input type="hidden" name="owner_name" value="' . $product->owner_name . '">'
            . '<button class="btn btn-' . $deleteButtonType . '"' . $isDisabled . '>Delete</button>'
            . '</form>';
        echo '</tr>';
    }
    ?>

  </tbody>
</table>

<?php
if ($products->isEmpty()) {
  echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto; margin-top: 50px">';
  if (DB::table('category')->where('category_name', $filter_category)->get()->isEmpty())
    echo 'Category <strong>' . $filter_category . '</strong> does not exist.';
  else echo 'There is no product within <strong>' . $filter_category . '</strong> category. Please choose another one.';
  echo '</div>';
}
?>