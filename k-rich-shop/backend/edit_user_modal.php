<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//เช้คว่ามีการเข้าสู่ระบบหรือไม่
if (empty($_SESSION['role'])) {
    //ถ้าไม่มีการเข้าสู่ระบบให้กลับไปที่หน้า index และแสดงกล่องข้อความแจ้งเตือน
    gotopage('index.php?act=login_pls');
}

if (!empty($_POST['uid'])) {
    $query = 'select * from user_account where account_id = :aid ';
    $result = $con->prepare($query);
    $result->execute(['aid'  => $_POST['uid']]);
    if ($result->rowCount()>0) {
        $rs = $result->fetch();
    }
} else {
    gotopage('user.php');
}
?>
<form action="update_user.php" method="post" class="form" enctype="multipart/form-data">
<div id="edit-user" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">แก้ไขผู้ใช้งาน</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">สิทธิการใช้งาน</label>
                            <select name="role" class="form-control" required>
                                <?php if ($rs['role_id']==1) { ?>
                                <option value="1">ผู้ดูแลระบบ</option>
                                <option value="2">พนักงาน</option>
                                <?php } else if ($rs['role_id']==2) { ?>
                                <option value="2">พนักงาน</option>
                                <option value="1">ผู้ดูแลระบบ</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fname">ชื่อ</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $rs['first_name']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lname">นามสกุล</label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $rs['last_name']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $rs['email']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">รูปโปรไฟล์</label>
                            <div style="margin-bottom:8px;">
                                <?php 
                                    $defaultPhoto = 'dist/img/default-150x150.png';
                                    $photoPath = !empty($rs['photo']) ? '../img/user/'.$rs['photo'] : $defaultPhoto;
                                ?>
                                <img src="<?php echo $photoPath; ?>" alt="profile" style="height:60px;width:60px;object-fit:cover;border-radius:50%;">
                            </div>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pass">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="pass">
                        </div>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
                <input type="hidden" name="id_edit" value="<?php echo $rs['account_id']; ?>">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>
