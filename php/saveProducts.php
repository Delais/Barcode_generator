<?php

include_once('connection.php');

/* Leemos los datos que ,amda la peticion */

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$idSub_category = $_POST['idSub_category'];
$code = $_POST['code'];

$query = "INSERT INTO products(name,price, description, code, idSub_category) VALUES ('$name','$price','$description', '$code', '$idSub_category')";

$result = mysqli_query($conn, $query);

if (!$result){
    die("failed");
}

?>