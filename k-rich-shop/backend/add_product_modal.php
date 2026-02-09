<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 
?>
<form action="save_product.php" method="post" class="form" enctype="multipart/form-data">
<div id="add-product" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">เพิ่มสินค้า</h4>
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
                                <option value="">- เลือก -</option>
                                <?php
                                    //คิวรี่เพื่อดึงข้อมูลหมวดหมู่สินค้า
                                    $query2 = 'select * from category';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute();
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
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="detail">คำอธิบายสินค้า</label>
                            <textarea name="detail" rows="6" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">จำนวน (-1 = ไม่จำกัด)</label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unit">หน่วยสินค้า</label>
                            <input type="text" class="form-control" name="unit" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">ราคา/หน่วย</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">ภาพสินค้า (แนบได้หลายภาพ)</label>
                            <input type="file" name="fileupload[]" accept="images/*" multiple required>
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