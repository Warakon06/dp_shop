<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 
?>
<form action="save_user.php" method="post" class="form" enctype="multipart/form-data">
<div id="add-user" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">เพิ่มผู้ใช้งาน</h4>
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
                                <option value="1">ผู้ดูแลระบบ</option>
                                <option value="2">พนักงาน</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fname">ชื่อ</label>
                            <input type="text" class="form-control" name="fname" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lname">นามสกุล</label>
                            <input type="text" class="form-control" name="lname" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">รูปโปรไฟล์</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pass">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="pass" required>
                        </div>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>
