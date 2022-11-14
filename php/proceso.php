<?php

  session_start();
  $_SESSION['dataProductsNames']  = $_POST["dataProductsNames"];
  $_SESSION['dataProductsPrices'] = $_POST["dataProductsPrices"];
  $_SESSION['dataProductsCodes'] = $_POST["dataProductsCodes"];

?>