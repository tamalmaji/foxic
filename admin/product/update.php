<?php
require_once "../../config/_dbCon.php";
$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: product.php');
    exit;
}
$sqll = 'SELECT * FROM foxic_product WHERE product_id = :id';
if ($stmt = $pdo->prepare($sqll)) {
    $stmt->bindValue(':id', $id);
    if ($stmt->execute()) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
$catId = $product['catagory_id'];
$colId = $product['colors_id'];
$sizeId = $product['sizes_m_id'];

$sqli = 'SELECT * FROM foxic_catagory WHERE catagory_id = :id';
if ($stat = $pdo->prepare($sqli)) {
    $stat->bindValue(':id', $catId);
    if ($stat->execute()) {
        $cat = $stat->fetch(PDO::FETCH_ASSOC);
    }
}

$sql = 'SELECT * FROM foxic_catagory';
if ($statement = $pdo->prepare($sql)) {
    if ($statement->execute()) {
        $catagorys = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$sqli = 'SELECT * FROM foxic_colors';
if ($statements = $pdo->prepare($sqli)) {
    if ($statements->execute()) {
        $colors = $statements->fetchAll(PDO::FETCH_ASSOC);
    }
}
$sq = 'SELECT * FROM foxic_colors WHERE colors_id = :id';
if ($stats = $pdo->prepare($sq)) {
    $stats->bindValue(':id', $colId);
    if ($stats->execute()) {
        $cols = $stats->fetch(PDO::FETCH_ASSOC);
    }
}

$sqlli = 'SELECT * FROM foxic_sizes';
if ($statms = $pdo->prepare($sqlli)) {
    if ($statms->execute()) {
        $sizes = $statms->fetchAll(PDO::FETCH_ASSOC);
    }
}
$sqi = 'SELECT * FROM foxic_sizes WHERE sizes_id = :id';
if ($statm = $pdo->prepare($sqi)) {
    $statm->bindValue(':id', $sizeId);
    if ($statm->execute()) {
        $sizev = $statm->fetch(PDO::FETCH_ASSOC);
    }
}


$title = $product['product_title'];
$price = $product['product_price'];
$desc = $product['product_desc'];
$decpriceDate = $product['product_discount_time'];
$decprice = $product['product_discount'];
$qty = $product['product_qty'];
$catagory = $product['catagory_id'];
$col = $product['colors_id'];
$siz = $product['sizes_m_id'];
$date = date('Y_m_d H:i:s');

$title_err = '';
$price_err = '';
$decprice_err = '';
$qty_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $desc = trim($_POST['desc']);
    $decpriceDate = trim($_POST['decpriceDate']);
    $decprice = trim($_POST['decprice']);
    $qty = trim($_POST['qty']);
    $catagory = trim($_POST['catagory']);
    $col = trim($_POST['col']);
    $siz = trim($_POST['siz']);

    if (empty($title)) {
        $title_err = 'Enter Your Product Name';
    }
    if (empty($price)) {
        $price_err = 'Enter Your Product price';
    }
    if (empty($decprice)) {
        $decprice_err = 'Enter Your Product Discount';
    }
    if (empty($qty)) {
        $qty_err = 'Enter Your Product Quantity';
    }

    require_once "./validProduct.php";

    if (empty($title_err) && empty($price_err) && empty($price_err) && empty($qty_err)) {

        $sql = 'UPDATE foxic_product SET  product_title = :product_title, product_desc = :product_desc, product_price = :product_price, product_discount = :product_discount, product_discount_time = :product_discount_time, product_qty =:product_qty, catagory_id = :catagory_id, colors_id = :colors_id, sizes_m_id = :sizes_m_id, product_img = :product_img, update_at = :update_at WHERE product_id = :id';

        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':product_title', $title);
            $statement->bindValue(':product_desc', $desc);
            $statement->bindValue(':product_price', $price);
            $statement->bindValue(':product_discount', $decprice);
            $statement->bindValue(':product_discount_time', $decpriceDate);
            $statement->bindValue(':product_qty', $qty);
            $statement->bindValue(':catagory_id', $catagory);
            $statement->bindValue(':colors_id', $col);
            $statement->bindValue(':sizes_m_id', $siz);
            $statement->bindValue(':product_img', $upload_dir);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
            if ($statement->execute()) {
                header('location: product.php');
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title" value="<?php echo $title ?>">
                        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
                    </div>
                    <div class="form-group">
                        <label>Product Desc</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Product Desc.." name="desc"><?php echo $desc ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Product Price</label>
                        <input type="number" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" name="price" placeholder="Enter Price" value="<?php echo $price ?>">
                        <samp class="invalid-feedback"><?php echo $price_err; ?></samp>
                    </div>
                    <div class="form-group">
                        <label>Product Discount Time:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control float-right" id="reservation" name="decpriceDate" value="<?php echo $decpriceDate ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Product Discount</label>
                        <input type="number" class="form-control <?php echo (!empty($decprice_err)) ? 'is-invalid' : ''; ?>" name="decprice" placeholder="Enter Discount" value="<?php echo $decprice ?>">
                        <samp class="invalid-feedback"><?php echo $decprice_err; ?></samp>
                    </div>
                    <div class="form-group">
                        <label for="title">Product Quantity</label>
                        <input type="number" class="form-control <?php echo (!empty($qty_err)) ? 'is-invalid' : ''; ?>" name="qty" placeholder="Enter Quantity" value="<?php echo $qty ?>">
                        <samp class="invalid-feedback"><?php echo $qty_err; ?></samp>
                    </div>
                    <div class="form-group">
                        <label>Select Product Catagory</label>
                        <select class="form-control" name="catagory">
                            <option value="<?php echo $cat['catagory_id'] ?>">
                                <?php echo $cat['catagory_title'] ?>
                            </option>
                            <?php foreach ($catagorys as $catagory) : ?>
                                <option value="<?php echo $catagory['catagory_id'] ?>"><?php echo $catagory['catagory_title'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Product color</label>
                        <select class="form-control" name="col">
                            <option value="<?php echo $cols['colors_id'] ?>">
                                <?php echo $cols['colors_title'] ?>
                            </option>
                            <?php foreach ($colors as $color) : ?>
                                <option value="<?php echo $color['colors_id'] ?>"><?php echo $color['colors_title'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Product Size</label>
                        <select class="form-control" name="siz">
                            <?php if ($sizev) { ?>
                                <option value="<?php echo $sizev['sizes_id'] ?>">
                                    <?php echo $sizev['sizes_titleSize'] ?>
                                </option>
                            <?php }else {  ?>
                                <option value="<?php echo 0 ?>">Select Option</option>
                            <?php } ?>
                            <?php foreach ($sizes as $size) : ?>
                                <option value="<?php echo $size['sizes_id'] ?>"><?php echo $size['sizes_titleSize'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label class="form-label">Upload Product Image Images</label>
                            <input class="form-control" type="file" name="img">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "../partials/footer.php" ?>