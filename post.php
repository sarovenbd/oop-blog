<?php
  require 'inc/header.php';
  require 'inc/nav.php';
?>
    <?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $_GET['id'];
    }else{
        gotoUrl("/404.php");
    }
    $query = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at, users.name FROM posts INNER JOIN users ON posts.user_id=users.id WHERE posts.id = '$id' AND posts.status = 1";
        $posts = $db->select($query);
        if (!$posts) {
            gotoUrl("/404.php");
        }else{

        while($post = $posts->fetch_assoc()){ ?>
      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Read full Post
          <!-- <small>Secondary Text</small> -->
        </h1>

        <!-- Blog Post -->

            <div class="card mb-4">
              <img class="card-img-top" style="height: 300px;width: auto;" src="admin/inc/uploads/images/<?php echo $post['image']; ?>" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title"><?php echo $post['title']; ?></h2>
                <p class="card-text"><?php echo $post['content']; ?></p>

              </div>
              <div class="card-footer text-muted">
                Posted on <?php $date = strtotime($post['created_at']); echo date('F jS, Y',$date); ?> by
                <a href="#"><?php echo $post['name']; ?></a>
              </div>
            </div>
        <?php

// $str = "<h1>hello</h1>";

// // Outputs: Is your name O\'Reilly?
// echo addslashes($str);
    } } ?>



      </div>




<?php
  require 'inc/sidebar.php';
  require 'inc/footer.php';
?>
