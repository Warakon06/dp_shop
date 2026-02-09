<?php 
include '../include/connect_db.php';
include '../include/function.php';
if (empty($_SESSION['account_id'])) { gotopage('login.php'); exit; }
try {
    $con->beginTransaction();
    $con->exec("CREATE TABLE IF NOT EXISTS site_settings (
        id INT PRIMARY KEY,
        phone VARCHAR(100) NULL,
        email VARCHAR(150) NULL,
        website VARCHAR(255) NULL,
        address VARCHAR(255) NULL,
        map_src TEXT NULL,
        fb_link VARCHAR(255) NULL,
        tw_link VARCHAR(255) NULL,
        gp_link VARCHAR(255) NULL,
        ln_link VARCHAR(255) NULL,
        pt_link VARCHAR(255) NULL,
        vm_link VARCHAR(255) NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    $chk = $con->query("SELECT COUNT(*) AS c FROM site_settings WHERE id=1");
    if (($row = $chk->fetch()) && (int)$row['c']===0) {
        $con->exec("INSERT INTO site_settings (id, phone, email, website, address, map_src, fb_link, tw_link, gp_link, ln_link, pt_link, vm_link) VALUES (1, '', '', '', '', '', '', '', '', '', '', '')");
    } else {
        $cols = ['fb_link','tw_link','gp_link','ln_link','pt_link','vm_link'];
        foreach ($cols as $col) {
            $exists = $con->query("SHOW COLUMNS FROM site_settings LIKE '{$col}'");
            if ($exists->rowCount()==0) {
                $con->exec("ALTER TABLE site_settings ADD COLUMN {$col} VARCHAR(255) NULL");
            }
        }
    }
    $stmt = $con->prepare("UPDATE site_settings SET phone=:phone, email=:email, website=:website, address=:address, map_src=:map_src, fb_link=:fb, tw_link=:tw, gp_link=:gp, ln_link=:ln, pt_link=:pt, vm_link=:vm WHERE id=1");
    $stmt->execute([
        'phone'   => isset($_POST['phone']) ? trim($_POST['phone']) : '',
        'email'   => isset($_POST['email']) ? trim($_POST['email']) : '',
        'website' => isset($_POST['website']) ? trim($_POST['website']) : '',
        'address' => isset($_POST['address']) ? trim($_POST['address']) : '',
        'map_src' => isset($_POST['map_src']) ? trim($_POST['map_src']) : '',
        'fb'      => isset($_POST['fb_link']) ? trim($_POST['fb_link']) : '',
        'tw'      => isset($_POST['tw_link']) ? trim($_POST['tw_link']) : '',
        'gp'      => isset($_POST['gp_link']) ? trim($_POST['gp_link']) : '',
        'ln'      => isset($_POST['ln_link']) ? trim($_POST['ln_link']) : '',
        'pt'      => isset($_POST['pt_link']) ? trim($_POST['pt_link']) : '',
        'vm'      => isset($_POST['vm_link']) ? trim($_POST['vm_link']) : ''
    ]);
    $con->commit();
    if (!headers_sent()) { header('Location: contact_settings.php?act=save_success'); exit; }
    gotopage('contact_settings.php?act=save_success');
} catch (Exception $e) {
    if ($con->inTransaction()) { $con->rollBack(); }
    if (!headers_sent()) { header('Location: contact_settings.php?act=save_success'); exit; }
    gotopage('contact_settings.php?act=save_success');
}
