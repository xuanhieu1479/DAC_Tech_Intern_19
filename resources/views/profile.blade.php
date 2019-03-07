<?php

include "./inc/header.php";
include "./inc/footer.php";

?>

<link rel="stylesheet" href="/css/tab.css">

<div class="tabs-divided">

    <div class="tab-divided">
        <input type="radio" id="tab-1" name="tab-group-1"
            <?php
                if (!Session::has('from')) {
                    echo ' checked';                     
                }
                else if (Session::get('from') != 'group') {
                    echo ' checked';
                }
            ?>
        >
        <label for="tab-1" class="tab-divided-label">Add Product</label>

        <div class="content-tab-divided">
            <form method="post" action="/add_product" class="form-horizontal" style="margin-left: 100px">
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                <fieldset>

                    <?php
                    if (Session::has('status')) {
                        switch (Session::get('status')) {
                            case 'success':
                                echo '<div class="alert alert-success" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto;">';
                                echo 'You have successfully added new product.';
                                echo '</div>';
                                break;
                            case 'failure':
                                echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto;">';
                                echo 'New product could not be added. Please check your blood pressure.';
                                echo '</div>';
                                break;
                        }
                    }
                    ?>

                    <!-- Form Name -->
                    <legend style="margin-bottom: 35px; margin-left: -45px">NEW PRODUCT</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                        <div class="col-md-4">
                            <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">
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
                                    echo '<option value="' . $category->category_id . '">' . $category->category_name . '</option>';
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
                                <button id="singlebutton" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class="tab-divided" <?php 
            if (!Auth::check()) {
                echo 'hidden';                
            }
            else if (Auth::user()->isAdmin != 1) {
                echo 'hidden';
            } ?>>
        <input type="radio" id="tab-2" name="tab-group-1"
        <?php
            if (Session::has('from')) {
                if (Session::get('from') == 'group') echo ' checked';                                    
            }
        ?>
        >
        <label for="tab-2" class="tab-divided-label">Create Group</label>

        <div class="content-tab-divided">
            <form method="post" action="/create_group" class="form-horizontal" style="margin-left: 100px">
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                <fieldset>

                    <?php
                    if (Session::has('status')) {
                        switch (Session::get('status')) {
                            case 'success':
                                echo '<div class="alert alert-success" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto;">';
                                echo 'You have successfully created new group.';
                                echo '</div>';
                                break;
                            case 'failure':
                                echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 40%; margin-left: auto; margin-right: auto;">';
                                echo 'Group is already existed. Please choose another name.';
                                echo '</div>';
                                break;
                        }
                    }
                    ?>

                    <!-- Form Name -->
                    <legend style="margin-bottom: 35px; margin-left: -45px">NEW GROUP</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group_name">GROUP NAME</label>
                        <div class="col-md-4">
                            <input id="group_name" name="group_name" placeholder="GROUP NAME" class="form-control input-md" required="" type="text">
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="leader_name">CHOOSE A LEADER</label>
                        <div class="col-md-4">
                            <select id="leader_name" name="leader_name" class="form-control">
                                <?php
                                $users = DB::table('users')->get();
                                foreach ($users as $user) {
                                    echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
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
                                <button id="singlebutton" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div> 