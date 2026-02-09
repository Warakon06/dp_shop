<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

$query = 'select 
    a.orders_id, 
    concat(b.first_name, " ", b.last_name) as member_name, 
    b.phone_number, b.home_no ,b.village, b.soi, b.road, 
    c.name_th as province_name, d.name_th as district_name, 
    e.name_th as subdistrict_name, b.post_code
    from orders as a , member as b 
    left outer join province as c on b.province_id = c.province_id 
    left outer join district as d on b.district_id = d.district_id 
    left outer join subdistrict as e on b.subdistrict_id = e.subdistrict_id 
    where a.orders_id = :orid 
    and a.member_id = b.member_id 
';
$result = $con->prepare($query);
$result->execute(['orid' => $_POST['orid']]);
if ($result->rowCount()>0) {
    $rs = $result->fetch();
}
?>
<form action="save_delivery.php" method="post" class="form">
<div id="add-delivery" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">บันทึกการจัดส่งสินค้า</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>ชื่อผู้รับ</h3>
                        <p><?php echo $rs['member_name']; ?></p>
                        <h3>ที่อยู่ผู้รับ</h3>
                        <p>
                        <?php 
                            if (!empty($rs['village'])) { echo $rs['village']; }
                            echo ' เลขที่ '.$rs['home_no'];
                            if (!empty($rs['soi'])) { echo ' ซอย'.$rs['soi']; }
                            if (!empty($rs['road'])) { echo ' ถนน'.$rs['road']; }
                            echo ' ตำบล'.$rs['subdistrict_name'];
                            echo ' อำเภอ'.$rs['district_name'];
                            echo ' จังหวัด'.$rs['province_name'];
                            echo ' รหัสไปรษณีย์ '.$rs['post_code'];
                        ?>
                        </p>
                        <h3>เบอร์โทรศัพท์ผู้รับ</h3>
                        <p><?php echo $rs['phone_number']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ddate">วันที่จัดส่ง</label>
                            <input type="text" class="form-control" name="ddate" id="ddate" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dtime">เวลาจัดส่ง</label>
                            <input type="text" class="form-control" name="dtime" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="traking">เลขพัสดุ</label>
                            <input type="text" class="form-control" name="traking" required>
                        </div>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
                <input type="hidden" name="orders_id" value="<?php echo $rs['orders_id']; ?>">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>