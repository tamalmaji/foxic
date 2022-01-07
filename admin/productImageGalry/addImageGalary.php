<?php
require_once "../../config/_dbCon.php";
$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: ../product/product.php');
    exit;
}
$sql = 'SELECT * FROM foxic_product WHERE product_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $product = $statement->fetch(PDO::FETCH_ASSOC);
    }
}
$productId = $product['product_id'];
$title = '';
$date = date('Y-m-d H:i:s');
$title_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);
    $title = trim($_POST['title']);

    if (!is_dir('../../public/images/productGallery')) {
        mkdir('../../public/images/productGallery');
    }

    if (empty($title)) {
        $title_err = 'Enter You Image Title';
    }

    if (empty($title_err)) {
        $valid_extensions = array('jpeg', 'jpg', 'png');
        foreach ($_FILES['image']['tmp_name'] as $i => $value) {
            $image = $_FILES['image']['name'][$i];
            // $imageSize = $_FILES['image']['size'][$i];
            $temp_dir = $_FILES['image']['tmp_name'][$i];

            $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if (in_array($imgExt, $valid_extensions)) {
                // if ($imageSize < 5000000) {
                // if ($productRel['images']) {
                //     unlink('../../public/' . $productRel['images']);
                // }
                $picProfile = rand(1000, 1000000) . '.' . $imgExt;
                $upload_dir = 'images/productGallery/' . $picProfile;
                $upload_File_dir = '../../public/images/productGallery/' . $picProfile;
                move_uploaded_file($temp_dir, $upload_File_dir);
                $sql = 'INSERT INTO foxic_imggallery (imgGallery_title, imgGallery_alt, product_id, create_at, update_at) 
                VALUE(:imgGallery_title, :imgGallery_alt, :product_id, :create_at, :update_at)';
                if ($statement = $pdo->prepare($sql)) {
                    $statement->bindValue(':imgGallery_title', $upload_dir);
                    $statement->bindValue(':imgGallery_alt', $title);
                    $statement->bindValue(':product_id', $id);
                    $statement->bindValue(':create_at', $date);
                    $statement->bindValue(':update_at', $date);
                    if ($statement->execute()) {
                        header('location:  ../product/product.php');
                    }
                }
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
                <?php include_once "_form.php" ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "../partials/footer.php" ?>