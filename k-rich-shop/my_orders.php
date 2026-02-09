<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ตรวจสอบการเข้าสู่ระบบ
if (empty($_SESSION['member_id'])) {
	//ไปที่หน้า login
	gotopage('login.php?act=login_pls');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $shop_name; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="img/K-Rich-Photoroom.png">
		<!-- Fonts
		============================================ -->
		<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@500&display=swap" rel="stylesheet"> 
 		<!-- CSS  -->
		<!-- Bootstrap CSS
		============================================ -->      
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- font-awesome.min CSS
		============================================ -->      
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Mean Menu CSS
		============================================ -->      
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- owl.carousel CSS
		============================================ -->      
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- owl.theme CSS
		============================================ -->      
        <link rel="stylesheet" href="css/owl.theme.css">
		<!-- owl.transitions CSS
		============================================ -->      
        <link rel="stylesheet" href="css/owl.transitions.css">
		<!-- Price Filter CSS
		============================================ --> 
        <link rel="stylesheet" href="css/jquery-ui.min.css">	
		<!-- nivo-slider css
		============================================ --> 
		<link rel="stylesheet" href="css/nivo-slider.css">
 		<!-- animate CSS
		============================================ -->         
        <link rel="stylesheet" href="css/animate.css">
		<!-- jquery-ui-slider CSS
		============================================ --> 
		<link rel="stylesheet" href="css/jquery-ui-slider.css">
 		<!-- normalize CSS
		============================================ -->        
        <link rel="stylesheet" href="css/normalize.css">
        <!-- main CSS
		============================================ -->          
        <link rel="stylesheet" href="css/main.css">
        <!-- style CSS
		============================================ -->          
        <link rel="stylesheet" href="style.css">
        <!-- responsive CSS
		============================================ -->          
        <link rel="stylesheet" href="css/responsive.css">
        <style type="text/css" media="screen">
	        body {
	            font-family: 'Sarabun', sans-serif;
	        }
	    </style>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- Sweet alert 2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    </head>
    <body class="">
               
        <!-- HEADER AREA -->
        <?php include 'template/header.php'; ?>
        <!-- END HEADER -->

        <!-- MAIN MENU AREA -->
        <?php include 'template/menu.php'; ?>
		<!-- END MENU -->

        <!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.php">หน้าแรก</a></li>
					<li>รายการสั่งซื้อสินค้าของ <?php echo $_SESSION['member_name']; ?></li>
				</ul>
			</div>
		</div>

		<!-- Chart AREA -->
		<form action="?act=update" method="post" accept-charset="utf-8">
		<div class="chart-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="chart-item table-responsive fix">
							<?php 
								//ดึงข้อมูลรายการสั่งซื้อ
								$query = 'select a.get_orders_date, 
									a.orders_id, a.orders_date, a.sum_total, a.status, a.payment_method, 
									(select sum(amount) from orders_detail where orders_id = a.orders_id) as orders_amount,
									case when a.payment_method = 1 then "ชำระผ่านบัญชีธนาคาร" 
									when a.payment_method = 2 then "ชำระเงินผ่านบัตร เดบิต/เครดิต" 
									when a.payment_method = 3 then "ชำระผ่านคิวอาร์โค้ด" 
									else "" end payment_method_name, 
									case when a.status = 1 then "ยังไม่ชำระเงิน" 
									when a.status = 2 then "รอตรวจสอบยอดเงิน" 
									when a.status = 3 then "ชำระเงินแล้ว" 
									when a.status = 4 then "พัสดุกำลังจัดส่ง" 
									when a.status = 5 then "ได้รับสินค้าแล้ว" 
									when a.status = 6 then "ยกเลิก" 
									when a.status = 7 then "คืนสินค้า" 
									when a.status = 8 then "ไม่รับคืนสินค้า" 
									else "" end as status_name,
									a.delivery_track  
									from orders as a 
									left outer join member as b on a.member_id = b.member_id 
									where a.member_id = :mid ';
								$result = $con->prepare($query);
								$result->execute(['mid'  => $_SESSION['member_id']]);
								if ($result->rowCount()>0) {
							?>
							<table class="col-md-12">
								<thead>
									<tr>
										<th class="th-orderid">เลขใบสั่งซื้อ</th>
										<th class="th-orderdate">วัน-เวลาที่สั่งซื้อ</th>
										<th class="th-amount">จำนวนสินค้า</th>
										<th class="th-sumtotal">ยอดสั่งซื้อ</th>
										<th class="th-payment">ชำระเงิน</th>
										<th class="th-delivery">ส่งสินค้า</th>
										<th class="th-status">สถานะ</th>
										<th class="th-tools">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($result as $key => $rs) { ?>
									<tr>
										<td class="th-orderid"><?php echo $rs['orders_id']; ?></td>
										<td class="th-orderdate"><?php echo thaidatetime($rs['orders_date']); ?></td>
										<td class="th-amount"><?php echo $rs['orders_amount']; ?></td>
										<td class="th-sumtotal"><?php echo number_format($rs['sum_total'], 2); ?> ฿</td>
										<td class="th-payment">
											<?php
												if ($rs['status']==1) {
													echo $rs['status_name'];
											?>
											<br><a href="add_payment.php" target="_new" class="btn btn-warning">ชำระเงินเลย</a>
											<?php 
												} else {
													echo $rs['payment_method_name'];
												} 
											?>
										</td>
										<td class="th-delivery">
											<?php
											?>
										</td>
										<td class="th-status"><?php echo $rs['status_name']; ?></td>
										<td class="th-tools">
											<a href="#" onclick="ordersDetail('<?php echo $rs['orders_id']; ?>')" class="btn btn-info">รายละเอียด</a>
											<?php if ($rs['status']>2 and $rs['status']!=6 and $rs['status']!=7) { //สถานะรอตรวจสอบยอดเงิน ?>
											<a href="print_receipt.php?orid=<?php echo $rs['orders_id']; ?>" target="_new" class="btn btn-warning">ใบเสร็จ</a>
											<?php } ?>
											<?php if ($rs['status']==4) { //สถานะกำลังจัดส่งพัสดุ ?>
											<a href="#" onclick="confirmOrder('<?php echo $rs['orders_id']; ?>')" class="btn btn-success">ฉันได้รับสินค้าแล้ว</a>
											<?php } ?>
											<?php if ($rs['status']<5) { //ถ้าไม่รับสินค้าหรือยกเลิกไปแล้วจะแสดงปุ่มยกเลิกรายการสั่งซื้อ ?>
											<a href="#" onclick="cancelOrders('<?php echo $rs['orders_id']; ?>')" class="btn btn-danger">ยกเลิก</a>
											<?php } ?>
											<?php 
												//สถานะเป้นรับสินค้าแล้ว
												if ($rs['status']==5 and !empty($rs['get_orders_date'])) {
													//คำนวณค่าส่วนต่างวันที่ปัจจุบัน
													$diff = date_diff(date_create(date("Y-m-d")), date_create($rs['get_orders_date']));
													//echo $diff->format("%a");
													if ($diff->format("%a")<7) { //ถ้ารับสินค้าไปแล้วแต่ไม่เกิน 7 วัน จะสามารถคืนสินค้าได้
											?>
											<a href="#" onclick="returnOrders('<?php echo $rs['orders_id']; ?>')" class="btn btn-danger">คืนสินค้า</a>
											<?php } } ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
						<div class="cart-button">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="cart-shopping-area fix">
						<div class="col-md-4 col-sm-4">
							<!-- <div class="calculate-shipping chart-all">
								<h2>CALCULATE SHIPPING</h2>
								<p>Enter your destination to get a shipping estimate.</p>
								<select>
									<option>Sellect Country</option>
									<option>America</option>
									<option>Afganisthan</option>
									<option>Bangladesh</option>
									<option>Chin</option>
									<option>Japna</option>
								</select>
								<select>
									<option>State/Provinence</option>
									<option>Dhaka</option>
									<option>Borishal</option>
									<option>Gajipur</option>
									<option>Kustiya</option>
									<option>Vola</option>
									<option>Gaibandha</option>
								</select>
								<input type="text" placeholder="Zip / Post Code">
								<button type="button" class="btn">Get A Quote</button>
							</div> -->
						</div>
						<div class="col-md-4 col-sm-4">
							<!-- <div class="chart-all">
								<h2>PROMOTIONAL CODE</h2>
								<p>Enter your destination to get a shipping estimate.</p>
								<input type="text" placeholder="Zip / Post Code">
								<button type="button" class="btn">Get A Quote</button>
							</div> -->
						</div>
						<div class="col-md-4 col-sm-4">
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>

		<!-- Footer AREA -->
		<?php include 'template/footer.php'; ?>
		<!-- End Footer -->

    </body>
</html>
<!-- Modal -->
<div id="orders-modal"></div>

<!-- JS -->
        
<!-- jquery-1.11.3.min js
============================================ -->         
<script src="js/vendor/jquery-1.11.3.min.js"></script>
        
 		<!-- bootstrap js
		============================================ -->         
        <script src="js/bootstrap.min.js"></script>
		
		<!-- nivo slider js
		============================================ --> 
		<script src="js/jquery.nivo.slider.pack.js"></script>
        
 		<!-- Mean Menu js
		============================================ -->         
        <script src="js/jquery.meanmenu.min.js"></script>
        
   		<!-- owl.carousel.min js
		============================================ -->       
        <script src="js/owl.carousel.min.js"></script>
		
		<!-- jquery price slider js
		============================================ --> 		
		<script src="js/jquery-price-slider.js"></script>
		
		<!-- wow.js
		============================================ -->
        <script src="js/wow.js"></script>		
		<script>
			new WOW().init();
		</script>
        
   		<!-- plugins js
		============================================ -->         
        <script src="js/plugins.js"></script>
		
<!-- main js
============================================ -->           
<script src="js/main.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script language="javascript">
	$(function(){
		<?php 
            if (!empty($_GET['act'])) { 
                if ($_GET['act']=='save_success') { 
        ?>
	        Swal.fire({
		        title: 'บันทึกคำสั่งซื้อของคุณเรียบร้อยแล้ว',
		        icon: 'success',
		        confirmButtonText: 'ตกลง'
		    });
		<?php } else if ($_GET['act']=='save_get_success') { ?>
			Swal.fire({
		        title: 'บันทึกข้อมูลเรียบร้อย',
		        icon: 'success',
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

    function confirmOrder(orders_id) {
        let data = new Object();
        data.orid = orders_id;

        $('#orders-modal').load('get_orders_modal.php', data, function(){
            $("#get-orders").modal('show');
        });
    }

    function returnOrders(orders_id) {
        let data = new Object();
        data.orid = orders_id;

        $('#orders-modal').load('return_orders_modal.php', data, function(){
            $("#return-orders").modal('show');
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
                        console.log(response);
                        if (response=='true') {
                            top.window.location='my_orders.php?act=cncl_success';
                        } else {
                            top.window.location='my_orders.php?act=cncl_error';
                        }
                    }
                });
            }
        });
	}
</script>