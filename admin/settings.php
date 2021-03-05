<?php

    require 'inc/header.php';
    require 'inc/navbar.php';

    $query = "SELECT * FROM settings WHERE id = 1";
    $data = $db->select($query);
    if ($data) {
        $d = $data->fetch_assoc();
        $id = $d['id'];
    }
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
      // print_r($_POST); die;
        $title = validate($_POST['title']);
        $description = validate($_POST['description']);
        $tags = validate($_POST['tags']);
        $url = validate($_POST['url']);

        if (empty($title)) {
            $_SESSION['error'] = "Site title can not be empty!";
        }else if (empty($description)) {
            $_SESSION['error'] = "SEO description can not be empty!";
        }else if (empty($tags)) {
            $_SESSION['error'] = "Tags can not be empty!";
        }else if(empty($url)){
          $_SESSION['error'] = "Site url can not be empty";
        }else {

            if (!$data) {
              $sql = "INSERT INTO settings (title, description, tags, url) VALUES ('$title', '$description', '$tags', '$url')";
              $result = $db->insert($sql);
            }else{

              $sql = "UPDATE settings SET title = '$title', description = '$description', tags = '$tags', url = '$url' WHERE id = '$id' ";
              $result = $db->update($sql);
            }

            if ($result) {
                $_SESSION['success'] = "Information updated successfully.";
                // gotoUrl("$base_url/admin/settings.php"); die;
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }

    }
 ?>
    <h1 class="mt-4">Settings</h1>
    <ol class="breadcrumb mb-4">
        <span>Fill the correct information about this website. it will be displayed in public section.</span>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
       General Information
    </div>
    <div class="card-body">
    <form action="settings.php" method="post">
      <div class="form-group">
        <label for="title">Site Title</label>
        <input type="text" class="form-control" value="<?php echo $data ? $d['title'] : ''; ?>" name="title" placeholder="Site title">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">SEO description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $data ? $d['description'] : ''; ?></textarea>
      </div>
      <div class="form-group">
        <label for="tags">SEO Tag</label>
        <input type="text" class="form-control" value="<?php echo $data ? $d['tags'] : ''; ?>" name="tags" placeholder="Tags">
      </div>
      <div class="form-group">
        <label for="url">Site Url</label>
        <input type="text" class="form-control" value="<?php echo $data ? $d['url'] : ''; ?>" name="url" placeholder="Url">
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
