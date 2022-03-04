<?php 
	include 'include/header.php';
  	require 'backend/dbconnect.php';

?>

<?php 
 $directoryURI = $_SERVER['REQUEST_URI'];
 $path = parse_url($directoryURI, PHP_URL_QUERY);
 if (isset($path)) {
 	$components = explode('=', $path);
 	$id = $components[1];
 	$id_name=$components[0];

 	if ($id && $id_name=='typefilter') {
 		$sql="SELECT cars.*,car_types.name as c_name FROM cars INNER JOIN car_types ON cars.car_type_id=car_types.id where cars.car_type_id=:id";
 		$stmt=$pdo->prepare($sql); 		
        $stmt->bindParam(':id',$id);
 		$stmt->execute();
 		$cars=$stmt->fetchAll();
 		// var_dump($cars);
 	}
 }
 else{
 	$sql="SELECT cars.*,car_types.name as c_name FROM cars INNER JOIN car_types ON cars.car_type_id=car_types.id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $cars=$stmt->fetchAll();
 }



 if ($_SERVER['REQUEST_METHOD']=="POST") {
    $pick_up_location=$_POST['pick_up_location'];
    $drop_off_location=$_POST['drop_off_location'];
    $pick_up_date=$_POST['pick_up_date'];
    $drop_off_date=$_POST['drop_off_date'];
    $pick_up_time=$_POST['pick_up_time'];
    $driver_string=$_POST['driver'];
    $myArray = explode(',', $driver_string);
    $driver =$myArray[0];
    $payment=$_POST['payment'];
    $total_price=$_POST['total_price'];
    $user_id=$_SESSION['loginuser']['id'];
    $status=0;
    $reason="";
    $order_date= date('d-m-Y');
    // var_dump($order_date);
    // echo "$user_id and $pick_up_location and $drop_off_location and $pick_up_date and $drop_off_date and $pick_up_time and $driver and $payment and $total_price ";
    // die();   

    

    $sql="INSERT INTO orders (order_date, user_id, pick_up_location, drop_off_location, pick_up_date, drop_off_date,pick_up_time,driver_id,payment,total_price,status,reason) VALUES(:order_date, :user_id, :pick_up_location, :drop_off_location, :pick_up_date, :drop_off_date,:pick_up_time,:driver_id,:payment,:total_price,:status,:reason)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':order_date',$order_date);
    $stmt->bindParam(':user_id',$user_id);
    $stmt->bindParam(':pick_up_location',$pick_up_location);
    $stmt->bindParam(':drop_off_location',$drop_off_location);
    $stmt->bindParam(':pick_up_date',$pick_up_date);
    $stmt->bindParam(':drop_off_date',$drop_off_date);
    $stmt->bindParam(':pick_up_time',$pick_up_time);
    $stmt->bindParam(':driver_id',$driver);
    $stmt->bindParam(':payment',$payment);
    $stmt->bindParam(':total_price',$total_price);
    $stmt->bindParam(':status',$status);
    $stmt->bindParam(':reason',$reason);
    $stmt->execute();
    if ($stmt->rowCount()) {
        header("location:slip.php");
      }else{
        echo "Error";
      }

  
}
 ?>
	<style type="text/css">
		@media only screen and (max-width: 600px) {
		  .select_width{
		    width: 70% !important;
		  }
		}
	</style>
	<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
	  <div class="overlay"></div>
	  <div class="container">
	    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
	      <div class="col-md-9 ftco-animate pb-5">
	      	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
	        <h1 class="mb-3 bread">Choose Your Car</h1>
	      </div>
	    </div>
	  </div>
	</section>

	
		
	
	<form class="text-center mr-5 mt-5 pr-5">
		<h2 class="mr-md-4 text-center">Choose Car Type</h2>
		<!-- <select class="custom-select w-25 select_width" class="ChooseType"> -->
			<!-- <option value="0">Choose Car Type</option> -->
			<a href="rent.php" class="btn btn-outline-info px-4">All</a>
			<?php 
				$sql="SELECT * FROM car_types";
				$stmt=$pdo->prepare($sql);
				$stmt->execute();
				$car_types=$stmt->fetchAll();
				foreach ($car_types as $car_type) {

				
			?>
			<a href="rent.php?typefilter=<?= $car_type['id'] ?>" class="btn btn-outline-info"><?= $car_type['name'] ?></a>
		<?php } ?>
		<!-- </select> -->
	</form>	

	<section class="mt-5"><!-- ftco-section -->
		<div class="container">
			<div class="row">

				<?php 
                
                foreach ($cars as $car) {                 
               
              ?>
				<div class="col-md-4">
					<div class="car-wrap rounded ftco-animate">
						<div class="img rounded d-flex align-items-end" style="background-image: url(backend/<?= $car['photo']?>););">
						</div>
						<div class="text">
							<h2 class="mb-0"><a href="car-single.html"><?= $car['name'] ?></a></h2>
							<div class="d-flex mb-3">
								<span class="cat"><?= $car['c_name'] ?></span>
								<p class="price ml-auto"><?= $car['price'] ?> <span>/day</span></p>
							</div>
							<p class="d-flex mb-0 d-block"><a href="#exampleModal" data-toggle="modal" class="btn btn-primary py-2 mr-1 booknow" data-id="<?= $car['id']  ?>" data-price="<?= $car['price']  ?>">Book now</a> <a href="detail.php?id=<?= $car['id']  ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			
		</div>
	</section>

<?php
	include 'include/footer.php'; 
?>

<script type="text/javascript">
	$(document).ready(function(){
	   $('#need').hide();
	   $("#Need").click(function(event){
	     $('#need').show();
	   });
	   $("#Noneed").click(function(event){
	     $('#need').hide();
	   });
     $(".booknow").click(function(event){
       var id = $(this).data('id');
       var price = $(this).data('price');
       $('#id').val(id);
       $('.totalprice').val(price);
       $('.totalprice_hidden').val(price);

     });

     $('#book_off_date').change(function(event) {
      var startdate= $('#book_pick_date').val();
      var enddate= $('#book_off_date').val();
      var totalprice=$('.totalprice_hidden').val();
      var date1 = new Date(startdate); 
      var date2 = new Date(enddate);
      var Time = date2.getTime() - date1.getTime(); 
      var Days = Time / (1000 * 3600 * 24);
      var Days =Days+1;
      var result= totalprice * Days;
      $('.totalprice').val(result);
      $('.totalprice_next').val(result);
     });


     $('.drive').change(function(event) {
       var price = $(this).val();
       var firstprice = price.split(',');
       var totalprice=$('.totalprice_next').val();

       // console.log(firstprice[0]);

       // alert(firstprice[1]);

       var result=parseInt(totalprice)+parseInt(firstprice[1]);
       $('.totalprice').val(result);

     });
	 });
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Car Rental</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h2>Make your trip</h2>          
            <input type="hidden" name="car_id" id="id">
          <div class="form-group">
            <label for="" class="label">Pick-up location</label>
            <input type="text" class="form-control" placeholder="City, Airport, Station, etc" required="" name="pick_up_location">
          </div>
          <div class="form-group">
            <label for="" class="label">Drop-off location</label>
            <input type="text" class="form-control" placeholder="City, Airport, Station, etc" required="" name="drop_off_location">
          </div>
          <div class="d-flex">
          <div class="form-group mr-2">
              <label for="" class="label">Pick-up date</label>
              <input type="date" class="form-control" id="book_pick_date" placeholder="Date" required="" name="pick_up_date">
            </div>
            <div class="form-group ml-2">
              <label for="" class="label">Drop-off date</label>
              <input type="date" class="form-control" id="book_off_date" placeholder="Date" required="" name="drop_off_date">
            </div>
            
            </div>
            <div class="form-group">
              <label for="" class="label">Pick-up time</label>
              <input type="time" class="form-control" id="time_pick" placeholder="Time" required="" name="pick_up_time">
            </div>
             <div class="form-group">
              <label for="" class="label">Driver</label>
              <br>
              <a href="#" class="btn btn-success text-light" id="Need">Need</a> <a href="#" class="btn btn-danger text-light" id="Noneed">No Need</a>

              <div id="need">
                <select class="custom-select mt-3 drive" name="driver">
                  <?php 
                  $sql="SELECT * FROM drivers";
                  $stmt=$pdo->prepare($sql);
                  $stmt->execute();
                  $drivers=$stmt->fetchAll();
                  ?>
                  <option value="0">Choose Driver</option>
                  <?php
                  foreach ($drivers as $drive) {

                   ?>
                  <option value="<?= $drive['id'] ?>,<?= $drive['price'] ?>" data-amount="<?= $drive['price'] ?>"><?= $drive['type'] ?>(<?= $drive['price'] ?>)</option>

                <?php } ?>
                </select>
              </div>
              
            </div>
            <div class="form-group">
              <label for="" class="label">Total Price</label>
              <input type="hidden" name="" class="totalprice_hidden">
              <input type="hidden" name="" class="totalprice_next">

              <input type="text" class="form-control totalprice" name="total_price" readonly="">
            </div>
            <label>Payment</label>
            <select class="custom-select mb-5" name="payment" required="">
              <option>Choose Payment</option>
              <option value="Cash">Cash</option>
              <option value="CB Pay">CB Pay</option>
              <option value="AYA pay">AYA Pay</option>
              <option value="KBZ pay">KBZ Pay</option>
              <option value="Wave pay">Wave Pay</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

           <?php 
                    if (isset($_SESSION['loginuser'])) {
                    
                ?>
            <button type="submmit" class="btn btn-primary">Book Now</button>
            <?php }else{ ?>
            <a type="submit" href="login.php" class="btn btn-primary">Login</a>
          
          <?php } ?>

          </div>
          </form>
      </div>
    </div>
  </div>
