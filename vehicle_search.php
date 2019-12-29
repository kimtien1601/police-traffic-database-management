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
	<h2>Vehicle Information</h2>

	<form class="box2" action="" method="POST" >
		<input type="text" name="search_text" placeholder="Search for vehicle licence plate"/>
		<input type="Submit" value = "Search"/>
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

		if ($_POST['search_text']!="")
		{
			$sql = "SELECT * FROM Vehicle, People, Ownership WHERE Vehicle.Vehicle_ID = Ownership.Vehicle_ID AND Ownership.People_ID = People.People_ID AND Vehicle_licence LIKE '%".$_POST['search_text']."%'";
			$result = mysqli_query($conn, $sql);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows == 0)
			{
				echo "<p>Can not find this person</p>";
			}
			else
			{
				if ($num_rows == 1)
					echo "<div><h3>".$num_rows." result searching for '".$_POST['search_text']."'</h3>";
				else
					echo "<div><h3>".$num_rows." results searching for '".$_POST['search_text']."'</h3>";
				echo "<table>";  // start table
			    echo "<tr><th>Vehicle licence</th><th>Vehicle type</th><th>Vehicle Colour</th><th>Owner's name</th><th>Owner's licence number</th></tr>"; // table header

			   // loop through each row of the result (each tuple will
			   // be contained in the associative array $row)
			    while($row = mysqli_fetch_assoc($result))
			    {
				 // output name and phone number as table row
					echo "<tr>";
					echo "<td>".$row["Vehicle_licence"]."</td>";
					echo "<td>".$row["Vehicle_type"]."</td>";
					echo "<td>".$row["Vehicle_colour"]."</td>";
					echo "<td>".$row["People_name"]."</td>";
					echo "<td>".$row["People_licence"]."</td>";


					echo "</tr>";
				}
			    echo "</table></div>";
			}
		}

	mysqli_close($conn);

	}
	?>
	</body>
</html>
