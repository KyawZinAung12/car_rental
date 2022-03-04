<?php 
	include 'include/header.php'; 
	
	if (!isset($_SESSION['loginuser'])) {

		require 'backend/dbconnect.php';
		if ($_SERVER['REQUEST_METHOD']=="POST") {

			$email=$_POST['email'];
			$password=sha1($_POST['password']);

			// echo "$email and $password";

			$sql="SELECT * FROM users  WHERE email=:user_email AND password=:user_password";
			$stmt=$pdo->prepare($sql);
			$stmt->bindParam(':user_email',$email);
			$stmt->bindParam(':user_password',$password);
			$stmt->execute();
			$data=$stmt->fetch(PDO::FETCH_ASSOC);

			// var_dump($data);die();


			if ($data) {
				$_SESSION['loginuser']=$data;

				if ($_SESSION['loginuser']) {
					if ($_SESSION['loginuser']['role']=='customer'){
						header("location:index.php");
					}else{
						header("location:backend/index.php");
					}
				}else{
					header("location:login.php");
				}
			}else{
				header("location:login.php");

			}
		}


?>
<div style="background-image: url('images/car2.jpg'); margin-top: -50px; height: 90vh">
	<div class="container my-5 py-md-5">
		<h3 class="text-center pt-5 mt-5 text-light">Login Form</h3>
		<form action="" method="post">
			<div class="row my-5">
				<div class="offset-1 offset-md-4 col-md-4 mb-3">
				    <label for="email" class="col-sm-3 col-form-label text-light">Email</label>
				    <div class="">
				      <input type="text" class="form-control" id="email" name="email" >
				    </div>
				 </div>
				 <div class="offset-1 offset-md-4 col-md-4  mb-3">
				    <label for="inputPassword" class="col-sm-3 col-form-label text-light">Password</label>
				    <div class="">
				      <input type="password" class="form-control" id="inputPassword" name="password">
				    </div>
				 </div>
				 <div class="offset-9 offset-md-7 mb-3">
				    <input type="submit" class="btn btn-outline-danger px-3 mt-3 float-end w-100" value="Login">
				    
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
