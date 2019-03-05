<?php
include "./inc/header.html";
include "./inc/footer.php";
?>

<!DOCTYPE html>
<html lang="en">
<ul>
    <?php
    if (isset($user_name)) {
        echo "<li>Username : " . $user_name . "</li>";
    }

    ?>
</ul>

</html> 