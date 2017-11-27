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
        exit(0);
    }

    $patient_name = $_POST['patient_name'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];

    $sql = "SELECT p_number FROM Patient
            ORDER BY p_number desc";

    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }

    foreach ($result as $row) {
        $p_number[0] = $row['p_number'];
        break;
    }
    $patient_number = $p_number[0] + 1;

    $stmt = $connection->prepare("INSERT INTO Patient VALUES(:p_number, :name, :birthday, :address)");
    $stmt->bindParam(':p_number', $patient_number);
    $stmt->bindParam(':name', $patient_name);
    $stmt->bindParam(':birthday', $birthdate);
    $stmt->bindParam(':address', $address);

    if($stmt->execute()){
        echo("<h3>New patient inserted in the database</h3>");
        echo "<ul>
                <li>Patient name: $patient_name</li>
                <br>
                <li>Patient number: $patient_number</li>
                <br>
                <li>Birthday: $birthdate</li>
                <br>
                <li>Address: $address</li>
              </ul>";
    }else {
        echo "<h2>ERROR: inserting new patient</h2>";
    }

    $connection = null;
?>
<?php include '../footer.php';?>
    </body>
</html>
