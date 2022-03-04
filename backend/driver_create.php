<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$type=$_POST['type'];
		$price=$_POST['price'];
		$license_number=$_POST['license_number'];
		$experience=$_POST['experience'];
		
		$sql="INSERT INTO drivers (type,price,license_number,experience) VALUES(:type,:price,:license_number,:experience)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':type',$type);
		$stmt->bindParam(':price',$price);
		$stmt->bindParam(':license_number',$license_number);
		$stmt->bindParam(':experience',$experience);
		$stmt->execute();

		if ($stmt->rowCount()) {
			header("location:driver_list.php");
		}else{
			echo "Error";
		}
		
	}


	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">Add New Driver</h1>
                
            </div>
            <div class="text-end mt-4">
            	<a href="driver_list.php" class="btn btn-primary"><i class="fas fa-backward me-2"></i>Go Back</a>
            </div>
        </div>
		
        
		<div class="row mt-3">
			<div class="offset-md-3 col-md-6">
				<form method="POST" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="type" class="form-label">Driver Type</label>
						<input type="text" class="form-control" name="type" id="type" placeholder="Level 1" required="">
					</div>
					<div class="mb-3">
						<label for="price" class="form-label">Price</label>
						<input type="text" class="form-control" name="price" id="price" placeholder="50000" required="">
					</div>
					<div class="mb-3">
						<label for="license_number" class="form-label">License Number</label>
						<input type="text" class="form-control" name="license_number" id="license_number" required="">
					</div>
					<div class="mb-3">
						<label for="experience" class="form-label">Experience</label>
						<input type="text" class="form-control" name="experience" id="experience" placeholder=" 3 years" required="">
					</div>
					
					<div class="text-end">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

<?php  

	require 'include/footer.php';

	}else{
      header("location:../index.php");
    }

?>