<?php
require_once "../../config/_dbCon.php";
$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: ../product/product.php');
}

$sql = 'SELECT * FROM foxic_product WHERE product_id  =:id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $product = $statement->fetch(PDO::FETCH_ASSOC);
    }
}

$sql = 'SELECT * FROM foxic_sizes';
if ($statement = $pdo->prepare($sql)) {
    if ($statement->execute()) {
        $sizes = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$siz = '';
$date = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $siz = trim($_POST['siz']);

    $sql = 'INSERT INTO foxic_variable (sizes_id, create_at, update_at)
            VALUE(:sizes_id, :create_at, :update_at)';
    if ($statement = $pdo->prepare($sql)) {
        $statement->bindValue(':sizes_id', $siz);
        // $statement->bindValue(':product_id', $proId);
        $statement->bindValue(':create_at', $date);
        $statement->bindValue(':update_at', $date);
        if ($statement->execute()) {
            header('location: ../product/product.php');
        }
    }
    unset($statement);
}

?>
<?php include_once "../partials/header.php" ?>
<div class="content-wrapper" style="min-height: 485.139px;">
    <div class="container m-5">
        <div class="row">
            <div class="col-12">
                <form action="add.php" method="post">
                    <div class="form-group">
                        <label>Select Product Size <?php echo $proId = $product['product_id']; ?></label>
                        <select class="form-control" name="siz[]" multiple>
                            <option value="<?php echo 0 ?>">Select Option</option>
                            <?php foreach ($sizes as $size) : ?>
                                <option value="<?php echo $size['sizes_id'] ?>" multiple="multiple"><?php echo $size['sizes_titleSize'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "../partials/footer.php" ?>