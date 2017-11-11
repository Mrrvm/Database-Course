<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist180856";	// <== replace istxxx by your IST identity
	$password="tkeh0706";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 	$tables = array("Patient", "Doctor", "Device", "Sensor", "Reading", "Period",
		"Wears", "Request", "Study", "Series", "Element", "Region");
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

	foreach($tables as $table) {

		$sql = "SELECT * FROM $table;";
		echo("\n<p>Query: " . $sql . "</p>\n");

		$result = $connection->query($sql);
		
		$columns = NULL;
		for ($i = 0; $i < $result->columnCount(); $i++) {
		    $col = $result->getColumnMeta($i);
		    $columns[] = $col['name'];
		}

		foreach($columns as $column) {
			print $column;
			$nspaces = 20 - strlen($column);
			$j = 0;
			while ($j < $nspaces) {
				print " ";
				$j++;
			}
		}

		
		print "\n";

		foreach ($result as $row) {
			foreach($columns as $column) {
	        	print $row[$column];
				$nspaces = 20 - strlen($row[$column]);
				$j = 0;
				while ($j < $nspaces) {
					print " ";
					$j++;
				}
			}
			print "\n";
    	}

    	print "\n\n";
		//print_r($columns);
	}
		
    $connection = null;
	
	echo("<p>Connection closed.</p>\n");
?>


	
