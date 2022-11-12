<?php

include_once('connection.php');

$query = "SELECT `id`,`name`,`price`,`description`,`code` FROM `products`";

$result = mysqli_query($conn, $query);
$data = array();
if (!$result){
        $data[] = '';
        return;
    }
    

while ($values = mysqli_fetch_assoc($result)) {
    
        $data[] = $values;
   
}


echo json_encode($data);
?>