<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SIBD Project</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include 'header.php';?>
    <ul>
      <li>
        <h3>Search Patient</h3>
        <form action="look_for_patient.php" method="post">
          <p>Patient name: <input value="" type="text" name="patient_name" required/> <input value="Submit" type="submit" value="Submit"/></p>
        </form>
      </li>
      <li>
        <a href = "create_study.php"><h3>Create New Study</h3>
        </a>
      </li>
      <li>
        <a href = ""><h3>Add New Region<h3>
        </a>
      </li>
    </ul>
    <?php include 'footer.php';?>
</body>
</html>

