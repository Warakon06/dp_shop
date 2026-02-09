<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

if (isset($_SESSION['sess_id'])=='') {
    gotopage('index.php?act=login_pls');
}

if (!empty($_POST['year'])) {
    $year = $_POST['year'];
} else { $year = $curyear_en; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $shop_name; ?></title>
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  	<!-- Tempusdominus Bootstrap 4 -->
  	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/adminlte.min.css">
  	<!-- Google Font Sarabun -->
  	<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@500&display=swap" rel="stylesheet"> 
    <style type="text/css" media="screen">
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>
<!-- Navba Fixed -->
<!-- <body class="hold-transition sidebar-mini layout-navbar-fixed"> -->
<!-- Side bar Collapse -->
<!-- <body class="hold-transition sidebar-mini sidebar-collapse"> -->
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div>
		<?php 
			include 'template/header.php'; 
			include 'template/side_menu.php';
		?>
		<!-- Content Wrapper. Contains page content -->
  		<div class="content-wrapper">

  			<!-- Content Header (Page header) -->
    		<div class="content-header">
      			<div class="container-fluid">
        			<div class="row mb-2">
          				<div class="col-sm-6">
            				<h1 class="m-0">แดชบอร์ด</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item active">แดชบอร์ด</li>
	            			</ol>
	          			</div>
	          			<!-- /.col -->
        			</div>
        			<!-- /.row -->
      			</div>
      			<!-- /.container-fluid -->
    		</div>
    		<!-- /.content-header -->
			
			<!-- Main content -->
    		<section class="content">
      			<div class="container-fluid">
                    <form action="dashboard.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="month" class="form-control select2">
                                                    <option value="">เดือน</option>
                                                    <?php
                                                        foreach ($thaiMonths as $key => $value) {
                                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="year" class="form-control select2" required>
                                                    <option value="">ปี</option>
                                                    <?php
                                                        echo '<option value="'.$curyear_en.'">'.$curyear_th.'</option>'; 
                                                        for ($i=0; $i < 3; $i++) { 
                                                            echo '<option value="'.($curyear_en-$i).'">'.($curyear_th-$i).'</option>'; 
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-warning" type="submit">แสดงผล</button>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            กำลังแสดงผลข้อมูลของ 
                                            <?php if (!empty($_POST['month'])) { echo 'เดือน: '.thaiMonthName($_POST['month']).' '; } ?>
                                            <?php echo 'ปี: '.($year + 543); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                    <!-- End row -->
                    </form>

                    <div class="row">
                        <div class="col-lg-3 col-6">
                        <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                        $query_static = 'select coalesce( sum(sum_total), 0) as sum_sale 
                                            from orders 
                                            where status in (3,4,5) and year(orders_date) = :year ';
                                        if (!empty($_POST['month'])) {
                                            $query_static .= ' and month(orders_date) = '.$_POST['month'];
                                        }
                                        $result_static = $con->prepare($query_static);
                                        $result_static->execute(['year' => $year]);
                                        $rs_static = $result_static->fetch();
                                    ?>
                                    <h3><?php echo number_format($rs_static['sum_sale'], 0); ?> <sup style="font-size: 20px">฿</sup></h3>
                                    <p>ยอดขาย</p>
                                </div>
                                <div class="icon"><i class="fas fa-cash-register"></i></div>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                        $query_static = 'select count(orders_id) as sum_orders 
                                            from orders 
                                            where year(orders_date) = :year ';
                                        if (!empty($_POST['month'])) {
                                            $query_static .= ' and month(orders_date) = '.$_POST['month'];
                                        }
                                        $result_static = $con->prepare($query_static);
                                        $result_static->execute(['year' => $year]);
                                        $rs_static = $result_static->fetch();
                                    ?>
                                    <h3><?php echo $rs_static['sum_orders']; ?><!-- <sup style="font-size: 20px">%</sup> --></h3>
                                    <p>รายการสั่งซื้อ</p>
                                </div>
                                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                        $query_static = 'select count(product_id) as sum_product 
                                            from product ';
                                        $result_static = $con->prepare($query_static);
                                        $result_static->execute();
                                        $rs_static = $result_static->fetch();
                                    ?>
                                    <h3><?php echo $rs_static['sum_product']; ?></h3>
                                    <p>สินค้า</p>
                                </div>
                                <div class="icon"><i class="fas fa-warehouse"></i></div>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                        $query_static = 'select count(member_id) as sum_member 
                                            from member ';
                                        $result_static = $con->prepare($query_static);
                                        $result_static->execute();
                                        $rs_static = $result_static->fetch();
                                    ?>
                                    <h3><?php echo $rs_static['sum_member']; ?></h3>
                                    <p>สมาชิก</p>
                                </div>
                                <div class="icon"><i class="fas fa-users"></i></div>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    
                    <?php if (!empty($_POST['month'])) { ?>
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-primary card-outline">
              					<div class="card-header">
                					<h5 class="card-title m-0">ยอดขายรายวัน</h5>
              					</div>
              					<div class="card-body">
	                				<div id="forDay" style="width: 100%;"></div> 
              					</div>
            				</div>
            				<!-- End Card -->
      					</div>
      				</div>
      				<!-- End row -->
                    <?php } else { ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">ยอดขายรายเดือน</h5>
                                </div>
                                <div class="card-body">
                                    <div id="forMonth" style="width: 100%;"></div> 
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                    <!-- End row -->
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">สินค้าขายดี</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="bestSeller" style="width: 100%;"></div> 
                                        </div>
                                    </div>
                                    <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                                $query2 = 'select 
                                                    b.product_id, count(b.amount) as sum_sell, 
                                                    c.name as product_name
                                                    from orders as a, orders_detail as b 
                                                    left outer join product as c on b.product_id = c.product_id   
                                                    where
                                                    a.orders_id = b.orders_id  
                                                    and a.status in (3,4,5) 
                                                    and year(a.orders_date) = :wyear 
                                                    ';
                                                if (!empty($_POST['month'])) {
                                                    $query2 .= ' and month(a.orders_date) = '.$_POST['month'];
                                                }
                                                $query2 .= ' 
                                                    group by b.product_id 
                                                    order by b.product_id desc 
                                                    limit 5 ';
                                                $result2 = $con->prepare($query2);
                                                $result2->execute(['wyear' => $year]);
                                                if ($result2->rowCount()>0) { 
                                            ?>
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; font-weight: bold;">อันดับ</th>
                                                        <th style="text-align: center; font-weight: bold;">สินค้า</th>
                                                        <th style="text-align: center; font-weight: bold;">ขาย (ชิ้น)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($result2 as $key => $value) { ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo ($key+1) ?></td>
                                                        <td><?php echo $value['product_name']; ?></td>
                                                        <td><?php echo $value['sum_sell']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">สินค้ายอดนิยม</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; font-weight: bold;">อันดับ</th>
                                                <th style="text-align: center; font-weight: bold;">สินค้า</th>
                                                <th style="text-align: center; font-weight: bold;">คะแนนเฉลี่ย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query2 = 'select 
                                                    c.name as product_name, 
                                                    (select count(review_id) from review_product where orders_id = a.orders_id 
                                                        and product_id = b.product_id) as count_orders, 
                                                    (select coalesce(sum(score), 0) from review_product where orders_id = a.orders_id 
                                                        and product_id = b.product_id) as sum_score 
                                                    from orders as a, orders_detail as b 
                                                    left outer join product as c on b.product_id = c.product_id 
                                                    where 
                                                    a.orders_id = b.orders_id 
                                                    and a.status in (3,4,5) 
                                                    and year(a.orders_date) = :wyear 
                                                    group by b.product_id 
                                                    order by sum_score desc ';
                                                $result2 = $con->prepare($query2);
                                                $result2->execute(['wyear' => $year]); 
                                                if ($result2->rowCount()>0) {
                                                    foreach ($result2 as $key => $value) {
                                                        if ($value['sum_score']!=0) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo ($key +1); ?></td>
                                                <td><?php echo $value['product_name']; ?></td>
                                                <td style="text-align: center;"><?php echo number_format($value['sum_score'] / $value['count_orders'], 1); ?></td>
                                            </tr>
                                            <?php } } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                    <!-- End row -->

                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">สินค้าขายดี</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">รายการขอคืนสินค้า</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- End row -->

      			</div>
			</section>
			<!-- End Section -->
  		</div>
  		<!-- End Main Content -->

  		<?php include 'template/footer.php'; ?>
	</div>
	<!-- End Wrapper -->
</body>
</html>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(function(){
        $('.select2').select2();
    });

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        <?php if (!empty($_POST['month'])) { ?>
        ///////// กราฟรายวัน
        // Some raw data (not necessarily accurate)
        var dataForDay = google.visualization.arrayToDataTable([
            ['วันที่', 'ยอดขาย', { role: 'annotation' } ],
            <?php
                $day_of_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                for ($i=0; $i <= $day_of_month ; $i++) { 
                    $wdate = date("Y-m-").str_pad($i,2, "0", STR_PAD_LEFT);
                    $query_sum_sale_of_day = 'select 
                        coalesce(sum(sum_total), 0) as sum_sale 
                        from orders 
                        where date(orders_date) = :wdate 
                        and status in (3,4,5) ';
                    $result_sum_sale_of_day = $con->prepare($query_sum_sale_of_day);
                    $result_sum_sale_of_day->execute(['wdate' => $wdate]);
                    if ($result_sum_sale_of_day->rowCount()>0) {
                        $rs_sum_sale_of_day = $result_sum_sale_of_day->fetch();
                    }
            ?>
            ['<?php echo $i; ?>',  <?php echo $rs_sum_sale_of_day['sum_sale']; ?>, <?php echo $rs_sum_sale_of_day['sum_sale']; ?>]
            <?php 
                if ($i==$day_of_month) { echo ''; } else { echo ','; }
                } 
            ?>
        ]);

        var optionsForDay = {
          title : '',
          vAxis: {title: 'ยอดขาย (บาท)'},
          hAxis: {title: 'วันที่'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chartForDay = new google.visualization.ComboChart(document.getElementById('forDay'));
        chartForDay.draw(dataForDay, optionsForDay);

        <?php } else { ?>

        ////////////// กราฟรายเดือน
        
        var dataForMonth = google.visualization.arrayToDataTable([
            ['เดือน', 'ยอดขาย', { role: 'annotation' } ],
            <?php 
                for ($i=1; $i <= 12; $i++) { 
                    $wmonth = str_pad($i, 2, "0", STR_PAD_LEFT);
                    $thaimonth = thaiMonthName($wmonth);
                    $query_sum_sale_of_month = 'select 
                        coalesce(sum(sum_total), 0) as sum_sale 
                        from orders 
                        where month(orders_date) = :wmonth 
                        and year(orders_date) = :wyear  
                        and status in (3,4,5) ';
                    $result_sum_sale_of_month = $con->prepare($query_sum_sale_of_month);
                    $result_sum_sale_of_month->execute([
                        'wmonth'    => $wmonth, 
                        'wyear'     => $year 
                    ]);
                    if ($result_sum_sale_of_month->rowCount()>0) {
                        $rs_sum_sale_of_month = $result_sum_sale_of_month->fetch();
                    }
            ?>
            ['<?php echo $thaimonth; ?>', <?php echo $rs_sum_sale_of_month['sum_sale']; ?>, <?php echo $rs_sum_sale_of_month['sum_sale']; ?>]
            <?php 
                if ($i==12) { echo ''; } else { echo ','; }
                }
            ?>
        ]);

        var optionsForMonth = {
            title : '',
            vAxis: {title: 'ยอดขาย (บาท)'},
            hAxis: {title: 'เดือน'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };

        var chartForMonth = new google.visualization.ComboChart(document.getElementById('forMonth'));

        chartForMonth.draw(dataForMonth, optionsForMonth);
        <?php } ?>

        ///////////// สินค้าขายดี
        var dataBestSeller = google.visualization.arrayToDataTable([
            ['สินค้า', 'จำนวนที่ขาย'],
            <?php 
                $query_best_seller = 'select 
                    b.product_id, count(b.amount) as sum_sell, 
                    c.name as product_name 
                    from orders as a, orders_detail as b 
                    left outer join product as c on b.product_id = c.product_id   
                    where
                    a.orders_id = b.orders_id  
                    and a.status in (3,4,5) 
                    and year(a.orders_date) = :wyear 
                ';
                if (!empty($_POST['month'])) {
                    $query_best_seller .= ' and month(a.orders_date) = '.$_POST['month'];
                }
                $query_best_seller .= ' 
                    group by b.product_id 
                    order by b.product_id desc 
                    limit 10 ';
                $result_best_seller = $con->prepare($query_best_seller);
                $result_best_seller->execute(['wyear' => $year]);

                foreach ($result_best_seller as $key => $value) {
            ?>
            ['<?php echo $value['product_name']; ?>', <?php echo $value['sum_sell']; ?>]
            <?php 
                if ($key==$result_best_seller->rowCount()) { echo ''; } else { echo ','; }
                }
            ?>
        ]);

        var optionsbestSeller = {
          title: ''
        };

        var chartBestSeller = new google.visualization.PieChart(document.getElementById('bestSeller'));

        chartBestSeller.draw(dataBestSeller, optionsbestSeller);

        //////////// คะแนนสินค้า
        
        //////////// ขอคืนสินค้า
    }
</script>