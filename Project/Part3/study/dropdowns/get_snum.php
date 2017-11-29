<?php include '../../database/db.php';?>
<?php
    $manufacturer = $_POST["manufacturer"];

    $sql = "SELECT distinct serialnum FROM Device 
            WHERE manufacturer='$manufacturer' 
            ORDER BY serialnum";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        exit(0);
    }
    echo("<option></option>");
    foreach($result as $row) {
        $serial_number = $row['serialnum'];
        echo("<option value=\"$serial_number\">$serial_number</option>");
    }

?>