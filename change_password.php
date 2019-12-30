<html>
	<head>
		<title>Change Password</title>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			include('connection.php');
			include('topnav.php');
		?>
		<h2>Change password</h2>
		<form class="box1" action="" method="POST">
			<input type="password" name="oldpassword" placeholder="Your current password"/><br>
			<input type="password" name="newpassword" placeholder="Your new password"/><br>
			<input type="password" name="confirmpassword" placeholder="Confirm your new password"/><br>
			<input type="Submit" value="Submit"/>
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
				if ($_POST['oldpassword']!="" && $_POST['newpassword']!="" && $_POST['confirmpassword']!="")
				{					
					if ($_POST['newpassword']== $_POST['confirmpassword'])
					{
						// Query current password from table Users
						$sql = "SELECT Password FROM Users WHERE Username='".$_SESSION['user_name']."'";
						$result = mysqli_query($conn, $sql);
						
						if ($_POST['oldpassword'] != mysqli_fetch_assoc($result)['Password']) // Wrong old password
						{
							function_alert("Your current password is incorrect.Please try again!");
						}
						else
						{
							// Update new password
							$sql = "UPDATE Users SET Password = '".$_POST['newpassword']."' WHERE Username='".$_SESSION['user_name']."'";
							$result = mysqli_query($conn, $sql);
							function_alert("Your password changed successfully!");
						}
					}
					else
					{
						function_alert("Your confirmation for the new password is incorrect. Please try again!");
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
