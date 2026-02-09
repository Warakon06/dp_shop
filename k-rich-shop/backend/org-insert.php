<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

/*if (isset($_SESSION['sess_id'])=='') {
    gotopage('index.php?act=login_pls');
}*/
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
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/dist/css/bootstrap-datepicker.css"  />
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
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
            				<h1 class="m-0">Insert Forms</h1>
          				</div>
          				<!-- /.col -->
	          			<div class="col-sm-6">
	            			<ol class="breadcrumb float-sm-right">
	              				<li class="breadcrumb-item"><a href="#">Home</a></li>
	              				<li class="breadcrumb-item active">Insert Forms</li>
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
                					<h5 class="card-title m-0">Featured</h5>
              					</div>
              					<div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name="exampleInputEmail1" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date Picker</label>
                                                <input type="text" class="form-control" name="date" id="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Select Box</label>
                                                <select name="" class="form-control">
                                                    <option value="">- เลือก -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Select2</label>
                                                <select class="form-control select2" style="width: 100%;">
                                                    <option value="">- เลือก -</option>
                                                    <option value="">Alaska</option>
                                                    <option value="">California</option>
                                                    <option value="">Delaware</option>
                                                    <option value="">Tennessee</option>
                                                    <option value="">Texas</option>
                                                    <option value="">Washington</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1">Select2 Multiple</label>
                                            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary1" checked>
                                                <label for="checkboxPrimary1">Checkbox</label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary1" name="r1" checked>
                                                <label for="radioPrimary1">Radio Button</label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary2" name="r1">
                                                <label for="radioPrimary2"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Editor</label>
                                            <textarea name="detail" id="detail" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea id="codeMirrorDemo" class="p-3">
                                                <div class="info-box bg-gradient-info">
                                                    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Bookmarks</span>
                                                        <span class="info-box-number">41,410</span>
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">70% Increase in 30 Days</span>
                                                    </div>
                                                </div>
                                            </textarea>
                                        </div>
                                    </div>
              					</div>
              					<div class="card-footer">
                                    <a href="#" class="btn btn-warning"><i class="fas fa-undo"></i> กลับ</a>
                                    <a href="#" class="btn btn-success float-right"><i class="far fa-save"></i> บันทึก</a>
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
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Date Picker -->
<script type="text/javascript" src="plugins/datepicker/dist/js/bootstrap-datepicker-custom.js"></script>
<script type="text/javascript" src="plugins/datepicker/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script type="text/javascript">
    $(function() {
        $('.select2').select2();

        $('#detail').summernote();

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
          mode: "htmlmixed",
          theme: "monokai"
        });

        $('#date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true              //Set เป็นปี พ.ศ.
        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    });
</script>