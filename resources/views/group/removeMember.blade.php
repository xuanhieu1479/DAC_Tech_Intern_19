<form method="post" action="/remove_member" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
    <?php echo get_csrf_token(); ?>
    <fieldset>
        <input name="group_name" value=<?php echo "'".$currentGroup."'"; ?> type="text" readonly hidden>

        <div class="form-group">
            <label class="col-md-4 control-label" for="del_member_name">CURRENT MEMBERS</label>
            <div class="row">
                <div class="col-md-4" style="margin-left: 15px">
                    <select id="del_member_name" name="del_member_name" class="form-control" 
                        <?php echo disable_if_unauthorized() . ">";
                        //Only show who is already in group, except leader.
                        $users = DB::table('ug')->where('group_name', $currentGroup)->where('user_name', '<>', $currentLeader)->get();
                        foreach ($users as $user) {
                            echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
                        }?>
                    >
                    </select>
                </div>
                <div><button id="singlebutton" class="btn btn-primary" 
                <?php echo hidden_if_unauthorized() ?>>Remove member</button></div>
            </div>
            <p style="margin-left: 90px; color: red;"><?php echo get_error_message('removeMember'); ?></p>
        </div>
    </fieldset>
</form>