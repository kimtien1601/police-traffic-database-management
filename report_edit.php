<html>
	<head>
		<title>Report Update</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

		<?php
			include('connection.php');
			include('topnav.php'); 
		?>

		<h2>Edit report</h2>
			
		<?php
			// Check connection
			if(mysqli_connect_errno())
			{
			   echo "Failed to connect to MySQL: ".mysqli_connect_error();
			   die();
			}
			else
			{
				// Query all Incident information
				$sql = "SELECT * FROM Incident, Vehicle, People, Offence WHERE Incident_ID =".$_GET['id']." AND Vehicle.Vehicle_ID = Incident.Vehicle_ID AND Incident.People_ID = People.People_ID AND Offence.Offence_ID = Incident.Offence_ID";
				$result = mysqli_query($conn, $sql);
				$num_rows = mysqli_num_rows($result);		
				
				if ($num_rows == 0) // if the result is empty
				{
					echo "<p>There is no report in the database.</p>";
				}
				else
				{  
					// Draw form
					echo '<form class="box2" action="report_update.php" method="GET">';
					$row = mysqli_fetch_assoc($result);
					echo  '<input type="hidden" name="incidentID" value='.$_GET['id'].'>';
					echo 'Incident date:<br><input type="text" name="date" value="'.$row['Incident_Date'].'" required/><br>';
					
					// Add dropdown list for offence (query from table offence)
					echo 'Offence:<br><select name="offence">';
					$sql1 = "SELECT * FROM Offence";
					$result1 = mysqli_query($conn, $sql1);
					while ($row1 = mysqli_fetch_array($result1)) 
					{
						if ($row1['Offence_description'] == $row["Offence_description"])
							echo '<option selected>'.$row1['Offence_description'].'</option>';
						else
							echo '<option>'.$row1['Offence_description'].'</option>';
					}
					echo '</select><br>';
					
					echo 'Textual statement:<br><input type="text" name="report" value="'.$row['Incident_Report'].'" required/><br>';
					echo 'Vehicle licence number:<br><input type="text" name="V_LicenceNo" value="'.$row['Vehicle_licence'].'" required/><br>';
					echo 'Vehicle type:<br><input type="text" name="V_Type" value="'.$row['Vehicle_type'].'" required/><br>';
					echo 'Vehicle colour:<br><input type="text" name="V_Colour" value="'.$row['Vehicle_colour'].'" required/><br>';
					echo 'Owner name:<br><input type="text" name="O_Name" value="'.$row['People_name'].'" required/><br>';
					echo 'Owner address:<br><input type="text" name="O_Address" value="'.$row['People_address'].'" required/><br>';
					echo 'Driving licence number:<br><input type="text" name="O_Licence" value="'.$row['People_licence'].'" required/><br>';	
					echo '<button type="Submit" name="action" value="save"/>Save changes</button>';			
					echo '</form>';
				}
			}
		?>
    </body>
</html>
	