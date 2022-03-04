<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$id=$_POST['id'];

		$sql="DELETE FROM cars WHERE cars.id=:id";
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
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
				<h1 class="mt-4">Car List</h1>
                
            </div>
            <div class="text-end mt-4">
            	<a href="car_create.php" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add New Car</a>
            </div>
        </div>
		
        
		<div class="card my-4">
			<div class="card-header">
				<i class="fas fa-table mr-1"></i>
				Items List
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Car Type</th>
								<th>Seat</th>
								<th>Price</th>
								<th>Option</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Car Type</th>
								<th>Seat</th>
								<th>Price</th>
								<th>Option</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								$j=1;
								$sql="SELECT cars.*,car_types.name as c_name FROM cars INNER JOIN car_types ON cars.car_type_id=car_types.id";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$cars=$stmt->fetchAll();
								foreach ($cars as $car) {

								
							?>
								<tr>
									<td><?= $j++ ?></td>
									<td><?= $car['name'] ?></td>
									<td><?= $car['c_name'] ?></td>
									<td><?= $car['seat'] ?></td>
									<td><?= $car['price'] ?></td>

									
									<td>
										<!-- <a href="item_detail.php?id=<?= $item['id'] ?>" class="btn btn-outline-primary btn-sm">Detail</a> --> 
										<a href="car_edit.php?id=<?= $car['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
										<form method="POST" action="" class="d-inline">
											<input type="hidden" name="id" value="<?= $car['id'] ?>">
											<input type="submit" name="" value="Delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure Delete?')">
										</form>
										
										 
									</td>

								</tr>

							<?php
							 } 
							?>
						</tbody>
					</table>
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