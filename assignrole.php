<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
?>

<html>
	<h1><center>Assign Role</center></h1>
	
	<body>
		<form name="assignrole.php" action="" method="post">
			<a href="logout.php"> Logout </a>
			<br>
			<br>
			<input type="submit" name="submit" value="Assign">
			<input type="submit" name="submit1" value="Back">
			
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

			$query = "SELECT * FROM role WHERE role_id!='$roleid'";
			$result = mysqli_query($conn, $query);
			echo "<table border='2'>";
			echo "<tr>". "<td>". "Select". "<td>". "Role";
			$temprole = array();
			for($i=0; $i<=$count; $i++) 
			{ 
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$count++;
			$role = $row['role_name'];
			$temprole[$count - 1] = $role;	  
			?>
			<tr> <td> <input name="field2[]" type="radio" value="<?php echo $temprole[$count-1]; ?>" onclick=""> <?php echo "<td>". $role;?>
			<br></td></br></td></tr>
			<?php } }?>
			</td>
			<br></br>
			<?php
			if($count == 0)
			{
				echo "No roles";
			}
			else
			{
				$_SESSION['string']=$role;
			}
			?>
			
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

			$query = "SELECT * FROM user WHERE user_id!='$userid' AND role_id = 0";
			$result = mysqli_query($conn, $query);
			echo "<table border='2'>";
			echo "<tr>". "<td>". "Select". "<td>". "User";
			$tempperm = array();
			for($i=0; $i<=$count; $i++) 
			{ 
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$count++;
			$user = $row['username'];
			$tempuser[$count - 1] = $user;	  
			?>
			<tr> <td> <input name="field[]" type="radio" value="<?php echo $tempuser[$count-1]; ?>" onclick=""> <?php echo "<td>". $user;?>
			<br></td></tr></br>
			<?php } }?>
			</td>
			<br></br>
			<?php
			if($count == 0)
				{
					echo "No users to assign roles";
				}
				else
				{
					$_SESSION['string']=$user;
				}
			?>
			</td>
			<br>
		</form>
	</body>
</html>

<?php
	$servername = "localhost";
	$username = "chitra";
	$password = "password";
	$dbname="cs6301";

	//Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!empty($_POST['submit']))
	{
		
		$user = $_SESSION['string'];
		$role = $_SESSION['string'];
			
		$count1=count($user);
		
		for($i=0;$i<=$count1;$i++)
		{
			if(isset($_POST['field'][$i]))
			{
				$username1=$_POST['field'][$i];
				break;
			}
		}
		
		$count2=count($role);
		
		for($i=0;$i<=$count2;$i++)
		{
			if(isset($_POST['field2'][$i]))
			{
				$rolename1=$_POST['field2'][$i];
				break;
			}
		}
		//Check connection
		if (!$conn) 
		{
				die("Connection failed: " . mysqli_connect_error());
		}
			
			$sql2 = "SELECT * FROM user WHERE username = '$username1'";
			$result2 = mysqli_query($conn, $sql2);
			$array2 = mysqli_fetch_array($result2,MYSQL_ASSOC);
			
			if($array2!="")
			{
				$user_id1=$array2['user_id'];
		
				$sql3 = "SELECT role_id FROM role WHERE role_name = '$rolename1'";
				$result3 = mysqli_query($conn, $sql3);
				$array3 = mysqli_fetch_array($result3,MYSQL_ASSOC);
				
				if($array3!="")
				{
					$updrole = $array3['role_id'];
					$sql4 = "UPDATE user SET role_id = '$updrole' WHERE user_id ='$user_id1'";
					$result4 = mysqli_query($conn, $sql4);
				
					if($result4)
					{
						echo"Role assigned";
						header('Location: admin.php');
					}
				}
			}
			else
			{
				echo"User not selected";
			}
		mysqli_close($conn);
	}
	if(!empty($_POST['submit1']))
	{
		header('Location: admin.php');
	}
?>
