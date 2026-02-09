<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//รับค่าตัวแปร act 
if (!empty($_GET['act'])) {
    //เพิ่มข้อมูล สินค้า
    if ($_GET['act']=='add') {
        //ถ้ามีรหัสอาหารและเครื่องดื่ม
        if (!empty($_GET['pid'])) {
            //เช็คว่ามีรหัส สินค้า นี้ใรตัวแปร session หรือยัง
            //ถ้ามีแล้ว
            if(isset($_SESSION['cart'][$_GET['pid']])) {
                //ถ้ามีการส่งค่าจำนวนมาด้วย
                if (!empty($_GET['amt'])) {
                    $_SESSION['cart'][$_GET['pid']] += $_GET['amt'];
                //ถ้าไม่มีการส่งค่าจำนวนมาให้เพิ่มไปอีก 1
                } else {
                    $_SESSION['cart'][$_GET['pid']] ++;
                }
            //ถ้ายังไม่มี
            } else {
                //ถ้ามีการส่งค่าจำนวนมาด้วย
                if (!empty($_GET['amt'])) {
                    $_SESSION['cart'][$_GET['pid']] = $_GET['amt'];
                //ถ้าไม่มีการส่งค่าจำนวนมาให้จำนวน = 1
                } else {
                    $_SESSION['cart'][$_GET['pid']] = 1;
                }
            }
        }
    //อัปเดทข้อมูลจำนวนรายการอาหารและเครื่องดื่ม
    } else if ($_GET['act']=='update') { 
        //รับค่าตัวแปรจำนวนแบบอาเรย์
        $amount_array = isset($_POST['amount']) ? $_POST['amount'] : '';
        //วนลูปเพื่อเอาจำนวนมาอัปเดทในตัวแปร session
        if ($amount_array!='') {
            foreach($amount_array as $pid => $amount) {
                $_SESSION['cart'][$pid] = $amount;
            }
         }
    //ลบข้อมุลรายการอาหารและเครื่องดื่ม
    } else if ($_GET['act']=='remove') {
        unset($_SESSION['cart'][$_GET['pid']]);
    //ลบตะกร้าสินค้า
    } else if ($_GET['act']=='del') {
        unset($_SESSION['cart']);
    }
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
					<li>ตะกร้าสินค้า</li>
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
							<table class="col-md-12">
								<thead>
									<tr>
										<th class="th-product">&nbsp;</th>
										<th class="th-details">รายการ</th>
										<th class="th-price">ราคา/หน่วย</th>
										<th class="th-qty">จำนวน</th>
										<th class="th-total">รวมเป็น</th>
										<th class="th-delate">ลบ</th>
									</tr>
								</thead>
								<tbody>
									<?php 
		                                //ประกาศค่าตัวแปรที่ใช้ในการคำนวณ
		                                $sum_price = $sum_total = 0;
		                                //ตรวจสอบว่าถ้าตัวแปร session ไม่ใช่ค่าว่าง
		                                if (!empty($_SESSION['cart'])) { 
		                                    //วนลูปเพื่อดึงข้อมูลรายการอาหารและเครื่องดื่ม
		                                    foreach ($_SESSION['cart'] as $pid => $amt) {
		                                        //คิวรี่ดึงข้อมูลรายการอาหารและเครื่องดื่มจากฐานข้อมูล
		                                        $query = 'select 
		                                        	a.product_id, a.name, a.price, b.photo 
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
									<tr>
										<td class="th-product">
											<a href="product_detail.php?pid=<?php echo $pid; ?>"><img src="img/product/<?php echo $rs['photo']; ?>" alt="cart"></a>
										</td>
										<td class="th-details">
											<h2><a href="#"><?php echo $rs['name']; ?></a></h2>
										</td>
										<td class="th-price"><?php echo number_format($rs['price'], 2); ?> ฿</td>
										<td class="th-qty">
											<input type="number" min="1" name="amount[<?php echo $pid; ?>]" value="<?php echo $amt; ?>">
										</td>
										<td class="th-total"><?php echo number_format($sum_price, 2); ?> ฿</td>
										<td class="th-delate"><a href="cart.php?act=remove&pid=<?php echo $pid; ?>"><i class="fa fa-trash"></i></a></td>
									</tr>
									<?php } } ?>
									<tr>
										<td colspan="4" style="text-align: center; font-weight: bold;">รวมเป็นเงินทั้งสิ้น</td>
										<td><i class="text-danger" style="font-weight: bold;"><?php echo number_format($sum_total, 2); ?> ฿</i></td>
										<td>&nbsp;</td>
									</tr>
									<?php } else { ?>
									<tr>
										<td colspan="6"><h4 class="text-center">ยังไม่มีสินค้าในตะกร้า</h4></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="cart-button">
							<button type="button" class="btn" onclick="top.window.location='product.php';">กลับไปช้อปต่อ</button>
							<?php if (!empty($_SESSION['cart'])) { //ถ้าตะกร้าสินค้าไม่ว่างเปล่าจะแสดงปุ่ม ?>
							<button type="submit" class="btn">คำนวณใหม่</button>
							<button type="button" class="btn" onclick="top.window.location='cart.php?act=del';">ลบรายการทั้งหมด</button>
							<button type="button" class="btn" onclick="top.window.location='check_out.php';">ชำระเงิน</button>
							<?php } ?>
							<?php if (empty($_SESSION['member_id'])) { //ถ้าไม่ได้เข้าสู่ระบบจะแสดงลิ้งค์ ?>
							กรุณา <a href="login.php">เข้าสู่ระบบ</a> หรือ <a href="register.php">ลงทะเบียนสมาชิก</a> ก่อนเพื่อสั่งซื้อสินค้า
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>

		<!-- Footer AREA -->
		<?php include 'template/footer.php'; ?>
		<!-- ฎ์ฏ Footer -->

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
                		if ($_GET['act']=='save_error') { 
        		?>
	        		Swal.fire({
		                title: 'เกิดข้อผิดพลาด!',
		                text: 'ไม่สามารถบันทึกข้อมูลได้',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
		        <?php } else if ($_GET['act']=='no_stock') { ?>
		        	Swal.fire({
		                title: 'เกิดข้อผิดพลาด!',
		                text: 'สินค้าในคลังมีการเปลี่ยนแปลง กรุณาลองใหม่อีกครั้ง',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
        		<?php } } ?>
			});
		</script>
    </body>
</html>
