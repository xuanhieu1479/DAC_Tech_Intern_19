<div class="col-3">
    <div class="list-group">
        <?php
        $groups = DB::table('groups')->get();
        foreach ($groups as $group) {
            $isActive = ' ';
            if (isset($currentGroup) && $group->group_name == $currentGroup) $isActive .= 'active';
            echo '<a href="/group?name=' . $group->group_name . '" class="list-group-item list-group-item-action'
                . $isActive . '">' . $group->group_name . '</a>';
        } ?>
    </div>
</div> 