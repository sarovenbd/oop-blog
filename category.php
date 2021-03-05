<?php
  require 'inc/header.php';
  require 'inc/nav.php';
?>
    <?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $_GET['id'];
        $sql = "SELECT * FROM categories WHERE id='$id'";
        $categories = $db->select($sql);
        if ($categories) {
            $cat = $categories->fetch_assoc();
        }else{
            gotoUrl("/404.php");
        }
    }else{
        gotoUrl("/404.php");
    }
    $query = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at, users.name FROM posts INNER JOIN users ON posts.user_id=users.id WHERE posts.cat_id = '$id' AND posts.status = 1";
        $posts = $db->select($query);

         ?>
      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">All Post In:
          <small><?php echo $cat['title']; ?></small>
        </h1>

        <!-- Blog Post -->

        <?php
        if($posts){
        while($post = $posts->fetch_assoc()){ ?>
            <div class="card mb-4">
              <img class="card-img-top" style="height: 300px;width: auto;" src="admin/inc/uploads/images/<?php echo $post['image']; ?>" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title"><?php echo $post['title']; ?></h2>
                <p class="card-text"><?php echo htmlentities(substr($post['content'], 0, 120)).'....'; ?></p>
                <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More &rarr;</a>

              </div>
              <div class="card-footer text-muted">
                Posted on <?php $date = strtotime($post['created_at']); echo date('F jS, Y',$date); ?> by
                <a href="#"><?php echo $post['name']; ?></a>
              </div>
            </div>
        <?php }} else{
          echo '<p> No post available in this category!</p>';
        } ?>



      </div>





<?php
  require 'inc/sidebar.php';
  require 'inc/footer.php';
?>
