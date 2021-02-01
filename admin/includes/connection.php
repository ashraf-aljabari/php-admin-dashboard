<?php
// open connection
$conn = mysqli_connect("localhost", "root", "", "ecoma");
if (!$conn) {
    die('cannot connecto to server');
}

//$sql =     "CREATE TABLE IF NOT EXISTS category(
//            category_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//            category_name VARCHAR(100) NOT NULL,
//            category_image VARCHAR(255) NOT NULL );
//
//            CREATE TABLE IF NOT EXISTS product(
//            product_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//            product_name VARCHAR(100) NOT NULL,
//            product_image VARCHAR(255) NOT NULL );
//
//            CREATE TABLE IF NOT EXISTS category_product(
//            id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//            product_id int(10) NOT NULL,
//            category_id int(10) NOT NULL,
//            FOREIGN KEY (product_id) REFERENCES product(product_id),
//            FOREIGN KEY (category_id) REFERENCES category(category_id)
//            );";
//
//mysqli_select_db('ecoma');
//$retval = mysqli_query($conn, $sql);

