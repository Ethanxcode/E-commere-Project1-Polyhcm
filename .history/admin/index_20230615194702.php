﻿<?php include 'inc/part1.php'; ?>
<?php include 'inc/part2.php'; ?>
<?php include '../classes/user.php'; ?>

<?php
$user = new user();
$show_index = $user->show_index();
$cart1 = 0;
$cart2 = 0;
$cart3 = 0;
$cart4 = 0;
if ($show_index) {
    foreach ($show_index as $result) {
        $cart1 += $result['sales'];
        $cart2 += $result['price'] * 1.1;
    }
}

?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sản Phẩm Đã Bán</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $cart1 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng doanh thu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$
                                <?php echo $cart2 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Chỉ tiêu (
                                <?php echo $cart1 ?>/1000 )
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php echo $cart1 / 10 ?>%
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: <?php echo $cart1 / 10 ?>%" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center justify-content-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Đơn cần xử lý</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <!-- <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Đơn cần xử lý</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div> -->
                        <div id="adminChart" style="width:100%;  height:250px"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Primary
                    <div class="text-white-50 small">#4e73df</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    Success
                    <div class="text-white-50 small">#1cc88a</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    Info
                    <div class="text-white-50 small">#36b9cc</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    Warning
                    <div class="text-white-50 small">#f6c23e</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    Danger
                    <div class="text-white-50 small">#e74a3b</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    Secondary
                    <div class="text-white-50 small">#858796</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-light text-black shadow">
                <div class="card-body">
                    Light
                    <div class="text-black-50 small">#f8f9fc</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    Dark
                    <div class="text-white-50 small">#5a5c69</div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<?php include 'inc/part4.php'; ?>