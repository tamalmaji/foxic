<?php
require_once "../config/_dbCon.php";
$sql = 'SELECT * FROM foxic_state';
if ($stmt = $pdo->prepare($sql)) {
    if ($stmt->execute()) {
        $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$fname = '';
$lname = '';
$email = '';
$pwd = '';
$cpwd = '';
$cuntry = '';
$state = '';
$type = 2;
$date = date('Y-m-d H:i:s');

$fname_err = '';
$lname_err = '';
$email_err = '';
$pwd_err = '';
$cpwd_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_EMAIL);

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);
    $cpwd = trim($_POST['cpwd']);
    $cuntry = trim($_POST['cuntry']);
    $state = trim($_POST['state']);

    if (empty($fname)) {
        $fname_err = 'Please Enter First Name';
    }
    if (empty($lname)) {
        $lname_err = 'Please Enter Last Name';
    }
    if (empty($email)) {
        $email_err = 'Please Enter Email';
    }else{
        $sql = 'SELECT users_id  FROM foxic_users WHERE users_email = :email';
        if ($stmts = $pdo->prepare($sql)) {
            $stmts->bindValue(':email', $email);
            if ($stmts->execute()) {
                if ($stmts->rowCount() === 1) {
                    $email_err = 'Email is alrady exits';
                }
            }else {
                die('Somthing went Wrong');
            }
        }
    }

    if (empty($pwd)) {
        $pwd_err = 'Please enter Password and Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters ';
    }elseif (strlen($pwd) < 8 || strlen($pwd) > 16) {
        $pwd_err = 'Password should be min 8 characters and max 16 characters';
    }elseif (!preg_match("/\b/", $pwd)) {
       $pwd_err = 'Password should  contain  at least one digite';
    }elseif (!preg_match('/[A-Z]/', $pwd)) {
        $pwd_err = "Password should  contain at least one Capital Letter";
    }elseif( !preg_match("/[a-z]/", $pwd)){
        $pwd_err = "Password should  contain at least one Small Letter";
    }elseif( !preg_match("/\W/", $pwd)){
        $pwd_err = "Password should  contain at least one special character";
    }elseif(preg_match("/\s/", $pwd)){
        $pwd_err = "Password should not contain any white space";
    }

    if (empty($cpwd)) {
        $cpwd_err = 'Please enter Confirm Password';
    }
    if ($pwd !== $cpwd) {
        $cpwd_err = 'Password do not match';
    }

    if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($pwd_err) && empty($cpwd_err)) {
        
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        $sqli = 'INSERT INTO foxic_users (users_fname, users_lname, users_email, users_pass, users_state, users_cuntry, users_type, create_at, Update_at) 
                VALUE(:users_fname, :users_lname, :users_email, :users_pass, :users_state, :users_cuntry, :users_type, :create_at, :Update_at)';

        if ($statement = $pdo->prepare($sqli)) {
            $statement->bindValue(':users_fname', $fname);
            $statement->bindValue(':users_lname', $lname);
            $statement->bindValue(':users_email', $email);
            $statement->bindValue(':users_pass', $pwd);
            $statement->bindValue(':users_state', $state);
            $statement->bindValue(':users_cuntry', $cuntry);
            $statement->bindValue(':users_type', $type);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':Update_at', $date);
            if ($statement->execute()) {
                header('location: login.php');
            }
        }
        
    }
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
                    <h1 class="m-0">Register</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../public/index.php">Home</a></li>
                        <li class="breadcrumb-item active">Register</li>
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
                        <h3 class="card-title">Register</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="" method="POST">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>"  placeholder="First Name" name="fname" value="<?php echo $fname ?>">
                                    <samp class="invalid-feedback"><?php echo $fname_err; ?></samp>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-2 col-form-label">last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" placeholder="last Name" name="lname" value="<?php echo $lname; ?>">
                                    <samp class="invalid-feedback"><?php echo $lname_err; ?></samp>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"  placeholder="Email" name="email" value="<?php echo $email; ?>">
                                    <samp class="invalid-feedback"><?php echo $email_err; ?></samp>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pwd" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control <?php echo (!empty($pwd_err)) ? 'is-invalid' : ''; ?>"  placeholder="Password" name="pwd" value="<?php echo $pwd ?>">
                                    <samp class="invalid-feedback"><?php echo $pwd_err; ?></samp>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cpwd" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control <?php echo (!empty($cpwd_err)) ? 'is-invalid' : ''; ?>"  placeholder="Confirm Password" name="cpwd" value="<?php $cpwd ?>">
                                    <samp class="invalid-feedback"><?php echo $cpwd_err; ?></samp>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Cuntry</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="cuntry">
                                        <option value="<?php echo 1; ?>">India</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select State</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="state">
                                        <option value="<?php echo 0 ?>">Select Option</option>
                                        <?php foreach ($states as $state) : ?>
                                            <option value="<?php echo $state['state_id'] ?>"><?php echo $state['state_title'] ?></option>
                                        <?php endforeach ?>
                                    </select>
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