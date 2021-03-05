<?php
  session_start();
    require 'admin/config/config.php';
    require 'admin/lib/database.php';
    require 'admin/helper/function.php';

    $db = new Database ();
    $query = "SELECT * FROM settings WHERE id = 1";
    $data = $db->select($query);
    if ($data) {
        $d = $data->fetch_assoc();
        $id = $d['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $data ? $d['description'] : 'saroven blog' ?>">
  <meta name="keywords" content="<?php echo $data ? $d['tags'] : 'blog, tech, saroven blog, sarovenbd' ?>">
  <meta name="author" content="saroven">

  <title><?php echo $data ? $d['title'] : 'Saroven Personal Blog' ?></title>

  <!-- Bootstrap core CSS -->
  <link href="inc/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="inc/css/blog-home.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body>
