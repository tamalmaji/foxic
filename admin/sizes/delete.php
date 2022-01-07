<?php

$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: sizes.php');
}
require_once "../../config/_dbCon.php";
$sql = 'DELETE FROM foxic_sizes WHERE sizes_id  = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        header('location: sizes.php');
    }
}