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
			
			// Check fines existence in table Fines
			$sql = "SELECT * FROM Fines WHERE Incident_ID = ".$_GET['incidentID'];
			$result = mysqli_query($conn, $sql);
			$num_rows = mysqli_num_rows($result);
			$amount = $_GET["amount"];
			$point = $_GET["points"];
						
			// If at least one of the 2 inputs is not null (or 0)
			if (($amount != "" && $amount != "0") || ($point != "" && $point != "0"))
			{
				// If amount or point input is null => set it as 0
				if ($amount == "") $amount=0;
				if ($point == "") $point=0;
				if ($num_rows == 0) // if fines doesn't exist
				{
					//Insert new Fines
					$sql = "INSERT INTO Fines(Fine_Amount,Fine_Points,Incident_ID) VALUES(".$amount.",".$point.",".$_GET["incidentID"].")";
					$result = mysqli_query($conn, $sql);
				}
				else
				{				
					// Update Fines
					$sql = "UPDATE Fines SET Fine_Amount = ".$amount.",  Fine_Points = ".$point." WHERE Incident_ID =".$_GET["incidentID"];
					$result = mysqli_query($conn, $sql);
				}
			}
			// If both 2 inputs are null (or 0)
			else
			{
				if ($num_rows != 0) // if fines previously exist -> delete from table
				{
					//Insert new Fines
					$sql = "DELETE FROM Fines WHERE Incident_ID =".$_GET["incidentID"];
					$result = mysqli_query($conn, $sql);
				}
			}
		?>
		<script type="text/javascript">
			alert("Fines updated successfully!");
			window.location = "fines_list.php";
		</script>
	</body>
</html>