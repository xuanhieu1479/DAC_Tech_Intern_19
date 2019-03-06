<link rel="stylesheet" href="/css/header.css">

<div class="container indigo topBotomBordersOut">
    <a href="/">HOME</a>
    <a>GROUPS</a>
    <?php
    if (Auth::check()) {        
        echo '<a style="float: right; margin: -10px" href="/logout">LOGOUT</a>';
        echo '<a style="float: left; margin: -10px" href="/profile">Welcome back '. Auth::user()->user_name . '</a>';
    } else {
        echo '<a style="float: right; margin: -10px" href="/login">LOGIN</a>';
    }
    ?>    
</div>