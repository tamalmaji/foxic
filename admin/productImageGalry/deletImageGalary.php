<?php
require_once "../../config/_dbCon.php";
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header("location:../product/product.php");
}

$sqll = 'SELECT * FROM foxic_imggallery WHERE product_id = :id';
if ($stmt = $pdo->prepare($sqll)) {
    $stmt->bindValue(':id', $id);
    if ($stmt->execute()) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product['imgGallery_title']) {
           unlink('../../public/' . $product['imgGallery_title']);
        }
        $sqli = 'DELETE FROM foxic_imggallery WHERE imgGallery_id  = :id';
        if ($statement = $pdo->prepare($sqli)) {
            $statement->bindValue(':id', $product['imgGallery_id']);
            if ($statement->execute()) {
                header('location: ../product/product.php');
            }
        }
    }
}

