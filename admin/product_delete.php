<?php
require('includes/connection.php');

$query = "delete from product where product_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:manage_products.php");

?>