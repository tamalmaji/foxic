<?php
require_once "../config/_dbCon.php";
$email = '';
$pwd = '';

$email_err = '';
$pwd_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);

    if (empty($email)) {
        $email_err = 'Please Enter Email';
    }

    if (empty($pwd)) {
        $pwd_err = 'Please Enter Password';
    }

    if (empty($email_err) && empty($pwd_err)) {
        $pql = 'SELECT users_email, users_pass FROM foxic_users WHERE users_email = :email';

        if ($statemets = $pdo->prepare($sql)) {
            $statemets->bindValue(':email', $email);
            if ($statemets->execute()) {
                if ($statemets->rowCount() === 1) {
                   if ( $row = $statemets->fetch()) {
                       $haspassword = $row['users_email'];
                       if (password_hash($pwd, $haspassword)) {
                            session_start();
                            $_SESSION['loggin'] = true;
                            $_SESSION['user_login'] = $row['user_login'];
                            header('Location: ../public/index.php');
                       }else {
                           $pwd_err = 'The password you enterd is not valid';
                       }
                   }
                } else {
                    $pwd_err = 'No Account found that Email';
                }
            } else {
                die('Somthing Went Worng');
            }
        }
        unset($statemets);
    }
    unset($pdo);
}

?>
<?php include_once "./partial/header.php" ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Login</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../public/index.php">Home</a></li>
                        <li class="breadcrumb-item active">Login</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Login Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Password" name="pwd">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Sign in</button>
                            <button type="submit" class="btn btn-default float-right">Cancel</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once "./partial/footer.php" ?>