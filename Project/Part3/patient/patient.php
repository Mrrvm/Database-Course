<html>
    <head>
        <meta charset="utf-8">
        <title>SIBD Project</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
<?php include '../header.php';?>
<?php

    $host = "db.ist.utl.pt";
    $user = "ist180856";
    $pass = "tkeh0706";
    $dsn = "mysql:host=$host; dbname=$user";

    try {
        $connection = new PDO($dsn, $user, $pass);
    } catch (PDOException $exception) {
        echo("<p>Error: ");
        echo($exception->getMessage());
        echo("</p>");
        exit();
    }

    $patient = $_GET['number'];

    $sql = "SELECT Wears.p_start, Wears.p_end, Wears.snum, Wears.manuf
            FROM Wears, Device
            WHERE Wears.snum = Device.serialnum
                AND Wears.manuf = Device.manufacturer
                AND Wears.patient = $patient
            ORDER BY    Wears.p_end desc";

    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }

    $nrows = $result->rowCount();
    if ($nrows == 0) {
        echo "<h3>No devices</h3>";
    }
    else {
        echo "<h3>Devices used or in use by the patient:</h3>";
        echo "<ul>";
        $today = date("Y-m-d");
        foreach ($result as $row) {
            $start = $row['p_start'];
            $end = $row['p_end'];
            $snum = $row['snum'];
            $manuf = $row['manuf'];
            if($today < $end){
                echo "<li><mark>$snum &nbsp &nbsp $manuf</mark> &nbsp &nbsp ";
                echo("<a href='replace_device.php?snum=$snum&manuf=$manuf
                &patient=$patient&start=$start'><button>REPLACE</button></a></li></br>");
            }
            else{
                echo "<li>$snum &nbsp &nbsp $manuf</li></br>";
            }
        }
        echo "</ul>";
    }

    $connection = null;
?>
    </body>
<?php include '../footer.php';?>
</html>
