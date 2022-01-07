<?php
require_once "../../config/_dbCon.php";
$title = '';
$date = date('Y_m_d H:i:s');

$title_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $title = trim($_POST['title']);
    if (empty($title)) {
        $title_err = 'Enter Your color Name';
    } else {
        $sql = 'SELECT colors_id FROM foxic_colors WHERE colors_title = :title';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $title_err = 'Color Name Alrady Exits';
                }
            } else {
                die('Somthing Went Wrong');
            }
        }
        unset($statement);
    }

    if (empty($title_err)) {
        $sql = 'INSERT INTO foxic_colors (colors_title, create_at, update_at) 
        VALUE(:colors_title, :create_at, :update_at)';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':colors_title', $title);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
            if ($statement->execute()) {
                header('location: colors.php');
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