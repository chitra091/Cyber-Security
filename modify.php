<?php
session_start();
$userid = $_SESSION['user_id'];	
$roleid = $_SESSION['role_id'];
$emp_id = $_SESSION['emp_id'];
?>
<html>
	<h1><center>Modify Employee</center></h1>
	
	<body>
		<form name="modify.php" action="" method="post">
			<a href="logout.php"> Logout </a>
			<br></br>
			<br></br>
			<input type="submit" name="submit" value="Update">
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
			$emp_id = $_SESSION['emp_id'];
			
			$query = "SELECT * FROM employee WHERE emp_id = '$emp_id'";
			$result = mysqli_query($conn, $query);
			echo "<table border='2'>";
			echo "<tr>". "<td>". "Edit Employee Details";
			$temp = array();
			$temp1 = array();
			$temp2 = array();
			$temp3 = array();
			$temp4 = array();
			$temp5 = array();
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
			$temp1[$count - 1] = $tempadd;
			$temp2[$count - 1] = $tempphno;
			$temp3[$count - 1] = $tempsal;
			$temp4[$count - 1] = $tempstate;
			$temp5[$count - 1] = $tempcnt;
			?>
			<tr> <td> <input name="field[]" type="textbox" value="<?php echo $temp[$count-1]; ?>" onclick=""> 
			<tr> <td> <input name="field1[]" type="textbox" value="<?php echo $temp1[$count-1]; ?>" onclick=""> 
			<tr> <td> <input name="field2[]" type="textbox" value="<?php echo $temp2[$count-1]; ?>" onclick=""> 
			<tr> <td> <input name="field3[]" type="textbox" value="<?php echo $temp3[$count-1]; ?>" onclick=""> 
			<tr> <td> <input name="field4[]" type="textbox" value="<?php echo $temp4[$count-1]; ?>" onclick=""> 
			<tr> <td> <input name="field5[]" type="textbox" value="<?php echo $temp5[$count-1]; ?>" onclick=""> 
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
				$_SESSION['string']=$tempname;
				$_SESSION['string']=$tempadd;
				$_SESSION['string']=$tempphno;
				$_SESSION['string']=$tempsal;
				$_SESSION['string']=$tempstate;
				$_SESSION['string']=$tempcnt;}
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
		$tempadd = $_SESSION['string'];
		$tempphno = $_SESSION['string'];
		$tempsal = $_SESSION['string'];
		$tempstate = $_SESSION['string'];
		$tempcnt = $_SESSION['string'];
		
		$count=count($tempname);
		
		for($i=0;$i<=$count;$i++)
		{
			if(isset($_POST['field'][$i]))
			{
				$tempname=$_POST['field'][$i];
			}
			if(isset($_POST['field1'][$i]))
			{
				$tempadd=$_POST['field1'][$i];
			}
			if(isset($_POST['field2'][$i]))
			{
				$tempphno=$_POST['field2'][$i];
			}
			if(isset($_POST['field3'][$i]))
			{
				$tempsal=$_POST['field3'][$i];
			}
			if(isset($_POST['field4'][$i]))
			{
				$tempstate=$_POST['field4'][$i];
			}
			if(isset($_POST['field5'][$i]))
			{
				$tempcnt=$_POST['field5'][$i];
			}
		}
				
		//Check connection
		if (!$conn) 
		{
				die("Connection failed: " . mysqli_connect_error());
		}
		if($tempname == null)
		{
			echo "Invalid name entered";
		}
		else{
			$emp_id = $_SESSION['emp_id'];
			$sql = "UPDATE employee SET emp_name = '$tempname', emp_add = '$tempadd', emp_ph_no = '$tempphno', emp_sal = '$tempsal', emp_state = '$tempstate', emp_country = '$tempcnt' WHERE emp_id = '$emp_id'";
			$result = mysqli_query($conn, $sql);
			
			if($result)
			{
				header('Location: edit.php');
			}
			else
			{
				echo"Employee not modified";
			}
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