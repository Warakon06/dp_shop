<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ตรวจสอบการเข้าสู่ระบบ
if (empty($_SESSION['member_id'])) {
	//ไปที่หน้า login
	gotopage('login.php?act=login_pls');
//ถ้ามีการเข้าสู่ระบบ
} else {
	//ดึงข้อมูลสมาชิก
	$query = 'select * from member where member_id = :mid ';
	$result = $con->prepare($query);
	$result->execute(['mid'  => $_SESSION['member_id']]);
	if ($result->rowCount()>0) {
		$rs = $result->fetch();
	}

	//ถ้ามีรายการสินค้าในตะกร้าสินค้า
	/*if (!empty($_SESSION['cart'])) {
		//บันทึกข้อมูลการสั่งซื้อ
		try {
			//ประกาศตัวแปร
			$sum_price = $sum_total = 0;
			//ประกาศเริ่ม transaction
			$con->beginTransaction();
			//คิวรี่บัทึกข้อมูล
			$query = 'insert into orders value(NULL, :mid, :odt, NULL 
				,NULL, NULL, NULL, NULL 
				,NULL, NULL, NULL, NULL, 1)';
			$result = $con->prepare($query);
			//แทนค่าตัวแปรในคิวรี่
			$result->execute([
				'mid'	=> $_SESSION['member_id'], 
				'odt'	=> date("Y-m-d H:i")
			]);
			//เก็บค่ารหัสรายการสั่งซื้อที่บันทึกเข้าไปล่าสุด
			$orders_id = $con->lastInsertId();

			//บันทึกข้อมูลรายการสินค้า
			foreach ($_SESSION['cart'] as $product_id => $amount) {
				//วนลูปเพื่อดึงข้อมูลรายการสินค้าในตะกร้า
				$query2 = 'select * from product where product_id = :pid';
				$result2 = $con->prepare($query2);
				$result2->execute(['pid' => $product_id]);
				//ถ้ามีข้อมูล
				if ($result2->rowCount()>0) {
					$rs2 = $result2->fetch();
					//คำนวณราคารวมสินค้า
					$sum_price = $rs2['price'] * $amount;
					$sum_total += $sum_price;

					//บันทึกข้อมูลรายการสินค้า
					$query3 = 'insert into orders_detail value(NULL, :orid, :pid, :amt, :price, :sprice)';
					$result3 = $con->prepare($query3);
					$result3->execute([
						'orid'		=> $orders_id, 
						'pid'		=> $product_id, 
						'amt'		=> $amount,
						'price'		=> $rs2['price'],
						'sprice'	=> $sum_price
					]);
				}	
			}

			//อัปเดทราคารวมของคำสั่งซื้อนี้
			$query4 = 'update orders set sum_total = :sumt where orders_id = :orid ';
			$result4 = $con->prepare($query4);
			$result4->execute([
				'sumt'	=> $sum_total,
				'orid'	=> $orders_id 
			]);

			//ลบค่าในตัวแปร session ตะกร้าสินค้า
			unset($_SESSION['cart']);

			$con->commit();

		//กรณ๊ถ้าบันทึกข้อมูลสินค้าแล้ว error
		} catch (PDOException $e) {
			//ให้ rollback ข้อมูลกลับ
			$con->rollBack();
			//แสดง error
			echo $e->getMessage();
			//กลับไปที่หน้าตะกร้าสินค้า
			gotopage('cart.php?act=save_error');
		}
	//ถ้าไม่มีรายการสินค้า
	} else {
		//กลับไปที่หน้าตะกร้าสินค้า
		gotopage('cart.php?act=save_error');
	}*/
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
        <!-- Select2 -->
    	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    </head>
    <body class="">   
        <!-- HEADER AREA -->
        <?php include 'template/header.php'; ?>
        <!-- ENd HEADER -->

        <!-- MAIN MENU AREA -->
        <?php include 'template/menu.php'; ?>
		<!-- END MENU -->

        <!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.php">หน้าแรก</a></li>
					<li>ชำระเงินค่าสินค้า</li>
				</ul>
			</div>
		</div>

		<!-- Checkout AREA -->
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
					</div>
				</div>
				<form action="confirm_orders.php" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-8">
						<div class="billing-address">
							<div class="checkout-head">
								<h2>ที่อยู่จัดส่งสินค้า</h2>
							</div>
							<div class="checkout-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ชื่อ-นามสกุล (ผู้รับ) <sup>*</sup></label>
											<input type="text" class="form-control" name="rname" value="<?php echo $rs['first_name'].' '.$rs['last_name']; ?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">เบอร์โทรศัพท์ <sup>*</sup></label>
											<input type="text" class="form-control" name="pnumber" value="<?php echo $rs['phone_number']; ?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">บ้านเลขที่ <sup>*</sup></label>
											<input type="text" class="form-control" name="homeno" value="<?php echo $rs['home_no']; ?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">หมู่บ้าน/อาคาร </label>
											<input type="text" class="form-control" name="village" value="<?php echo $rs['village']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ซอย</label>
											<input type="text" class="form-control" name="soi" value="<?php echo $rs['soi']; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ถนน </label>
											<input type="text" class="form-control" name="road" value="<?php echo $rs['road']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">จังหวัด <sup>*</sup></label>
											<select name="province" id="province" class="form-control select2" onchange="chLocal('province', this.value)" required>
												<?php 
													$query2 = 'select * from province where province_id = :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute(['pid' => $rs['province_id']]);
													$rs2 = $result2->fetch();
													echo '<option value="'.$rs2['province_id'].'">'.$rs2['name_th'].'</option>';

													$query2 = 'select * from province where province_id != :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute(['pid'  => $rs['province_id']]);
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
															echo '<option value="'.$rs2['province_id'].'">'.$rs2['name_th'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">อำเภอ/เขต </label>
											<select name="district" id="district" class="form-control select2" onchange="chLocal('district', this.value)" required>
												<?php 
													$query2 = 'select * from district where district_id = :did ';
													$result2 = $con->prepare($query2);
													$result2->execute(['did' => $rs['district_id']]);
													$rs2 = $result2->fetch();
													echo '<option value="'.$rs2['district_id'].'">'.$rs2['name_th'].'</option>';

													$query2 = 'select * from district where district_id != :did and province_id = :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute([
														'did'  => $rs['district_id'], 
														'pid'  => $rs['province_id'] 
													]);
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
															echo '<option value="'.$rs2['district_id'].'">'.$rs2['name_th'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ตำบล / แขวง <sup>*</sup></label>
											<select name="subdistrict" id="subdistrict" class="form-control select2" onchange="chLocal('subdistrict', this.value)" required>
												<?php 
													$query2 = 'select * from subdistrict where subdistrict_id = :subdid ';
													$result2 = $con->prepare($query2);
													$result2->execute(['subdid' => $rs['subdistrict_id']]);
													$rs2 = $result2->fetch();
													echo '<option value="'.$rs2['subdistrict_id'].'">'.$rs2['name_th'].'</option>';

													$query2 = 'select * from subdistrict where 
													subdistrict_id != :subdid 
													and district_id = :did ';
													$result2 = $con->prepare($query2);
													$result2->execute([
														'subdid'  	=> $rs['subdistrict_id'], 
														'did'  		=> $rs['district_id']
													]);
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
															echo '<option value="'.$rs2['subdistrict_id'].'">'.$rs2['name_th'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">รหัสไปรษณีย์ </label>
											<input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $rs['post_code']; ?>" required>
										</div>
									</div>
								</div>
								<div class="payment-method">
									<h2>วิธีการชำระเงิน</h2>
									<div class="payment-radio">
										<input type="radio" name="pmethod" value="1" checked> ชำระผ่านบัญชีธนาคาร
									</div>
									<p>
										ธนาคาร xxxx <br>
										เลขบัญชี xxxx <br>
										ชื่อบัญชี xxxx 
									</p>
									<div class="row">
										<div class="col-md-6">
											<input type="file" class="form-control" name="fileupload1">
										</div>
										<div class="col-md-6">
											แนบหลักฐานการชำระเงิน
										</div>
									</div>
									<br>
									<div class="payment-radio">
										<input type="radio" name="pmethod" value="2"> ชำระเงินผ่านบัตร เดบิต/เครดิต
									</div>
									<div class="row">
										<div class="col-md-6">
											<input type="text" class="form-control" name="cno" placeholder="หมายเลขบนบัตร">
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" name="cm" placeholder="เดือน">
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" name="cy" placeholder="ปี">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<input type="text" class="form-control" name="cname" placeholder="ชื่อผู้ถือบัตร">
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" name="cs" placeholder="เลขหลังบัตร">
										</div>
									</div>
									<br>
									<div class="payment-radio">
										<input type="radio" name="pmethod" value="3"> ชำระผ่านคิวอาร์โค้ด
										<br><img src="https://promptpay.io/0925399604.png">
									</div>
									<div class="row">
										<div class="col-md-6">
											<input type="file" class="form-control" name="fileupload2">
										</div>
										<div class="col-md-6">
											แนบหลักฐานการชำระเงิน
										</div>
									</div>
									<button type="submit" class="btn">ยืนยันคำสั่งซื้อของคุณ</button>
								</div>
							</div>
						</div>
					</div>


					<div class="col-md-4">
						<div class="review-order">
							<div class="checkout-head">
								<h2>รายการสินค้า</h2>
							</div>
							<?php 
								//ประกาศค่าตัวแปรที่ใช้ในการคำนวณ
		                        $sum_price = $sum_total = 0;
		                        //ตรวจสอบว่าถ้าตัวแปร session ไม่ใช่ค่าว่าง
		                        if (!empty($_SESSION['cart'])) { 
		                        	//วนลูปเพื่อดึงข้อมูลรายการอาหารและเครื่องดื่ม
		                            foreach ($_SESSION['cart'] as $pid => $amt) {
		                            	//คิวรี่ดึงข้อมูลรายการอาหารและเครื่องดื่มจากฐานข้อมูล
		                                $query = 'select 
		                                    a.product_id, a.name, a.price, a.unit, 
		                                    b.photo 
		                                    from product as a 
		                                    left outer join product_photo as b on a.product_id = b.product_id 
											and b.active = 1
		                                    where a.product_id = :pid ';
		                                $result = $con->prepare($query);
		                                $result->execute(['pid'  => $pid]);
		                                //ถ้ามีข้อมูลรายการอาหารและเครื่องดื่ม
		                                if ($result->rowCount()>0) {
		                                   	$rs = $result->fetch();
		                                    //คำนวณราคา จำนวน * ราคา
		                                    $sum_price = $amt * $rs['price'];
		                                    $sum_total += $sum_price;
							?>
							<div class="single-review">
								<div class="single-review-img">
									<a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>" target="_new">
										<img src="img/product/<?php echo $rs['photo']; ?>" alt="review" width="150px;">
									</a>
								</div>
								<div class="single-review-content">
									<h2>
										<a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>" target="_new">
											<?php echo $rs['name']; ?>
										</a>
									</h2>
									<p><span>จำนวน : x </span> <?php echo $amt; ?></p>
									<p><span>ราคา/<?php echo $rs['unit']; ?> ละ :</span> <?php echo number_format($rs['price'], 2); ?> ฿</p>
									<h3>รวม <?php echo number_format($sum_price, 2); ?> ฿</h3>
								</div>
							</div>
							<br>
							<?php } } } ?>
						</div>
						<br>
						<p>
							<a href="cart.php" class="btn btn-warning">แก้ไขสินค้า</a>
						</p>
						
						<div class="subtotal-area">
							<div class="subtotal-content fix">
								<h2 class="floatleft">ค่าสินค้า</h2>
								<h2 class="floatright"><?php echo number_format($sum_total, 2); ?> ฿</h2>
							</div>
							<div class="subtotal-content fix">
								<h2 class="floatleft">ค่าจัดส่ง  </h2>
								<h2 class="floatright">FREE</h2>
							</div>
							<div class="subtotal-content fix">
								<h2 class="floatleft">รวมทั้งสิ้น</h2>
								<h2 class="floatright"><?php echo number_format($sum_total, 2); ?> ฿</h2>
							</div>
						</div>
					</div>
					<!-- END -->
				
				</form>
				<div class="row">
					<div class="col-md-12">
						<p>&nbsp;</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer AREA -->
		<?php include 'template/footer.php'; ?>
		<!-- END Footer -->
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
			$(function() {
				<?php 
            		if (!empty($_GET['act'])) { 
                		if ($_GET['act']=='login_error') {
        		?>
        			Swal.fire({
		                title: '',
		                text: 'อีเมลหรือรหัสผ่านผิด',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
		        <?php } else if ($_GET['act']=='login_pls') { ?>
		        	Swal.fire({
		                title: 'กรุณาเข้าสู่ระบบก่อน',
		                icon: 'warning',
		                confirmButtonText: 'ตกลง'
		            });
        		<?php } } ?>
			});

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
		</script>
    </body>
</html>
