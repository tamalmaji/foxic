<?php
require_once "../../config/_dbCon.php";
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: userType.php');
}

$sql = 'DELETE FROM foxic_usertype WHERE userType_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        header('location: userType.php');
    }
}