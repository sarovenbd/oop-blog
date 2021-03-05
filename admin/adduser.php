<?php

    require 'inc/header.php';
    require 'inc/navbar.php';


    if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['password'])) {


        $name = validate($_POST["name"]);
        $email = validate($_POST["email"]);
        $gender = validate($_POST["gender"]);
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $data = $db->select($sql);

        if (!$data) {


        if (empty($name)) {
            $_SESSION['error'] = "Name can not be empty!";
        }else if (empty($email)) {
            $_SESSION['error'] = "Email can not be empty!";
        }else if(strlen($password) < 6){
            $_SESSION['error'] = "Password must be minimum 6 charecters long!";
        }else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $_SESSION['error'] = "Only letters and white space allowed!";
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format";
          }else {
            date_default_timezone_set("Asia/Dhaka");
            $date = date('Y-m-d h:i:sa');
            $password = md5($password);
            $sql = "INSERT INTO users (name, email, gender, password, created_at) VALUES ('$name', '$email', '$gender', '$password', '$date')";

            $result = $db->insert($sql);

            if ($result) {
                $_SESSION['success'] = "User added successfully.";
            }else{
                $_SESSION['error'] = "Something went wrong, please try again!";
            }
        }
    }else{
        $_SESSION['error'] = "This email is already registered";
    }
    }
 ?>
    <h1 class="mt-4">Add User</h1>
    <ol class="breadcrumb mb-4">
    <a href="users.php" class="btn btn-success">View Users</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Add user
    </div>
    <div class="card-body">
    <form action="adduser.php" method="post">
      <div class="form-group">
        <label for="title">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter user name">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Enter Email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter Password" class="form-control">
      </div>
      <div class="from-group">
      <select name="gender" class="form-control">
      <option value="">Select Gender</option>
      <option value="1">Male</option>
      <option value="2">Female</option>
      <option value="3">Other</option>
      </select>

      </div>

      <div class="form-group mt-2">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
      </div>
    </form>
    </div>

</div>

<?php require 'inc/footer.php'; ?>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="inc/js/datatables-demo.js"></script>
