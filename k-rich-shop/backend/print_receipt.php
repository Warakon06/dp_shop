<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

$query = 'select 
a.orders_id, a.orders_date, a.sum_total, 
concat(b.first_name, " ", b.last_name) as member_name, b.phone_number, 
b.home_no, b.village, b.soi, b.road, 
c.name_th as province_name, d.name_th as district_name, 
e.name_th as subdistrict_name, b.post_code
from orders as a, member as b 
left outer join province as c on b.province_id = c.province_id 
left outer join district as d on b.district_id = d.district_id 
left outer join subdistrict as e on b.subdistrict_id = e.subdistrict_id 
where 
a.orders_id = :orid 
and a.membeR_id = b.member_id ';
$result = $con->prepare($query);
$result->execute(['orid' => $_GET['orid']]);
if ($result->rowCount()>0) {
	$rs = $result->fetch(); 
} else {
	gotopage('dashboard.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>ใบเสร็จรับเงิน</title>
	<!-- Tempusdominus Bootstrap 4 -->
  	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@500&display=swap" rel="stylesheet">
	<style type="text/css" media="screen">
		body {
			font-family: 'Sarabun', sans-serif;
		}
	</style>
</head>
<body onload="window.print()">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>&nbsp;</h2>
				<h2 class="text-center">ใบเสร็จรับเงิน</h2>
				<h2>&nbsp;</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td style="width:50%"><b>เลขที่: </b> <?php echo $rs['orders_id']; ?></td>
							<td><b>วันที่ออก: </b> <?php echo thaidatetime($rs['orders_date']); ?></td>
						</tr>
						<tr>
							<td><b>ลูกค้า: </b> <?php echo $rs['member_name']; ?></td>
							<td><b>เบอร์โทรศัพท์: </b> <?php echo $rs['phone_number']; ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<b>ที่อยู่จัดส่งสินค้า: </b> 
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
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th style="text-align: center; font-weight: bold;">ลำดับ</th>
							<th style="text-align: center; font-weight: bold;">รายการ</th>
							<th style="text-align: center; font-weight: bold;">ราคา/หน่วย</th>
							<th style="text-align: center; font-weight: bold;">จำนวน</th>
							<th style="text-align: center; font-weight: bold;">รวมเป็น</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query2 = 'select 
								a.amount, a.price, a.sum_price, 
								b.name, c.photo 
								from orders_detail as a, product as b 
								left outer join product_photo as c on b.product_id = c.product_id 
								and c.active= 1 
								where a.orders_id = :orid 
								and a.product_id = b.product_id ';
							$result2 = $con->prepare($query2);
							$result2->execute(['orid' => $rs['orders_id']]);
							if ($result2->rowCount()>0) {
								foreach ($result2 as $key => $value) {
						?>
						<tr>
							<td style="text-align: center;"><?php echo $key+1; ?></td>
							<td><?php echo $value['name']; ?></td>
							<td style="text-align: right;"><?php echo number_format($value['price'] ,2); ?></td>
							<td style="text-align: center;"><?php echo $value['amount']; ?></td>
							<td style="text-align: right;"><?php echo number_format($value['sum_price'] ,2); ?></td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="4" style="text-align: right; font-weight: bold;">ค่าสินค้า</td>
							<td style="text-align: right;"><?php echo number_format($rs['sum_total'] ,2); ?></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align: right; font-weight: bold;">ค่าจัดส่งสินค้า</td>
							<td style="text-align: right;">FREE</td>
						</tr>
						<tr>
							<td colspan="4" style="text-align: right; font-weight: bold;">รวมเป็นเงินทั้งสิ้น</td>
							<td style="text-align: right;"><?php echo number_format($rs['sum_total'] ,2); ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2>&nbsp;</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6"></div>
		</div>
	</div>
</body>
</html>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>