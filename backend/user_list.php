<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
	
	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$id=$_POST['id'];

		$sql="DELETE FROM users WHERE users.id=:id";
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
		$stmt->execute();

		if ($stmt->rowCount()) {
			header("location:user_list.php");
		}else{
			echo "Error";
		}
	}

	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">Users List</h1>
                
            </div>
            <!-- <div class="col-6 text-end mt-4">
            	<a href="item_create.php" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add New Item</a>
            </div> -->
        </div>
		
        
		<div class="card my-4">
			<div class="card-header">
				<i class="fas fa-table mr-1"></i>
				Users List
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Option</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Option</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								$j=1;
								$sql="SELECT * FROM users";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$users=$stmt->fetchAll();
								foreach ($users as $user) {

								
							?>
								<tr>
									<td><?= $j++ ?></td>
									<td><?= $user['name'] ?></td>
									<td><?= $user['phone'] ?></td>
									<td><?= $user['email'] ?></td>
									<td>
										<!-- <a href="item_edit.php?id=<?= $item['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a> -->
										<form method="POST" action="" class="d-inline">
											<input type="hidden" name="id" value="<?= $car['id'] ?>">
											<input type="submit" name="" value="Ban" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure to Ban?')">
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