<!-- Navbar -->
<?php 
    $displayName = !empty($_SESSION['account_name']) ? $_SESSION['account_name'] : 'ผู้ใช้งาน';
    $photoPath = 'dist/img/default-150x150.png';
    if (!empty($_SESSION['account_id']) && isset($con)) {
        try {
            $stmt = $con->prepare('select photo from user_account where account_id = :aid');
            $stmt->execute(['aid' => $_SESSION['account_id']]);
            $row = $stmt->fetch();
            if ($row && !empty($row['photo'])) {
                $photoPath = '../img/user/'.$row['photo'];
            }
        } catch (Exception $e) {}
    }
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="เปิดเมนู">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="<?php echo $photoPath; ?>" alt="profile" style="height:28px;width:28px;object-fit:cover;border-radius:50%;margin-right:8px;">
                <?php echo $displayName; ?> <i class="fas fa-angle-double-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Menu</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="editSelfProfile()">
                    <i class="fas fa-user-cog mr-2"></i> แก้ไขโปรไฟล์
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item">
                    <i class="fas fa-door-open mr-2"></i> ออกจากระบบ
                </a>
                <div class="dropdown-divider"></div>
                <!-- <a href="#" class="dropdown-item dropdown-footer">ออกจากระบบ</a> -->
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<div id="global-modal"></div>
<script>
    function editSelfProfile() {
        var data = {};
        data.uid = '<?php echo !empty($_SESSION['account_id']) ? $_SESSION['account_id'] : ''; ?>';
        $('#global-modal').load('edit_user_modal.php', data, function(){
            $("#edit-user").modal('show');
        });
    }
</script>
<!-- /.navbar
