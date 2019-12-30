<html>
	<?php		
		session_start();
		$user_name = $_SESSION['user_name'];
		echo '
		<div class="usernav">
			<div class="userdropdown">
			<button class="userdropbtn">Hi, '.$user_name.'!</button>
			<div class="userdropdown-content">
			<a href="/~psxtl3/change_password.php">Change password</a>
			<a href="/~psxtl3/login.php">Log out</a>
			</div>
			</div>
		</div>';
	?>
	<h1>POLICE TRAFFIC DATABASE</h1>
	<div class="topnav" id="myTopnav">
		<div class="dropdown">
		<button class="dropbtn">People</button>
			<div class="dropdown-content">
				<a href="/~psxtl3/people.php">Search for people</a>
			</div>
		</div>
		<div class="dropdown">
		<button class="dropbtn">Vehicle</button>
			<div class="dropdown-content">
				<a href="/~psxtl3/vehicle_add.php">Add new vehicle</a>
				<a href="/~psxtl3/vehicle_search.php">Search for vehicle</a>
			</div>
		</div>
		<div class="dropdown">
		<button class="dropbtn">Report</button>
			<div class="dropdown-content">
				<a href="/~psxtl3/report_add.php">Add new report</a>
				<a href="/~psxtl3/report_list.php">List of reports</a>
			</div>
		</div>
	<?php
		if ($user_name == "haskins")
			echo '<div class="dropdown">
					<button class="dropbtn">Fines</button>
						<div class="dropdown-content">
							<a href="/~psxtl3/fines_list.php">Add/Edit fines</a>
						</div>
					</div>
					<div class="dropdown">
					<button class="dropbtn" style="width:160px">Police officer</button>
						<div class="dropdown-content">
							<a href="/~psxtl3/policeofficer_createaccount.php">Add new account</a>
						</div>
					</div>
					</div>';
		else
			echo '</div>';
	?>
</html>
