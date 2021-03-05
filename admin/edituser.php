<?php

    require 'inc/header.php';
    require 'inc/navbar.php';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = validate($_GET['id']);

    $sql = "SELECT * FROM users WHERE id='$id'";
    $data = $db->select($sql);

    if ($data) {
        $d = $data->fetch_assoc();

    }else{
        gotoUrl("$base_url/admin/users.php");
    }

}else{
    gotoUrl("$base_url/admin/users.php");
}

if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['password'])) {

    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $gender = validate($_POST["gender"]);
    $status = validate($_POST["status"]);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND id != '$id'";
    $check = $db->select($sql);

    if (!$check) {
    if (empty($name)) {
        $_SESSION['error'] = "Name can not be empty!";
    }else if (empty($email)) {
        $_SESSION['error'] = "Email can not be empty!";
    }else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $_SESSION['error'] = "Only letters and white space allowed!";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
      }else if(empty($password)){
        $sql = "UPDATE users SET name = '$name', email = '$email', gender = '$gender', status = '$status' WHERE id = '$id'";
        }else{
            if(strlen($password) < 6){
                $_SESSION['error'] = "Password must be minimum 6 charecters long!";
            }else{
                $password = md5($password);
                $sql = "UPDATE users SET name = '$name', email = '$email', gender = '$gender', password = '$password', status = '$status' WHERE id = '$id'";
            }
        }
        $result = $db->update($sql);

        if ($result) {
            $_SESSION['success'] = "User edited successfully.";
        }else{
            $_SESSION['error'] = "Something went wrong, please try again!";
        }
    }else{
        $_SESSION['error'] = "This email is already registered";
    }
}
 ?>
    <h1 class="mt-4">Edit User</h1>
    <ol class="breadcrumb mb-4">
    <a href="users.php" class="btn btn-success">View users</a>
    </ol>
    <?php
    include 'helper/message.php';
     ?>
 <div class="card mb-4">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body">
    <form action="edituser.php?id=<?php echo $id; ?>" method="post">
      <div class="form-group">
        <label for="name">User Name</label>
        <input type="text" class="form-control" value="<?php echo $d['name']; ?>" name="name" placeholder="Enter user name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" value="<?php echo $d['email']; ?>" name="email" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="password">Password - </label> <span style="color: gray;">if you don't want to change password please leave it empty.</span>
        <input type="password" class="form-control" name="password" placeholder="Enter password">
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control">
            <?php $gender = $d['gender']; ?>
            <option value="1"<?php if($gender == 1){echo "Selected";} ?> >Male</option>
            <option value="2" <?php if($gender == 2){echo "Selected";} ?> >Female</option>
            <option value="3" <?php if($gender == 3){echo "Selected";} ?> >Other</option>
        </select>
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
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
      </div>
    </form>
    </div>

</div>

<?php require 'inc/footer.php'; ?>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="inc/js/datatables-demo.js"></script>
