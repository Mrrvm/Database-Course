<html>
    <head>
        <meta charset="utf-8">
        <title>SIBD Project</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
<?php include 'header.php';?>
<?php include 'footer.php';?>
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

    $request_number = $_POST['request_number'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $doctor_id = $_POST['doctor_id'];
    $manufacturer = $_POST['manufacturer'];
    $serial_number = $_POST['serial_number'];
    $series_id = $_POST['series_id'];
    $serie_name = $_POST['series_name'];
    $series_description = $_POST['series_description'];
    $url = "https://web.ist.utl.pt/".$user."/series/".$series_id;

    /* If series already exists */
    $sql = "SELECT series_id FROM Series WHERE series_id=$series_id;";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    $nrows = $result->rowCount();
    if($nrows > 0) {
        echo("<p> A new study was NOT created! ERROR: series already exists.</p>");
        echo("<a href='create_study.php'>Go back</a>");
        exit(0);
    }
    
    /* If study date is invalid */
    $sql = "SELECT r_date FROM Request WHERE r_number=$request_number;";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    $r_date = $result->fetchColumn(0);
    if($date < $r_date) {
        echo("<p> A new study was NOT created! ERROR: date is invalid.</p>");
        echo("<a href='create_study.php'>Go back</a>");
        exit(0);
    }

    /* If doctor is invalid (can also be done w/ existant function?)*/
    $sql = "SELECT doctor_id FROM Request WHERE r_number=$request_number;";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    $r_doctor = $result->fetchColumn(0);
    if($r_doctor == $doctor_id) {
        echo("<p> A new study was NOT created! ERROR: doctor is invalid.</p>");
        echo("<a href='create_study.php'>Go back</a>");
        exit(0);
    }

    /* If device doesn't exist */
    $sql = "SELECT serialnum FROM Device WHERE serialnum='$serial_number' AND manufacturer='$manufacturer';";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    $nrows = $result->rowCount();
    if($nrows == 0) {
        echo("<p> A new study was NOT created! ERROR: device is invalid.</p>");
        echo("<a href='create_study.php'>Go back</a>");
        exit(0);
    }

    /* Try insert in database (to avoid SQL Injetion)*/
    /* Just in try??*/
    try {
        $insert_study = "INSERT INTO Study values (:request_number, :description, :s_date, :doctor_id, :serial_number, :manufacturer);";
        $result_study = $connection->prepare($insert_study);
        $insert_series = "INSERT INTO Series values (:series_id, :name, :base_url, :request_number, :description);";
        $result_series = $connection->prepare($insert_series);

        $connection->beginTransaction();

        $result_study->bindParam(':request_number',$request_number);
        $result_study->bindParam(':description',$description);
        $result_study->bindParam(':s_date',$date);
        $result_study->bindParam(':doctor_id',$doctor_id);
        $result_study->bindParam(':serial_number',$serial_number);
        $result_study->bindParam(':manufacturer',$manufacturer);
        $result_study->execute();

        $result_series->bindParam(':series_id',$series_id);
        $result_series->bindParam(':name', $name);
        $result_series->bindParam(':base_url',$url);
        $result_series->bindParam(':request_number',$request_number);
        $result_series->bindParam(':description',$description); 
        $result_series->execute();

        $connection->commit();
    }
    catch(PDOException $err) {
        $connection->rollBack();
        echo("<p> A new study was NOT created! ERROR: $err.</p>");
        echo("<a href='create_study.php'>Go back</a>");
        exit(0);
    }       

    $connection = null;
?>
    </body>
</html>
