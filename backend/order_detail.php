<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {
    
	require 'dbconnect.php';

    $id=$_GET['id'];

    $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE orders.id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $order_list=$stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($order_list['driver_id']);
    // die();
    if ($order_list['driver_id']==0) {
        $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id  WHERE orders.id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $order=$stmt->fetch(PDO::FETCH_ASSOC);
    }else{

    $sql="SELECT orders.*,users.name as u_name,drivers.type as d_type FROM orders INNER JOIN users ON orders.user_id=users.id INNER JOIN drivers ON orders.driver_id=drivers.id WHERE orders.id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $order=$stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($order);die();
}

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
                <h1 class="mt-4">Order Detail</h1>
                
            </div>
            <div class="text-end mt-4">
                <a href="javascript:history.go(-1)" class="btn btn-primary"><i class="fas fa-backward me-2"></i>Go Back</a>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body">
                <div class="row">
                    <div class="offset-md-2 col-md-8 py-3 border">
                        <h5 class="text-center py-2">Car Rent</h5>
                        <div class="row text-center">
                            <div class="col-md-6 text-center text-md-left ">
                                <p>Name : <?= $order['u_name'] ?></p>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                <p>Order Date : <?= $order['order_date'] ?></p>
                            </div>
                        </div>
                       <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th scope="col">Category</th>
                              <th scope="col">Value</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Pick Up Location</td>
                              <td><?= $order['pick_up_location'] ?></td>
                            </tr>
                            <tr>
                              <td>Drop Off Location</td>
                              <td><?= $order['drop_off_location'] ?></td>
                            </tr>
                            <tr>
                              <td>Pick Up Date</td>
                              <td><?= $order['pick_up_date'] ?></td>
                            </tr>
                            <tr>
                              <td>Drop Off Date</td>
                              <td><?= $order['drop_off_date'] ?></td>
                            </tr>
                            <tr>
                              <td>Pick Up Time</td>
                              <td><?= $order['pick_up_time'] ?></td>
                            </tr>
                            
                            <tr>
                              <td>Driver</td>
                              <?php if ($order_list['driver_id']==0): ?>
                                  <td>No Need Driver</td>
                              <?php elseif($order_list['driver_id']!=0): ?>
                              <td><?= $order['d_type'] ?></td>
                              <?php endif; ?>
                            </tr>
                            <tr>
                              <td>Payment</td>
                              <td><?= $order['payment'] ?></td>
                            </tr>
                            <tr>
                              <td>Total Price</td>
                              <td><?= $order['total_price'] ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <form method="POST" action="" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                    <input type="hidden" name="status" value="11">
                                    <input type="button" value="Reject" required="" class="btn btn-outline-danger btn-sm reason_show reject_btn">
                                    <input type="text" name="reason_text" class="reason reason_hide" placeholder="Give me reason?">
                                    <input type="submit" name="reason" value="Save" class="btn btn-outline-success btn-sm reason_hide" onclick="return confirm('Are You Sure Reject?')">
                                </form>
                                
                                
                            </div>
                            <div class="offset-md-4 col-6 col-md-2 text-end">
                                <form method="POST" action="" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                    <input type="hidden" name="status" value="1">
                                    <input type="hidden" name="reason_text" class="reason" value="Order Confrim" placeholder="Give me reason?">
                                    <input type="submit" name="" value="Confirm" class="btn btn-success btn-sm" onclick="return confirm('Are You Confirm?')">
                                </form>
                            </div>
                        </div>
                    </div>
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