<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//เช้คว่ามีการเข้าสู่ระบบหรือไม่
if (empty($_SESSION['role'])) {
    //ถ้าไม่มีการเข้าสู่ระบบให้กลับไปที่หน้า index และแสดงกล่องข้อความแจ้งเตือน
    gotopage('index.php?act=login_pls');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>ระบบจัดการ<?php echo $shop_name ?></title>
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
            				<h1 class="m-0">รายการสั่งซื้อ</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item"><a href="dashboard.php">แดชบอร์ด</a></li>
	              				<li class="breadcrumb-item active">รายการสั่งซื้อ</li>
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
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-primary card-outline">
              					<div class="card-header">
                					<h5 class="card-title m-0">               
                                    </h5>
                                    <div class="card-tools">
                                    </div>
              					</div>
              					<div class="card-body">
	                				<div class="row">
                                        <div class="col-md-12">
                                            <table id="example1" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; font-weight: bold;">เลขใบสั่งซื้อ</th>
                                                        <th style="text-align: center; font-weight: bold;">วัน-เวลา</th>
                                                        <th style="text-align: center; font-weight: bold;">ผู้สั่งซื้อ</th>
                                                        <th style="text-align: center; font-weight: bold;">จำนวนสินค้า</th>
                                                        <th style="text-align: center; font-weight: bold;">ยอดสั่งซื้อ</th>
                                                        <th style="text-align: center; font-weight: bold;">สถานะ</th>
                                                        <th style="text-align: center; font-weight: bold;">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $query = 'select 
                                                            a.orders_id, a.orders_date, a.sum_total, a.status, 
                                                            (select sum(amount) from orders_detail where orders_id = a.orders_id) as orders_amount,
                                                            case when a.status = 1 then "ยังไม่ชำระเงิน" 
                                                            when a.status = 2 then "รอตรวจสอบยอดเงิน" 
                                                            when a.status = 3 then "ชำระเงินแล้ว" 
                                                            when a.status = 4 then "พัสดุกำลังจัดส่ง" 
                                                            when a.status = 5 then "ได้รับสินค้าแล้ว" 
                                                            when a.status = 6 then "ยกเลิก" 
                                                            when a.status = 7 then "คืนสินค้า" 
                                                            when a.status = 8 then "ไม่รับคืนสินค้า" 
                                                            else "" end as status_name, 
                                                            concat(b.first_name, " ", b.last_name) as member_name, 
                                                            b.phone_number
                                                            from orders as a 
                                                            left outer join member as b on a.member_id = b.member_id 
                                                            order by a.orders_id desc ';
                                                        $result = $con->prepare($query);
                                                        $result->execute();
                                                        if ($result->rowCount()>0) {
                                                            foreach ($result as $key => $rs) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $rs['orders_id']; ?></td>
                                                        <td><?php echo thaidatetime($rs['orders_date']); ?></td>
                                                        <td><?php echo $rs['member_name']; ?></td>
                                                        <td><?php echo $rs['orders_amount']; ?></td>
                                                        <td><?php echo number_format($rs['sum_total'], 2); ?></td>
                                                        <td><?php echo $rs['status_name']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="#" onclick="ordersDetail('<?php echo $rs['orders_id']; ?>')" class="btn btn-info"><i class="fas fa-search"></i></a>
                                                                <?php if ($rs['status']!=6) { ?>
                                                                <a href="#" onclick="cancelOrders('<?php echo $rs['orders_id']; ?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } } ?>
                                                </tbody>
                                            </table>
                                        </div>               
                                    </div>
              					</div>
              					<div class="card-footer">
              					</div>
            				</div>
            				<!-- End Card -->
      					</div>
      				</div>
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
<!-- Modal -->
<div id="orders-modal"></div>

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

        <?php 
            if (!empty($_GET['act'])) { 
                if ($_GET['act']=='save_success') {
        ?>
            Swal.fire({
                title: 'บันทึกข้อมูลเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            });
        <?php } else if ($_GET['act']=='save_error') { ?>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด!',
                text: 'ไม่สามารถบันทึกข้อมูลได้',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        <?php } else if ($_GET['act']=='save_duplicate') { ?>
            Swal.fire({
                title: 'ไม่สามารถบันทึกข้อมูลได้!',
                text: 'ชื่อหมวดหมู่ซ้ำ',
                icon: 'warning',
                confirmButtonText: 'ตกลง'
            });
        <?php } else if ($_GET['act']=='save_duplicate') { ?>
            Swal.fire({
                title: 'แจ้งเตือน!',
                text: 'ชื่อหมวดหมู่ซ้ำ',
                icon: 'warning',
                confirmButtonText: 'ตกลง'
            });
        <?php } else if ($_GET['act']=='del_success') { ?>
            Swal.fire({
                title: 'ลบข้อมูลเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            });
        <?php } else if ($_GET['act']=='del_error') { ?>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด!',
                text: 'ไม่สามารถลบข้อมูลได้',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        <?php } } ?>
    });

    function ordersDetail(orders_id) {
        let data = new Object();
        data.orid = orders_id;

        $('#orders-modal').load('orders_detail_modal.php', data, function(){
            $("#orders-detail").modal('show');
        });
    }

    function cancelOrders (orders_id) {
        Swal.fire({
            title: "คุณแน่ใจหรือว่าต้องการยกเลิก?",
            text: 'กรุณากดปุ่ม "ยืนยัน"" เพื่อทำการยกเลิก',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "post",
                    url  : "cancel_orders.php",
                    data : {id_cncl:orders_id},
                    success: function(response){
                        //console.log(response);
                        if (response=='true') {
                            top.window.location='orders.php?act=cncl_success';
                        } else {
                            top.window.location='orders.php?act=cncl_error';
                        }
                    }
                });
            }
        });
    }
</script>