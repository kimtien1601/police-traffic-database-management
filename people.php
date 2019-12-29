<html>
	<head>
		<title>People Information</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			include('connection.php');
			include('topnav.php');
		?>
		<h2>Search for people</h2>
		<form class="box2" action="" method="POST" >
			<input type="text" name="search_text" placeholder="Search for name or driving license number" style="width:80%"/>
			<input type="Submit" value = "Search" style="width:16%"/>
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
						
						// Draw table
						echo "<table>";  
						echo "<tr><th>People ID</th><th>People name</th><th>People address</th><th>Driving licence number</th></tr>"; // table header
						while($row = mysqli_fetch_assoc($result)) // loop through each row of the result 
						{
							echo "<tr>";
							echo "<td>".$row["People_ID"]."</td>";
							echo "<td>".$row["People_name"]."</td>";
							echo "<td>".$row["People_address"]."</td>";
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
