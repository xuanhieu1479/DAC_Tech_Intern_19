<form method="post" action="/delete_group" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
    <?php echo get_csrf_token(); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="group_name">GROUP NAME</label>
            <div class="row">
                <div class="col-md-4" style="margin-left: 15px">
                    <input id="group_name" name="group_name" value=<?php echo "'" . $currentGroup . "'"; ?> class="form-control input-md" type="text" readonly>
                </div>
                <div><button id="singlebutton" class="btn btn-primary" <?php echo hidden_if_unauthorized() ?>>Delete this group</button></div>
            </div>
        </div>
    </fieldset>
</form> 