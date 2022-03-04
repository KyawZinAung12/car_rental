<?php 

	include 'include/header.php'; 
	if (!isset($_SESSION['loginuser'])) {
	
		include 'backend/dbconnect.php'; 
		
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$name=$_POST['name'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$password=$_POST['password'];
			$confirmpassword=$_POST['confirmpassword'];			
			$role='customer';

			if($password!=$confirmpassword){
				$_SESSION['password_error_msg']="Password and confirm password does not math!";
				header("location:register.php");

			}else{

				$password=sha1($password);

				$sql="INSERT INTO users (name,email,phone,password,role) VALUES(:name,:email,:phone,:password,:role)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':name',$name);
				$stmt->bindParam(':email',$email);
				$stmt->bindParam(':phone',$phone);
				$stmt->bindParam(':password',$password);
				$stmt->bindParam(':role',$role);

				$stmt->execute();

			    unset($_SESSION['password_error_msg']);


				if ($stmt->rowCount()) {
					header("location:login.php");
				}else{
					echo "Error";
				}
			}
			
		}

?>
<div style="background-image: url('images/car5.jpg'); margin-top: -50px; width: 100% !important;">
	<div class="container mt-4 py-md-5">
		<h3 class="text-center text-light mt-5 pt-5">Register Form</h3>
		<form action="" method="POST">
			<div class="row">

				<div class="offset-md-4 col-md-4">
					<div class="form-group">
						<label for="name" class="text-light">User Name</label>
						<input type="text" name="name" class="form-control" required="" style="height: 45px !important;">
					</div>
					<div class="form-group my-3">
						<label for="email" class="text-light">Email</label>
						<input type="email" name="email" class="form-control" required="" style="height: 45px !important;">
					</div>
					<div class="form-group my-3">
						<label for="password" class="text-light">Password</label>
						<input type="password" name="password" class="form-control" required="" style="height: 45px !important;">
						<?php 
		                    if (isset($_SESSION['password_error_msg'])) {
		                  ?>
		                  <small class="text-danger"><?php echo $_SESSION['password_error_msg']; ?></small>
		                <?php 
		                  }

		                   ?>
					</div>
					<div class="form-group my-3">
						<label for="confirmpassword" class="text-light">Confirm Password</label>
						<input type="password" name="confirmpassword" class="form-control" required="" style="height: 45px !important;">
					</div>
					<div class="form-group my-3">
						<label for="phone" class="text-light">Phone</label>
						<input type="number" name="phone" class="form-control" required="" style="height: 45px !important;">
					</div>
					<div class="mt-4">
						<input type="submit" class="btn btn-outline-danger float-end px-4" value="Register">
					</div>
					
					
				</div>
			
			</div>
		</form>
		
		
	</div>
</div>	

<?php 
	}else{
		header('location:index.php');
	}
	include 'include/footer.php'; 
?>
