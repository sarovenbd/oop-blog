<?php
    require 'inc/header.php';
    require 'inc/navbar.php';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = validate($_GET['id']);

    $sql = "SELECT * FROM posts WHERE id='$id'";
    $data = $db->select($sql);


    if ($data) {
        $result = $data->fetch_assoc();
        if($result['image'] != 'no-image.png'){
            $img = $result['image'];
            $target_file = "inc/uploads/images/$img";
            if (file_exists($target_file)) {
              unlink("inc/uploads/images/$img");
            }
          }
        $sql = "DELETE FROM posts WHERE id='$id'";
        $delete = $db->delete($sql);
        if ($delete) {
            gotoUrl("$base_url/admin/posts.php");
        }
    }else{
        gotoUrl("$base_url/admin/posts.php");
    }

}else{
    $_SESSION['error'] = "Id can not be empty!";
    gotoUrl("$base_url/admin/posts.php");
}


 ?>
