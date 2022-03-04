<?php include 'include/header.php'; ?>

<?php 
	require 'backend/dbconnect.php';

	$status=0;
    
    $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE status=:status ORDER BY id DESC LIMIT 1";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':status',$status);
    $stmt->execute();
    $order=$stmt->fetch(PDO::FETCH_ASSOC);


    $id=$order['id'];
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
 ?>

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Slip <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Slip</h1>
          </div>
        </div>
      </div>
    </section>



<div class="container my-5">
	<div class="card border-0">
        <div class="card-body">
            <div class="row">
                <div class="offset-2 col-md-8 py-3 border">
                    <h5 class="text-center py-2">Car Rent</h5>
                    <div class="row text-center">
                        <div class="col-md-6 text-center text-md-left ">
                            <p>Name : <?= $order['u_name'] ?></p>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <p>Order Date : <?= $order['order_date'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row m-0 p-0">
                    	<div class="col col-md-6 m-0">
                    		<p class="text-dark font-weight-bold mb-0">Category</p>
                    	</div>
                    	<div class="col col-md-6 m-0">
                    		<p class="text-dark font-weight-bold mb-0 ml-md-5">Value</p>
                    	</div>
                    </div>
                    <hr class="mb-1">
                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="mt-2">Pick Up Location</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="mt-2 ml-md-5"><?= $order['pick_up_location'] ?></p>
                    	</div>
                    </div>
                    <hr class="mt-0">
                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Drop Off Location</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="ml-md-5"><?= $order['drop_off_location'] ?></p>
                    	</div>
                    </div>
                    <hr class="mt-0">
                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Pick Up Date</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="ml-md-5"><?= $order['pick_up_date'] ?></p>
                    	</div>
                    </div>
                    <hr class="mt-0">

                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Drop Off Date</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="ml-md-5"><?= $order['drop_off_date'] ?></p>
                    	</div>
                    </div>
                    <hr class="mt-0">

                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Pick Up Time</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="ml-md-5"><?= $order['pick_up_time'] ?></p>
                    	</div>
                    </div>
                    <hr class="mt-0">

                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Driver</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<?php if ($order_list['driver_id']==0): ?>
                                  <p class="ml-md-5">No Need Driver</p>
                              <?php elseif($order_list['driver_id']!=0): ?>
                              <p class="ml-md-5"><?= $order['d_type'] ?></p>
                              <?php endif; ?>
                    	</div>
                    </div>
                    <hr class="mt-0">
                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Total Price</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="ml-md-5"><?= $order['total_price'] ?></p>
                    	</div>
                    </div>
                    <hr class="mt-0">
                    <div class="row m-0 p-0">
                    	<div class="col col-md-6">
                    		<p class="">Payment</p>
                    	</div>
                    	<div class="col col-md-6">
                    		<p class="ml-md-5"><?= $order['payment'] ?></p>
                    	</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>  
    <p class="text-center font-weight-bold">Thank You For Your Order! <a href="index.php">Go Back Home</a></p>

</div>


<?php include 'include/footer.php'; ?>