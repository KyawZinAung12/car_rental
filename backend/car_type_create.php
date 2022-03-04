<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$name=$_POST['name'];
		
		$sql="INSERT INTO car_types (name) VALUES(:name)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name',$name);
		$stmt->execute();

		if ($stmt->rowCount()) {
			header("location:car_type_list.php");
		}else{
			echo "Error";
		}
		
	}


	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">Add New Car Type</h1>
                
            </div>
            <div class="float-end mt-4">
            	<a href="car_type_list.php" class="btn btn-primary"><i class="fas fa-backward me-2"></i>Go Back</a>
            </div>
        </div>
		
        
		<div class="row mt-3">
			<div class="offset-md-3 col-md-6">
				<form method="POST" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="name" class="form-label">Car Type Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Salon" required="">
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