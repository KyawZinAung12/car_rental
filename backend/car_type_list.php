<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$id=$_POST['id'];

		$sql="DELETE FROM car_types WHERE car_types.id=:id";
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
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
				<h1 class="mt-4">Car Type List</h1>
                
            </div>
            <div class="text-end mt-4">
            	<a href="car_type_create.php" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add New Car Type</a>
            </div>
        </div>
		
        
		<div class="card my-4">
			<div class="card-header">
				<i class="fas fa-table mr-1"></i>
				Car Type List
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Option</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Option</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								$j=1;
								$sql="SELECT * FROM car_types";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$car_types=$stmt->fetchAll();
								foreach ($car_types as $car_type) {

								
							?>
								<tr>
									<td><?= $j++ ?></td>
									<td><?= $car_type['name'] ?></td>
									<td>
										<a href="car_type_edit.php?id=<?= $car_type['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
										<form method="POST" action="" class="d-inline">
											<input type="hidden" name="id" value="<?= $car_type['id'] ?>">
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