<?php
include "./inc/header.php";
include "./inc/footer.php";
include_once "./inc/function_helper.php";
include_once "./inc/global_var.php";

if (!Auth::check()) {
    header('Location: /');
    exit();
}
?>

<link rel="stylesheet" href="/css/tab.css">
<div class="tabs-divided">
    @include('profile.add_product')
    @include('profile.create_group')    
</div> 