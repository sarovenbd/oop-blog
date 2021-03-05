<?php

    require 'inc/header.php';
    require 'inc/navbar.php';


    if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['title']) && isset($_POST['content'])) {

        $title = validate($_POST['title']);
        $content = validate($_POST['content']);
        $slug = validate($_POST['slug']);

        if (empty($title)) {
            $_SESSION['error'] = "Title can not be empty!";
        }else if (empty($content)) {
            $_SESSION['error'] = "Content can not be empty!";
        }else if (empty($slug)) {
            $_SESSION['error'] = "Slug can not be empty!";
        }else{
            date_default_timezone_set("Asia/Dhaka");
            $date = date('Y-m-d h:i:sa');
            $sql = "INSERT INTO pages (title, content, slug, created_at) VALUES ('$title', '$content', '$slug', '$date')";

            $result = $db->insert($sql);

            if ($result) {
                $_SESSION['success'] = "Page added successfully.";
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }

    }
 ?>
    <h1 class="mt-4">Add Page</h1>
    <ol class="breadcrumb mb-4">
    <a href="pages.php" class="btn btn-success">View Pages</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Add Page
    </div>
    <div class="card-body">
    <form action="addpage.php" method="post">
      <div class="form-group">
        <label for="title">Page Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter page title">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Content</label>
        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" placeholder="Slug">
      </div>

      <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
      </div>
    </form>
    </div>

</div>

<?php require 'inc/footer.php'; ?>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="inc/js/datatables-demo.js"></script>
