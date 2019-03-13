<form method="post" action="/add_member" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
    <?php echo get_csrf_token(); ?>
    <fieldset>
        <input name="group_name" value=<?php echo "'".$currentGroup."'"; ?> type="text" readonly hidden>

        <div class="form-group">
            <label class="col-md-4 control-label" for="add_member_name">NOT MEMBERS</label>
            <div class="row">
                <div class="col-md-4" style="margin-left: 15px">
                    <select id="add_member_name" name="add_member_name" class="form-control" 
                        <?php echo disable_if_unauthorized() . ">";
                        //Only show who is not in the group.
                        $users = DB::table('users')
                            ->whereNotIn('user_name', DB::table('ug')
                                ->where('group_name', $currentGroup)
                                ->pluck('user_name'))
                            ->get();
                        foreach ($users as $user) {
                            echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
                        }?>
                    >
                    </select>
                </div>
                <div><button id="singlebutton" class="btn btn-primary" 
                <?php echo hidden_if_unauthorized() ?>>Add new member</button></div>
            </div>
            <p style="margin-left: 90px; color: red;"><?php echo get_error_message('addMember'); ?></p>
        </div>
    </fieldset>
</form>