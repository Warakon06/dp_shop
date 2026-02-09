<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//ถ้ามีการส่งค่ารหัสสินค้ามาที่หน้านี้
if (!empty($_POST['pid'])) {
    //คิวรี่ดึงข้อมูลสินค้าที่ต้องการแก้ไข  
    $query = 'select * from product where product_id = :pid ';
    $result = $con->prepare($query);
    //แทนค่า parameter
    $result->execute(['pid'  => $_POST['pid']]);
    //ถ้ามีข้อมูลสินค้า
    if ($result->rowCount()>0) {
        //ดึงข้อมูลออกไว้ในตัวแปรอาเรย์
        $rs=$result->fetch();
    //ถ้าไม่มีข้อมูลสินค้า
    } else {
        //ให้กลับไปที่หน้าจอ สินค้า
        gotopage('product.php');
    }
//ถ้าไม่มีการส่งข้อมูลรหัสสินค้ามา
} else {
    //ให้กลับไปที่หน้าจอ สินค้า
    gotopage('product.php');
}
?>
<form action="update_product.php" method="post" class="form" enctype="multipart/form-data">
<div id="edit-product" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">แก้ไขสินค้า</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cat">หมวดหมู่สินค้า</label>
                            <select name="cat" class="form-control" required>
                                <?php
                                    $query2 = 'select * from category where category_id = :cid ';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute(['cid'  => $rs['category_id']]);
                                    $rs2=$result2->fetch();
                                    echo '<option value="'.$rs2['category_id'].'">'.$rs2['name'].'</option>';

                                    //คิวรี่เพื่อดึงข้อมูลหมวดหมู่สินค้า
                                    $query2 = 'select * from category where category_id != :cat';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute(['cat'  => $rs['category_id']]);
                                    //ถ้ามีข้อมูล หมวดหมู่สินค้า
                                    if ($result2->rowCount()>0) {
                                        //วนลูปเพื่อดึงข้อมูลออกมาก
                                        foreach ($result2 as $key2 => $value2) {
                                            //แสดงผลด้วยตัวเลือก
                                            echo '<option value="'.$value2['category_id'].'">'.$value2['name'].'</option>';
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
                            <label for="name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $rs['name']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="detail">คำอธิบายสินค้า</label>
                            <textarea name="detail" rows="6" class="form-control"><?php echo $rs['description']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">จำนวน (-1 = ไม่จำกัด)</label>
                            <input type="text" class="form-control" name="amount" value="<?php echo $rs['amount']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unit">หน่วยสินค้า</label>
                            <input type="text" class="form-control" name="unit" value="<?php echo $rs['unit']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">ราคา/หน่วย</label>
                            <input type="text" class="form-control" name="price" value="<?php echo $rs['price']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">ภาพสินค้า (แนบได้หลายภาพ)</label>
                            <input type="file" name="fileupload[]" accept="images/*" multiple>
                        </div>
                    </div>
                </div>
                <?php
                    $query2 = 'select * from product_photo where product_id = :pid ';
                    $result2 = $con->prepare($query2);
                    $result2->execute(['pid' => $_POST['pid']]);
                    if ($result2->rowCount()>0) { 
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center; font-weight: bold;">แสดงภาพแรก</th>
                                    <th style="text-align: center; font-weight: bold;">รูปภาพ</th>
                                    <th style="text-align: center; font-weight: bold;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result2 as $key => $rs2) { ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="active" id="radio4" value="<?php echo $rs2['photo_id']; ?>" <?php if ($rs2['active']==1) { ?>checked<?php } ?>>
                                            <label for="radio4"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="../img/product/<?php echo $rs2['photo']; ?>" alt="" class="img-rounded" width="200px;">
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="delete_product_photo.php?id_del=<?php echo $rs2['photo_id']; ?>" class="btn btn-danger">ลบรูปภาพ</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
                <input type="hidden" name="id_edit" value="<?php echo $rs['product_id']; ?>">
            	<button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>