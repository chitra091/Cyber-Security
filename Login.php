<?php
session_start();
?>

<html>
	
	<head>
		<title>
		ABC Company
		</title>
	<head>
	
	<body>
	
		<h1> 
		<center> ABC Company </center> 
		</h1>
		
		<h3>
		<center> Login </center>
		</h3>
		
		<form name="Login.php" action="" method="post">
			<center>
			Username
			<input type="text" name="user_name" >
			<br></br>
			Password
			<input type="password" name="pswd" >
			<br></br>
			<input type="submit" name="submit"></input>
			</center>
		</form>
	
		<?php
		$servername = "localhost";
		$username = "chitra";
		$password = "password";
		$dbname="cs6301";
		
		//Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if(!empty($_POST['submit']))
		{
			$user = $_POST['user_name'];
			$pass = $_POST['pswd'];
			
			$_SESSION['user_name']= $user;
			$_SESSION['pswd']= $pass;
			
			//Check connection
			if (!$conn) 
			{
					die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";
			$result = mysqli_query($conn, $sql);
			$array=mysqli_fetch_array($result,MYSQL_ASSOC);
			
			if($array!="")
			{
				$userid= $array['user_id'];
				$roleid= $array['role_id'];
				$_SESSION['user_id']=$userid;
				$_SESSION['role_id']=$roleid;
				$sql1 = "SELECT * FROM role WHERE role_id = '$roleid'";
				$result1 = mysqli_query($conn, $sql1);
				$array1=mysqli_fetch_array($result1,MYSQL_ASSOC);
				
				if($array1!="")
				{
					$rolename = $array1['role_name'];
					if ($rolename == "admin")
					{
						header('Location: admin.php');
					}
					else if ($rolename == "manager")
					{
						header('Location: manager.php');
					}
					else if ($rolename == "developer")
					{
						header('Location: developer.php');
					}
					else
					{
						echo"Role not setup for user";
					}
				}
				else
				{
					echo "Role not setup for user";
				}
			}
			else
			{
				echo "Invalid User";
			}
			mysqli_close($conn);
		}
		?>
	</body>
<html/>