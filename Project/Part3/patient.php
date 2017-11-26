<html>
    <body>
<?php

        $host = "db.ist.utl.pt";
        $user = "ist178755";
        $pass = "jagx2469";
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

        $sql = "SELECT      Wears.p_start, Wears.p_end, Wears.snum, Wears.manuf
                FROM        Wears, Device
                WHERE       Wears.snum = Device.serialnum
                            AND Wears.manuf = Device.manufacturer
                            AND Wears.patient = $patient
                ORDER BY    Wears.p_end desc";

        $result = $connection->query($sql);
        $nrows = $result->rowCount();

        if ($nrows == 0) {
            echo "<h2>No devices</h2>";
        }else {
            echo "<h2>Devices used or in use by the patient:</h2>";
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
                    &patient=$patient&start=$start'>REPLACE</a></li></br>");
                }else{
                    echo "<li>$snum &nbsp &nbsp $manuf</li></br>";
                }
            }
            echo "</ul>";
        }

        $connection = null;

        echo("</br><h3><a href='index.html'>Home page</a></h3>");
?>
    </body>
</html>
