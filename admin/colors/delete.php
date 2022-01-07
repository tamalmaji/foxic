<?php

$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: colors.php');
}
require_once "../../config/_dbCon.php";
$sql = 'DELETE FROM foxic_colors WHERE colors_id  = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        header('location: colors.php');
    }
}