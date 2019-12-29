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
			
			// Update table Incident
			$sql = "UPDATE Incident SET Incident_Date = '".$_GET["date"]."',  Incident_Report = '".$_GET["report"]."',
					Offence_ID = (SELECT Offence_ID FROM Offence WHERE Offence_description='".$_GET["offence"]."') 
					WHERE Incident_ID =".$_GET['incidentID'];
			$result = mysqli_query($conn, $sql);

			//Update table Vehicle
			$sql = "UPDATE Vehicle SET Vehicle_type = '".$_GET["V_Type"]."',  Vehicle_colour = '".$_GET["V_Colour"]."',
					Vehicle_licence = '".$_GET["V_LicenceNo"]."' 
					WHERE Vehicle_ID = (SELECT Vehicle_ID FROM Incident WHERE Incident_ID = ".$_GET['incidentID'].")";
			$result = mysqli_query($conn, $sql);
			
			//Update table People
			$sql = "UPDATE People SET People_name = '".$_GET["O_Name"]."',  People_address = '".$_GET["O_Address"]."',
					People_licence = '".$_GET["O_Licence"]."' 
					WHERE People_ID = (SELECT People_ID FROM Incident WHERE Incident_ID = ".$_GET['incidentID'].")";
			$result = mysqli_query($conn, $sql);
		?>
		<script type="text/javascript">
			alert("Updated successfully!");
			window.location = "report_list.php";
		</script>
	</body>
</html>