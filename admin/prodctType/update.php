<?php
require_once "../../config/_dbCon.php";

$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: productType.php');
}

$sql = 'SELECT * FROM foxic_producttype WHERE ProductType_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $catagory = $statement->fetch(PDO::FETCH_ASSOC);
    }
}

$title = $catagory['ProductType_title'];
$date = date('Y_m_d H:i:s');

$title_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $title = trim($_POST['title']);
    if (empty($title)) {
        $title_err = 'Enter Your productType Name';
    } else {
        $sql = 'SELECT ProductType_id  FROM foxic_producttype WHERE ProductType_title = :title';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $title_err = 'productType Name Alrady Exits';
                }
            } else {
                die('Somthing Went Wrong');
            }
        }
        unset($statement);
    }

    if (empty($title_err)) {
        $sql = 'UPDATE foxic_producttype SET ProductType_title = :ProductType_title, update_at = :update_at WHERE ProductType_id = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':ProductType_title', $title);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
            if ($statement->execute()) {
                header('location: productType.php');
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
    <div class="container m-5">
        <div class="row">
            <div class="col-12">
                <?php include_once "_form.php" ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "../partials/footer.php" ?>