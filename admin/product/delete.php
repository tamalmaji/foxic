<?php
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: product.php');
    exit;
}

require_once "../../config/_dbCon.php";

$sql = 'SELECT * FROM foxic_product WHERE product_id = :id';
if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindValue(':id', $id);
    if ($stmt->execute()) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product['product_img']) {
            unlink('../../public/' . $product['product_img']);
         }
        $sqli = 'DELETE FROM foxic_product WHERE product_id = :id';
        if ($statement = $pdo->prepare($sqli)) {
            $statement->bindValue(':id', $id);
            if ($statement->execute()) {
                header('location: product.php');
            }
        }
    }
}