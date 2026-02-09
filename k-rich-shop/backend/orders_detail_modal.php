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
        a.orders_id, a.orders_date, 
        a.sum_total, a.status, a.member_id, 
        case when a.status = 1 then "ยังไม่ชำระเงิน" 
        when a.status = 2 then "รอตรวจสอบยอดเงิน" 
        when a.status = 3 then "ชำระเงินแล้ว" 
        when a.status = 4 then "พัสดุกำลังจัดส่ง" 
        when a.status = 5 then "ได้รับสินค้าแล้ว" 
        when a.status = 6 then "ยกเลิก" 
        when a.status = 7 then "คืนสินค้า" 
        when a.status = 8 then "ไม่รับคืนสินค้า"
        else "" end as status_name
        from orders as a 
        where a.orders_id = :orid ';
    $result = $con->prepare($query);
    $result->execute(['orid'  => $_POST['orid']]);
    $rs = $result->fetch();

    $query2 = 'select 
        concat(a.first_name, " ", a.last_name) as member_name, 
        a.phone_number, a.home_no, a.village, a.soi, a.road, 
        b.name_th as province_name, c.name_th as district_name, 
        d.name_th as subdistrict_name, a.post_code 
        from member as  a  
        left outer join province as b on a.province_id = b.province_id 
        left outer join district as c on a.district_id = c.district_id 
        left outer join subdistrict as d on a.subdistrict_id = d.subdistrict_id 
        where a.member_id = :mid ';
    $result2 = $con->prepare($query2);
    $result2->execute(['mid'  => $rs['member_id']]);
    $rs2 = $result2->fetch();
}
?>
<form action="#" method="post" class="form">
<div id="orders-detail" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-xl" style="width: 100%;">
      	<div class="modal-content">
          	<div class="modal-header bg-header-modals">
              	<h4 class="modal-title " id="myModalLabel2">ใบสั่งซื้อ: <?php echo $rs['orders_id']; ?></h4>
              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" name="act" value="add">
          	</div>
            <!-- end header -->
          	<div class="modal-body">
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
                        <b>ชื่อ-นามสกุลผู้รับ: </b><?php echo $rs2['member_name']; ?>
                    </div>
                    <div class="col-md-6">
                        <b>หมายเลขโทรศัพท์: </b><?php echo $rs2['phone_number']; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>ที่อยู่จัดส่ง: </b>
                        <?php 
                            if (!empty($rs2['village'])) { echo $rs2['village']; }
                            echo ' เลขที่ '.$rs2['home_no'];
                            if (!empty($rs2['soi'])) { echo ' ซอย'.$rs2['soi']; }
                            if (!empty($rs2['road'])) { echo ' ถนน'.$rs2['road']; }
                            echo ' ตำบล'.$rs2['subdistrict_name'];
                            echo ' อำเภอ'.$rs2['district_name'];
                            echo ' จังหวัด'.$rs2['province_name'];
                            echo ' รหัสไปรษณีย์ '.$rs2['post_code'];
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
                                    <th style="text-align: center; font-weight: bold;">รายการสินค้า</th>
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
                                        <img src="../img/product/<?php if (!empty($rs3['photo'])) { echo $rs3['photo']; } else { echo 'product-avarta.jpg'; } ?>" alt="" width="100px;" class="img-thumbnail">
                                    </td>
                                    <td><?php echo $rs3['name']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($rs2['price'], 2); ?></td>
                                    <td style="text-align: center;"><?php echo $rs2['amount']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($rs2['sum_price'], 2); ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h2><b>สถานะ: </b><?php echo $rs['status_name']; ?></h2>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td><b>ค่าสินค้า</b></td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?> ฿</td>
                                </tr>
                                <tr>
                                    <td><b>ค่าจัดส่ง</b></td>
                                    <td style="text-align: right;">FREE</td>
                                </tr>
                                <tr>
                                    <td><b>รวมเป็นเงินทั้งสิ้น</b></td>
                                    <td style="text-align: right;"><?php echo number_format($rs['sum_total'], 2); ?> ฿</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
          	</div>
            <!-- end body -->
          	<div class="modal-footer">
            	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> ปิด</button>
          	</div>
          </div>
    </div>
</div>
</form>