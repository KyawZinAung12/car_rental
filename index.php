<?php 
// session_start();
  include 'include/header.php';

  require 'backend/dbconnect.php';

  
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
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/car1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
	            <p style="font-size: 18px;">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts</p>
	           <!--  <a href="https://vimeo.com/45830194" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center"> -->
	            	<!-- <div class="icon d-flex align-items-center justify-content-center">
	            		<span class="ion-ios-play"></span>
	            	</div> -->
	            	<div class="heading-title ml-5 text-light">
		            	<span>Easy steps for renting a car</span>
	            	</div>
	            <!-- </a> -->
            </div>
          </div>
        </div>
      </div>
    </div>

<!--      <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-12	featured-top">
    				<div class="row no-gutters">
	  					<div class="col-md-4 d-flex align-items-center">
	  						<form action="#" class="request-form ftco-animate bg-primary">
		          		<h2>Make your trip</h2>
			    				<div class="form-group">
			    					<label for="" class="label">Pick-up location</label>
			    					<input type="text" class="form-control" placeholder="City, Airport, Station, etc">
			    				</div>
			    				<div class="form-group">
			    					<label for="" class="label">Drop-off location</label>
			    					<input type="text" class="form-control" placeholder="City, Airport, Station, etc">
			    				</div>
			    				<div class="d-flex">
			    					<div class="form-group mr-2">
			                <label for="" class="label">Pick-up date</label>
			                <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
			              </div>
			              <div class="form-group ml-2">
			                <label for="" class="label">Drop-off date</label>
			                <input type="text" class="form-control" id="book_off_date" placeholder="Date">
			              </div>
		              </div>
		              <div class="form-group">
		                <label for="" class="label">Pick-up time</label>
		                <input type="text" class="form-control" id="time_pick" placeholder="Time">
		              </div>
			            <div class="form-group">
			              <input type="submit" value="Rent A Car Now" class="btn btn-secondary py-3 px-4">
			            </div>
			    			</form>
	  					</div>
	  					<div class="col-md-8 d-flex align-items-center">
	  						<div class="services-wrap rounded-right w-100">
	  							<h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
	  							<div class="row d-flex mb-4">
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Choose Your Pickup Location</h3>
				                </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Select the Best Deal</h3>
					              </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Reserve Your Rental Car</h3>
					              </div>
					            </div>      
					          </div>
					        </div>
					        <p><a href="#" class="btn btn-primary py-3 px-4">Reserve Your Perfect Car</a></p>
	  						</div>
	  					</div>
	  				</div>
				</div>
  		</div>
    </section> -->


    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
		      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
		      	<span class="subheading">What we offer</span>
		        <h2 class="mb-2">Feeatured Vehicles</h2>
		      </div>
		    </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="carousel-car owl-carousel">
              <?php 
                $j=1;
                $sql="SELECT cars.*,car_types.name as c_name FROM cars INNER JOIN car_types ON cars.car_type_id=car_types.id";
                $stmt=$pdo->prepare($sql);
                $stmt->execute();
                $cars=$stmt->fetchAll();
                foreach ($cars as $car) {                 
               
              ?>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(backend/<?= $car['photo']?>);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#"><?= $car['name'] ?></a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat"><?= $car['c_name'] ?> ( <?= $car['seat'] ?> Seats) </span>
			    						<p class="price ml-auto"><?= $car['price']  ?> <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#exampleModal" data-toggle="modal" class="btn btn-primary py-2 mr-1 booknow" data-id="<?= $car['id']  ?>" data-price="<?= $car['price']  ?>">Book now</a> <a href="detail.php?id=<?= $car['id']  ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
		    					</div>
		    				</div>
    					</div>

              <?php
               } 
              ?>

    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section ftco-about">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section heading-section-white pl-md-5">
	          	<span class="subheading">About us</span>
	            <h2 class="mb-4">Welcome to Carbook</h2>

	            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p><a href="rent.php" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
	          </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Services</span>
            <h2 class="mb-3">Our Latest Services</h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Wedding Ceremony</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">City Transfer</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Airport Transfer</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Whole City Tour</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>

<!-- 		<section class="ftco-section ftco-intro" style="background-image: url(images/bg_3.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Do You Want To Earn With Us? So Don't Be Late.</h2>
            <a href="#" class="btn btn-primary btn-lg">Become A Driver</a>
          </div>
				</div>
			</div>
		</section>
 -->

    <!-- <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-3">Happy Clients</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_2.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_3.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
 -->
    <!-- <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Blog</span>
            <h2>Recent Blog</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a>
              <div class="text pt-4">
              	<div class="meta mb-3">
                  <div><a href="#">Oct. 29, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-2"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
                <p><a href="#" class="btn btn-primary">Read more</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
              </a>
              <div class="text pt-4">
              	<div class="meta mb-3">
                  <div><a href="#">Oct. 29, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-2"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
                <p><a href="#" class="btn btn-primary">Read more</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry">
              <a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
              </a>
              <div class="text pt-4">
              	<div class="meta mb-3">
                  <div><a href="#">Oct. 29, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-2"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
                <p><a href="#" class="btn btn-primary">Read more</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->	

<!--     <section class="ftco-counter ftco-section img bg-light" id="section-counter">
			<div class="overlay"></div>
    	<div class="container">
    		<div class="row">
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="60">0</strong>
                <span>Year <br>Experienced</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="1090">0</strong>
                <span>Total <br>Cars</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="2590">0</strong>
                <span>Happy <br>Customers</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text d-flex align-items-center">
                <strong class="number" data-number="67">0</strong>
                <span>Total <br>Branches</span>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </section>	 -->

	
<?php 
	include 'include/footer.php';
 // }else{
 //      header("location:index.php");
 //    }

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
              <input type="date" class="form-control" id="book_off_date" placeholder="Date" required="" name="drop_off_date" data-id=<?= $car['price'] ?>>
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

    