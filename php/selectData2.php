<?php

include_once('connection.php');

$data = array();

$query = "SELECT `id`,`name` FROM category ";

$result = mysqli_query($conn, $query);

if (!$result){
    $data[] = '';
    return;
}

while ($valeus = mysqli_fetch_assoc($result)) {
    $data[] = $valeus;
}

echo json_encode($data);

?>