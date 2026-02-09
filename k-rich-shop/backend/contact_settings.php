<?php 
include '../include/connect_db.php';
include '../include/function.php';
if (empty($_SESSION['account_id'])) { gotopage('login.php'); exit; }
try {
    $con->exec("CREATE TABLE IF NOT EXISTS site_settings (
        id INT PRIMARY KEY,
        phone VARCHAR(100) NULL,
        email VARCHAR(150) NULL,
        website VARCHAR(255) NULL,
        address VARCHAR(255) NULL,
        map_src TEXT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    $chk = $con->query("SELECT COUNT(*) AS c FROM site_settings WHERE id=1");
    if (($row = $chk->fetch()) && (int)$row['c']===0) {
        $con->exec("INSERT INTO site_settings (id, phone, email, website, address, map_src) VALUES (1, '', '', '', '', '')");
    }
    $rs = $con->query("SELECT * FROM site_settings WHERE id=1")->fetch();
} catch (Exception $e) { $rs = ['phone'=>'','email'=>'','website'=>'','address'=>'','map_src'=>'']; }
$actStatus = !empty($_GET['act']) ? $_GET['act'] : '';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตั้งค่าข้อมูลติดต่อ</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <style> body{font-family:'Sarabun',sans-serif;} .map-preview{border:1px solid #ddd;border-radius:4px;overflow:hidden} </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'template/header.php'; ?>
    <?php include 'template/side_menu.php'; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1>ตั้งค่าข้อมูลติดต่อ</h1></div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <?php 
                            if (!empty($actStatus)) {
                                if ($actStatus=='save_success') {
                                    echo '<div class="alert alert-success">บันทึกสำเร็จ</div>';
                                } else if ($actStatus=='save_error') {
                                    echo '<div class="alert alert-danger">บันทึกไม่สำเร็จ</div>';
                                }
                            }
                        ?>
                        <form action="update_contact_settings.php" method="post">
                            <div class="form-group">
                                <label>โทร</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($rs['phone']); ?>">
                            </div>
                            <div class="form-group">
                                <label>อีเมล</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($rs['email']); ?>">
                            </div>
                            <div class="form-group">
                                <label>เว็บไซต์</label>
                                <input type="text" name="website" class="form-control" value="<?php echo htmlspecialchars($rs['website']); ?>">
                            </div>
                            <div class="form-group">
                                <label>ที่ตั้ง</label>
                                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($rs['address']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Google Maps iframe src</label>
                                <textarea name="map_src" class="form-control" rows="3" placeholder="วางค่า src จาก Google Maps Embed"><?php echo htmlspecialchars($rs['map_src']); ?></textarea>
                                <small class="text-muted">ใส่เฉพาะค่า src เช่น https://www.google.com/maps/embed?pb=...</small>
                            </div>
                            <hr>
                            <h5>ลิงก์โซเชียล</h5>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" name="fb_link" class="form-control" value="<?php echo isset($rs['fb_link']) ? htmlspecialchars($rs['fb_link']) : ''; ?>" placeholder="เช่น https://facebook.com/yourpage">
                            </div>
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="text" name="tw_link" class="form-control" value="<?php echo isset($rs['tw_link']) ? htmlspecialchars($rs['tw_link']) : ''; ?>" placeholder="เช่น https://twitter.com/yourhandle">
                            </div>
                            <div class="form-group">
                                <label>Google+</label>
                                <input type="text" name="gp_link" class="form-control" value="<?php echo isset($rs['gp_link']) ? htmlspecialchars($rs['gp_link']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>LinkedIn</label>
                                <input type="text" name="ln_link" class="form-control" value="<?php echo isset($rs['ln_link']) ? htmlspecialchars($rs['ln_link']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Pinterest</label>
                                <input type="text" name="pt_link" class="form-control" value="<?php echo isset($rs['pt_link']) ? htmlspecialchars($rs['pt_link']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Vimeo</label>
                                <input type="text" name="vm_link" class="form-control" value="<?php echo isset($rs['vm_link']) ? htmlspecialchars($rs['vm_link']) : ''; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">ตัวอย่างแผนที่</div>
                    <div class="card-body map-preview">
                        <?php if (!empty($rs['map_src'])) { ?>
                        <iframe src="<?php echo htmlspecialchars($rs['map_src']); ?>" style="width:100%;height:350px;border:0;" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <?php } else { ?>
                        <p class="text-muted">ยังไม่ได้ตั้งค่าแผนที่</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include 'template/footer.php'; ?>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<script>
    $(function(){
        var act = '<?php echo $actStatus; ?>';
        if (act==='save_success') {
            Swal.fire({ title: 'บันทึกสำเร็จ', icon: 'success', confirmButtonText: 'ตกลง' });
        } else if (act==='save_error') {
            Swal.fire({ title: 'บันทึกไม่สำเร็จ', icon: 'error', confirmButtonText: 'ตกลง' });
        }
    });
</script>
</body>
</html>
