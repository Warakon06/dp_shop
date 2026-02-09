<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//ถ้ามีการส่งค่ารหัสหมวดหมู่มาที่หน้านี้
if (!empty($_POST['cid'])) {
    //คิวรี่ดึงข้อมูลหมวดหมู่ที่ต้องการแก้ไข    
    $query = 'select * from category where category_id = :cid ';
    $result = $con->prepare($query);
    //แทนค่า parameter
    $result->execute(['cid'  => $_POST['cid']]);
    //ถ้ามีข้อมูลหมวดหมู่
    if ($result->rowCount()>0) {
        //ดึงข้อมูลออกไว้ในตัวแปรอาเรย์
        $rs=$result->fetch();
    //ถ้าไม่มีข้อมูลหมวดหมู่
    } else {
        //ให้กลับไปที่หน้าจอ หมวดหมู่สินค้า
        gotopage('category.php');
    }
//ถ้าไม่มีการส่งข้อมูลรหัสหมวดหมู่มา
} else {
    //ให้กลับไปที่หน้าจอ หมวดหมู่สินค้า
    gotopage('category.php');
}
?>
<form action="update_category.php" method="post" class="form">
<div id="edit-cat" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">แก้ไขหมวดหมู่สินค้า</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">ชื่อหมวดหมู่</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $rs['name']; ?>" required>
                        </div>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
                <input type="hidden" name="id_edit" value="<?php echo $rs['category_id']; ?>">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>