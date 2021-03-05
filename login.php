<?php
    session_start();

    require 'admin/config/config.php';
    require 'admin/lib/database.php';
    require 'admin/helper/function.php';

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && $_SESSION['user_id'] != '' && $_SESSION['user_name'] != '') {
        gotoUrl('/index.php');
    }


    $db = new Database ();

    $sql = "SELECT * FROM settings WHERE id=1";
    $data = $db->select($sql);
    if($data){
        $d = $data->fetch_assoc();
    }
    // $_SESSION['error'] = "Something went wrong";
    if(isset($_POST['submit']) && $_POST['submit'] != ''){
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $password = md5($_POST['password']);

        if(empty($email)){
            $_SESSION['error'] = "Email can not be empty!";
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format";
          }else if(empty($password)){
            $_SESSION['error'] = "Password can not be empty!";
        }

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 1";
        $logindata = $db->select($sql);
        if($logindata){
            $user = $logindata->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            gotoUrl('/index.php');
        }else{
            $_SESSION['error'] = "Invalid Email or Password!";
        }


    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo $data ? $d['description'] : 'Saroven Blog description';  ?>" />
        <meta name="author" content="saroven" />
        <title><?php echo $data ? $d['title'] : 'Saroven Blog';  ?> | Login</title>
        <link href="admin/inc/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><a href="/index.php" style="text-decoration: none; color: black; text-transform: uppercase;"><?php echo $data ? $d['title'] : 'Saroven Blog';  ?></a></h3></div>
                                    <?php include 'admin/helper/message.php' ?>
                                    <div class="card-body">
                                        <form method="post" action= "login.php">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="recover_password.php">Forgot Password?</a>

                                                <input type="submit" name="submit" value="submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="#">Need an account? Sign up!</a></div>
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
                            <div class="text-muted">Copyright &copy; saroven blog 2021</div>
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
