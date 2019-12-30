<html>
	<head>
		<title>Vehicle Information</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			include('connection.php');
			include('topnav.php');
		?>

		<h2>Add new vehicle</h2>

		<script type="text/javascript">
			function enter_people_information(ID)
			{
				var table = document.getElementById('people_list');
				var rows = table.getElementsByTagName('tr');
				myForm = document.forms['myVehicle'];
				for ( var i = 1; i < rows.length; i++) {
					if (table.rows[i].cells[0].innerHTML == ID)
					{
						myForm.elements["O_Name"].value = table.rows[i].cells[1].innerHTML;
						myForm.elements["O_Address"].value = table.rows[i].cells[2].innerHTML;
						myForm.elements["O_Licence"].value = table.rows[i].cells[3].innerHTML;
					}
				};
			}
		</script>

		<form class="box2" action="" method="POST" id="myVehicle">
			Owner information:<br>
			<input type="text" id="search_text" name="search_text" placeholder="Check people existence by name or driving license number" style="width:80%"/>
			<button type="Submit" name="action" value="search_people" style="width:16%"/>Search</button><br>
			<input type="text" name="O_Name" placeholder="Owner name"/><br>
			<input type="text" name="O_Address" placeholder="Owner address"/><br>
			<input type="text" name="O_Licence" placeholder="Driving licence number"/><br>
			<br>
			Vehicle information:<br>
			<input type="text" name="V_LicenceNo" placeholder="Vehicle licence number"/><br>
			<input type="text" name="V_Type" placeholder="Vehicle make/model"/><br>
			<input type="text" name="V_Colour" placeholder="Vehicle colour"/><br>
			<button type="Submit" name="action" value="add_vehicle"/>Add vehicle</button>
		</form>


		<?php
		// Check connection
		if(mysqli_connect_errno())
		{
		   echo "Failed to connect to MySQL: ".mysqli_connect_error();
		   die();
		}
		else
		{
			// If button "Search" is pressed
			if ($_POST['action']=="search_people")
			{
				if ($_POST['search_text']!="")
				{
					// Query from table People based on the search text
					$sql = "SELECT * FROM People WHERE People_name LIKE '%".$_POST['search_text']."%' OR People_licence like '%".$_POST['search_text']."%'";
					$result = mysqli_query($conn, $sql);
					$num_rows = mysqli_num_rows($result);

					if ($num_rows == 0) // if the result is empty
					{
						echo "<p>Can not find this person</p>";
					}
					else
					{
						// Show number of results
						if ($num_rows == 1)
							echo "<div><h3>".$num_rows." result searching for '".$_POST['search_text']."'</h3>";
						else
							echo "<div><h3>".$num_rows." results searching for '".$_POST['search_text']."'</h3>";
						echo "<table id='people_list'>";  // start table
						echo "<tr><th>People ID</th><th>People name</th><th>People address</th><th>Driving licence number</th></tr>"; // table header

						// Draw table
						while($row = mysqli_fetch_assoc($result)) // loop through each row of the result
						{
							echo "<tr>";
							echo "<td>".$row["People_ID"]."</td>";
							echo "<td>".$row["People_name"]."</td>";
							echo "<td>".$row["People_address"]."</td>";
							echo "<td>".$row["People_licence"]."</td>";
							echo '<td><button type="Submit" style="padding:7px 15px" onclick=enter_people_information('.$row["People_ID"].')>Add</button></td>';
							echo "</tr>";
						}
						echo "</table></div>";
						echo "</table></div>";
					}
				}
			}

			// If button "Add vehicle" is pressed
			elseif ($_POST['V_LicenceNo']!="" && $_POST['V_LicenceNo']!="" && $_POST['V_Colour']!=""
					&& $_POST['O_Name']!="" && $_POST['O_Address']!="" && $_POST['O_Licence']!="")
			{
				// Insert into table Vehicle
				$sql = "INSERT INTO Vehicle(Vehicle_type,Vehicle_colour,Vehicle_licence) VALUES ('".$_POST['V_Type']."','".$_POST['V_Colour']."','".$_POST['V_LicenceNo']."')";
				$result = mysqli_query($conn, $sql);

				// Get Vehicle ID (auto_increment when adding a new one)
				$sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence='".$_POST['V_LicenceNo']."'";
				$result = mysqli_query($conn, $sql);
				$V_ID = mysqli_fetch_assoc($result)['Vehicle_ID'];

				// Check existence of people by combination of people name and licence
				$sql = "SELECT * FROM People WHERE People_name = '".$_POST['O_Name']."' AND People_licence = '".$_POST['O_Licence']."'";
				$result = mysqli_query($conn, $sql);
				$num_rows = mysqli_num_rows($result);
				if ($num_rows != 0)
				{
					// Get People ID
					$O_ID = mysqli_fetch_assoc($result)['People_ID'];
				}
				else
				{
					// If this person does not exist in the database, add to table People
					$sql = "INSERT INTO People(People_name,People_address,People_licence) VALUES ('".$_POST['O_Name']."','".$_POST['O_Address']."','".$_POST['O_Licence']."')";
					$result = mysqli_query($conn, $sql);
					// Get People ID
					$sql = "SELECT People_ID FROM People WHERE People_name = '".$_POST['O_Name']."' AND People_licence = '".$_POST['O_Licence']."'";
					$result = mysqli_query($conn, $sql);
					$O_ID = mysqli_fetch_assoc($result)['People_ID'];
				}

				// Insert to table Ownership
				$sql = "INSERT INTO Ownership VALUES ('".$O_ID."','".$V_ID."')";
				$result = mysqli_query($conn, $sql);

				// Notification
				echo "<script type='text/javascript'>alert('New vehicle added!');</script>";
			}

		mysqli_close($conn);
		}
		?>
	</body>
</html>
