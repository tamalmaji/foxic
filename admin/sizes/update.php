<?php
require_once "../../config/_dbCon.php";

$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: sizes.php');
}

$sql = 'SELECT * FROM foxic_sizes WHERE sizes_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $sizes = $statement->fetch(PDO::FETCH_ASSOC);
    }
}

$title = $sizes['sizes_title'];
$titleSize = $sizes['sizes_titleSize'];
$dec = $sizes['sizes_dec'];
$date = date('Y_m_d H:i:s');

$title_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $title = trim($_POST['title']);
    $titleSize = trim($_POST['titleSize']);
    $dec = trim($_POST['dec']);

    if (empty($title)) {
        $title_err = 'Enter Your title Name';
    }
    if (empty($titleSize)) {
        $titleSize_err = 'Enter Your title sizes Name';
    }

    if (empty($dec)) {
        $dec_err = 'Enter Your description sizes Name';
    }

    if (empty($title_err) && empty($titleSize_err)) {
        $sql = 'UPDATE foxic_sizes SET sizes_title = :sizes_title, sizes_titleSize = :sizes_titleSize, sizes_dec = :sizes_dec, update_at = :update_at WHERE sizes_id = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':sizes_title', $title);
            $statement->bindValue(':sizes_titleSize', $titleSize);
            $statement->bindValue(':sizes_dec', $dec);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
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