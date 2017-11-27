<html>
    <head>
        <meta charset="utf-8">
        <title>SIBD Project</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
<?php include '../header.php';?>
    <div id="insert_patient">
        <form action="insert_patient.php" method = "post">
            <h3>Insert a new patient:</h3>
            <span class="error">* required field</span>
            <p>Patient name: <input type="text" name="patient_name" required/>
                <span class="error">* </span>
            </p>
            <p>Birth date: <input type = "date" name="birthdate" required/>
                <span class="error">* </span>
            </p>
            <p>Address: <input type="text" name="address" required/>
                <span class="error">* </span>
            </p>
            <p><input type="submit" value="Submit"/></p>
        </form>
    </div>
    <script>
        $('#insert_patient').hide();
        function show_insert_patient() {
           $('#insert_patient').show();
           $('#listed').hide();  
        }
    </script>
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

        $patient_name = $_REQUEST['patient_name'];
        $sql = "SELECT  name, p_number
                FROM    Patient
                WHERE   name like '%$patient_name%'";
        $result = $connection->query($sql);
        $nrows = $result->rowCount();

        if($nrows == 0){
            echo("<script>$('#insert_patient').show()</script>
                  <h3 style='color:red'>There is no patient named $patient_name</h3> 
                ");
        } 
        else {
            echo("<div id='listed'>");
            echo("<h3>Patients with '$patient_name':</h3>");
            echo("<ul>");
            foreach ($result as $row) {
                $p_name = $row['name'];
                $p_number = $row['p_number'];
                echo("<li><h3><a href='patient.php?number=$p_number'>$p_name</a></h3></li>");
            }
            echo("</ul>");
            echo("<button type='button' onclick='show_insert_patient()'>Not listed? Insert new patient</button>");
            echo("</div>");
        }
        $connection = null;
?>
<?php include '../footer.php';?>
    </body>
</html>
