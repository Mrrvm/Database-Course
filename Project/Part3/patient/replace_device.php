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

        $patient = $_GET['patient'];
        $start = $_GET['start'];
        $curr_snum = $_GET['snum'];
        $curr_manuf = $_GET['manuf'];
        $today = date("Y-m-d");

        $sql = "SELECT distinct Device.serialnum, Device.manufacturer
                FROM Device, Wears
                WHERE Wears.snum = Device.serialnum
                    AND Wears.manuf = Device.manufacturer
                    AND Device.serialnum != '$curr_snum'
                    AND Device.manufacturer = '$curr_manuf'
                    AND Wears.p_end > $today";

        $result = $connection->query($sql);
        if ($result == FALSE) {
            $info = $connection->errorInfo();
            echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
            exit(0);
        }
        $nrows = $result->rowCount();

        if ($nrows == 0) {
            echo "<h3>No devices available for replacement</h3>";
        }else {
            echo("<h3>Possible replacement devices:</h3>");
            echo("<ul>");
            foreach ($result as $row) {
                $snum = $row['serialnum'];
                $manuf = $row['manufacturer'];
                echo("<li><a href='update_device.php?new_snum=$snum
                &manuf=$manuf&patient=$patient&start=$start'>$snum</a>");
                echo "&nbsp &nbsp $manuf</li></br>";
            }
            echo("</ul>");
        }

        $connection = null;       
?>
   </body>
<?php include '../footer.php';?>
</html>
