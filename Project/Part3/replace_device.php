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

        $patient = $_GET['patient'];
        $start = $_GET['start'];
        $curr_snum = $_GET['snum'];
        $curr_manuf = $_GET['manuf'];
        $today = date("Y-m-d");

        $sql = "SELECT  distinct Device.serialnum, Device.manufacturer
                FROM    Device, Wears
                WHERE   Wears.snum = Device.serialnum
                        AND Wears.manuf = Device.manufacturer
                        AND Device.serialnum != '$curr_snum'
                        AND Device.manufacturer = '$curr_manuf'
                        AND Wears.p_end > $today";

        $result = $connection->query($sql);
        $nrows = $result->rowCount();

        if ($nrows == 0) {
            echo "<h2>No devices available for replacement</h2>";
        }else {
            echo("<h2>Possible replacement devices:\n\n</h2>");
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

        echo("</br><h3><a href='index.html'>Home page</a></h3>");
?>
   </body>
</html>
