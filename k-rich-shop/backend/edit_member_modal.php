<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//เช้คว่ามีการเข้าสู่ระบบหรือไม่
if (empty($_SESSION['role'])) {
    //ถ้าไม่มีการเข้าสู่ระบบให้กลับไปที่หน้า index และแสดงกล่องข้อความแจ้งเตือน
    gotopage('index.php?act=login_pls');
} else {
    $query = 'select 
        a.member_id, a.first_name, a.last_name, a.village, a.home_no, 
        a.soi, a.road, a.post_code, a.phone_number, a.email, 
        a.province_id, a.district_id, a.subdistrict_id, 
        b.name_th as province_name, c.name_th as district_name, 
        d.name_th as subdistrict_name 
        from member as a 
        left outer join province as b on a.province_id = b.province_id 
        left outer join district as c on a.district_id = c.district_id 
        left outer join subdistrict as d on a.subdistrict_id = d.subdistrict_id 
        where a.member_id = :mid ';
    $result = $con->prepare($query);
    $result->execute(['mid'  => $_POST['mid']]);
    $rs = $result->fetch();
}
?>
<form action="update_member.php" method="post" class="form" enctype="multipart/form-data">
<div id="edit-member" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">แก้ไขข้อมูลสมาชิก</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>ข้อมูลส่วนบุคคล</h4><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php 
                                $photoPath = 'dist/img/default-150x150.png';
                                try {
                                    $chk = $con->query("SHOW COLUMNS FROM member LIKE 'photo'");
                                    if ($chk->rowCount()>0) {
                                        $stp = $con->prepare('select photo from member where member_id = :mid');
                                        $stp->execute(['mid' => $rs['member_id']]);
                                        $rp = $stp->fetch();
                                        if ($rp && !empty($rp['photo'])) {
                                            $photoPath = '../img/member/'.$rp['photo'];
                                        }
                                    }
                                } catch (Exception $e) {}
                            ?>
                            <div style="margin-bottom:8px;">
                                <img src="<?php echo $photoPath; ?>" alt="profile" style="height:80px;width:80px;object-fit:cover;border-radius:50%;">
                            </div>
                            <label for="photo">รูปโปรไฟล์</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fname">ชื่อ <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $rs['first_name']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lname">นามสกุล <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $rs['last_name']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="tel" value="<?php echo $rs['phone_number']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>ที่อยู่สำหรับจัดส่งสินค้า</h4><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="home">บ้านเลขที่ <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="home" value="<?php echo $rs['home_no']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="village">หมู่บ้าน/อาคาร</label>
                            <input type="text" class="form-control" name="village" value="<?php echo $rs['village']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="soi">ซอย</label>
                            <input type="text" class="form-control" name="soi" value="<?php echo $rs['soi']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="road">ถนน</label>
                            <input type="text" class="form-control" name="road" value="<?php echo $rs['road']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="province">จังหวัด <sup class="text-danger">*</sup></label>
                            <select name="province" id="province" class="form-control select2" onchange="chLocal('province', this.value)" required>
                                <option value="<?php echo $rs['province_id']; ?>"><?php echo $rs['province_name']; ?></option>
                                <?php 
                                    $query2 = 'select * from province where province_id != :pid';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute(['pid' => $rs['province_id']]);
                                    if ($result2->rowCount()>0) {
                                        foreach ($result2 as $key => $rs2) {
                                            echo '<option value="'.$rs2['province_id'].'">'.$rs2['name_th'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="district">อำเภอ/เขต <sup class="text-danger">*</sup></label>
                            <select name="district" id="district" class="form-control select2" onchange="chLocal('district', this.value)" required>
                                <option value="<?php echo $rs['district_id']; ?>"><?php echo $rs['district_name']; ?></option>
                                <?php 
                                    $query2 = 'select * from district where district_id != :disid and province_id = :pid ';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute([
                                        'disid' => $rs['district_id'],
                                        'pid'   => $rs['province_id']
                                    ]);
                                    if ($result2->rowCount()>0) {
                                        foreach ($result2 as $key => $rs2) {
                                            echo '<option value="'.$rs2['district_id'].'">'.$rs2['name_th'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subdistrict">ตำบล/แขวง <sup class="text-danger">*</sup></label>
                            <select name="subdistrict" id="subdistrict" class="form-control select2" onchange="chLocal('subdistrict', this.value)" required>
                                <option value="<?php echo $rs['subdistrict_id']; ?>"><?php echo $rs['subdistrict_name']; ?></option>
                                <?php 
                                    $query2 = 'select * from subdistrict where 
                                        subdistrict_id != :subid and 
                                        district_id = :distid ';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute([
                                        'subid'     => $rs['subdistrict_id'],
                                        'distid'    => $rs['district_id']
                                    ]);
                                    if ($result2->rowCount()>0) {
                                        foreach ($result2 as $key => $rs2) {
                                            echo '<option value="'.$rs2['subdistrict_id'].'">'.$rs2['name_th'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="postcode">รหัสไปรษณีย์ <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $rs['post_code']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>ข้อมูลการเข้าใช้งานระบบ</h4><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">อีเมล <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="email" value="<?php echo $rs['email']; ?>" readonly>
                        </div>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
                <input type="hidden" name="id_edit" value="<?php echo $rs['member_id']; ?>">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>
