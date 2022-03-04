<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {

	require 'dbconnect.php';

	$status=0;
    
    $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE status=:status ORDER BY id DESC";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':status',$status);
    $stmt->execute();
    $orders=$stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $id=$_POST['id'];
        $status=$_POST['status'];
        $reason=$_POST['reason_text'];

        $sql="UPDATE orders SET status=:status,reason=:reason  WHERE orders.id=:id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':reason',$reason);
        $stmt->execute();

        if ($stmt->rowCount()) {
            header("location:order_list.php");
        }else{
            echo "Error";
        }
    }

	require 'include/header.php';

?>
	<div class="container">
		<div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
				<h1 class="mt-4">Order List</h1>
                
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
				Order List
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
                                    <td><span class="badge rounded-pill bg-danger">New Order</span></td>
                                    <td>
                                        <a href="order_detail.php?id=<?= $order['id'] ?>" class="btn btn-outline-primary btn-sm reason_show">Detail</a>
                                        
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="status" value="11">
                                            <input type="button" value="Reject" required="" class="btn btn-outline-danger btn-sm reason_show reject_btn">
                                            <input type="text" name="reason_text" class="reason reason_hide" placeholder="Give me reason?">
                                            <input type="submit" name="reason" value="Save" class="btn btn-outline-success btn-sm reason_hide" onclick="return confirm('Are You Sure Reject?')">
                                        </form>
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="status" value="1">
                                            <input type="hidden" name="reason_text" class="reason" value="Order Confrim" placeholder="Give me reason?">

                                            <input type="submit" name="" value="Confirm" class="btn btn-outline-success btn-sm reason_show" onclick="return confirm('Are You Sure Confirm?')">
                                            
                                            
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.reason_show').show();
        $('.reason_hide').hide();
        $('.reject_btn').click(function(event) {
            $('.reason_hide').show();
            $('.reason_show').hide();
        });
    });
</script>