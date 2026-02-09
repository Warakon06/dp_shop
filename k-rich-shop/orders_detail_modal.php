<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ดึงข้อมูลรายการสั่งซื้อ
$query = 'select 
a.orders_id, a.orders_date, a.sum_total, a.status, a.phone_number, 
concat(b.first_name, " ", b.last_name) as member_name, 
a.home_no, a.village, a.soi, a.road, c.name_th as province_name, 
d.name_th as district_name, e.name_th as subdistrict_name, 
a.post_code, a.payment_method, a.slip, a.card_no, a.expire_month, 
a.expire_year, a.card_name, a.card_code, a.delivery_date, a.delivery_time, 
a.delivery_track, a.get_orders_date, 
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
and a.orders_id = :orid 
';
$result = $con->prepare($query);
$result->execute(['orid' => $_POST['orid']]);
$rs = $result->fetch();
?>
<form action="#" method="post" class="form">
<div id="orders-detail" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">&nbsp;</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>ใบสั่งซื้อ</h4>
                    </div>
                </div>
                <br>
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
                                    <th style="text-align: center; font-weight: bold;">ราคา/หน่วย</th>
                                    <th style="text-align: center; font-weight: bold;">จำนวน</th>
                                    <th style="text-align: center; font-weight: bold;">รวมเงิน</th>
                                    <th style="text-align: center; font-weight: bold;">คะแนน</th>
                                    <th style="text-align: center; font-weight: bold;">รีวิว</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    //ดึงข้อมูลรายการสินค้าที่สั่งซื้อ
                                    $query2 = 'select 
                                        a.amount, a.price, a.sum_price, 
                                        b.name, c.photo, d.score, d.comment 
                                        from orders_detail as a 
                                        left outer join review_product as d on a.orders_id = d.orders_id and a.product_id = d.product_id  
                                        , product as b 
                                        left outer join product_photo as c on b.product_id = c.product_id 
                                        and c.active = 1 
                                        where a.orders_id = :orid  
                                        and a.product_id = b.product_id';
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
                                    <td style="text-align: center;"><?php echo $value['score']; ?></td>
                                    <td><?php echo $value['comment']; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; font-weight: bold;">ค่าสินค้า</td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center; font-weight: bold;">ค่าจัดส่ง</td>
                                    <td style="text-align: right;">Free</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center; font-weight: bold;">รวมเป็นเงินทั้งสิ้น</td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h4>การชำระเงิน</h4>
                        <b>วิธีการชำระเงิน: </b> <?php echo $rs['payment_method_name']; ?>
                        <table class="table table-striped table-hover">
                            <tbody>
                                <?php if ($rs['payment_method']==1) { //โอนเงิน ?>
                                <tr>
                                    <td>หลักฐาน</td>
                                    <td><a href="img/slip/<?php echo $rs['slip']; ?>" target="_new">ดูสลิป</a></td>
                                </tr>
                                <?php } else if ($rs['payment_method']==2) { //บัตรเครดิต/เดบิต ?>
                                <tr>
                                    <td>card no</td>
                                    <td><?php echo $rs['card_no']; ?></td>
                                </tr>
                                <tr>
                                    <td>expire</td>
                                    <td><?php echo $rs['expire_month'].'/'.$rs['expire_year']; ?></td>
                                </tr>
                                <tr>
                                    <td>card name</td>
                                    <td><?php echo $rs['card_name']; ?></td>
                                </tr>
                                <?php } else if ($rs['payment_method']==3) { //สแกน QRCode ?>
                                <tr>
                                    <td>หลักฐาน</td>
                                    <td><a href="img/slip/<?php echo $rs['slip']; ?>" target="_new">ดูสลิป</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>การจัดส่งสินค้า</h4>
                        <?php if (!empty($rs['delivery_track'])) { ?>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>วัน-เวลาที่จัดส่ง</td>
                                    <td><?php echo thaidate($rs['delivery_date']).' '.$rs['delivery_time']; ?></td>
                                </tr>
                                <tr>
                                    <td>หมายเลขพัสดุ</td>
                                    <td><?php echo $rs['delivery_track']; ?></td>
                                </tr>
                                <?php if (!empty($rs['get_orders_date'])) { ?>
                                <tr>
                                    <td>วันที่รับสินค้า</td>
                                    <td><?php echo thaidate($rs['get_orders_date']); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-danger" data-dismiss="modal"> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>