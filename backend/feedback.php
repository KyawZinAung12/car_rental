<?php 
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {

	require 'dbconnect.php';

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$id=$_POST['id'];

		$sql="DELETE FROM feedbacks WHERE feedbacks.id=:id";
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
		$stmt->execute();

		if ($stmt->rowCount()) {
			header("location:feedback.php");
		}else{
			echo "Error";
		}
	}

	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">FeedBack List</h1>
                
            </div>
        </div>
		
        
		<div class="card my-4">
			<div class="card-header">
				<i class="fas fa-table mr-1"></i>
				Menu List
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Subject</th>
								<th>Message</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Subject</th>
								<th>Message</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								$j=1;
								$sql="SELECT * FROM feedbacks";
								$stmt=$pdo->prepare($sql);
								$stmt->execute();
								$feedbacks=$stmt->fetchAll();
								foreach ($feedbacks as $feedback) {


								
							?>
								<tr>
									<td><?= $j++ ?></td>
									<td><?= $feedback['name'] ?></td>
									<td><?= $feedback['subject'] ?></td>
									<td><?= $feedback['message'] ?></td>
									

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