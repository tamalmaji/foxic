<?php
require_once "../../config/_dbconnection.php";

$sql = 'SELECT * FROM broccoli_catagory ORDER BY catagory_id  DESC';
$statement  = $pdo->prepare($sql);
$statement->execute();
$catagory = $statement ->rowCount();

$sqli = 'SELECT * FROM broccoli_usertype ORDER BY userType_id DESC';
$statements  = $pdo->prepare($sqli);
$statements->execute();
$userType = $statements ->rowCount();

$sqlii = 'SELECT * FROM broccoli_product ORDER BY product_id DESC';
$statementss  = $pdo->prepare($sqlii);
$statementss->execute();
$product = $statementss ->rowCount();


$sqliii = 'SELECT * FROM broccoli_users ORDER BY user_id DESC';
$statementsss  = $pdo->prepare($sqliii);
$statementsss->execute();
$user = $statementsss ->rowCount();