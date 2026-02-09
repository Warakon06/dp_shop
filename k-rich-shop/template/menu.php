	<?php 
		$homeAvatar = '';
		if (!empty($_SESSION['member_id']) && isset($con)) {
			$defaultPhoto = 'img/product/product-avarta.jpg';
			$photoPath = $defaultPhoto;
			try {
				$chk = $con->query("SHOW COLUMNS FROM member LIKE 'photo'");
				if ($chk->rowCount()>0) {
					$stp = $con->prepare('select photo from member where member_id = :mid');
					$stp->execute(['mid' => $_SESSION['member_id']]);
					$rp = $stp->fetch();
					if ($rp && !empty($rp['photo'])) { $photoPath = 'img/member/'.$rp['photo']; }
				}
			} catch (Exception $e) {}
			$homeAvatar = '<span class="home-avatar"><img src="'.$photoPath.'" alt="profile"></span>';
		}
	?>
	<style>
		.home-avatar { display:inline-block; height:44px; width:44px; border-radius:50%; overflow:hidden; }
		.home-avatar img { height:100%; width:100%; object-fit:cover; display:block; }
		/* จัดให้อยู่กึ่งกลางแนวตั้ง */
		.main-menu nav > ul { display:flex; align-items:center; }
		.main-menu .menu-avatar-item { display:flex; align-items:center; margin-right:16px; padding:0; }
		.mobile-menu .menu-avatar-item { display:inline-flex; align-items:center; padding:14px 18px; margin-right:0; }
		.main-menu nav > ul > li > a { font-size:20px; }
		.mobile-menu nav > ul > li > a { font-size:18px; }
	</style>
	<div class="main-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-menu hidden-xs">
							<nav>
								<ul>
									<?php if (!empty($homeAvatar)) { ?><li class="menu-avatar-item"><?php echo $homeAvatar; ?></li><?php } ?>
									<li><a href="index.php">หน้าแรก</a></li>
									<li><a href="product.php">สินค้า</a></li>
									<li><a href="contact.php">ติดต่อเรา</a></li>
									<?php if (empty($_SESSION['member_id'])) { ?>
									<li><a href="register.php">ลงทะเบียน</a></li>
									<li><a href="login.php">เข้าสู่ระบบ</a></li>
									<?php } else { ?>
									<li><a href="#">เมนูสำหรับสมาชิก</a>
										<ul class="sub-menu">
											<li><a href="my_profile.php">ข้อมูลสมาชิก</a></li>
											<li><a href="my_orders.php">ข้อมูลการสั่งซื้อ</a></li>
											<li><a href="change_password.php">เปลี่ยนรหัสผ่าน</a></li>
											<li><a href="logout.php">ออกจากระบบ</a></li>
										</ul>
									</li>
									<?php } ?>

									<!-- <li><a href="index.html">Home</a>
										<ul class="sub-menu">
											<li><a href="index.html">Home Page 1</a></li>
											<li><a href="index-2.html">Home Page 2</a></li>
											<li><a href="index-3.html">Home Page 3</a></li>
										</ul>
									</li>
									<li><a href="shop.html">Shop</a>
										<ul class="mega-menu hidden-xs">
											<li>
												<div class="mega-menu-list">
													<div class="single-mega-menu">
														<h2>Shop Layouts</h2>
														<a href="#">Full Width</a>
														<a href="#">Sidebar Left</a>
														<a href="#">Sidebar Right</a>
														<a href="#">List View</a>
													</div>
													<div class="single-mega-menu">
														<h2>Shop Pages</h2>
														<a href="#">Category</a>
														<a href="#">My Account</a>
														<a href="#">Wishlist</a>
														<a href="#">Shopping Cart</a>
													</div>
													<div class="single-mega-menu">
														<h2>Product Types</h2>
														<a href="#">Simple Product</a>
														<a href="#">Variable Product</a>
														<a href="#">Grouped Product</a>
														<a href="#">Downloadable</a>
													</div>
												</div>
											</li>
										</ul>
									</li>
									<li><a href="shop.html">Men</a></li>
									<li><a href="shop.html">Women</a></li>
									<li><a href="shop.html">Kids</a></li>
									<li><a href="shop.html">gift</a></li>
									<li><a href="blog-left-sidebar.html">Blog</a>
										<ul class="sub-menu">
											<li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
											<li><a href="blog-single.html">Blog Details</a></li>
										</ul>
									</li>
									<li><a href="#">Pages</a>
										<ul class="sub-menu">
											<li><a href="shop.html">Shop</a></li>
											<li><a href="shop.html">Men</a></li>
											<li><a href="shop.html">Women</a></li>
											<li><a href="shop.html">Kids</a></li>
											<li><a href="shop.html">Gift</a></li>
											<li><a href="about-us.html">About Us</a></li>
											<li><a href="single-product.html">Single Product</a></li>
											<li><a href="single-shop.html">Single Item</a></li>
											<li><a href="cart.html">Cart</a></li>
											<li><a href="checkout.html">Checkout</a></li>
											<li><a href="look-book.html">Look Book</a></li>
											<li><a href="404.html">Error 404</a></li>
										</ul>
									</li>
									<li><a href="contact.html">contact</a></li> -->
								</ul>
							</nav>
						</div>
						<!-- Mobile MENU AREA -->
						<div class="mobile-menu hidden-sm hidden-md hidden-lg">
							<nav>
								<ul>
									<?php if (!empty($homeAvatar)) { ?><li class="menu-avatar-item"><?php echo $homeAvatar; ?></li><?php } ?>
									<li><a href="index.php">หน้าแรก</a></li>
									<li><a href="product.php">สินค้า</a></li>
									<li><a href="contact.php">ติดต่อเรา</a></li>
									<?php if (empty($_SESSION['member_id'])) { ?>
									<li><a href="register.php">ลงทะเบียน</a></li>
									<li><a href="login.php">เข้าสู่ระบบ</a></li>
									<?php } else { ?>
									<li><a href="#">เมนูสำหรับสมาชิก</a>
										<ul class="sub-menu">
											<li><a href="my_profile.php">ข้อมูลสมาชิก</a></li>
											<li><a href="my_orders.php">ข้อมูลการสั่งซื้อ</a></li>
											<li><a href="change_password.php">เปลี่ยนรหัสผ่าน</a></li>
											<li><a href="logout.php">ออกจากระบบ</a></li>
										</ul>
									</li>
									<?php } ?>
									
									<!--<li><a href="index.html">Home</a>
										<ul class="sub-menu">
											<li><a href="index.html">Home Page 1</a></li>
											<li><a href="index-2.html">Home Page 2</a></li>
											<li><a href="index-3.html">Home Page 3</a></li>
										</ul>
									</li>
									<li><a href="shop.html">Shop</a>
										<ul>
											<li><a href="#">Shop Layouts</a>
												<ul>
													<li><a href="#">Full Width</a></li>
													<li><a href="#">Sidebar Left</a></li>
													<li><a href="#">Sidebar Right</a></li>
													<li><a href="#">List View</a></li>
												</ul>	
											</li>
											<li><a href="#">Shop Pages</a>
												<ul>
													<li><a href="#">Category</a></li>
													<li><a href="#">My Account</a></li>
													<li><a href="#">Wishlist</a></li>
													<li><a href="#">Shopping Cart</a></li>
												</ul>	
											</li>
											<li><a href="#">Product Types</a>
												<ul>
													<li><a href="#">Simple Product</a></li>
													<li><a href="#">Variable Product</a></li>
													<li><a href="#">Grouped Product</a></li>
													<li><a href="#">Downloadable</a></li>
												</ul>	
											</li>
										</ul>
									</li>
									<li><a href="shop.html">Men</a></li>
									<li><a href="shop.html">Women</a></li>
									<li><a href="shop.html">Kids</a></li>
									<li><a href="shop.html">gift</a></li>
									<li><a href="blog-left-sidebar.html">Blog</a>
										<ul>
											<li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
											<li><a href="blog-single.html">Blog Details</a></li>
										</ul>
									</li>
									<li><a href="#">Pages</a>
										<ul>
											<li><a href="shop.html">Shop</a></li>
											<li><a href="shop.html">Men</a></li>
											<li><a href="shop.html">Women</a></li>
											<li><a href="shop.html">Kids</a></li>
											<li><a href="shop.html">Gift</a></li>
											<li><a href="about-us.html">About Us</a></li>
											<li><a href="single-product.html">Single Product</a></li>
											<li><a href="single-shop.html">Single Item</a></li>
											<li><a href="cart.html">Cart</a></li>
											<li><a href="checkout.html">Checkout</a></li>
											<li><a href="look-book.html">Look Book</a></li>
											<li><a href="404.html">Error 404</a></li>
										</ul>
									</li>
									<li><a href="contact.html">contact</a></li> -->
								</ul>
							</nav>
						</div>
						<!-- End Menu -->
					</div>
				</div>
			</div>
		</div>
