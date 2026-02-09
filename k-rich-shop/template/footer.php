		<div class="footer-area">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="footer-info-card">
								<div class="footer-logo">
									<a href="index.php"><img src="img/K-Rich-Photoroom.png" alt="logo"></a>
								</div>
								<p>Lorem ipsum dolor sit amet, coetuer adipiscing elit. Aenean comodo liula eget dolor. Aenean massa. Cum sociis natoque penatibus.</p>
								<ul class="list-inline">
									<li><a href="#"><img src="img/visa-card/visa-card-1.png" alt="card" class="img-responsive"></a></li>
									<li><a href="#"><img src="img/visa-card/visa-card-2.png" alt="card" class="img-responsive"></a></li>
									<li><a href="#"><img src="img/visa-card/visa-card-3.png" alt="card" class="img-responsive"></a></li>
									<li><a href="#"><img src="img/visa-card/visa-card-4.png" alt="card" class="img-responsive"></a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="footer-menu-area">
								<h2 class="footer-heading">เมนูหลัก</h2>
								<div class="footer-menu">
									<ul>
										<li><a href="index.php"><i class="fa fa-angle-right"></i>หน้าแรก</a></li>
										<li><a href="product.php"><i class="fa fa-angle-right"></i>สินค้า</a></li>
										<li><a href="contact.php"><i class="fa fa-angle-right"></i>ติดต่อเรา</a></li>
										<!-- <li><a href="#"><i class="fa fa-angle-right"></i>Meet</a></li> -->
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 hidden-sm hidden-xs">
							<div class="footer-menu-area">
								<h2 class="footer-heading">สำหรับสมาชิก</h2>
								<div class="footer-menu opening-time">
									<ul>
										<?php if (!empty($_SESSION['sess_id'])) { ?>
										<li><a href="my_profile.php"><i class="fa fa-angle-right"></i>ข้อมูลสมาชิก</a></li>
										<li><a href="my_orders.php"><i class="fa fa-angle-right"></i>รายการสั่งซื้อ</a></li>
										<li><a href="logout.php"><i class="fa fa-angle-right"></i>ออกจากระบบ</a></li>
										<?php } else { ?>
										<li><a href="register.php"><i class="fa fa-angle-right"></i>ลงทะเบียน</a></li>
										<li><a href="login.php"><i class="fa fa-angle-right"></i>เข้าสู่ระบบ</a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="contact-info-area">
								<h2 class="footer-heading">ติดต่อเรา</h2>
								<div class="contact-info">
									<div class="contanct-details">
										<div class="info-icon">
											<i class="fa fa-phone"></i>
										</div>
										<div class="info-content">
											<?php 
												$contact = ['phone'=>'','email'=>'','address'=>'','fb_link'=>'','tw_link'=>'','gp_link'=>'','ln_link'=>'','pt_link'=>'','vm_link'=>''];
												try {
													$stf = $con->query("SELECT phone,email,address,fb_link,tw_link,gp_link,ln_link,pt_link,vm_link FROM site_settings WHERE id=1");
													$rowf = $stf->fetch();
													if ($rowf) { $contact = $rowf; }
												} catch (Exception $e) {}
												$phones = array_filter(preg_split('/[\n,]+/', (string)$contact['phone']));
												if (empty($phones)) { $phones = ['-']; }
												foreach ($phones as $ph) { 
													$clean = preg_replace('/\s+/', '', trim($ph));
													echo '<p><a href="tel:'.$clean.'">'.htmlspecialchars(trim($ph)).'</a></p>'; 
												}
											?>
										</div>
									</div>
									<div class="contanct-details">
										<div class="info-icon">
											<i class="fa fa-envelope-o"></i>
										</div>
										<div class="info-content">
											<?php 
												$emails = array_filter(preg_split('/[\n,]+/', (string)$contact['email']));
												if (empty($emails)) { $emails = ['-']; }
												foreach ($emails as $em) { 
													$trim = trim($em);
													echo '<p><a href="mailto:'.$trim.'">'.htmlspecialchars($trim).'</a></p>'; 
												}
											?>
										</div>
									</div>
									<div class="contanct-details">
										<div class="info-icon">
											<i class="fa fa-map-marker"></i>
										</div>
										<div class="info-content">
											<p><?php echo !empty($contact['address']) ? htmlspecialchars($contact['address']) : '-'; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="copyright">
								Copyrignt@2567/<a href="backend/" target="_blank">Admin Login</a>/ ALL RIGHTS RESERVED
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="footer-social-icon">
								<ul class="list-inline">
									<?php if (!empty($contact['fb_link'])) { ?><li><a href="<?php echo htmlspecialchars($contact['fb_link']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
									<?php if (!empty($contact['tw_link'])) { ?><li><a href="<?php echo htmlspecialchars($contact['tw_link']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
									<?php if (!empty($contact['gp_link'])) { ?><li><a href="<?php echo htmlspecialchars($contact['gp_link']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
									<?php if (!empty($contact['ln_link'])) { ?><li><a href="<?php echo htmlspecialchars($contact['ln_link']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
									<?php if (!empty($contact['pt_link'])) { ?><li><a href="<?php echo htmlspecialchars($contact['pt_link']); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
									<?php if (!empty($contact['vm_link'])) { ?><li><a href="<?php echo htmlspecialchars($contact['vm_link']); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li><?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
