<?php
include "./inc/header.php";
include "./inc/footer.php";
include_once "./inc/function_helper.php";

use Illuminate\Support\Facades\Input;

if (DB::table('groups')->get()->isEmpty()) {
    echo '<div class="alert alert-danger" role="alert" style="text-align: center; width: 50%; margin-left: auto; margin-right: auto; margin-top: 50px">';
    echo 'Opps! There are no groups to display. Go <a href="/create_group" class="alert-link">add</a> some and be sure you are the admin before doing that.';
    echo '</div>';
    return;
}

$currentGroup = return_first_group(Input::get('name'));
if (!$currentGroup) {
    header('Location: /group?name=' . return_first_group()->group_name);
    exit();
}
else $currentGroup = $currentGroup->group_name;
$currentLeader = DB::table('groups')->where('group_name', $currentGroup)->get()->first();
if ($currentLeader) $currentLeader = $currentLeader->leader_name;
?>

<div class="container">
    <div class="row">
        @include('group.listGroup')
        <div class="col">
            @include('group.deleteGroup')
            @include('group.updateLeader')
            @include('group.addMember')
            @include('group.removeMember')
        </div>
    </div>
</div> 