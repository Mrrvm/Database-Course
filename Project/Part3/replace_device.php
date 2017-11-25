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

        $curr_snum = $_GET['snum'];
        $curr_manuf = $_GET['manuf'];
        $today = date("Y-m-d");

        echo "$curr_snum $curr_manuf $today</br>";

        $sql = "SELECT  distinct Device.serialnum, Device.manufacturer
                FROM    Device, Wears
                WHERE   Device.serialnum = Wears.snum
                        AND Device.serialnum <> $curr_snum
                        AND Device.manufacturer = Wears.manuf
                        AND Device.manufacturer = $curr_manuf
                        AND Wears.p_end < $today";

        $result = $connection->query($sql);
        $nrows = $result->rowCount();

        echo "nrows = $nrows</br>";

        if ($nrows == 0) {
            echo "<h2>No devices available for replacement</h2>";
        }else {
            echo("<h2>Devices:\n\n</h2>");
            echo("<ul>");
            foreach ($result as $row) {
                $snum = $row['serialnum'];
                $manuf = $row['manufacturer'];
                echo "<li>$snum &nbsp &nbsp $manuf &nbsp &nbsp ";
            }
            echo("</ul>");
        }

        $connection = null;

        echo("</br><h3><a href='index.html'>Home page</a></h3>");
?>
   </body>
</html>
