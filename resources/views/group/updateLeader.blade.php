<form method="post" action="/update_leader" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
    <?php echo get_csrf_token(); ?>
    <fieldset>
    <input name="group_name" value=<?php echo '"'.$currentGroup.'"'; ?> type="text" readonly hidden>

    <div class="form-group">
        <label class="col-md-4 control-label" for="leader_name">LEADER</label>
        <div class="row">
            <div class="col-md-4" style="margin-left: 15px">
                <select id="leader_name" name="leader_name" class="form-control"
                    <?php echo disable_if_unauthorized() . ">";
                    //Only show who is already in the group.
                    $users = DB::table('ug')->where('group_name', $currentGroup)->get();
                    foreach ($users as $user) {
                        $isSelected = ' ';
                        if ($user->user_name == $currentLeader) $isSelected .= 'selected';
                        echo '<option value="' . $user->user_name . '"' . $isSelected . '>' . $user->user_name . '</option>';
                    }
                    ?>
                >
                </select>
            </div>
            <div><button id="singlebutton" class="btn btn-primary"
            <?php echo hidden_if_unauthorized() ?>>Change leader</button></div>
        </div>
        <p style="margin-left: 90px; color: red;"><?php echo get_error_message('updateLeader'); ?></p>
    </div>
    </fieldset>
</form>