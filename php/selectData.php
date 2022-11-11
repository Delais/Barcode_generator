<?php

include_once('connection.php');

$category = $_POST['idCayegory'];

$data = array();

$query = "SELECT subCat.id, subCat.name FROM sub_category subCat JOIN category cat ON cat.id = subCat.id_category WHERE cat.id = '$category' ";

$result = mysqli_query($conn, $query);

while ($values = mysqli_fetch_assoc($result)) {
    
    $data[] = $values;

}


echo json_encode($data);