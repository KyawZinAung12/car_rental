<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	$id=$_GET['id'];

	$sql="SELECT * FROM cars WHERE cars.id=:car_id";
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':car_id',$id);
	$stmt->execute();
	$car=$stmt->fetch(PDO::FETCH_ASSOC);

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		
		$name=$_POST['name'];
		$car_type=$_POST['car_type'];
		$seat=$_POST['seat'];
		$fullpath = $_POST['old_photo'];
		$photo=$_FILES['photo'];
		$price=$_POST['price'];

		// echo "$menu and $ingredient and $item_name and $price and $discount ";

		if ($photo['size']>0) {
			$basepath="images/cars/";
			$fullpath=$basepath.$photo['name'];
			move_uploaded_file($photo['tmp_name'], $fullpath);
		}

		$sql="UPDATE cars SET name=:name,car_type_id=:car_type,seat=:seat,photo=:photo,price=:price WHERE cars.id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':car_type',$car_type);
		$stmt->bindParam(':seat',$seat);
		$stmt->bindParam(':photo',$fullpath);
		$stmt->bindParam(':price',$price);		
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
				<h1 class="mt-4">Edit Item</h1>
                
            </div>
            <div class="text-end mt-4">
            	<a href="car_list.php" class="btn btn-primary"><i class="fas fa-backward me-2"></i>Go Back</a>
            </div>
        </div>
		
        
		<div class="row mt-3">
			<div class="offset-md-3 col-md-6">
				<form method="POST" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="name" class="form-label">Car Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Seafood Pizza" required="" value="<?= $car['name'] ?>">
					</div>
					<div class="mb-3">
						<label for="menu" class="form-label">Car Type Name</label>
						<select class="form-control" aria-label="Default select example" name="car_type" id="menu" required="">
							<option value="">Open this select menu</option>
							<?php  

								$sql="SELECT * FROM car_types";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$car_types=$stmt->fetchAll();

								foreach ($car_types as $car_type) {
							?>
								<option value="<?= $car_type['id'] ?>" <?php if($car['car_type_id']==$car_type['id']) echo 'selected' ?>><?= $car_type['name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="seat" class="form-label">Number of Seat</label>
						<input type="text" class="form-control" name="seat" id="seat" placeholder="Seafood Pizza" required="" value="<?= $car['seat'] ?>">
					</div>
					<div class="mb-3">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="old-tab" data-toggle="tab" href="#old" role="tab" aria-controls="old" aria-selected="true">Old Photo</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="profile" aria-selected="false">New Photo</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="old" role="tabpanel" aria-labelledby="old-tab">
								<img src="<?= $car['photo'] ?>" width="150" height="100" class="mt-3">
								<input type="hidden" class="form-control mt-3" name="old_photo" id="old_photo" value="<?= $car['photo'] ?>">
							</div>
							<div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
								<input type="file" class="form-control-file mt-3" name="photo" id="photo" >
								
							</div>
						</div>
						
						
					</div>
					<div class="mb-3">
						<label for="price" class="form-label">Price</label>
						<input type="text" class="form-control" name="price" id="price" required="" value="<?= $car['price'] ?>">
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