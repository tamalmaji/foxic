<?php

$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: catagory.php');
}
require_once "../../config/_dbCon.php";
$sql = 'DELETE FROM foxic_catagory WHERE catagory_id  = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        header('location: catagory.php');
    }
}