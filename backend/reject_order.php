<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {

	require 'dbconnect.php';

    $status=11;
    
    $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE status=:status ORDER BY id DESC";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':status',$status);
    $stmt->execute();
    $orders=$stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $id=$_POST['id'];
        $status=$_POST['status'];

        $sql="UPDATE orders SET status=:status WHERE orders.id=:id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':status',$status);
        $stmt->execute();

        if ($stmt->rowCount()) {
            header("location:reject_order.php");
        }else{
            echo "Error";
        }
    }

	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">Reject List...</h1>
                
            </div>
            <!-- <div class="col-3 text-end mt-4">
            	<select class="form-control">
            		<option><a href="">Complete</a></option>
            	</select>
            </div> -->
        </div>
		
        
		<div class="card my-4">
			<div class="card-header">
				<i class="fas fa-table mr-1"></i>
				Reject List...
			</div>
			<div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php  
                                $j=1;
                                foreach ($orders as $order) {
                                    
                            ?>
                                <tr>
                                    <td><?= $j++ ?></td>
                                    <td><?= $order['u_name'] ?></td>
                                    <td><?= $order['created_at'] ?></td>
                                    <td><?= $order['pick_up_location'] ?></td>
                                    <td><?= $order['drop_off_location'] ?></td>
                                    <td><?= $order['total_price'] ?></td>
                                    <td><span class="badge rounded-pill bg-warning">Reject</span></td>
                                    <td>
                                    	<a href="reject_detail.php?id=<?= $order['id'] ?>" class="btn btn-outline-primary btn-sm">Detail</a> 
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="status" value="0">
                                            <input type="submit" name="" value="Restore" class="btn btn-outline-success btn-sm" onclick="return confirm('Are You Restore?')">
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