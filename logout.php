<?php
require 'admin/helper/function.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && $_SESSION['user_id'] != '' && $_SESSION['user_name'] != '') {
    session_destroy();
    gotoUrl('/login.php');
}else{
    gotoUrl('/index.php');
}
