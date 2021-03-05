<?php

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && $_SESSION['user_id'] != '' && $_SESSION['user_name'] != '') {
        # code...
    }else{
        gotoUrl('/login.php');
    }


?>
