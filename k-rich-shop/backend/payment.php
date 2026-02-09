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
            				<h1 class="m-0">รายการชำระเงิน</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item"><a href="dashboard.php">แดชบอร์ด</a></li>
	              				<li class="breadcrumb-item active">รายการชำระเงิน</li>
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
                                                        <th style="text-align: center; font-weight: bold;">ยอดสั่งซื้อ</th>
                                                        <th style="text-align: center; font-weight: bold;">วิธีการชำระเงิน</th>
                                                        <th style="text-align: center; font-weight: bold;">หลักฐาน</th>
                                                        <th style="text-align: center; font-weight: bold;">สถานะ</th>
                                                        <th style="text-align: center; font-weight: bold;">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $query = 'select 
                                                            orders_id, sum_total, payment_method, slip, 
                                                            card_no, expire_month, expire_year, card_name, 
                                                            card_code, status, 
                                                            case when payment_method = 1 then "โอนเข้าบัญชี" 
                                                            when payment_method = 2 then "บัตรเครดิต/เดบิต" 
                                                            when payment_method = 3 then "สแกนจ่าย" 
                                                            else "" end as payment_method_name, 
                                                            case when status = 1 then "ยังไม่ชำระเงิน" 
                                                            when status = 2 then "รอตรวจสอบยอดเงิน" 
                                                            when status = 3 then "ชำระเงินแล้ว" 
                                                            when status = 4 then "ชำระเงินแล้ว" 
                                                            when status = 5 then "ชำระเงินแล้ว"
                                                            when status = 6 then "ยกเลิก"  
                                                            when status = 7 then "ชำระเงินแล้ว" 
                                                            when status = 8 then "ชำระเงินแล้ว" 
                                                            else "" end as status_name 
                                                            from orders 
                                                            ';
                                                        $result = $con->prepare($query);
                                                        $result->execute();
                                                        if ($result->rowCount()>0) {
                                                            foreach ($result as $key => $value) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $value['orders_id']; ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($value['sum_total'], 2); ?></td>
                                                        <td><?php echo $value['payment_method_name']; ?></td>
                                                        <td>
                                                            <?php if ($value['status']!=6  
                                                                and $value['payment_method']==1  
                                                                or $value['payment_method']==3) { ?>
                                                            <a href="../img/slip/<?php echo $value['slip']; ?>" target="_new"><i class="fa fa-search"></i></a>
                                                            <?php 
                                                                } else if ($value['status']!=6 and $value['payment_method']==2) {
                                                                    echo 'เลขบัตร '.$value['card_no'].'<br>';
                                                                    echo 'หมดอายุ '.$value['expire_month'].' / '.$value['expire_year'].'<br>';
                                                                    echo 'ชื่อผู้ถือ '.$value['card_name'];
                                                                }
                                                            ?>
                                                        </td>
                                                        <td style="text-align: center;"><?php echo $value['status_name']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php if ($value['status']==3 or $value['status']==4 or $value['status']==5) { ?>
                                                                <a href="print_receipt.php?orid=<?php echo $value['orders_id']; ?>" target="_new" class="btn btn-info"><i class="fas fa-print"></i></a>
                                                                <?php } ?>
                                                                <?php if ($value['status']==2) { ?>
                                                                <a href="#" onclick="confirmPayment('<?php echo $value['orders_id']; ?>','3')" class="btn btn-success"><i class="fas fa-check"></i></a>
                                                                <a href="#" onclick="cancelPayment('<?php echo $value['orders_id']; ?>','1')" class="btn btn-danger"><i class="fas fa-times"></i></a>
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
<div id="product-modal"></div>

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

    function confirmPayment (orders_id, status) {
        Swal.fire({
            title: "ยืนยันการชำระเงิน?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "post",
                    url  : "update_payment.php",
                    data : {orid:orders_id,status:status},
                    success: function(response){
                        //console.log(response);
                        if (response=='true') {
                            Swal.fire({
                                title: 'บันทึกข้อมูลเรียบร้อย',
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    top.window.location='payment.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'ไม่สามารถบันทึกข้อมูลได้',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    top.window.location='payment.php';
                                }
                            });
                        }
                    }
                });
            }
        });
    }

    function cancelPayment (orders_id, status) {
        Swal.fire({
            title: "ต้องการยกเลิกรายการนี้?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "post",
                    url  : "update_payment.php",
                    ddata : {orid:orders_id,status:status},
                    success: function(response){
                        //console.log(response);
                        if (response=='true') {
                            Swal.fire({
                                title: 'ยกเลิกข้อมูลเรียบร้อย',
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    top.window.location='payment.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'ไม่สามารถลบข้อมูลได้',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    top.window.location='payment.php';
                                }
                            });
                        }
                    }
                });
            }
        });
    }
</script>