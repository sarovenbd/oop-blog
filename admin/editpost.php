<?php

    require 'inc/header.php';
    require 'inc/navbar.php';
    require 'lib/uploader.php';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = validate($_GET['id']);

    $sql = "SELECT * FROM posts WHERE id='$id'";
    $data = $db->select($sql);

    $query = "SELECT * FROM categories WHERE status = 1";
    $cdata = $db->select($query);

    if ($data) {
        $d = $data->fetch_assoc();

    }else{
        gotoUrl("$base_url/admin/posts.php");
    }

}else{
    gotoUrl("$base_url/admin/posts.php");
}

if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['title']) && isset($_POST['content'])) {

  $title = validate($_POST['title']);
  $content = validate($_POST['content']);
  $tags = validate($_POST['tags']);
  $slug = validate($_POST['slug']);
  $status = validate($_POST['status']);
  $cat_id = validate($_POST['category']);


  if (empty($title)) {
      $_SESSION['error'] = "Title can not be empty!";
  }else if (empty($content)) {
      $_SESSION['error'] = "Content can not be empty!";
  }else if (empty($tags)) {
      $_SESSION['error'] = "tags can not be empty!";
  }else if (empty($slug)) {
      $_SESSION['error'] = "Slug can not be empty!";
  }else {
         if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
            $uploader   =   new Uploader();
            $uploader->setDir('inc/uploads/images/');
            $uploader->setExtensions(array('jpg','jpeg','png','gif')); //allowed extensions list//
            $uploader->setMaxSize(.5); //set max file size to be allowed in MB//

            if($uploader->uploadFile('image')){   //txtFile is the filebrowse element name //
                $image  =   $uploader->getUploadName(); //get uploaded file name, renames on upload//
                if($d['image'] != 'no-image.png'){
                  $img = $d['image'];
                  $target_file = "inc/uploads/images/$img";
                  if (file_exists($target_file)) {
                    unlink("inc/uploads/images/$img");
                  }
                }

            }else{ //upload failed
            $message = $uploader->getMessage(); //get upload error message
            $_SESSION['error'] = $message;
            $image = $d['image'];

            }
         }else{
           $image = $d['image'];
         }
            date_default_timezone_set("Asia/Dhaka");
            $date = date('Y-m-d h:i:sa');

            $sql = "UPDATE posts SET title = '$title', content = '$content', cat_id = '$cat_id', tags = '$tags', slug ='$slug', image = '$image', status = '$status' WHERE id = '$id' ";

            $result = $db->update($sql);



            if ($result) {
                $_SESSION['success'] = "post added successfully.";
                gotoUrl("$base_url/admin/posts.php"); die;
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }

    }
 ?>
    <h1 class="mt-4">Edit Post</h1>
    <ol class="breadcrumb mb-4">
    <a href="posts.php" class="btn btn-success">View Posts</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Edit Post
    </div>
    <div class="card-body">
    <form action="editpost.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $d['title']; ?>" name="title" placeholder="Enter post title">
      </div>

      <div class="form-group">
        <label for="editor">Content</label>
        <textarea class="form-control" name="content" id="editor" rows="3"><?php echo $d['content']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="category">Post Category</label>
        <select name="category" class="form-control">
        <option value="">Select Category</option>
        <?php if($cdata) {
          while ($cat = $cdata->fetch_assoc()) { ?>
          <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $d['cat_id']){echo "SELECTED";} ?> ><?php echo $cat['title']; ?></option>
        <?php } }else{
          echo "<option value=''>No category added yet! Plese add some category first!</option>";
        } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" value="<?php echo $d['tags']; ?>" name="tags" placeholder="Enter post tags">
      </div>
      <div class="form-group">
        <label for="slug">Post slug</label>
        <input type="text" class="form-control" value="<?php echo $d['slug']; ?>" name="slug" placeholder="Enter post slug">
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
        height: 100
      });
</script>

