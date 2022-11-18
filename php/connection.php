<?php

    $conn = mysqli_connect(
        '127.0.0.1:3306',
        'root',
        '',
        'bd_emisferios_barcode_products'
    );

    mysqli_set_charset($conn, "utf8mb4");

?>