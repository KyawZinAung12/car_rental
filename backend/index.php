<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role']=="admin") {

    require 'dbconnect.php';

    $sql="SELECT id FROM car_types";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $car_type_count=$stmt->rowCount();

    $sql="SELECT id FROM cars";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $car_count=$stmt->rowCount();

    $sql="SELECT id FROM drivers";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $driver_count=$stmt->rowCount();

    // $sql="SELECT id FROM orders";
    // $stmt=$pdo->prepare($sql);
    // $stmt->execute();
    // $order_count=$stmt->rowCount();

    $status=0;
    $sql="SELECT id FROM orders WHERE status=:status";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':status',$status);
    $stmt->execute();
    $order_count=$stmt->rowCount();

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $from=$_POST['from'];
        $to=$_POST['to'];
        $newDatefrom = date("d-m-Y", strtotime($from));  
        $newDateto = date("d-m-Y", strtotime($to));  
        

        $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE order_date BETWEEN '$newDatefrom' AND '$newDateto'";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        $reports=$stmt->fetchAll();
        // var_dump($reports);      

        
    }else{

    $order_date= date('d-m-Y');
    $sql="SELECT orders.*,users.name as u_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE order_date=:order_date";
    // $sql="SELECT id FROM orders WHERE order_date=:order_date";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':order_date',$order_date);
    $stmt->execute();
    $reports=$stmt->fetchAll();
}


    require 'include/header.php';
    
    


?>
    
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body pb-1">
                        <p class="text-uppercase fs-6 fw-light mb-0">Total Car Types</p>
                        <h3 class="my-0"><?= $car_type_count ?></h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="car_type_list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body pb-1">
                        <p class="text-uppercase fs-6 fw-light mb-0">Total Cars</p>
                        <h3 class="my-0"><?= $car_count ?></h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="car_list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body pb-1">
                        <p class="text-uppercase fs-6 fw-light mb-0">Total Driver</p>
                        <h3 class="my-0"><?= $driver_count ?></h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="driver_list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body pb-1">
                        <p class="text-uppercase fs-6 fw-light mb-0">Total Order</p>
                        <h3 class="my-0"><?= $order_count ?></h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="order_list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <form class="mt-5 mb-2" method="POST">
            <div class="row">
                <div class="col-4">
                    <label>From</label>
                     <input type="date" name="from" class="form-control" required="">
                </div>
                <div class="col-4">
                    <label>To</label>
                     <input type="date" name="to" class="form-control" required="">
                </div>
                <div class="col-4">
                    <label>.</label>
                     <button type="submit" class="form-control">Search</button>
                </div>
            </div>
        </form>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Report
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <!-- <th>Action</th> -->

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php  
                                $j=1;
                                $total=0;
                                $sub_total=0;
                                foreach ($reports as $report) {
                                  
                            ?>
                                <tr>
                                    <td><?= $j++ ?></td>
                                    <td><?= $report['u_name'] ?></td>
                                    <td><?= $report['order_date'] ?></td>
                                    <td><?= $report['total_price'] ?></td>
                                    <!-- <td>
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="status" value="1">
                                            <input type="submit" name="" value="Accept" class="btn btn-outline-primary btn-sm" onclick="return confirm('Are You Sure Accept?')">
                                        </form>
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="status" value="11">
                                            <input type="submit" name="" value="Reject" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure Reject?')">
                                        </form>
                                    </td> -->
                                </tr>

                            <?php 
                                $total=$report['total_price'];
                                $sub_total+= $total;
                                }
                            ?>
                            <tr>
                                <td colspan="3" class="text-center font-weight-bold">Total Price</td>
                                <td class="font-weight-bold"><?= $sub_total ?></td>
                            </tr>
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