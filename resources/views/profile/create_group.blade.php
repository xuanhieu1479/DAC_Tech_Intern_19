<div class="tab-divided" <?php echo hidden_if_unauthorized() ?>>
    <input type="radio" id="tab-2" name="tab-group-1"
        <?php
        if (Session::has('from')) {
            switch (Session::get('from')) {
                case 'product':
                    echo '';
                    break;
                case 'group':
                    echo ' checked';
                    break;
            }
        }?>
    >

    <label for="tab-2" class="tab-divided-label">Create Group</label>
    <div class="content-tab-divided">
        <form method="post" action="/create_group" class="form-horizontal" style="margin-left: 100px">
            <?php echo get_csrf_token(); ?>
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
                }?>

                <legend style="margin-bottom: 35px; margin-left: -45px">NEW GROUP</legend>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="group_name">GROUP NAME</label>
                    <div class="col-md-4">
                        <input id="group_name" name="group_name" placeholder="GROUP NAME" class="form-control input-md" required="" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="leader_name">CHOOSE A LEADER</label>
                    <div class="col-md-4">
                        <select id="leader_name" name="leader_name" class="form-control">
                            <?php
                            $users = DB::table('users')->get();
                            foreach ($users as $user) {
                                echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
                            }?>
                        </select>
                    </div>
                </div>                    

                <div class="form-group" style="margin-top: 30px">
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