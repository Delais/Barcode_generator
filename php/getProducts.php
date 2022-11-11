<?php

include_once('connection.php');

$query = "SELECT `name`,`price`,`description`,`code` FROM `products`";

$result = mysqli_query($conn, $query);

while ($values = mysqli_fetch_assoc($result)) {
    
        $data[] = $values;
   
}


echo json_encode($data);
?>