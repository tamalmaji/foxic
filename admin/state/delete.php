<?php
require_once "../../config/_dbCon.php";
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: state.php');
    exit;
}

$sql = 'DELETE FROM foxic_state WHERE state_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        header('location: state.php');
    }
}