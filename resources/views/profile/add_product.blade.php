<div class="tab-divided">
    <input type="radio" id="tab-1" name="tab-group-1"
        <?php
        if (!Session::has('from')) echo ' checked';
        else {
            switch (Session::get('from')) {
                case 'product':
                    echo ' checked';
                    break;
                case 'group':
                    echo '';
                    break;
            }
        }?>
    >

    <label for="tab-1" class="tab-divided-label">Add Product</label>
    <div class="content-tab-divided">
        <form method="post" action="/add_product" class="form-horizontal" style="margin-left: 100px">
            <?php echo get_csrf_token(); ?>
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
                }?>

                <legend style="margin-bottom: 35px; margin-left: -45px">NEW PRODUCT</legend>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                    <div class="col-md-4">
                        <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="category_id">PRODUCT CATEGORY</label>
                    <div class="col-md-4">
                        <select id="category_id" name="category_id" class="form-control">
                            <?php
                            $categories = Config::get('categories');
                            foreach ($categories as $category) {
                                echo '<option value="' . $category->category_id . '">' . $category->category_name . '</option>';
                            }?>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 30px">
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