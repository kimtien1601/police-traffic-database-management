<html>
	<head>
	<title>User Login</title>
	<meta http-equiv="Content-type" content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1 class="toppadding">User Login</h1>
		<form class="box1" action="" method="POST">
			<input type="text" name="username" placeholder="Username" required/><br>
			<input type="password" name="password" placeholder="Password" required/><br>
			<input type="Submit" value = "Login"/>
		</form>
		
		<?php       
			// MySQL database information
			$servername = "mysql.cs.nott.ac.uk";
			$username = "psxtl3";
			$password = "EQRVZT";
			$dbname = "psxtl3";
			$conn = mysqli_connect($servername, $username, $password,$dbname);		
								  
			// Check connection
			if(mysqli_connect_errno()) 
			{
			   echo "Failed to connect to MySQL: ".mysqli_connect_error();
			   die();
			} 
			else
			{
				if ($_POST['username']!="" && $_POST['password']!="")
				{
					session_start(); 
					$_SESSION['user_name'] = $_POST['username'];
					
					$sql = "SELECT Password FROM Users where Username='".$_POST['username']."'";
					$result = mysqli_query($conn, $sql);
					$num_rows = mysqli_num_rows($result);					
					if ($num_rows === 0)
					{
						function_alert("This username does not exist.\\nPlease try again!");
					}
					else
					{
						if ($_POST['password'] == mysqli_fetch_assoc($result)['Password'])
							header("location: /~psxtl3/people.php");
						else
							function_alert("Incorrect username or password.\\nPlease try again!");
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