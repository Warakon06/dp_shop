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
    when a.status = 7 then "คืนสินค้า" 
    when a.status = 8 then "ไม่รับคืนสินค้า" 
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
    and a.orders_id = :orid ';
$result = $con->prepare($query);
$result->execute(['orid' => $_POST['orid']]);
$rs = $result->fetch();
?>
<form action="save_return_orders.php" method="post" class="form">
<div id="return-orders" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">ทำเรื่องคืนสินค้า</h4>
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
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2" style="text-align: center; font-weight: bold;">รายการ</th>
                                    <th style="text-align: center; font-weight: bold;">ราคา/หน่วย</th>
                                    <th style="text-align: center; font-weight: bold;">จำนวน</th>
                                    <th style="text-align: center; font-weight: bold;">รวมเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    //ดึงข้อมูลรายละเอียดการสั่งซื้อ
                                    $query2 = 'select 
                                        a.amount, a.price, a.sum_price, 
                                        b.name, c.photo 
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
                                    </td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($value['price'], 2); ?></td>
                                    <td style="text-align: center;"><?php echo $value['amount']; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($value['sum_price'], 2); ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; font-weight: bold;">ค่าสินค้า</td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center; font-weight: bold;">ค่าจัดส่ง</td>
                                    <td style="text-align: right;">Free</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center; font-weight: bold;">รวมเป็นเงินทั้งสิ้น</td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ระบุเหตุผลที่ขอคืน</label>
                            <textarea name="reason" rows="5" class="form-control" reqiored></textarea>
                        </div>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
                <input type="hidden" name="orders_id" value="<?php echo $rs['orders_id']; ?>">
                <button class="btn btn-success" type="submit">บันทึก</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal"> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>