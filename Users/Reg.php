<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Customer | Loan Management System</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['userlogin_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:50%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:50%;
		height: calc(100%);
		background:#59b6ec61;
		display: flex;
		align-items: center;
		
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
    z-index: 10;
}
div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    background: #000000e0;
}

</style>

<body>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
		  <div class="card col-md-2">
		  </div>
		  <div class="card col-md-8">
  				<div class="card-body">
  					<h3>Personal Information</h3>
  					<form id="login-form"  method="POST" >
  						<div class="form-group">
  							<label for="firstname" class="control-label">First Name</label>
  							<input type="text" id="firstname" name="firstname" class="form-control" require>
  						</div>
  						<div class="form-group">
  							<label for="MiddleName" class="control-label">Middle Name</label>
  							<input type="text" id="MiddleName" name="MiddleName" class="form-control" require>
  						</div>
						  <div class="form-group">
  							<label for="lastname" class="control-label">Last Name</label>
  							<input type="text" id="lastname" name="lastname" class="form-control" require>
  						</div>
						 
						  <div class="form-group">
  							<label for="contact_no" class="control-label">contact_no</label>
  							<input type="text" id="contact_no" name="contact_no" class="form-control" require>
  						</div>
						  <div class="form-group">
  							<label for="address" class="control-label">address</label>
  							<input type="text" id="address" name="address" class="form-control" require>
  						</div>
						  <div class="form-group">
  							<label for="email" class="control-label">email</label>
  							<input type="text" id="email" name="email" class="form-control" require>
  						</div>
						  <div class="form-group">
  							<label for="tax_id" class="control-label">tax id</label>
  							<input type="text" id="tax_id" name="tax_id" class="form-control" require>
  						</div>
						 
  					

					  
  				</div>
  			</div>
  		</div>

  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
  					<h3>Account Information</h3>
  					
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control" require>
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control" require>
  						</div>
						  <div class="form-group">
  							<label for="confirm" class="control-label">confirm Password</label>
  							<input type="password" id="confirm" name="confirm" class="form-control" require>
  						</div>
  						<center>
						  <button type="submit" name="signup"  id="signup" class="btn-sm btn-block btn-wave col-md-4 btn-primary">Register</button>
						  <a href="login.php"> Click here After Register to login</a>
						  </center>
						  	 
  					</form>

					  
  				</div>
  			</div>
  		</div>
   

  </main>


  <?php
	

	if(isset($_POST['signup']))
	{

    $first=mysqli_real_escape_string($conn,$_REQUEST['firstname']);
	$midn=mysqli_real_escape_string($conn,$_REQUEST['MiddleName']);
	$last=mysqli_real_escape_string($conn,$_REQUEST['lastname']);
	$contact=mysqli_real_escape_string($conn,$_REQUEST['contact_no']);
	$add=mysqli_real_escape_string($conn,$_REQUEST['address']);
	$emai=mysqli_real_escape_string($conn,$_REQUEST['email']);
	$tax=mysqli_real_escape_string($conn,$_REQUEST['tax_id']);
	$user=mysqli_real_escape_string($conn,$_REQUEST['username']);
	$pass=mysqli_real_escape_string($conn,$_REQUEST['password']);
	$conf=mysqli_real_escape_string($conn,$_REQUEST['confirm']);
		if($pass==$conf)
		{
			$_SESSION['n']=$first;
			$_SESSION['e']=$user;

			$query = " INSERT INTO users (  name, address, contact, username,  password, type)
             VALUES ( '$first','$add','$contact','$user','$pass','3') ";
         $result = mysqli_query($conn, $query);
		  
		  if( $result )
{
?>
<script type="text/javascript">
alert('Register success. Please Login to make an appointment.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('User already registered. Please try again');

</script>
<?php
}
		}
		else
		{
			?>
          <script type="text/javascript">
           alert('Password not matched...');
         </script>
          <?php
		}

		$res1=mysqli_query($conn,"select * from users where name='$first' and username='$user' ");
		while($row = mysqli_fetch_array($res1)) 
		{ 
           $id=$row['id']; 
		}


		$query = " INSERT INTO borrowers (  id, firstname, middlename, lastname,  contact_no, address,email,tax_id,date_created)
             VALUES ('$id','$first','$midn','$last','$contact','$add','$emai','$tax','0') ";
         $result1 = mysqli_query($conn, $query);
		

	}
  




?>







  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>

</html>