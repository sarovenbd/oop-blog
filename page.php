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
    $query = "SELECT * FROM pages WHERE id = $id AND status = 1";
        $pages = $db->select($query);
        if (!$pages) {
            gotoUrl("/404.php");
        }else{

         ?>
      <!-- Blog Entries Column -->
      <div class="col-md-8">
      <?php while($page = $pages->fetch_assoc()){ ?>

        <h1 class="my-4">
        <?php echo $page['title']; ?>

        </h1>

        <!-- Blog page -->

            <div class="card mb-4">

              <div class="card-body">

                <p class="card-text"><?php echo $page['content']; ?></p>

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
