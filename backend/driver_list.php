<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$id=$_POST['id'];

		$sql="DELETE FROM drivers WHERE drivers.id=:id";
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
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
				<h1 class="mt-4">Driver List</h1>
                
            </div>
            <div class="text-end mt-4">
            	<a href="driver_create.php" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add New Driver</a>
            </div>
        </div>
		
        
		<div class="card my-4">
			<div class="card-header">
				<i class="fas fa-table mr-1"></i>
				Driver List
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Type</th>
								<th>Price</th>
								<th>License Number</th>
								<th>Experience</th>
								<th>Option</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Type</th>
								<th>Price</th>
								<th>License Number</th>
								<th>Experience</th>
								<th>Option</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								$j=1;
								$sql="SELECT * FROM drivers";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$drivers=$stmt->fetchAll();
								foreach ($drivers as $driver) {

								
							?>
								<tr>
									<td><?= $j++ ?></td>
									<td><?= $driver['type'] ?></td>
									<td><?= $driver['price'] ?></td>
									<td><?= $driver['license_number'] ?></td>
									<td><?= $driver['experience'] ?></td>
									<td>
										<a href="driver_edit.php?id=<?= $driver['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
										<form method="POST" action="" class="d-inline">
											<input type="hidden" name="id" value="<?= $driver['id'] ?>">
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