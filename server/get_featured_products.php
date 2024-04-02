<?php

include('./connection.php');
$stmt = $conn->prepare("SELECT * from products");
$stmt->execute();
$featured_products = $stmt->get_result();
// echo "<pre>";
// var_dump($featured_products);
// echo "</pre>";
?>