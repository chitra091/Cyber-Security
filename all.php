<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
?>


<html>
	<h1><center>All actions</center></h1>
	
	<body>
		<a href="logout.php"> Logout </a>
		<br><br>
		<input type="button" value = "Add employee" onclick = "location.href='add.php'">
		<br><br></br>
		<input type="button" value = "Delete employee" onclick = "location.href='delete.php'">
		<br><br></br>
		<input type="button" value = "Modify employee" onclick = "location.href='edit.php'">
	</body>
</html>