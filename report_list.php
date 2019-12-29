<html>
	<head>
		<title>Report Information</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>		
		<?php
			include('connection.php');
			include('topnav.php');
		?>
		
		<h2>List of all reports</h2>

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
				$sql = "SELECT * FROM Incident, Vehicle, People, Offence WHERE Vehicle.Vehicle_ID = Incident.Vehicle_ID AND Incident.People_ID = People.People_ID AND Offence.Offence_ID = Incident.Offence_ID";
				$result = mysqli_query($conn, $sql);
				$num_rows = mysqli_num_rows($result);
				
				if ($num_rows == 0) // if the result is empty
				{
					echo "<p>There is no report in the database.</p>";
				}
				else
				{
					// Draw table
					echo "<table>";  // start table
					echo "<tr><th>Date</th><th>Offence</th><th>Textual statement</th>
						<th>Vehicle licence number</th><th>Vehicle type</th><th>Vehicle colour</th>
						<th>Owner name</th><th>Owner address</th><th>Driving licence number</th></tr>"; // table header
					while($row = mysqli_fetch_assoc($result)) // loop through each row of the result 
					{
						echo "<tr>";
						echo "<td>".$row["Incident_Date"]."</td>";
						echo "<td>".$row["Offence_description"]."</td>";
						echo "<td>".$row["Incident_Report"]."</td>";
						echo "<td>".$row["Vehicle_licence"]."</td>";
						echo "<td>".$row["Vehicle_type"]."</td>";
						echo "<td>".$row["Vehicle_colour"]."</td>";				
						echo "<td>".$row["People_name"]."</td>";
						echo "<td>".$row["People_address"]."</td>";
						echo "<td>".$row["People_licence"]."</td>";
						echo '<td><a type="button" class="button" href="report_edit.php?id='.$row['Incident_ID'].'">Edit</a></td>';
						echo "</tr>";
					}
					echo "</table>";
				}
			mysqli_close($conn);
			}
		?>
	</body>
</html>
