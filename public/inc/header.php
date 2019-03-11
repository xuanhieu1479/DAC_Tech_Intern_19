<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/header.css">

<div class="header-container indigo topBotomBordersOut">
    <a href="/">HOME</a>
    <a href=
    <?php
        $firstGroup = DB::table('groups')->first();
        if ($firstGroup) {
            echo '/group?name=' . $firstGroup->group_name;
        }
        else {
            echo '/group';
        }
    ?>
    >GROUPS</a>
    <?php
    if (Auth::check()) {        
        echo '<a style="float: right; margin: -10px" href="/logout">LOGOUT</a>';
        echo '<a style="float: left; margin: -10px" href="/profile">Welcome back '. Auth::user()->user_name . '</a>';
    } else {
        echo '<a style="float: right; margin: -10px" href="/login">LOGIN</a>';
    }
    ?>    
</div>