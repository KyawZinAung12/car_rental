<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Car Rental</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <link href="css/styles.css" rel="stylesheet" />

        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Car Rental</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto mr-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">Pofile</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>                           
                            <div class="sb-sidenav-menu-heading">Order</div>
                            <a class="nav-link" href="order_list.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Order
                            </a>
                            <a class="nav-link " href="#" data-bs-toggle="collapse" data-bs-target="#accepted" aria-expanded="false" aria-controls="accepted">
                                <div class="sb-nav-link-icon"><i class="fas fa-people-carry"></i></div>
                                Accepted Order
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse show" id="accepted" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!-- <a class="nav-link" href="pending_order.php">Pending</a> -->
                                    <a class="nav-link" href="complete_order.php">Confirm List</a>
                                    <a class="nav-link" href="reject_order.php">Reject List</a>
                                    
                                </nav>
                            </div>
                            
                            <div class="sb-sidenav-menu-heading">Items</div>
                            <a class="nav-link" href="car_list.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Cars List
                            </a>
                            <a class="nav-link" href="car_type_list.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cube"></i></div>
                                Car Type List
                            </a>
                            <a class="nav-link" href="driver_list.php">
                                <div class="sb-nav-link-icon"><i class="fab fa-uncharted"></i></div>
                                Driver List
                            </a>
                            
                            <a class="nav-link" href="user_list.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                User List
                            </a>
                            <a class="nav-link" href="feedback.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Feedback List
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['loginuser']['name']; ?> 
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>