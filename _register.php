<?php

session_start();
require 'admin/config/config.php';
require 'admin/lib/database.php';
require 'admin/helper/function.php';
$db = new Database();

//check if is user logged in or not
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && $_SESSION['user_id'] != '' && $_SESSION['user_name'] != '') {
    gotoUrl('/index.php');
}



if (isset($_POST['submit']) && $_POST['submit'] != '' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['password'])) {

    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $gender = validate($_POST["gender"]);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

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
      }else if($password != $cpassword){
        $_SESSION['error'] = "Password and Confirm Password Does not matched!";
      }else {
        date_default_timezone_set("Asia/Dhaka");
        $date = date('Y-m-d h:i:sa');
        $password = md5($password);
        $sql = "INSERT INTO users (name, email, gender, password, created_at) VALUES ('$name', '$email', '$gender', '$password', '$date')";

        $result = $db->insert($sql);

        if ($result) {
            $_SESSION['success'] = "Registration successfully, Please go to login page and start the session.";
        }else{
            $_SESSION['error'] = "Something went wrong, please try again!";
        }
    }
}else{
    $_SESSION['error'] = "This email is already registered";
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Saroven's Blog | Signup</title>
        <link href="admin/inc/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <?php require 'admin/helper/message.php'; ?>
                                    <div class="card-body">
                                        <form method="post" action="register.php">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputName">Name</label>
                                                <input class="form-control py-4" id="inputName" type="text" name="name" placeholder="Enter Full Name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputGender">Gender</label>
                                                <select name="gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" type="password" name="cpassword" placeholder="Confirm password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="submit" value="Create Account" class="btn btn-primary btn-block">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="admin/inc/js/scripts.js"></script>
    </body>
</html>
