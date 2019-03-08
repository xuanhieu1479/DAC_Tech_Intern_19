<?php

include "./inc/header.php";
include "./inc/footer.php";

?>

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
    $products = DB::table('product')
        ->join('category', 'product.category_id', '=', 'category.category_id')
        ->select('product.*', 'category.category_name')
        ->get();
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