<html>
	<head>
	<title>Report Information</title>
	<meta http-equiv="Content-type" content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<!-- <script type="text/javascript">
	function add_people(ID)
		{
/*
			var para = document.createElement("p");
			var node = document.createTextNode("This is new.");
			para.appendChild(node);
			var element = document.getElementById("div1");
			element.appendChild(para);
	*/

		var x = document.getElementById("div1");
		var line = document.createElement('hr'); // Giving Horizontal Row
		x.appendChild(line);

		var createform = document.createElement('form'); // Create New Element Form
		createform.setAttribute("action", ""); // Setting Action Attribute on Form
		createform.setAttribute("class", "box2");
		createform.setAttribute("method", "post"); // Setting Method Attribute on Form
		x.appendChild(createform);

		var heading = document.createElement('h2'); // Heading of Form
		heading.innerHTML = "Edit report";
		createform.appendChild(heading);

		// Create input field for date
		var inputelement = document.createElement('input');
		inputelement.setAttribute("type", "text");
		inputelement.setAttribute("name", "date");
		inputelement.setAttribute("placeholder", "Incident date");
		createform.appendChild(inputelement);

		// Create input field for offence
		inputelement.setAttribute("name", "offence");
		inputelement.setAttribute("placeholder", "Offence");
		createform.appendChild(inputelement);

		// Create input field for statement
		inputelement.setAttribute("name", "statement");
		inputelement.setAttribute("placeholder", "Textual statement");
		createform.appendChild(inputelement);

		// Create input field for vehicle licence number
		inputelement.setAttribute("name", "statement");
		inputelement.setAttribute("placeholder", "Textual statement");
		createform.appendChild(inputelement);

		var emailbreak = document.createElement('br');
		createform.appendChild(emailbreak);

		var messagelabel = document.createElement('label'); // Append Textarea
		messagelabel.innerHTML = "Your Message : ";
		createform.appendChild(messagelabel);

		var texareaelement = document.createElement('textarea');
		texareaelement.setAttribute("name", "dmessage");
		createform.appendChild(texareaelement);

		var messagebreak = document.createElement('br');
		createform.appendChild(messagebreak);

		var submitelement = document.createElement('input'); // Append Submit Button
		submitelement.setAttribute("type", "submit");
		submitelement.setAttribute("name", "dsubmit");
		submitelement.setAttribute("value", "Submit");
		createform.appendChild(submitelement);	}
	</script> -->
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
		$sql = "SELECT * FROM Incident, Vehicle, People, Offence WHERE Vehicle.Vehicle_ID = Incident.Vehicle_ID AND Incident.People_ID = People.People_ID AND Offence.Offence_ID = Incident.Offence_ID";
		$result = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($result);
		if ($num_rows == 0)
		{
			echo "<p>There is no report in the database.</p>";
		}
		else
		{
			echo "<table>";  // start table
			echo "<tr><th>Date</th><th>Offence</th><th>Textual statement</th><th>Vehicle licence number</th>
				<th>People name</th><th>People licence number</th></tr>"; // table header

			while($row = mysqli_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td>".$row["Incident_Date"]."</td>";
				echo "<td>".$row["Offence_description"]."</td>";
				echo "<td>".$row["Incident_Report"]."</td>";
				echo "<td>".$row["Vehicle_licence"]."</td>";
				echo "<td>".$row["People_name"]."</td>";
				echo "<td>".$row["People_licence"]."</td>";
				echo '<td><a type="button"  href="report_edit.php?id='.$row['Incident_ID'].'">Edit</a></td>';
				echo "</tr>";
			}
			echo "</table>";
			echo '<div id="div1"></div>';
		}
		if ($_POST['action']=="edit")
				{
			echo "here";
				}
	mysqli_close($conn);
	}
	?>

	</body>
</html>
