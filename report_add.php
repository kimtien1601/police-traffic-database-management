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
		<h2>Add new report</h2>

		<form class="box2" action="report_add.php" method="POST" id="myVehicle" onsubmit="check_vehicle()">
			<input type="text" name="date" placeholder="Incident date" required/><br>
			<div class="custom">
			<select name="offence">
				<option selected disabled>Select offence</option>
				<?php

				$sqli = "SELECT * FROM Offence";
				$result = mysqli_query($conn, $sqli);
				while ($row = mysqli_fetch_array($result))
					echo '<option>'.$row['Offence_description'].'</option>';
				?>
			</select>
			</div>
			<input type="text" name="report" placeholder="Textual statement" required/><br>
			<div id="vehicle">
			<input type="text" name="V_LicenceNo" placeholder="Vehicle's licence number" required/><br>
			</div>
			<div id="people">
			<!-- <input type="text" name="O_Name" placeholder="Owner's name" required/><br>
			<input type="text" name="O_Licence" placeholder="Driving licence number" required/><br>	 -->
			</div>
			<button type="Submit" name="action" value="check_existence" href="testsplit.php?action=edit & id='.$row['level_id']."/>Check vehicle and people existence</button>
			<button type="Submit" name="action" value="add_report"/>Add report</button>
		</form>

		<script>
			function check_vehicle()
			{
				window.location = "testsplit.php";
				// var st= document.getElementsByTagName('input')[0].value;
				// var result = "<?php find_vehicle_php('"+String(st)+"');?>";
				// alert(result);
				// if ((result))
				// {
				// 	alert("This vehicle already exists");
				// }
				// else
				// {
				// 	alert("This vehicle doesn't exist in the database. Please input its details");
				// 	var x = document.getElementById("vehicle");
				// 	var line = document.createElement('hr'); // Giving Horizontal Row
				// 	x.appendChild(line);

				// 	// var inputelement = document.createElement('input');
				// 	// inputelement.setAttribute("type", "text");
				// 	// inputelement.setAttribute("name", "V_Type");
				// 	// inputelement.setAttribute("placeholder", "Vehicle type");

				// 	// x.appendChild(inputelement);
				// }
				// return false;
			}

			function add_people(ID)
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


		<?php
		// Check connection
		if(mysqli_connect_errno())
		{
		   echo "Failed to connect to MySQL: ".mysqli_connect_error();
		   die();
		}
		else
		{
			if ($_POST['action']=="add_report")
			{			/*
				// Check vehicle existence
				$sql = "SELECT * FROM Vehicle WHERE Vehicle_licence LIKE '%".$_POST['V_LicenceNo']."%'";
				$result = mysqli_query($conn, $sql);
				$num_rows = mysqli_num_rows($result);
				echo "<p>".$num_rows."</p>";
				// Insert into table Vehicle
				$sql = "INSERT INTO Vehicle(Vehicle_type,Vehicle_colour,Vehicle_licence) VALUES ('".$_POST['V_Type']."','".$_POST['V_Colour']."','".$_POST['V_LicenceNo']."')";
				$result = mysqli_query($conn, $sql);
				// Get Vehicle ID
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
				echo "<script type='text/javascript'>alert('New vehicle added!');</script>";*/
			}
			else
			{

			}

		mysqli_close($conn);

		}
		function find_vehicle_php($V_Licence)
		{
			$servername = "mysql.cs.nott.ac.uk";
			$username = "psxtl3";
			$password = "EQRVZT";
			$dbname = "psxtl3";
			$conn = mysqli_connect($servername, $username, $password,$dbname);

			$sql = "SELECT * FROM Vehicle WHERE Vehicle_licence ='".$V_Licence."'";
			$result = mysqli_query($conn, $sql);
			$num_rows = mysqli_num_rows($result);

			$sql1 = "SELECT * FROM Vehicle WHERE Vehicle_licence ='LB15AJL'";
			$result1 = mysqli_query($conn, $sql1);
			$num_rows1 = mysqli_num_rows($result1);
			// if ($num_rows!=0)
			// 	return true;
			// else
			// 	return false;
			echo $sql." - ".$sql1."  /  ";
			echo $num_rows."  -  ".$num_rows1;
			mysqli_close($conn);
		}
		?>
	</body>
</html>
