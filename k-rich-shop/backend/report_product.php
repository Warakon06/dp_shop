<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

if (isset($_SESSION['sess_id'])=='') {
    gotopage('index.php?act=login_pls');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>รายงานสินค้า</title>
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  	<!-- Tempusdominus Bootstrap 4 -->
  	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/dist/css/bootstrap-datepicker.css"  />
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Sweet alert 2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@500&display=swap" rel="stylesheet">
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
            				<h1 class="m-0">รายงานสินค้า</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item"><a href="dashboard.php">แดชบอร์ด</a></li>
	              				<li class="breadcrumb-item active">รายงานสินค้า</li>
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
                    <form action="report_product.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h5 class="card-title m-0"></h5>
                                        <div class="card-tools">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cat">หมวดหมู่สินค้า</label>
                                                    <select name="cat" class="form-control select2">
                                                        <option value="">แสดงทั้งหมด</option>
                                                        <?php
                                                            $query2 = 'select * from category ';
                                                            $result2 = $con->prepare($query2);
                                                            $result2->execute(); 
                                                            if ($result2->rowcount()>0) {
                                                                foreach ($result2 as $key2 => $value2) {
                                                                    echo '<option value="'.$value2['category_id'].'">'.$value2['name'].'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="show_status" value="1">
                                                <button class="btn btn-info" type="submit"><i class="fas fa-search"></i> แสดงผล</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </form>
                    <?php if (!empty($_POST['show_status'])) { ?>
                    <hr>
      				<div class="row">
      					<div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        รายงานสินค้า 
                                    </h3>
                                    <br>
                                    <p>
                                        <?php 
                                            if (!empty($_POST['cat'])) {
                                                $query2 = 'select * from category where category_id = :cat ';
                                                $result2 = $con->prepare($query2);
                                                $result2->execute(['cat' => $_POST['cat']]);
                                                if ($result2->rowCount()>0) {
                                                    $rs2 = $result2->fetch();
                                                    echo '<b>หมวดหมู่สินค้า: </b>'.$rs2['name'];
                                                }
                                            } 
                                        ?>
                                    </p>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="example1" class="table table-bordered table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; font-weight: bold;">&nbsp;</th>
                                        <th style="text-align: center; font-weight: bold;">หมวดหมู่</th>
                                        <th style="text-align: center; font-weight: bold;">รายการ</th>
                                        <th style="text-align: center; font-weight: bold;">จำนวน</th>
                                        <th style="text-align: center; font-weight: bold;">ราคา/หน่วย</th>
                                        <th style="text-align: center; font-weight: bold;">ขายไปแล้ว</th>
                                        <th style="text-align: center; font-weight: bold;">คะแนนรีวิว</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = 'select 
                                            a.name, a.amount, a.unit, a.price, 
                                            b.name as category_name, c.photo, 
                                            (select sum(orders_detail.amount) from orders 
                                                left outer join orders_detail on orders.orders_id = orders_detail.orders_id 
                                                where orders.status in (3,4,5) ) as sum_sell, 
                                            (select count(review_id) from review_product where 
                                                review_product.product_id = a.product_id ) as count_product_review, 
                                            (select sum(score) from review_product where 
                                                review_product.product_id = a.product_id ) as sum_product_score
                                            from product as a 
                                            left outer join category as b on a.category_id = b.category_id 
                                            left outer join product_photo as c on a.product_id = c.product_id 
                                            and c.active = 1
                                            ';
                                        if (!empty($_POST['cat'])) { $query.=' where a.category_id = '.$_POST['cat']; }
                                        $query .= ' order by a.product_id desc ';
                                        $result = $con->prepare($query);
                                        $result->execute();
                                        if ($result->rowCount()>0) {
                                            foreach ($result as $key => $value) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <img src="../img/product/<?php echo $value['photo']; ?>" alt="" width="80px;">
                                        </td>
                                        <td style="text-align: center;"><?php echo $value['category_name']; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($value['amount']=='-1') { echo 'ไม่จำกัด'; } else { echo $value['amount']; } ?>
                                        </td>
                                        <td style="text-align: center;"><?php echo number_format($value['price'], 2).' / '.$value['unit']; ?></td>
                                        <td style="text-align: center;"><?php echo number_format($value['sum_sell']); ?></td>
                                        <td style="text-align: center;">
                                            <?php if (!empty($value['count_product_review']) and !empty($value['sum_product_score'])) { 
                                                    echo number_format(($value['sum_product_score'] / $value['count_product_review']) , 1);
                                                } 
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                                </div>
                            </div>
                            <!-- end card -->
      					</div>
      				</div>
                    <p>&nbsp;</p>
      				<!-- End row -->
                    <?php } ?>
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
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Date Picker -->
<script type="text/javascript" src="plugins/datepicker/dist/js/bootstrap-datepicker-custom.js"></script>
<script type="text/javascript" src="plugins/datepicker/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "print"]
        }).buttons()
        .container()
        .appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('.select2').select2();
    });
</script>