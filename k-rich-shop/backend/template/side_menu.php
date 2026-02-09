<?php 
    $sidebarPhotoPath = 'dist/img/default-150x150.png';
    if (!empty($_SESSION['account_id']) && isset($con)) {
        try {
            $stmt2 = $con->prepare('select photo from user_account where account_id = :aid');
            $stmt2->execute(['aid' => $_SESSION['account_id']]);
            $row2 = $stmt2->fetch();
            if ($row2 && !empty($row2['photo'])) {
                $sidebarPhotoPath = '../img/user/'.$row2['photo'];
            }
        } catch (Exception $e) {}
    }
?>
<!-- Sidebar Menu -->
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ระบบจัดการข้อมูล</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="<?php echo $sidebarPhotoPath; ?>" class="img-circle elevation-2" alt="User Image" style="height:34px;width:34px;object-fit:cover;">
            </div>
            <div class="info">
            <a href="#" class="d-block">
                <?php echo $_SESSION['account_name']; ?> <br>
                สิทธิ์: <?php echo $_SESSION['role_name']; ?>
            </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">เมนูหลัก</li>
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt text-success"></i>
                        <p> แดชบอร์ด</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>ตั้งค่า <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['role']==1) { //ใช้งานได้เฉพาะสิทธิผู้ดูแลระบบ ?>
                        <li class="nav-item">
                            <a href="user.php" class="nav-link">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>ผู้ใช้งาน </p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="category.php" class="nav-link">
                                <i class="fas fa-sitemap nav-icon"></i>
                                <p>หมวดหมู่สินค้า </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="product.php" class="nav-link">
                                <i class="fas fa-boxes nav-icon"></i>
                                <p>สินค้า </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact_settings.php" class="nav-link">
                                <i class="fas fa-address-card nav-icon"></i>
                                <p>ข้อมูลติดต่อ </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="member.php" class="nav-link">
                        <i class="nav-icon fas fa-users text-info"></i>
                        <p>สมาชิก </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="orders.php" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart text-success"></i>
                        <p>รายการสั่งซื้อ </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="payment.php" class="nav-link">
                        <i class="nav-icon fas fa-cash-register text-warning"></i>
                        <p>รายการชำระเงิน </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="prepare.php" class="nav-link">
                        <i class="nav-icon fas fa-dolly-flatbed text-warning"></i>
                        <p>รายการจัดเตรียมสินค้า </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="delivery.php" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast text-success"></i>
                        <p>รายการจัดส่งสินค้า </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="return_orders.php" class="nav-link">
                        <i class="nav-icon fas fa-undo text-danger"></i>
                        <p>รายการขอคืนสินค้า </p>
                    </a>
                </li>
                <?php if ($_SESSION['role']==1) { //ใช้งานได้เฉพาะสิทธิผู้ดูแลระบบ ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy text-info"></i>
                        <p>รายงาน <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="report_member.php" class="nav-link">
                                <i class="fas fa-file-alt nav-icon text-warning"></i>
                                <p>สมาชิก </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report_product.php" class="nav-link">
                                <i class="fas fa-file-alt nav-icon text-warning"></i>
                                <p>สินค้า </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report_sale.php" class="nav-link">
                                <i class="fas fa-file-alt nav-icon text-warning"></i>
                                <p>การสั่งซื้อ </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report_payment.php" class="nav-link">
                                <i class="fas fa-file-alt nav-icon text-warning"></i>
                                <p>การชำระเงิน </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report_delivery.php" class="nav-link">
                                <i class="fas fa-file-alt nav-icon text-warning"></i>
                                <p>การจัดส่งสินค้า </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report_return_orders.php" class="nav-link">
                                <i class="fas fa-file-alt nav-icon text-warning"></i>
                                <p>การคืนสินค้า </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

                <!--<li class="nav-item">
                    <a href="login.php" class="nav-link">
                        <i class="nav-icon fas fa-th text-info"></i>
                        <p>Login </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="org-main.php" class="nav-link">
                        <i class="nav-icon fas fa-th text-info"></i>
                        <p>Main </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="org-insert.php" class="nav-link">
                        <i class="nav-icon fas fa-edit text-info"></i>
                        <p>Insert Form </p>
                    </a>
                </li>
                <li class="nav-header">รายงาน</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy text-info"></i>
                        <p>รายงาน <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>รายงาน1 </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>รายงาน2 </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>รายงาน3 </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog text-info"></i>
                        <p>ข้อมูลส่วนตัว </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-door-open text-danger"></i>
                        <p>ออกจากระบบ </p>
                    </a>
                </li>
            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>
