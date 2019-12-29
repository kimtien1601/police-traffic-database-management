<html>
	<head>
		<title>Fines Information</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>		
		<?php
			include('connection.php');
			include('topnav.php');
		?>
		
		<h2>List of all fines</h2>

		<?php
			// Check connection
			if(mysqli_connect_errno())
			{
			   echo "Failed to connect to MySQL: ".mysqli_connect_error();
			   die();
			}
			else
			{
				// Query all Fines information
				$sql = "SELECT Incident.Incident_ID,Incident_Date,Incident_Report,Fine_Amount,Fine_Points FROM Incident LEFT OUTER JOIN Fines ON Incident.Incident_ID=Fines.Incident_ID";
				$result = mysqli_query($conn, $sql);
				$num_rows = mysqli_num_rows($result);
				
				if ($num_rows == 0) // if the result is empty
				{
					echo "<p>There is no report or fines in the database.</p>";
				}
				else
				{
					
					// Draw table
					echo "<table>";  // start table
					echo "<tr><th>Date</th><th>Textual statement</th>
						<th>Fine amount</th><th>Fine points</th></tr>"; // table header
					while($row = mysqli_fetch_assoc($result)) // loop through each row of the result 
					{
						echo "<tr>";
						echo "<td>".$row["Incident_Date"]."</td>";
						echo "<td>".$row["Incident_Report"]."</td>";
						echo '<form class="box3" action="fines_update.php" method="GET">';
						echo '<input type="hidden" name="incidentID" value='.$row['Incident_ID'].'>';
						echo "<td><input type='text' name='amount' style='width:100px' value='".$row["Fine_Amount"]."'/></td>";
						echo "<td><input type='text' name='points' style='width:100px' value='".$row["Fine_Points"]."'/></td>";
						echo '<td><button type="Submit" name="action" value="save"/>Save changes</button>';
						echo '</form>';
						echo "</tr>";
					}
					echo "</table>";
				}
			mysqli_close($conn);
			}
		?>
	</body>
</html>
