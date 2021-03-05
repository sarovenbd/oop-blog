<?php 
    require 'inc/header.php';
    require 'inc/navbar.php';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = validate($_GET['id']);

    $sql = "SELECT * FROM pages WHERE id='$id'";
    $data = $db->select($sql);
    
    if ($data) {
        $sql = "DELETE FROM pages WHERE id='$id'";
        $delete = $db->delete($sql);
        if ($delete) {
            gotoUrl("$base_url/admin/pages.php");
        }
    }else{
        gotoUrl("$base_url/admin/pages.php");
    }

}else{
    $_SESSION['error'] = "Id can not be empty!";
    gotoUrl("$base_url/admin/pages.php");
}


 ?>