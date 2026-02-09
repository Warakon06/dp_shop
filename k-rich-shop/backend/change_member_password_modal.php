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
?>
<form action="update_member_password.php" method="post" class="form" enctype="multipart/form-data" id="chPassForm">
<div id="chpass-member" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xs" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">เปลี่ยนรหัสผ่าน</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="newpass1">รหัสผ่านใหม่ <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="newpass1" id="newpass1" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="newpass2">ยืนยันรหัสผ่านใหม่ <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="newpass2" id="newpass2" required>
                        </div>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
                <input type="hidden" name="id_edit" value="<?php echo $_POST['mid']; ?>">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>