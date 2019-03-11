<?php

include "./inc/header.php";
include "./inc/footer.php";

use Illuminate\Support\Facades\Input;

if (DB::table('groups')->get()->isEmpty()) {
    echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 50%; margin-left: auto; margin-right: auto; margin-top: 50px">';
    echo 'Opps! There are no groups to display. Go <a href="/create_group" class="alert-link">add</a> some and be sure you are the admin before doing that.';
    echo '</div>';
    return;
}
$currentGroup = Input::get('name');
$currentLeader = DB::table('groups')->where('group_name', $currentGroup)->get()->first();
if ($currentLeader) $currentLeader = $currentLeader->leader_name;

?>

<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="list-group">
                <?php
                $groups = DB::table('groups')->get();
                foreach ($groups as $group) {
                    $isActive = ' ';
                    if (isset($currentGroup)) {
                        if ($group->group_name == $currentGroup) $isActive .= 'active';
                    }
                    echo '<a href="/group?name=' . $group->group_name . '" class="list-group-item list-group-item-action'
                        . $isActive
                        . '">' . $group->group_name . '</a>';
                }
                ?>
            </div>
        </div>
        <div class="col">
            <form method="post" action="/delete_group" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
                <input type="hidden" name="_token" value=<?php echo csrf_token() ?>>
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group_name">GROUP NAME</label>
                        <div class="row">
                            <div class="col-md-4" style="margin-left: 15px">
                                <input id="group_name" name="group_name" value=<?php echo "'".$currentGroup."'"; ?> class="form-control input-md" type="text" readonly>
                            </div>
                            <div><button id="singlebutton" class="btn btn-primary"
                            <?php
                            if (!Auth::check()) {
                                echo ' hidden';                
                            }
                            else if (Auth::user()->isAdmin != 1) {
                                echo ' hidden';
                            }?>>Delete this group</button></div>
                        </div>
                    </div>
                    
                </fieldset>
            </form>

            <form method="post" action="/add_member" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
                <input type="hidden" name="_token" value=<?php echo csrf_token(); ?>>
                <fieldset>

                <input name="group_name" value=<?php echo '"'.$currentGroup.'"'; ?> type="text" readonly hidden>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="leader_name">LEADER</label>
                    <div class="row">
                        <div class="col-md-4" style="margin-left: 15px">
                            <select id="leader_name" name="leader_name" class="form-control" 
                            <?php
                            if (!Auth::check()) {
                                echo 'disabled';                
                            }
                            else if (Auth::user()->isAdmin != 1) {
                                echo 'disabled';
                            }?>>
                                <?php
                                //Only show who is already in the group.
                                $users = DB::table('ug')->where('group_name', $currentGroup)->get();
                                foreach ($users as $user) {
                                    $isSelected = ' ';
                                    if ($user->user_name == $currentLeader) {
                                        $isSelected .= 'selected';
                                    }
                                    echo '<option value="' . $user->user_name . '"' . $isSelected . '>' . $user->user_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div><button id="singlebutton" class="btn btn-primary"
                        <?php
                        if (!Auth::check()) {
                            echo ' hidden';                
                        }
                        else if (Auth::user()->isAdmin != 1) {
                            echo ' hidden';
                        }?>>Change leader</button></div>
                    </div>
                    <?php
                    if (Session::has('status')) {
                        $status = Session::get('status');
                        switch ($status) {
                            case 'duplicated leader':
                                echo '<p style="margin-left: 90px; color: red;">This member is already leader of group</p>';
                                break;
                            case 'missing leader':
                                echo '<p style="margin-left: 90px; color: red;">This member is no longer in group</p>';
                                break;
                            case 'MENTOR!':
                                echo '<p style="margin-left: 90px; color: red;">Please contact my mentor to fix this~</p>';
                                break;
                        }
                    }
                    ?>
                </div>

                </fieldset>
            </form>

            <form method="post" action="/add_member" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
                <input type="hidden" name="_token" value=<?php echo csrf_token(); ?>>
                <fieldset>

                    <input name="group_name" value=<?php echo "'".$currentGroup."'"; ?> type="text" readonly hidden>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="add_member_name">NOT MEMBERS</label>
                        <div class="row">
                            <div class="col-md-4" style="margin-left: 15px">
                                <select id="add_member_name" name="add_member_name" class="form-control" 
                                <?php
                                if (!Auth::check()) {
                                    echo 'disabled';                
                                }
                                else if (Auth::user()->isAdmin != 1) {
                                    echo 'disabled';
                                }?>>
                                    <?php
                                    //Only show who is not in the group.
                                    $users = DB::table('users')
                                        ->whereNotIn('user_name', DB::table('ug')
                                            ->where('group_name', $currentGroup)
                                            ->pluck('user_name'))
                                        ->get();
                                    foreach ($users as $user) {
                                        echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div><button id="singlebutton" class="btn btn-primary" 
                            <?php
                            if (!Auth::check()) {
                                echo 'hidden';                
                            }
                            else if (Auth::user()->isAdmin != 1) {
                                echo 'hidden';
                            }?>>Add new member</button></div>
                        </div>
                        <?php
                        if (Session::has('status')) {
                            $status = Session::get('status');
                            switch ($status) {
                                case 'duplicated member':
                                    echo '<p style="margin-left: 90px; color: red;">This guy/gal is already member of group</p>';
                                    break;
                                case 'add empty member':
                                    echo '<p style="margin-left: 90px; color: red;">There is no one to add</p>';
                                    break;
                                case 'MENTOR!':
                                    echo '<p style="margin-left: 90px; color: red;">Please contact my mentor to fix this~</p>';
                                    break;
                            }
                        }
                        ?>
                    </div>

                </fieldset>
            </form>

            <form method="post" action="/remove_member" class="form-horizontal" style="margin-left: 10px; margin-top: 20px">
                <input type="hidden" name="_token" value=<?php echo csrf_token() ?>>
                <fieldset>

                    <input name="group_name" value=<?php echo "'".$currentGroup."'"; ?> type="text" readonly hidden>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="del_member_name">CURRENT MEMBERS</label>
                        <div class="row">
                            <div class="col-md-4" style="margin-left: 15px">
                                <select id="del_member_name" name="del_member_name" class="form-control" 
                                <?php
                                if (!Auth::check()) {
                                    echo ' disabled';                
                                }
                                else if (Auth::user()->isAdmin != 1) {
                                    echo ' disabled';
                                }?>>
                                    <?php
                                    //Only show who is already in group, except leader.
                                    $users = DB::table('ug')->where('group_name', $currentGroup)->where('user_name', '<>', $currentLeader)->get();
                                    foreach ($users as $user) {
                                        echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div><button id="singlebutton" class="btn btn-primary" 
                            <?php
                            if (!Auth::check()) {
                                echo ' hidden';                
                            }
                            else if (Auth::user()->isAdmin != 1) {
                                echo ' hidden';
                            }?>>Remove member</button></div>
                        </div>
                        <?php
                        if (Session::has('status')) {
                            $status = Session::get('status');
                            switch ($status) {
                                case 'remove empty member':
                                    echo '<p style="margin-left: 90px; color: red;">You just did a pointless action. Bravo!</p>';
                                    break;
                                case 'MENTOR!':
                                    echo '<p style="margin-left: 90px; color: red;">Please contact my mentor to fix this~</p>';
                                    break;
                            }
                        }
                        ?>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div> 