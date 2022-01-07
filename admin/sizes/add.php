<?php
require_once "../../config/_dbCon.php";
$title = '';
$titleSize = '';
$dec = '';
$date = date('Y_m_d H:i:s');

$title_err = '';
$titleSize_err = '';
$dec_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $title = trim($_POST['title']);
    $titleSize = trim($_POST['titleSize']);
    $dec = trim($_POST['dec']);
    if (empty($title)) {
        $title_err = 'Enter Your title Name';
    } else {
        $sql = 'SELECT sizes_id FROM foxic_sizes WHERE sizes_title = :title';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $title_err = 'Enter Your title Name';
                }
            } else {
                die('Somthing Went Wrong');
            }
        }
        unset($statement);
    }
    if (empty($titleSize)) {
        $titleSize_err = 'Enter Your title sizes Name';
    }

    if (empty($dec)) {
        $dec_err = 'Enter Your description sizes Name';
    }

    if (empty($title_err) && empty($titleSize_err)) {
        $sql = 'INSERT INTO foxic_sizes (sizes_title, sizes_titleSize, sizes_dec, create_at, update_at) 
        VALUE(:sizes_title, :sizes_titleSize, :sizes_dec, :create_at, :update_at)';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':sizes_title', $title);
            $statement->bindValue(':sizes_titleSize', $titleSize);
            $statement->bindValue(':sizes_dec', $dec);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
            if ($statement->execute()) {
                header('location: sizes.php');
            } else {
                die('Somthing Went Wrong');
            }
        }
        unset($statement);
    }
    unset($pdo);
}
?>
<?php include_once "../partials/header.php" ?>
<div class="content-wrapper" style="min-height: 485.139px;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <?php include_once "_form.php" ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "../partials/footer.php" ?>