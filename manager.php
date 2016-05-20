<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
?>

<html>
	<h1><center>Manager</center></h1>
	<body>
	<a href="logout.php"> Logout </a>
	</br></br>
	<?php
		$servername = "localhost";
		$username = "chitra";
		$password = "password";
		$dbname = "cs6301";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$count=0;
		$_SESSION['user_id'] = $userid;
		$_SESSION['role_id'] = $roleid;

		$query = "SELECT * FROM role WHERE role_id ='$roleid'";
		$result = mysqli_query($conn, $query);
		
		$array = mysqli_fetch_array($result,MYSQL_ASSOC);
		
		if($array!="")
		{
			$permid = $array['permission_id'];
			
			$query1 = "SELECT * FROM permission WHERE permission_id ='$permid'";
			$result1 = mysqli_query($conn, $query1);
		
			$array1 = mysqli_fetch_array($result1,MYSQL_ASSOC);
			
			if($array1!="")
			{
				$permtype = $array1['permission_type'];
				
				if($permtype == "all")
				{
					?>
					<input type="button" value = "All action" onclick = "location.href='all.php'">
					<?php
				}
				else if($permtype == "add")
				{
					?>
					<input type="button" value = "Add Employee" onclick = "location.href='add.php'">
					<?php
				}
				else if($permtype == "delete")
				{
					?>
					<input type="button" value = "Delete Employee" onclick = "location.href='delete.php'">
					<?php
				}
				else if($permtype == "edit")
				{
					?>
					<input type="button" value = "Modify Employee" onclick = "location.href='edit.php'">
					<?php
				}
				else
				{
					echo "Invalid permission";
				}
			}
			else
			{
				echo "Permission not found";
			}
			
		}
		else
		{
			echo "Role not assigned";
		}
	?>
	</body>
</html>