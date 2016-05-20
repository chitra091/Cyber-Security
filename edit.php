<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
?>
<html>
	<h1><center>Modify Employee</center></h1>
	
	<body>
		<form name="edit.php" action="" method="post">
			<a href="logout.php"> Logout </a>
			<br></br>
			<br></br>
			<input type="submit" name="submit" value="Modify">
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

			$query = "SELECT * FROM employee";
			$result = mysqli_query($conn, $query);
			echo "<table border='2'>";
			echo "<tr>". "<td>". "Select". "<td>". "Employee Name". "<td>". "Employee Address". "<td>". "Employee Ph no". "<td>". "Employee Salary". "<td>". "State". "<td>". "Country" ;
			$tempname = array();
			for($i=0; $i<=$count; $i++) 
			{ 
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$count++;
			$tempname = $row['emp_name'];
			$tempadd = $row['emp_add'];
			$tempphno = $row['emp_ph_no'];
			$tempsal = $row['emp_sal'];
			$tempstate = $row['emp_state'];
			$tempcnt = $row['emp_country'];
			$temp[$count - 1] = $tempname;	  
			?>
			<tr> <td> <input name="field[]" type="radio" value="<?php echo $temp[$count-1]; ?>" onclick=""> <?php echo "<td>". $tempname. "<td>". $tempadd. "<td>". $tempphno. "<td>". $tempsal. "<td>". $tempstate. "<td>". $tempcnt;?>
			<br></td>
			<?php } }?> 
			</td>
			<br></br>
			<?php
				if($count==0)
				{
					echo "No employees to modify";
				}
				else{
				$_SESSION['string']=$tempname;}
			?>
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
		
		$tempname = $_SESSION['string'];
		
		$count=count($tempname);
		
		for($i=0;$i<=$count;$i++)
		{
			if(isset($_POST['field'][$i]))
			{
				$tempname=$_POST['field'][$i];
				break;
			}
		}
				
		//Check connection
		if (!$conn) 
		{
				die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT emp_id FROM employee WHERE emp_name = '$tempname'";
		$result = mysqli_query($conn, $sql);
		$array = mysqli_fetch_array($result,MYSQL_ASSOC);
		
		if($array!="")
		{
			$emp_id = $array['emp_id'];
			$_SESSION['emp_id']=$emp_id;
			header('Location: modify.php');
		}
		else
		{
			echo"Employee not selected";
		}
	//	mysqli_close($conn);
	}
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