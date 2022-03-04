<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$name=$_POST['car_name'];
		$car_type=$_POST['car_type'];
		$price=$_POST['price'];
		$seat=$_POST['seat'];
		$photo=$_FILES['photo'];
		// echo "$main_item and $ingredient and $item_name and $price and $discount ";

		$basepath="images/cars/";
		$fullpath=$basepath.$photo['name'];
		move_uploaded_file($photo['tmp_name'], $fullpath);

		$sql="INSERT INTO cars (name, car_type_id, seat, price, photo) VALUES(:name, :car_type, :seat, :price, :photo)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':car_type',$car_type);
		$stmt->bindParam(':seat',$seat);
		$stmt->bindParam(':price',$price);
		$stmt->bindParam(':photo',$fullpath);
		$stmt->execute();

		if ($stmt->rowCount()) {
			header("location:car_list.php");
		}else{
			echo "Error";
		}
		
	}


	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">Add New Car</h1>
                
            </div>
            <div class="text-end mt-4">
            	<a href="car_list.php" class="btn btn-primary"><i class="fas fa-backward me-2"></i>Go Back</a>
            </div>
        </div>
		
        
		<div class="row mt-3">
			<div class="offset-md-3 col-md-6">
				<form method="POST" enctype="multipart/form-data">				
					
					<div class="mb-3">
						<label for="car_name" class="form-label">Car Name</label>
						<input type="text" class="form-control" name="car_name" id="car_name" placeholder="Toyota" required="">
					</div>
					<div class="mb-3">
						<label for="Car_Type" class="form-label">Car_Type Name</label>
						<select class=" form-control" aria-label="Default select example" name="car_type" id="Car_Type" required="">
							<option value="" selected>Open this select Car_Type</option>
							<?php  

								$sql="SELECT * FROM car_types";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$car_types=$stmt->fetchAll();

								foreach ($car_types as $car_type) {
							?>
								<option value="<?= $car_type['id'] ?>"><?= $car_type['name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="seat" class="form-label">Number Seat</label>
						<input type="number" class="form-control" name="seat" id="seat" placeholder="3" required="">				
					</div>
					<div class="mb-3">
						<label for="price" class="form-label">Day Price</label>
						<input type="number" class="form-control" name="price" id="price" placeholder="Unit Price" required="">				
					</div>
					<div class="mb-3">
						<label for="photo" class="form-label">Photo</label>
						<input type="file" class="form-control-file" name="photo" id="photo" required="">
					</div>
					<div class="text-end mt-5">
						<input type="submit" class="btn btn-primary" value="Submit" name="insert">
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