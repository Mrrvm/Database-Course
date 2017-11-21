<html>
    <body>
<?php
        function validateDate($date) {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            return $d && $d->format('Y-m-d') == $date;
        }

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

        $request_number = $_REQUEST['request_number'];
        $description = $_REQUEST['description'];
        $day = $_REQUEST['day'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $date = $year.'-'.$month.'-'.$day;
        $doctor_id = $_REQUEST['doctor_id'];
        $manufacturer = $_REQUEST['manufacturer'];
        $serial_number = $_REQUEST['serial_number'];
        $series_id = $_REQUEST['series_id'];
        $serie_name = $_REQUEST['series_name'];
        $series_description = $_REQUEST['series_description'];

        /* If study already exists */
        $sql = "SELECT request_number FROM Study WHERE request_number=$request_number";
        $result = $connection->query($sql);
        if($result->num_rows > 0)
            echo("study not created. ERROR: study already exists.");

        /* If series already exists */
        $sql = "SELECT series_id FROM Study WHERE series_id=$series_id";
        $result = $connection->query($sql);
        if($result->num_rows > 0) 
            echo("study not created. ERROR: series already exists.");

        /* If study date is invalid */
        if(validateDate($date) == false) {
            echo("study not created. ERROR: date is invalid.")
        }

        /* If doctor doesn't exist */
        $sql = "SELECT doctor_id FROM Doctor WHERE doctor_id=$doctor_id";
        $result = $connection->query($sql);
        if($result->num_rows == 0) 
            echo("study not created. ERROR: doctor doesn't exists.");

        /* If device doesn't exist */
        $sql = "SELECT serial_number FROM Device WHERE serial_number=$serial_number AND manufacturer=$manufacturer";
        $result = $connection->query($sql);
        if($result->num_rows == 0) 
            echo("study not created. ERROR: device doesn't exists.");


        $connection = null;
 ?>
    </body>
</html>
