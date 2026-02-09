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
  	<title>รายงานการจัดส่งสินค้า</title>
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
            				<h1 class="m-0">รายงานการจัดส่งสินค้า</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item"><a href="dashboard.php">แดชบอร์ด</a></li>
	              				<li class="breadcrumb-item active">รายงานการจัดส่งสินค้า</li>
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
                    <form action="report_delivery.php" method="post">
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
                                                    <label for="stdate">ตั้งแต่วันที่</label>
                                                    <input type="text" class="form-control" name="stdate" id="stdate" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="endate">ถึงวันที่</label>
                                                    <input type="text" class="form-control" name="endate" id="endate" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">สถานะ</label>
                                                    <select name="status" class="form-control select2" requierd>
                                                        <option value="">แสดงทั้งหมด</option>
                                                        <option value="4">พัสดุกำลังจัดส่ง</option>
                                                        <option value="5">ได้รับสินค้าแล้ว</option>
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
                    <?php  if (!empty($_POST['show_status'])) { ?>
                    <hr>
      				<div class="row">
      					<div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        รายงานการจัดส่งสินค้า
                                    </h3>
                                    <br>
                                    <p>
                                        <?php 
                                            if (!empty($_POST['stdate']) and !empty($_POST['endate'])) {
                                                echo '<b>ตั้งแต่วันที่: </b>'.$_POST['stdate'].' <b>ถึงวันที่: </b>'.$_POST['endate'];
                                            } 
                                            if (!empty($_POST['status'])) {
                                                echo '<br><b>สถานะ: </b>';
                                                switch ($_POST['status']) {
                                                    case '1':
                                                        echo 'พัสดุกำลังจัดส่ง';
                                                        break;
                                                    case '2':
                                                        echo 'ได้รับสินค้าแล้ว';
                                                        break;
                                                    default:
                                                        echo 'แสดงทั้งหมด';
                                                        break;
                                                }
                                            }
                                        ?>
                                    </p>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="example1" class="table table-bordered table-hover table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; font-weight: bold;">เลขใบสั่งซื้อ</th>
                                                <th style="text-align: center; font-weight: bold;">วัน-เวลาที่สั่งซื้อ</th>
                                                <th style="text-align: center; font-weight: bold;">ที่อยู่จัดส่ง</th>
                                                <th style="text-align: center; font-weight: bold;">วัน-เวลาที่จัดส่ง</th>
                                                <th style="text-align: center; font-weight: bold;">เลขพัสดุ</th>
                                                <th style="text-align: center; font-weight: bold;">ได้รับสินค้า</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = 'select 
                                                        a.orders_id, a.orders_date, a.delivery_date, a.delivery_time, 
                                                        a.delivery_track, a.get_orders_date, 
                                                        concat(b.first_name, " ", b.last_name) as member_name, 
                                                        b.phone_number, b.home_no ,b.village, b.soi, b.road, 
                                                        c.name_th as province_name, d.name_th as district_name, 
                                                        e.name_th as subdistrict_name, b.post_code
                                                    from orders as a, member as b 
                                                    left outer join province as c on b.province_id = c.province_id 
                                                    left outer join district as d on b.district_id = d.district_id 
                                                    left outer join subdistrict as e on b.subdistrict_id = e.subdistrict_id 
                                                    where 
                                                    a.member_id = b.member_id 
                                                    and date(a.orders_date) >= :stdate 
                                                    and date(a.orders_date) <= :endate 
                                                ';
                                                if (!empty($_POST['status'])) {
                                                    $query .= ' and a.status = '.$_POST['status'];
                                                    /*
                                                    if ($_POST['status']==4) {
                                                        $query .= ' and a.status = '.$_POST['status'];
                                                    } else {
                                                        $query .= ' and a.status not in (1,2,3,6,7) ';
                                                    }*/
                                                } else {
                                                    $query .= ' and a.status not in (1,2,3,6,7) ';
                                                }
                                                //echo $query;
                                                $result = $con->prepare($query);
                                                $result->execute([
                                                    'stdate'    => todate($_POST['stdate']), 
                                                    'endate'    => todate($_POST['endate']) 
                                                ]);

                                                if ($result->rowCount()>0) { $sum_total = 0;
                                                    foreach ($result as $key => $value) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $value['orders_id']; ?></td>
                                                <td style="text-align: center;"><?php echo thaidatetime($value['orders_date']); ?></td>
                                                <td>
                                                    <?php
                                                        echo $value['member_name'].'<br>';
                                                        if (!empty($value['village'])) { echo $value['village']; }
                                                        echo ' เลขที่ '.$value['home_no'];
                                                        if (!empty($value['soi'])) { echo ' ซอย'.$value['soi']; }
                                                        if (!empty($value['road'])) { echo ' ถนน'.$value['road']; }
                                                        echo '<br>ตำบล'.$value['subdistrict_name'];
                                                        echo ' อำเภอ'.$value['district_name'];
                                                        echo ' จังหวัด'.$value['province_name'];
                                                        echo '<br>รหัสไปรษณีย์ '.$value['post_code'];
                                                    ?>
                                                </td>
                                                <td style="text-align: right;"><?php if (!empty($value['delivery_date'])) { echo thaidate($value['delivery_date']).' '.$value['delivery_time']; } ?></td>
                                                <td style="text-align: center;"><?php echo $value['delivery_track']; ?></td> 
                                                <td style="text-align: center;"><?php if (!empty($value['get_orders_date'])) { echo thaidate($value['get_orders_date']); } ?></td> 
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
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Extra Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal -->
<div id="my-modal"></div>

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

        $('#stdate').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true              //Set เป็นปี พ.ศ.
        });  //กำหนดเป็นวันปัจุบัน

        $('#endate').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true              //Set เป็นปี พ.ศ.
        });  //กำหนดเป็นวันปัจุบัน
    });
</script>