<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

$query = 'select 
    a.orders_id, a.orders_date, a.sum_total, a.payment_method, 
    a.slip, a.card_no, a.expire_month, a.expire_year, 
    a.card_name, a.delivery_track, a.delivery_date, a.delivery_time, 
    a.get_orders_date, 
    case when payment_method = 1 then "โอนเข้าบัญชี" 
    when payment_method = 2 then "บัตรเครดิต/เดบิต" 
    when payment_method = 3 then "สแกนจ่าย" 
    else "" end as payment_method_name, 
    a.return_orders_reason, a.shop_comment, 
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
<form action="update_return_orders.php" method="post" class="form">
<div id="edit-return" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">จัดการรายการขอคืนสินค้า</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>หมายเลขการสั่งซื้อ <?php echo $rs['orders_id']; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>วัน-เวลาที่สั่งซื้อ: </b><?php echo thaidatetime($rs['orders_date']); ?>
                    </div>
                    <div class="col-md-6">
                        <b></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>ชื่อ-นามสกุลผู้รับ: </b><?php echo $rs['member_name']; ?>
                    </div>
                    <div class="col-md-6">
                        <b>หมายเลขโทรศัพท์: </b><?php echo $rs['phone_number']; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>ที่อยู่จัดส่ง: </b>
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
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center; font-weight: bold;"></th>
                                    <th style="text-align: center; font-weight: bold;">รายการ</th>
                                    <th style="text-align: center; font-weight: bold;">ราคา/หน่วย</th>
                                    <th style="text-align: center; font-weight: bold;">จำนวน</th>
                                    <th style="text-align: center; font-weight: bold;">เป็นเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query2 = ' select * from orders_detail where orders_id = :orid ';
                                    $result2 = $con->prepare($query2);
                                    $result2->execute(['orid' => $rs['orders_id']]);
                                    if ($result2->rowCount()>0) {
                                        foreach ($result2 as $key => $rs2) {
                                            $query3 = 'select 
                                                a.name, a.price, b.photo
                                                from 
                                                product as a 
                                                left outer join product_photo as b on a.product_id = b.product_id 
                                                and b.active = 1 
                                                where a.product_id = :pid ';
                                            $result3 = $con->prepare($query3);
                                            $result3->execute(['pid' => $rs2['product_id']]);
                                            $rs3 = $result3->fetch();
                                ?>
                                <tr>
                                    <td>
                                        <img src="../img/product/<?php echo $rs3['photo']; ?>" alt="" width="100px;">
                                    </td>
                                    <td><?php echo $rs3['name']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($rs2['price'], 2); ?></td>
                                    <td style="text-align: center;"><?php echo $rs2['amount']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($rs2['sum_price'], 2); ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4" style="text-align: right; font-weight: bold;">ค่าสินค้า</td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?> ฿</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right; font-weight: bold;">ค่าจัดส่ง</td>
                                    <td style="text-align: right;">FREE</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right; font-weight: bold;">รวมเป็นเงินทั้งสิ้น</td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?> ฿</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="well">
                            <h4>เหตุผลที่ขอคืน</h4>
                            <p>
                                <?php echo $rs['return_orders_reason']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">สถานะ</label>
                            <select name="status" class="form-control" required>
                                <option value="7">คืนสินค้า</option>
                                <option value="8">ไม่รับคืนสินค้า</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="comment">หมายเหตุ</label>
                            <textarea name="comment" rows="4" class="form-control" required></textarea>
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