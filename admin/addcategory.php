<?php

    require 'inc/header.php';
    require 'inc/navbar.php';


    if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['title'])) {

        $title = validate($_POST['title']);

        if (empty($title)) {
            $_SESSION['error'] = "Title can not be empty!";
        }else {
            date_default_timezone_set("Asia/Dhaka");
            $date = date('Y-m-d h:i:sa');
            $sql = "INSERT INTO categories (title, created_at) VALUES ('$title', '$date')";

            $result = $db->insert($sql);

            if ($result) {
                $_SESSION['success'] = "category added successfully.";
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }

    }
 ?>
    <h1 class="mt-4">Add Category</h1>
    <ol class="breadcrumb mb-4">
    <a href="categories.php" class="btn btn-success">View Categories</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">
    <form action="addcategory.php" method="post">
      <div class="form-group">
        <label for="title">Category Title</label>
        <input type="text" class="form-control" name="title" placeholder="title">
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
