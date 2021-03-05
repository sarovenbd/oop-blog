<?php

    require 'inc/header.php';
    require 'inc/navbar.php';
    require 'lib/uploader.php';

    $query = "SELECT * FROM categories WHERE status = 1";
    $data = $db->select($query);

    if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['title']) && isset($_POST['content'])) {

        $title = validate($_POST['title']);
        $content = validate($_POST['content']);
        $content = addslashes($_POST['content']);
        $tags = validate($_POST['tags']);
        $slug = validate($_POST['slug']);
        $category = validate($_POST['category']);


        if (empty($title)) {
            $_SESSION['error'] = "Title can not be empty!";
        }else if (empty($content)) {
            $_SESSION['error'] = "Content can not be empty!";
        }else if (empty($tags)) {
            $_SESSION['error'] = "tags can not be empty!";
        }else if (empty($slug)) {
            $_SESSION['error'] = "Slug can not be empty!";
        }else if (empty($category)) {
          $_SESSION['error'] = "Sategory can not be empty!";
      }else {
                $uploader   =   new Uploader();
                $uploader->setDir('inc/uploads/images/');
                $uploader->setExtensions(array('jpg','jpeg','png','gif')); //allowed extensions list//
                $uploader->setMaxSize(.5); //set max file size to be allowed in MB//

                if($uploader->uploadFile('image')){   //txtFile is the filebrowse element name //
                    $image  =   $uploader->getUploadName(); //get uploaded file name, renames on upload//
                }else{ //upload failed
                $message = $uploader->getMessage(); //get upload error message
                $_SESSION['error'] = $message;
                $image = "no-image.png";
                }

              $uid = $_SESSION['user_id'];

            date_default_timezone_set("Asia/Dhaka");
            $date = date('Y-m-d h:i:sa');
            $sql = "INSERT INTO posts (title, content, tags, slug, cat_id,user_id, image, created_at) VALUES ('$title', '$content', '$tags', '$slug', '$category', '$uid', '$image', '$date')";

            $result = $db->insert($sql);

            if ($result) {
                $_SESSION['success'] = "post added successfully.";
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }

    }

 ?>


    <h1 class="mt-4">Add post</h1>
    <ol class="breadcrumb mb-4">
    <a href="posts.php" class="btn btn-success">View posts</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Add post
    </div>
    <div class="card-body">
    <form action="addpost.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter post title">
      </div>

      <div class="form-group">
        <label for="editor">Content</label>
        <textarea class="form-control" name="content" id="editor" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="category">Post Category</label>
        <select name="category" class="form-control">
        <option value="">Select Category</option>
        <?php if($data) {
          while ($cat = $data->fetch_assoc()) {  ?>
          <option value="<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></option>
        <?php } }else{
          echo "<option value=''>No category added yet! Plese add some category first!</option>";
        } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" placeholder="Enter post tags">
      </div>
      <div class="form-group">
        <label for="slug">Post slug</label>
        <input type="text" class="form-control" name="slug" placeholder="Enter post slug">
      </div>
      <div class="form-group">
        <label for="image">Thumbnail</label>
        <input type="file" name="image" class="form-control">

        </div>


      <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
      </div>
    </form>
    </div>

</div>

<?php require 'inc/footer.php'; ?>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
   $('#editor').summernote({
        placeholder: 'Post content ',
        tabsize: 2,
        height: 200
      });
</script>
