<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ระบบจัดการ<?php echo $shop_name ?></title>
	<!-- Font Awesome -->
  	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  	<!-- icheck bootstrap -->
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
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
    		<a href="#"><b>ระบบจัดการ</b><?php echo $shop_name; ?></a>
  		</div>

  		<!-- /.login-logo -->
  		<div class="card">
    		<div class="card-body login-card-body">
      			<p class="login-box-msg">แบบฟอร์มลงชื่อเข้าใช้งาน</p>
      			<form action="chklogin.php" method="post">
        			<div class="input-group mb-3">
          				<input type="text" class="form-control" name="user" autofocus placeholder="อีเมล" required>
          				<div class="input-group-append">
            				<div class="input-group-text">
              					<span class="fas fa-envelope"></span>
            				</div>
          				</div>
        			</div>

        			<div class="input-group mb-3">
          				<input type="password" class="form-control" name="pass" placeholder="รหัสผ่าน" required>
          				<div class="input-group-append">
            				<div class="input-group-text">
              					<span class="fas fa-lock"></span>
            				</div>
          				</div>
        			</div>

        			<div class="row">
          				<div class="col-12">
            				<button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
          				</div>
          				<!-- /.col -->
        			</div>
      			</form>

      			<div class="social-auth-links text-center mb-3">
        			<p>- หรือ -</p>
        			<a href="../index.php" class="btn btn-block btn-warning">
        				กลับหน้าร้าน
        			</a>
      			</div>
      			<!-- /.social-auth-links -->
    		</div>
    		<!-- /.login-card-body -->
  		</div>
	</div>
</body>
</html>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
    $(function () {
        <?php 
            if (!empty($_GET['act'])) { 
                if ($_GET['act']=='login_error') {
        ?>
            Swal.fire({
                title: '',
                text: 'ไม่มีข้อมูล',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        <?php } } ?>
    });
</script>
