<?php  
require 'include/header.php';
if (isset($_SESSION['loginuser'])) {
	require 'backend/dbconnect.php';
	if ($_SERVER['REQUEST_METHOD']=="POST") {

		if (isset($_POST['current_password'])) {
		
			$password=$_SESSION['loginuser']['password'];
			$current_password=$_POST['current_password'];
			$new_password=$_POST['new_password'];
			$confirm_password=$_POST['confirm_password'];
			$cpass=sha1($current_password);
			

			if ($password!=$cpass) {
				$_SESSION['old_password_error_msg']="Current Password Wrong!";
				unset($_SESSION['password_error_msg']);
				header("location:profile.php");

			}
			elseif($new_password!=$confirm_password){
				$_SESSION['password_error_msg']="Password and confirm password does not math!";
				unset($_SESSION['old_password_error_msg']);
				header("location:profile.php");
				


			}else{

				unset($_SESSION['password_error_msg']);
				unset($_SESSION['old_password_error_msg']);
				$id=$_SESSION['loginuser']['id'];
				$password=sha1($new_password);
				$sql="UPDATE users SET password=:password WHERE users.id=:id";
				$stmt=$pdo->prepare($sql);
				$stmt->bindParam(':id',$id);
				$stmt->bindParam(':password',$password);
				$stmt->execute();

				if ($stmt->rowCount()) {
					header("location:logout.php");
				}else{
					echo "Error";
				}

				
			}
		}

		if ($_POST['name'] && $_POST['email'] && $_POST['phone'] && $_POST['address']){
			$id=$_SESSION['loginuser']['id'];
			$name=$_POST['name'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];

			// echo "$name and $id and $email and $phone and $address";die();

			$sql="UPDATE users SET name=:name, email=:email, phone=:phone, address=:address WHERE users.id=:id";
			$stmt=$pdo->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':phone',$phone);
			$stmt->bindParam(':address',$address);
			$stmt->execute();

			if ($stmt->rowCount()) {
				header("location:logout.php");
			}else{
				die("Error");
			}


		}


	}
	

?>
<div style="background-image: url('images/car5.jpg'); margin-top: -50px;">
	<div class="container">
		
        <div class="row mt-5 py-5">
        	<div class="offset-md-3 col-md-6 pt-5">
				<div class="card mt-5">
					<div class="card-body">
						<h3 class="text-center">Change Password</h3>
						<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="pass-tab" data-bs-toggle="tab" href="#pass" role="tab" aria-controls="pass" aria-selected="true">Change Password</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
							</li>	
						</ul> -->
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="pass" role="tabpanel" aria-labelledby="pass-tab">
								<form method="POST" class="mt-3">
									<div class="mb-3">
										<label for="current_password" class="form-label">Current Password</label>
										<input type="password" class="form-control" id="current_password" name="current_password" required>
										<?php 
						                    if (isset($_SESSION['old_password_error_msg'])) {
						                  ?>
						                  <small class="text-danger"><?php echo $_SESSION['old_password_error_msg']; ?></small>
						                <?php 
						                  }
						              
						                   ?>
									</div>
									<div class="mb-3">
										<label for="new_password" class="form-label">New Password</label>
										<input type="password" class="form-control" id="new_password" name="new_password" required>
										<?php 
						                    if (isset($_SESSION['password_error_msg'])) {
						                  ?>
						                  <small class="text-danger"><?php echo $_SESSION['password_error_msg']; ?></small>
						                <?php 
						                  }
						                  
						                   ?>
									</div>
									<div class="mb-3">
										<label for="confirm_password" class="form-label">Confirm Password</label>
										<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
									</div>
									<div class="mb-3">
										<input type="submit" name="" value="Save" class="btn btn-primary">
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<form method="POST" class="mt-3">
									<div class="mb-3">
										<label for="name" class="form-label">Name</label>
										<input type="name" class="form-control" id="name" name="name" value="<?= $_SESSION['loginuser']['name'] ?>">
									</div>
									<div class="mb-3">
										<label for="email" class="form-label">Email </label>
										<input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['loginuser']['email'] ?>">
									</div>
									<div class="mb-3">
										<label for="phone" class="form-label">Phone </label>
										<input type="number" class="form-control" id="phone" name="phone" value="<?= $_SESSION['loginuser']['phone'] ?>">
									</div>
									<div class="mb-3">
										<label for="address" class="form-label">Address </label>
										<textarea class="form-control" name="address" id="address"><?= $_SESSION['loginuser']['address'] ?></textarea>
									</div>
									<div class="mb-3">
										<input type="submit" value="Update" class="btn btn-primary">
									</div>
								</form>
							</div>
							
						</div>
						
					</div>
				</div>
				
			</div>
        </div>
		
	</div>
</div>

<?php  

	require 'include/footer.php';

	}else{
      header("location:../index.php");
    }

?>