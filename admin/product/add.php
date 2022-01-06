<?php
require_once "../../config/_dbCon.php";
$sql = 'SELECT * FROM foxic_catagory';
if ($statement = $pdo->prepare($sql)) {
    if ($statement->execute()) {
        $catagorys = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
$title = '';
$price = '';
$desc = '';
$decpriceDate = '';
$decprice = '';
$qty = '';
$catagory = '';

$title_err = '';
$price_err = '';
$decprice_err = '';
$qty_err = '';
$date = date('Y_m_d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $desc = trim($_POST['desc']);
    $decpriceDate = trim($_POST['decpriceDate']);
    $decprice = trim($_POST['decprice']);
    $qty = trim($_POST['qty']);
    $catagory = trim($_POST['catagory']);

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

        $sql = 'INSERT INTO foxic_product (product_title, product_desc, product_price, product_discount, product_discount_time, product_qty, catagory_id, product_img, create_at, update_at) 
        VALUE(:product_title, :product_desc, :product_price, :product_discount, :product_discount_time, :product_qty, :catagory_id, :product_img, :create_at, :update_at)';

        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':product_title', $title);
            $statement->bindValue(':product_desc', $desc);
            $statement->bindValue(':product_price', $price);
            $statement->bindValue(':product_discount', $decprice);
            $statement->bindValue(':product_discount_time', $decpriceDate);
            $statement->bindValue(':product_qty', $qty);
            $statement->bindValue(':catagory_id', $catagory);
            $statement->bindValue(':product_img', $upload_dir);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
            if ($statement->execute()) {
            }
        }
    }
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
                        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title">
                        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
                    </div>
                    <div class="form-group">
                        <label>Product Desc</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Product Desc.." name="desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Product Price</label>
                        <input type="number" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" name="price" placeholder="Enter Price">
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
                            <input type="date" class="form-control float-right" id="reservation" name="decpriceDate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Product Discount</label>
                        <input type="number" class="form-control <?php echo (!empty($decprice_err)) ? 'is-invalid' : ''; ?>" name="decprice" placeholder="Enter Discount">
                        <samp class="invalid-feedback"><?php echo $decprice_err; ?></samp>
                    </div>
                    <div class="form-group">
                        <label for="title">Product Quantity</label>
                        <input type="number" class="form-control <?php echo (!empty($qty_err)) ? 'is-invalid' : ''; ?>" name="qty" placeholder="Enter Quantity">
                        <samp class="invalid-feedback"><?php echo $qty_err; ?></samp>
                    </div>

                    <div class="form-group">
                        <label>Select Product Catagory</label>
                        <select class="form-control" name="catagory">
                            <option value="<?php echo 0 ?>">Select Option</option>
                            <?php foreach ($catagorys as $catagory) : ?>
                                <option value="<?php echo $catagory['catagory_id'] ?>"><?php echo $catagory['catagory_title'] ?></option>
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