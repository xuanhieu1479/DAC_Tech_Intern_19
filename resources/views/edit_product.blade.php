<?php

include "./inc/header.php";
include "./inc/footer.php";

use Illuminate\Support\Facades\Input;

if (!Auth::check()) header('Location: /login');
else if (Auth::user()->isAdmin != 1) header('Location: /');

$product_id = Input::get('product_id');
$product_name = Input::get('product_name');
$category_id = Input::get('category_id');
?>

<form method="post" action="/product/edit" class="form-horizontal" style="margin-left: 120px; margin-top: 50px">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <fieldset>

        <?php
        if (Session::has('status')) {
            switch (Session::get('status')) {
                case 'failure':
                    echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto;">';
                    echo 'Something was wrong. I have no idea.';
                    echo '</div>';
                    break;
            }
        }
        ?>

        <!-- Form Name -->
        <legend style="margin-bottom: 35px; margin-left: -45px">EDIT PRODUCT</legend>
        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
            <div class="col-md-4">
                <input id="product_name" name="product_name" value=<?php echo $product_name ?> class="form-control input-md" required="" type="text">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="category_id">PRODUCT CATEGORY</label>
            <div class="col-md-4">
                <select id="category_id" name="category_id" class="form-control">
                    <?php
                    $categories = DB::table('category')->get();                    
                    foreach ($categories as $category) {
                        $isSelected = ' ';
                        if ($category->category_id == $category_id) $isSelected .= 'selected';
                        echo '<option value="' . $category->category_id . '"' . $isSelected . '>' . $category->category_name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group" style="margin-top: 30px">
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="singlebutton" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </fieldset>
</form> 