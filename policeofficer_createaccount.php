<html>
	<head>
		<title>Police Officer Information</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			include('connection.php');
			include('topnav.php');
		?>
		
		<h2>Add new police officer account</h2>
		
		<form class="box1" action="" method="POST">
			<input type="text" name="username" placeholder="Police officer username" required/><br>
			<input type="password" name="password" placeholder="Police officer password" required/><br>
			<input type="password" name="confirmpassword" placeholder="Confirm password" required/><br>
			<input type="Submit" value="Add account"/>
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
				if ($_POST['username']!="" && $_POST['password']!="" && $_POST['confirmpassword']!="")
				{
					// Check username existence
					$sql = "SELECT * FROM Users WHERE Username='".$_POST['username']."'";
					$result = mysqli_query($conn, $sql);
					$num_rows = mysqli_num_rows($result);
					
					if ($num_rows != 0)
					{
						function_alert("This username already exists!");
					}
					else 
					{
						if ($_POST['password'] == $_POST['confirmpassword'])
						{						
							// Add new account to table Users
							$sql = "INSERT INTO Users VALUES ('".$_POST['username']."','".$_POST['password']."')";
							$result = mysqli_query($conn, $sql);
							function_alert("New police officer account added successfully!");
						}
						else
						{
							function_alert("Your confirmation for the password is incorrect. Please try again!");
						}				
					}
				}
			}
			mysqli_close($conn);
			function function_alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
		?>
	</body>
</html>
