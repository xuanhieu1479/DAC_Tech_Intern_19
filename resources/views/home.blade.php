<?php

use Illuminate\Support\Facades\Auth;
include "./inc/header.html";
include "./inc/footer.php";
?>

<!DOCTYPE html>
<html lang="en">
<ul>
    <?php
    //var_dump(Auth::attempt(['user_name' => 'Hieu', 'password' => '123']));
    //Auth::attempt(['user_name' => 'Hieu', 'password' => '123']);
    var_dump(Auth::check());

    if (Auth::check()) {
        $user = Auth::user();
        echo '<h1>' . $user->user_name . '</h1>';
    }

    ?>
</ul>

</html> 