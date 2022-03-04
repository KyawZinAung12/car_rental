<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	$id=$_GET['id'];

	$sql="SELECT * FROM drivers WHERE drivers.id=:driver_id";
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':driver_id',$id);
	$stmt->execute();
	$driver=$stmt->fetch(PDO::FETCH_ASSOC);
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$type=$_POST['type'];
		$price=$_POST['price'];
		$license_number=$_POST['license_number'];
		$experience=$_POST['experience'];
		
		$sql="UPDATE drivers SET type=:type,price=:price,license_number=:license_number,experience=:experience WHERE drivers.id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
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
				<h1 class="mt-4">Edit Driver</h1>
                
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
						<input type="text" class="form-control" name="type" id="type" required="" value="<?= $driver['type'] ?>">
					</div>
					<div class="mb-3">
						<label for="price" class="form-label">Price</label>
						<input type="text" class="form-control" name="price" id="price" required="" value="<?= $driver['price'] ?>">
					</div>
					<div class="mb-3">
						<label for="license_number" class="form-label">License Number</label>
						<input type="text" class="form-control" name="license_number" id="license_number" required="" value="<?= $driver['license_number'] ?>">
					</div>
					<div class="mb-3">
						<label for="experience" class="form-label">Experience</label>
						<input type="text" class="form-control" name="experience" id="experience" required="" value="<?= $driver['experience'] ?>">
					</div>
					
					<div class="text-end">
						<input type="submit" class="btn btn-primary" value="Update">
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