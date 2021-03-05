<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/"><?php echo $data ? $d['title'] : 'Saroven Personal Blog' ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
            $query = "SELECT * FROM pages WHERE status = 1";
            $pdata = $db->select($query);
            if ($pdata) {

            while($page = $pdata->fetch_assoc()){ ?>

          <li class="nav-item">
            <a class="nav-link" href="page.php?id=<?php echo $page['id']; ?>"><?php echo $page['title']; ?></a>
          </li>
        <?php } } ?>
        </ul>
      </div>
    </div>
    <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && $_SESSION['user_id'] != '' && $_SESSION['user_name'] != '') { ?>
                <a class="dropdown-item" href="/admin/">Dashboard</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout.php">Logout</a>
                <?php }else { ?>
                <a class="dropdown-item" href="/login.php">Login</a>
                <?php } ?>
            </div>
        </li>
    </ul>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
