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
$sizeId = $product['sizes_id'];

$sqli = 'SELECT * FROM foxic_catagory WHERE catagory_id = :id';
if ($stat = $pdo->prepare($sqli)) {
    $stat->bindValue(':id', $catId);
    if ($stat->execute()) {
        $cat = $stat->fetch(PDO::FETCH_ASSOC);
    }
}
$sq = 'SELECT * FROM foxic_imggallery WHERE product_id = :id';
if ($stmt = $pdo->prepare($sq)) {
    $stmt->bindValue(':id', $id);
    if ($stmt->execute()) {
        $gallerys = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
$s = 'SELECT * FROM foxic_colors WHERE colors_id = :id';
if ($stats = $pdo->prepare($s)) {
    $stats->bindValue(':id', $colId);
    if ($stats->execute()) {
        $cols = $stats->fetch(PDO::FETCH_ASSOC);
    }
}
$q = 'SELECT * FROM foxic_sizes WHERE sizes_id = :id';
if ($statm = $pdo->prepare($q)) {
    $statm->bindValue(':id', $sizeId);
    if ($statm->execute()) {
        $sizev = $statm->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<?php include_once "../partials/header.php" ?>
<div class="content-wrapper" style="min-height: 485.139px;">
    <div class="container m-5">
        <div class="row">
            <div class="col-12">
                <h3>Product Details</h3>
            </div>
            <!-- <div class="col-12"> -->

            <!-- </div> -->
        </div>
    </div>
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none"><?php echo $product['product_title'] ?></h3>
                        <div class="col-12">
                            <img src="../../public/<?php echo $product['product_img'] ?>" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 mt-3">
                            <h3>Image Gallery</h3>
                            <a href="./addImageGalary.php?id=<?php echo $product['product_id'] ?>" class="btn btn-info btn-xs">Add</a>
                            <form action="deletAll.php" method="POST" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?php echo $product['product_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-xs">Delete All</button>
                            </form>
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <?php foreach ($gallerys as $i => $gallery) : ?>
                                <div class="">
                                    <div class="product-image-thumb">
                                        <img src="../../public/<?php echo $gallery['imgGallery_title'] ?>" alt="Product Image" style="height: 100px;">
                                    </div>
                                    <div class="mt-2">
                                        <form action="deletImageGalary.php" method="POST" class="mt-2">
                                            <input type="hidden" name="id" value="<?php echo $gallery['product_id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3"><?php echo $product['product_title'] ?></h3>
                        <p><?php echo $product['product_desc'] ?></p>
                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                ₹ <?php echo $product['product_price'] ?>
                            </h2>
                            <h4 class="mt-0">
                                <small>₹ <?php echo $product['product_discount'] ?></small>
                            </h4>
                        </div>
                        <hr>
                        <h4>Available Colors</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                    <?php echo $cols['colors_title'] ?>
                                <br>
                                <!-- <i class="fas fa-circle fa-2x text-green"></i> -->
                            </label>
                        </div>

                        <h4 class="mt-3">Size <small>Please select one</small></h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                <span class="text-xl"><?php echo $sizev['sizes_title'] ?></span>
                                <br>
                                <?php echo $sizev['sizes_titleSize'] ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>
<?php include_once "../partials/footer.php" ?>