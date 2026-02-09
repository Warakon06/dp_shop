<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ถ้ามีการส่งรหัสสินค้ามา
if (!empty($_GET['pid'])) {
	//ดึงข้อมูลสินค้า
	$query = 'select * from product where product_id = :pid ';
	$result = $con->prepare($query);
	$result->execute(['pid'  => $_GET['pid']]);
	if ($result->rowCount()>0) {
		$rs=$result->fetch();
	}
//ถ้าไม่มีการส่งรหัสสินค้ามา
} else {
	//กลับไปที่หน้าแรก
	gotopage('index.php');
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
        <!-- Sweet alert 2 -->
    	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
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
					<li><a href="product.php">สินค้า</a></li>
					<li><?php echo $rs['name']; ?></li>
				</ul>
			</div>
		</div>

		<!-- Product Item AREA -->
		<div class="product-item-area">
			<div class="container">
				<div class="row">
					<!-- LEFT SIDE -->
					<div class="col-md-3 col-sm-4">
						<div class="product-item-categori">
							<div class="product-type">
								<h2>หมวดหมู่สินค้า</h2>
								<ul>
									<?php
										//ดึงข้อมูลหมวดหมู่สินค้า
										$query2 = 'select * from category ';
										$result2 = $con->prepare($query2);
										$result2->execute();
										if ($result2->rowCount()>0) {
										foreach ($result2 as $key => $rs2) {
									?>
									<li><a href="product.php?cat=<?php echo $rs2['category_id']; ?>"><i class="fa fa-angle-right"></i><?php echo $rs2['name']; ?></a></li>
									<?php } } ?>
								</ul>
							</div>
						</div>
						<!-- <div class="price-filter">
							<h2>กำหนดช่วงราคา</h2>
							<div id="slider-range"></div>
							<button class="btn btn-default">แสดงผล</button>
							<p>
							  <label for="amount">ช่วงราคา:</label>
							  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
							</p>
						</div> -->

						<!-- <div class="filter-size-area">
							<h2>Filter by Size</h2>
							<div class="filter-size">
								<div class="filter-size-left">
									<p>M (6)</p>
									<p>X (7)</p>
									<p>XS (10)</p>
								</div>
								<div class="filter-size-right">
									<p>M (6)</p>
									<p>X (7)</p>
									<p>XS (10)</p>
								</div>
							</div>
						</div> -->

						<div class="add-shop">
							<div class="add-kids single-add">
								<a href="https://ihavecpu.com/"><img src="img/banner/logo.jpg" alt="add"></a>
							</div>
							<div class="add-dress single-add">
								<a href="https://www.bnn.in.th/th"><img src="img/banner/site-logo.9ca15bd.jpg" alt="add"></a>
							</div>
						</div>
					</div>
					<!-- END LEFt SIDE -->

					<!-- RIGHT SIDE -->
					<div class="col-md-9 col-sm-8">
						<div class="row">

							<div class="col-md-5 col-sm-5">
								<div class="product-item-tab">
									<!-- Tab panes -->
									<div class="single-tab-content">
										<div class="tab-content">
											<?php
												//ดึงข้อมูลรูปสินค้า
												$query2 = 'select * from product_photo where product_id = :pid ';
												$result2 = $con->prepare($query2);
												$result2->execute(['pid'  => $rs['product_id']]);
												if ($result2->rowCount()>0) {
													foreach ($result2 as $key => $rs2) {
											?>
											<div role="tabpanel" class="tab-pane <?php if ($key==0) { ?>active<?php } ?>" id="img-<?php echo $key; ?>">
												<img src="img/product/<?php echo $rs2['photo']; ?>" alt="tab-img">
											</div>
											<?php } } ?>
										</div>
									</div>
									<!-- Nav tabs -->
									<div class="single-tab-img">
										<ul class="nav nav-tabs" role="tablist">
											<?php
												//ดึงข้อมูลรูปสินค้า
												$query2 = 'select * from product_photo where product_id = :pid ';
												$result2 = $con->prepare($query2);
												$result2->execute(['pid'  => $rs['product_id']]);
												if ($result2->rowCount()>0) {
													foreach ($result2 as $key => $rs2) {
											?>
											<li role="presentation" <?php if ($key==0) { ?>class="active"<?php } ?>>
												<a href="#img-<?php echo $key; ?>" role="tab" data-toggle="tab">
													<img src="img/product/<?php echo $rs2['photo']; ?>" alt="tab-img" width="30%">
												</a>
											</li>
											<?php } } ?>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-7 col-sm-7">
								<div class="product-tab-content">
									<div class="product-tab-header">
										<h1><?php echo $rs['name']; ?></h1>
										<?php
											//ดึงคำแนนรีวิวสินค้า
											$query3 = 'select count(a.review_id) as sum_review, 
												(select count(review_id) from review_product 
													where score = 5 and product_id = a.product_id) as score5,
												(select count(review_id) from review_product 
													where score = 4 and product_id = a.product_id) as score4, 
												(select count(review_id) from review_product 
													where score = 3 and product_id = a.product_id) as score3, 
												(select count(review_id) from review_product 
													where score = 2 and product_id = a.product_id) as score2, 
												(select count(review_id) from review_product 
													where score = 1 and product_id = a.product_id) as score1
												from review_product as a 
												where a.product_id = :pid ';
											$result3 = $con->prepare($query3);
											$result3->execute(['pid'  => $rs['product_id']]); 
											if ($result3->rowCount()>0) {
												$rs3 = $result3->fetch();
												$score = ((5 * $rs3['score5']) + (4 * $rs3['score4']) + (3 * $rs3['score3']) + (2 * $rs3['score2']) + (1 * $rs3['score1']));
												if ($score!=0) {
													$score = $score / $rs3['sum_review'];
										?>
										<div class="best-product-rating">
											<?php if ($score==5) { ?>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<p>(ขายไปแล้ว <?php echo $rs3['sum_review']; ?>)</p>
											<?php } else if ($score==4) { ?>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<p>(ขายไปแล้ว <?php echo $rs3['sum_review']; ?>)</p>
											<?php } else if ($score==3) { ?>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<p>(ขายไปแล้ว <?php echo $rs3['sum_review']; ?>)</p>
											<?php } else if ($score==2) { ?>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<p>(ขายไปแล้ว <?php echo $rs3['sum_review']; ?>)</p>
											<?php } else if ($score==1) { ?>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
											<p>(ขายไปแล้ว <?php echo $rs3['sum_review']; ?>)</p>
											<?php } ?>
										</div>
										<?php } } ?>
										<h3 class="text-success"><?php echo number_format($rs['price'], 2); ?> ฿</h3>
									</div>
									<div class="product-item-code">
										<p>รหัสสินค้า  :   #<?php echo $rs['product_id']; ?></p>
										<p>สถานะสินค้า :  <?php if ($rs['amount']>0) { ?><span class="text-success">In stock (<?php echo $rs['amount']; ?>)</span><?php } else { ?><span class="text-danger">สินค้าหมดชั่วคราว</span><?php } ?></p>
									</div>
									<!-- <div class="product-item-details">
										<p></p>
									</div> -->
									<div class="available-option">
										<!-- <h2>Available Options:</h2>
										<div class="color-option fix">
											<p>Color:</p>
											<a href="#" class="color-1"></a>
											<a href="#" class="color-2"></a>
											<a href="#" class="color-3"></a>
											<a href="#" class="color-4"></a>
											<a href="#" class="color-5"></a>
											<a href="#" class="color-6"></a>
										</div>
										<div class="size-option fix">
											<p>Size:</p>
											<select>
												<option value="Choose an option">Choose an option</option>
												<option value="Lg">Lg</option>
												<option value="Xs">M</option>
												<option value="Xs">Xs</option>
											</select>
										</div> -->
										<!-- <div class="wishlist-icon">
											<div class="single-wishlist">
												<a href="#"><i class="fa fa-heart"></i></a>
												<p>wishlist</p>
											</div>
											<div class="single-wishlist">
												<a href="#"><i class="fa fa-signal"></i></a>
												<p>Compare</p>
											</div>
										</div> -->
										<?php if ($rs['amount']>0) { ?>
										<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<input type="text" class="form-control" style="text-align: center;" name="amt" id="amt" value="1">
												</div>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12">
												<a href="#" onclick="addCart('<?php echo $rs['product_id']; ?>')" class="btn btn-warning">หยิบใส่ตะกร้า</a>
											</div>
										</div>
										<?php } ?>
									</div> 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="description-tab">
								<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#description" role="tab" data-toggle="tab">รายละเอียดสินค้า</a>
										</li>
										<!-- <li role="presentation">
											<a href="#information" role="tab" data-toggle="tab">Addisonal information</a>
										</li> -->
										<li role="presentation">
											<?php 
												//ดึงข้อมูลการรีวิวสินค้า
												$query3 = 'select count(review_id) as sum_review 
													from review_product 
													where product_id = :pid and comment != "" ';
												$result3 = $con->prepare($query3);
												$result3->execute(['pid' => $rs['product_id']]);
												$rs3 = $result3->fetch();
											?>
											<a href="#reviews" role="tab" data-toggle="tab">รีวิว (<?php echo $rs3['sum_review']; ?>)</a>
										</li>
									</ul>
									  <!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="description">
											<?php echo $rs['description']; ?>
										</div>
										<!-- <div role="tabpanel" class="tab-pane" id="information">
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
											<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
										</div> -->
										<div role="tabpanel" class="tab-pane" id="reviews">
											<?php
												//ดึงข้อมูลการรีวิวและคะแนนสินค้า
												$query3 = 'select a.score, a.comment, a.member_id 
													from review_product as a 
													where a.comment != "" 
													and a.product_id = :pid ';
												$result3 = $con->prepare($query3); 
												$result3->execute(['pid' => $rs['product_id']]);
												if ($result3->rowCount()>0) {
													foreach ($result3 as $key3 => $value3) {
														echo '<p>';
														echo 'สมาชิก: '.$value3['member_id'];
														echo ' คะแนน: '.$value3['score'];
														echo '<br>ความเห็น';
														echo '<br>'.$value3['comment'];
														echo '</p>';
													}
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="single-product-slider similar-product">
									<div class="product-items">
										<h2 class="product-header">สินค้าในหมวดหมู่เดียวกัน</h2>
										<div class="row">
											<div id="singleproduct-slider" class="owl-carousel">
												<?php
													$query2 = 'select 
														a.product_id, a.name, a.price, b.photo 
														from product as a 
														left outer join product_photo as b on a.product_id = b.product_id 
														and b.active = 1 
														where a.category_id = :cid  
														and a.product_id != :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute([
														'cid'	=> $rs['category_id'],
														'pid'  	=> $rs['product_id']
													]);
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
												?>
												<div class="col-md-4">
													<div class="single-product">
														<div class="single-product-img">
															<a href="product_detail.php?pid=<?php echo $rs2['product_id']; ?>">
																<img class="primary-img" src="img/product/<?php echo $rs2['photo']; ?>" alt="product">
															</a>
															<div class="single-product-action">
																<a href="product_detail.php?pid=<?php echo $rs2['product_id']; ?>"><i class="fa fa-external-link"></i></a>
																<a href="cart.php?act=add&pid=<?php echo $rs2['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
															</div>
														</div>
														<div class="single-product-content">
															<div class="product-content-left">
																<h2><a href="product_detail.php?pid=<?php echo $rs2['product_id']; ?>"><?php echo $rs2['name']; ?></a></h2>
															</div>
															<div class="product-content-right">
																<h3><?php echo number_format($rs2['price'], 2); ?> ฿</h3>
															</div>
														</div>
													</div>
												</div>
												<?php } } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
        <!-- Sweet alert 2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

        <script language="javascript">
        	$(function(){
        	});

        	function addCart (product_id) {
        		if ($('#amt').val()=='' || $('#amt').val()<1) {
        			Swal.fire({
		                title: 'ใส่ตะกร้าไม่ได้!',
		                text: 'กรุณาป้อนจำนวนสินค้าด้วยจ้า',
		                icon: 'warning',
		                confirmButtonText: 'ตกลง'
		            });
        		} else {
        			top.window.location = 'cart.php?act=add&pid='+product_id+'&amt='+$('#amt').val();
        		}
        	}
        </script>
    </body>
</html>
