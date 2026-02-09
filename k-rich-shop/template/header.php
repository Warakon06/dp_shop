		<div class="header-area">
			<div class="header-top-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="header-top-left">
								<div class="header-top-menu">
									<!-- <ul class="list-inline">
										<li><img src="img/flag.png" alt="flag"></li>
										<li class="dropdown"><a href="#" data-toggle="dropdown">English</a>
											<ul class="dropdown-menu">
												<li><a href="#">Spanish</a></li>
												<li><a href="#">China</a></li>
											</ul>
										</li>
										<li class="dropdown"><a href="#" data-toggle="dropdown">USD</a>
											<ul class="dropdown-menu usd-dropdown">
												<li><a href="#">USD</a></li>
												<li><a href="#">GBP</a></li>
												<li><a href="#">EUR</a></li>
											</ul>
										</li>
									</ul> -->
								</div>
								<!-- <p>Welcome visitor!</p> -->
							</div>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="header-top-right">
								<!-- <ul class="list-inline">
									<li><a href="#"><i class="fa fa-user"></i>My Account</a></li>
									<li><a href="#"><i class="fa fa-heart"></i>Wishlist</a></li>
									<li><a href="checkout.html"><i class="fa fa-check-square-o"></i>Checkout</a></li>
									<li><a href="#"><i class="fa fa-lock"></i>Login</a></li>
									<li><a href="#"><i class="fa fa-pencil-square-o"></i>Register</a></li>
								</ul> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-12">
							<div class="header-logo">
								<a href="index.php"><img src="img/K-Rich-Photoroom.png" alt="logo" style="width:260px;height:auto;margin-top:-24px;margin-bottom:-24px;"></a>
							</div>
						</div>
						<div class="col-md-10 col-sm-10 col-xs-12">
							<div class="search-chart-list">
								<!-- <div class="catagori-menu">
									<ul class="list-inline">
										<li><i class="fa fa-search"></i></li>
										<li>
											<select>
												<option value="All Categories">All Categories</option>
												<option value="Categorie One">Categorie One</option>
												<option value="Categorie Two">Categorie Two</option>
												<option value="Categorie Three">Categorie Three</option>
												<option value="Categorie Four">Categorie Four</option>
												<option value="Categorie Five">Categorie Five</option>
											</select>
										</li>
									</ul>
								</div>
								<div class="header-search">
									<form action="#">
										<input type="text" placeholder="My Search"/>
										<button type="button"><i class="fa fa-search"></i></button>
									</form>
								</div> -->
								<div class="header-chart">
									<ul class="list-inline">
										<li><a href="cart.php"><i class="fa fa-cart-arrow-down"></i></a></li>
										<li class="chart-li"><a href="cart.php">ตะกร้าสินค้า</a>
											<ul>
                                                <li>
                                                    <div class="header-chart-dropdown">
                                                    	<?php 
							                                //ประกาศค่าตัวแปรที่ใช้ในการคำนวณ
							                                $sum_price = $sum_total = 0;
							                                //ตรวจสอบว่าถ้าตัวแปร session ไม่ใช่ค่าว่าง
							                                if (!empty($_SESSION['cart'])) { 
							                                    //วนลูปเพื่อดึงข้อมูลรายการอาหารและเครื่องดื่ม
							                                    foreach ($_SESSION['cart'] as $pid => $amt) {
							                                        //คิวรี่ดึงข้อมูลรายการอาหารและเครื่องดื่มจากฐานข้อมูล
							                                        $query2 = 'select 
							                                        	a.product_id, a.name, a.price, b.photo 
							                                        	from product as a 
							                                        	left outer join product_photo as b on a.product_id = b.product_id 
																		and b.active = 1
							                                        	where a.product_id = :pid ';
							                                        $result2 = $con->prepare($query2);
							                                        $result2->execute(['pid'  => $pid]);
							                                        //ถ้ามีข้อมูลรายการอาหารและเครื่องดื่ม
							                                        if ($result2->rowCount()>0) {
							                                            $rs2 = $result2->fetch();
							                                            //คำนวณราคา จำนวน * ราคา
							                                            $sum_price = $amt * $rs2['price'];
							                                            $sum_total += $sum_price;
							                            ?>
                                                        <div class="header-chart-dropdown-list">
                                                            <div class="dropdown-chart-left floatleft">
                                                                <a href="product_detail.php?pid=<?php echo $pid; ?>"><img src="img/product/<?php echo $rs2['photo']; ?>" alt="list"></a>
                                                            </div>
                                                            <div class="dropdown-chart-right">
                                                                <h2><a href="product_detail.php?pid=<?php echo $pid; ?>"><?php echo $rs2['name']; ?></a></h2>
                                                                <h3>Qty: <?php echo $amt; ?></h3>
                                                                <h4><?php echo number_format($rs2['price'], 2); ?> ฿</h4>
                                                            </div>
                                                        </div>
                                                        <?php } } ?>
                                                        
														<div class="chart-checkout">
															<p>ยอดสั่งซื้อ<span><?php echo number_format($sum_total, 2); ?> ฿</span></p>
															<button type="button" onclick="top.window.location='cart.php';" class="btn btn-default">ตะกร้าสินค้า</button>
														</div>
														<?php } ?>
                                                    </div> 
                                                </li> 
                                            </ul> 
										</li>
										<?php if (!empty($_SESSION['cart'])) { ?>
										<li><a href="cart.php"><?php echo count($_SESSION['cart']); ?> รายการ</a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
