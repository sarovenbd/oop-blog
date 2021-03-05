      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
           <form method="get"" action="search.php">
            <div class="input-group">
              <input type="text" name="s" class="form-control" placeholder="Search for...">
              <span class="input-group-append">
              <button class="btn btn-secondary">Go!</button>
              </span>
            </div>
           </form>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <ul class="list-unstyled mb-0">
                <?php
                  $query = "SELECT * FROM categories WHERE status = 1";
                  $cdata = $db->select($query);
                  if ($cdata) {

                  while($category = $cdata->fetch_assoc()){ ?>
                  <li>
                    <a href="/category.php?id=<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a>
                  </li>
                  <?php }}else{ ?>
                    <li>
                    <p>No category!</p>
                    </li>
                  <?php } ?>
                </ul>
              </div>

            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>
