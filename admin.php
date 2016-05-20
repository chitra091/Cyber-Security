<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
?>

<html>
	<h1><center>Admin</center></h1>
	
	<body>
		<a href="logout.php"> Logout </a>
		<br><br>
		<input type="button" value = "Add role" onclick = "location.href='role.php'">
		<br><br></br>
		<input type="button" value = "Assign role to users" onclick = "location.href='assignrole.php'">
		<br><br></br>
		<input type="button" value = "Delete role" onclick = "location.href='roledel.php'">
	</body>
</html>