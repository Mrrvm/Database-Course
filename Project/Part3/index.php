<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SIBD Project</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>SIBD Project</h1>
    <h2><a style='color:#484848;' href=' '><span style='color:#484848'>SIBD's Medical Center</span></a></h2>
    <ul>
      <li>
        <h3>Search Patient</h3>
        <form action="patient/look_for_patient.php" method="post">
          <p>Patient name: <input value="" type="text" name="patient_name" required/> <input value="Submit" type="submit" value="Submit"/></p>
        </form>
      </li>
      <li>
        <a href = "study/create_study.php"><h3>Create New Study</h3>
        </a>
      </li>
      <li>
        <a href = "/region/studies.php"><h3>Add New Region<h3>
        </a>
      </li>
    </ul>
<?php include 'footer.php';?>
</body>
</html>

