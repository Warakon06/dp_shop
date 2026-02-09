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
            				<h1 class="m-0">สมาชิก</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item"><a href="dashboard.php">แดชบอร์ด</a></li>
	              				<li class="breadcrumb-item active">สมาชิก</li>
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
                                                        <th style="text-align: center; font-weight: bold;">รหัสสมาชิก</th>
                                                        <th style="text-align: center; font-weight: bold;">รูป</th>
                                                        <th style="text-align: center; font-weight: bold;">ชื่อ-นามสกุล</th>
                                                        <th style="text-align: center; font-weight: bold;">ที่อยู่</th>
                                                        <th style="text-align: center; font-weight: bold;">เบอร์โทรศัพท์</th>
                                                        <th style="text-align: center; font-weight: bold;">อีเมล</th>
                                                        <th style="text-align: center; font-weight: bold;">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        //คิวรี่ดึงข้อมูลสมาชิก
                                                        $query = 'select 
                                                            a.member_id, a.first_name, a.last_name, a.village, a.home_no, 
                                                            a.soi, a.road, a.post_code, a.phone_number, a.email, 
                                                            a.province_id, a.district_id, a.subdistrict_id, 
                                                            b.name_th as province_name, c.name_th as district_name, 
                                                            d.name_th as subdistrict_name 
                                                            from member as a 
                                                            left outer join province as b on a.province_id = b.province_id 
                                                            left outer join district as c on a.district_id = c.district_id 
                                                            left outer join subdistrict as d on a.subdistrict_id = d.subdistrict_id
                                                            order by a.member_id desc';
                                                        $result = $con->prepare($query);
                                                        $result->execute();
                                                        //ถ้ามีข้อมูลสมาชิก
                                                        if ($result->rowCount()>0) {
                                                            //วนลูปเพื่อดึงข้อมูลออกมาโดยใช้ foreach
                                                            foreach ($result as $key => $val) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $val['member_id']; ?></td>
                                                        <td style="text-align: center;">
                                                            <?php 
                                                                $defaultPhoto = 'dist/img/default-150x150.png';
                                                                $photoPath = $defaultPhoto;
                                                                try {
                                                                    $chk = $con->query("SHOW COLUMNS FROM member LIKE 'photo'");
                                                                    if ($chk->rowCount()>0) {
                                                                        $stp = $con->prepare('select photo from member where member_id = :mid');
                                                                        $stp->execute(['mid' => $val['member_id']]);
                                                                        $rp = $stp->fetch();
                                                                        if ($rp && !empty($rp['photo'])) { $photoPath = '../img/member/'.$rp['photo']; }
                                                                    }
                                                                } catch (Exception $e) {}
                                                            ?>
                                                            <img src="<?php echo $photoPath; ?>" alt="profile" style="height:40px;width:40px;object-fit:cover;border-radius:50%;">
                                                        </td>
                                                        <td><?php echo $val['first_name'].' '.$val['last_name']; ?></td>
                                                        <td>
                                                            <?php 
                                                                echo 'เลขที่ '.$val['home_no']; 
                                                                if (!empty($val['village'])) { echo ' หมู่บ้าน/อาคาร '.$val['village']; }
                                                                if (!empty($val['soi'])) { echo ' ซอย '.$val['soi']; }
                                                                if (!empty($val['road'])) { echo ' ถนน '.$val['road']; }
                                                                echo $val['subdistrict_name'].' '.$val['district_name'].' '.$val['province_name'];
                                                                echo ' '.$val['post_code'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $val['phone_number']; ?></td>
                                                        <td><?php echo $val['email']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="#" onclick="editMember('<?php echo $val['member_id']; ?>')" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                                <a href="#" onclick="chPass('<?php echo $val['member_id']; ?>')" class="btn btn-info"><i class="fas fa-key"></i></a>
                                                                <a href="#" onclick="confirmDelete('<?php echo $val['member_id']; ?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
<div id="member-modal"></div>

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

    function editMember(member_id) {
        let data = new Object();
        data.mid = member_id;

        $('#member-modal').load('edit_member_modal.php', data, function(){
            $("#edit-member").modal('show');
        });
    } 

    function chPass(member_id) {
        let data = new Object();
        data.mid = member_id;

        $('#member-modal').load('change_member_password_modal.php', data, function(){
            $("#chpass-member").modal('show');
        });
    }

    function chLocal (objName, Value) {
        $.ajax({
            type : "post",
            url  : "select_location.php",
            data : {obj:objName, data:Value},
            success: function(response){
                    //console.log(response);

                if (objName=='province') {
                    $('#district').empty();
                    $('#district').append(response);
                } else if (objName=='district') {
                    $('#subdistrict').empty();
                    $('#subdistrict').append(response);
                } else if (objName=='subdistrict') {
                    $('#postcode').val(response);
                }
                $('.select2').select2();
            }
        });
    }

    function confirmDelete (member_id) {
        Swal.fire({
            title: "แน่ใจหรือว่าต้องการลบข้อมูลนี้?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "post",
                    url  : "delete_member.php",
                    data : {id_del:member_id},
                    success: function(response){
                        //console.log(response);
                        if (response=='true') {
                            Swal.fire({
                                title: 'ลบข้อมูลเรียบร้อย',
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            });
                        } else {
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'ไม่สามารถลบข้อมูลได้',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    }
                });
            }
        });
    }

    chPassForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        let isValid = true;

        if ($('#newpass1').val() != $('#newpass2').val()) {
            isValid = false;
        }

        if (isValid==true) {
            //console.log('Form submitted successfully!');
            chPassForm.submit();
        } else {
            //console.log('Form validation failed.');
            Swal.fire({
                title: 'รหัสผ่านไม่ตรงกัน!',
                text: 'กรุณาป้อนใหม่',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        }
    });
</script>
