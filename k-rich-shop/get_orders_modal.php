<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ดึงข้อมูลการสั่งซื้อ
$query = 'select 
a.orders_id, a.orders_date, a.sum_total, a.status, a.phone_number, 
concat(b.first_name, " ", b.last_name) as member_name, a.member_id, 
a.home_no, a.village, a.soi, a.road, c.name_th as province_name, 
d.name_th as district_name, e.name_th as subdistrict_name, 
a.post_code, a.payment_method, a.slip, a.card_no, a.expire_month, 
a.expire_year, a.card_name, a.card_code, a.delivery_date, a.delivery_time, 
a.delivery_track, 
case when a.status = 1 then "ยังไม่ชำระเงิน" 
when a.status = 2 then "รอตรวจสอบยอดเงิน" 
when a.status = 3 then "ชำระเงินแล้ว" 
when a.status = 4 then "พัสดุกำลังจัดส่ง" 
when a.status = 5 then "ได้รับสินค้าแล้ว" 
when a.status = 6 then "ยกเลิก" 
else "" end as status_name, 
case when a.payment_method = 1 then "โอนผ่านบัญชีธนาคาร" 
when a.payment_method = 2 then "บัตรเครดิต/เดบิต" 
when a.payment_method = 3 then "สแกนจ่าย" 
else "" end as payment_method_name
from orders as a 
left outer join province as c on a.province_id = c.province_id 
left outer join district as d on a.district_id = d.district_id 
left outer join subdistrict as e on a.subdistrict_id = e.subdistrict_id
, member as b 
where 
a.member_id = b.member_id 
and a.orders_id = :orid 
';
$result = $con->prepare($query);
$result->execute(['orid' => $_POST['orid']]);
$rs = $result->fetch();
?>
<form action="save_get_orders.php" method="post" class="form">
<div id="get-orders" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">ยืนยันการรับสินค้า</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <b>เลขใบสั่งซื้อ: </b><?php echo $rs['orders_id']; ?>
                    </div>
                    <div class="col-md-6">
                        <b>วัน-เวลาที่สั่งซื้อ: </b><?php echo thaidatetime($rs['orders_date']); ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>ชื่อ-สกุลผู้สั่งซื้อ: </b><?php echo $rs['member_name']; ?>
                    </div>
                    <div class="col-md-6">
                        <b>เบอร์โทรศัพท์: </b><?php echo $rs['phone_number']; ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <b>ที่อยู่จัดส่งสินค้า: </b>
                        <?php 
                            //แสดงที่อยู่จัดส่งสินค้า
                            echo 'เลขที่ '.$rs['home_no']; 
                            if (!empty($rs['village'])) { echo ' หมู่บ้าน/อาคาร '.$rs['village']; }
                            if (!empty($rs['soi'])) { echo ' ซอย '.$rs['soi']; }
                            if (!empty($rs['road'])) { echo ' ถนน '.$rs['road']; }
                            echo $rs['subdistrict_name'].' '.$rs['district_name'].' '.$rs['province_name'];
                            echo ' '.$rs['post_code'];
                        ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <b>สถานะใบสั่งซื้อ: </b></b><?php echo $rs['status_name']; ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2" style="text-align: center; font-weight: bold;">รายการ</th>
                                    <th style="text-align: center; font-weight: bold;">คะแนน</th>
                                    <th style="text-align: center; font-weight: bold;">รีวิวสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    //ดึงข้อมูลรายการสินค้าที่สั่งซื้อ
                                    $query2 = 'select a.product_id, 
                                        a.amount, a.price, a.sum_price, 
                                        b.name, c.photo, b.unit 
                                        from orders_detail as a, product as b 
                                        left outer join product_photo as c on b.product_id = c.product_id 
                                        and c.active = 1 
                                        where a.orders_id = :orid 
                                        and a.product_id = b.product_id ';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute(['orid' => $_POST['orid']]);
                                    if ($result2->rowCount()>0) {
                                        foreach ($result2 as $key => $value) {
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <img src="img/product/<?php echo $value['photo']; ?>" alt="review" width="100px;">
                                        <input type="hidden" name="proid[]" value="<?php echo $value['product_id']; ?>">
                                    </td>
                                    <td><?php echo $value['name'].' x '.$value['amount'].' '.$value['unit']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" name="score[]" required>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="comment[]">
                                        </div>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        ** หากสินค้าไม่ตรงปกหรือติดปัญหาท่านสามารถทำเรื่องคืนสินค้าหลังจากได้รับสินค้าไปแล้วภายใน 7 วัน
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
                <input type="hidden" name="orders_id" value="<?php echo $rs['orders_id']; ?>">
                <input type="hidden" name="member_id" value="<?php echo $rs['member_id']; ?>">
                <button class="btn btn-success" type="submit">ยืนยันการรับสินค้า</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>