<?php

    require 'inc/header.php';
    require 'inc/navbar.php';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = validate($_GET['id']);

    $sql = "SELECT * FROM pages WHERE id='$id'";
    $data = $db->select($sql);

    if ($data) {
        $d = $data->fetch_assoc();

    }else{
        gotoUrl("$base_url/admin/pages.php");
    }

}else{
    gotoUrl("$base_url/admin/pages.php");
}

    if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['title']) && isset($_POST['content'])) {

        $title = validate($_POST['title']);
        $content = validate($_POST['content']);
        $slug = validate($_POST['slug']);
        $status = validate($_POST['status']);

        if (empty($title)) {
            $_SESSION['error'] = "Title can not be empty!";
        }else if (empty($content)) {
            $_SESSION['error'] = "Content can not be empty!";
        }else if (empty($status)) {
            $_SESSION['error'] = "Status can not be empty!";
        }else if (empty($slug)) {
            $_SESSION['error'] = "slug can not be empty!";
        }else{
            date_default_timezone_set("Asia/Dhaka");
            $date = date('Y-m-d h:i:sa');

            // $sql = "INSERT INTO pages (title, content, created_at) VALUES ('$title', '$content', '$date')";
            $sql = "UPDATE pages SET title = '$title', content = '$content', slug = '$slug', status = '$status' WHERE id = '$id' ";

            $result = $db->update($sql);

            if ($result) {
                $_SESSION['success'] = "Page added successfully.";
                gotoUrl("$base_url/admin/pages.php"); die;
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }

    }
 ?>
    <h1 class="mt-4">Edit Page</h1>
    <ol class="breadcrumb mb-4">
    <a href="pages.php" class="btn btn-success">View Pages</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Edit Page
    </div>
    <div class="card-body">
    <form action="editpage.php?id=<?php echo $id; ?>" method="post">
      <div class="form-group">
        <label for="title">Page Title</label>
        <input type="text" class="form-control" value="<?php echo $d['title']; ?>" name="title" placeholder="Enter page title">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Content</label>
        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"><?php echo $d['content']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="slug">Page Slug</label>
        <input type="text" class="form-control" value="<?php echo $d['slug']; ?>" name="slug" placeholder="Enter page slug">
      </div>
       <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <?php $status = $d['status']; ?>
            <option value="1"<?php if($status == 1){echo "Selected";} ?> >Active</option>
            <option value="2" <?php if($status == 2){echo "Selected";} ?> >Deactive</option>
        </select>
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
