<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
?>


<html>
	<h1><center>Add Employee</center></h1>
	
	<body>
		<form name="add.php" action="" method="post">
			<a href="logout.php"> Logout </a>
			<br>
			<br>
			Enter Employee details
			</br>
			<br></br>
			Employee Name
			<input type="text" name="empname" >
			<br></br>
			Employee address
			<input type="text" name="empadd" >
			<br></br>
			Employee phone number
			<input type="text" name="empph" >
			<br></br>
			Employee Salary
			<input type="text" name="empsal" >
			<br></br>
			State
			<input type="text" name="empstate" >
			<br></br>
			Country
			<input type="text" name="empcnt" >
			<br></br>
			<input type="submit" name="submit" value="Add">
			<input type="submit" name="submit1" value="Back">
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
	
		$emp_name = $_POST['empname'];
		$emp_add = $_POST['empadd'];
		$emp_ph_no = $_POST['empph'];
		$emp_sal = $_POST['empsal'];
		$emp_state = $_POST['empstate'];
		$emp_country = $_POST['empcnt'];
		
	//Check connection
		if (!$conn) 
		{
				die("Connection failed: " . mysqli_connect_error());
		}
		if($emp_name == null)
		{
			echo "Invalid name entered";
		}
		else
		{
			$sql = "INSERT INTO employee (emp_name, emp_add, emp_ph_no, emp_sal,emp_state, emp_country) VALUES ('$emp_name', '$emp_add', '$emp_ph_no', '$emp_sal', '$emp_state', '$emp_country')";
			$result = mysqli_query($conn, $sql);
			
			if($result)
			{
				echo"Employee added";
				$_SESSION['role_id'] = $roleid;
		
				$sql1 = "SELECT role_name FROM role WHERE role_id = '$roleid'";
				$result1 = mysqli_query($conn, $sql1);
				$array = mysqli_fetch_array($result1,MYSQL_ASSOC);
				
				if($array!="")
				{
					$rolename = $array['role_name'];
					
					if($rolename == "developer")
					{
						header('Location: developer.php');
					}
					else if($rolename == "manager")
					{
						header('Location: manager.php');
					}
				}
			}
			else
			{
				echo"Invalid Add";
			}
		}
	}
	//mysqli_close($conn);
	if(!empty($_POST['submit1']))
	{
		$_SESSION['role_id'] = $roleid;
		
		$sql1 = "SELECT role_name FROM role WHERE role_id = '$roleid'";
		$result1 = mysqli_query($conn, $sql1);
		$array = mysqli_fetch_array($result1,MYSQL_ASSOC);
		
		if($array!="")
		{
			$rolename = $array['role_name'];
			
			if($rolename == "developer")
			{
				header('Location: developer.php');
			}
			else if($rolename == "manager")
			{
				header('Location: manager.php');
			}
		}
	}
	mysqli_close($conn);
?>