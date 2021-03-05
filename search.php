<?php
  require 'inc/header.php';
  require 'inc/nav.php';
  include_once 'admin/helper/function.php';
  if (isset($_GET['s']) && $_GET['s'] != '') {

      $s = validate($_GET['s']);

      $query = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at, users.name FROM posts INNER JOIN users ON posts.user_id=users.id WHERE posts.status = 1 AND posts.title LIKE '%$s%' OR posts.content LIKE '%$s%'";
        $posts = $db->select($query);
  }
?>

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4"><?php echo $data ? $d['title'] : 'Saroven Personal Blog' ?>
          <small>Search Results</small>
        </h1>

        <!-- Blog Post -->
        <?php
            if ($posts) {

            while($post = $posts->fetch_assoc()){ ?>
            <div class="card mb-4">
              <img class="card-img-top" style="height: 300px;width: auto;" src="admin/inc/uploads/images/<?php echo $post['image']; ?>" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title"><?php echo $post['title']; ?></h2>
                <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on <?php $date = strtotime($post['created_at']); echo date('F jS, Y',$date); ?> by
                <a href="#"><?php echo $post['name']; ?></a>
              </div>
            </div>
        <?php } }else{ ?>

            <h2 class="card-title">No data found!</h2>
            <?php } ?>
        <!-- Pagination -->
        <!-- <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul> -->

      </div>




<?php
  require 'inc/sidebar.php';
  require 'inc/footer.php';
?>
