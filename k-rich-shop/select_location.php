<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//หน้านี้เอาไว้สำหรับดึงข้อมูล ตำบล/อำเภอ/จังหวัด แล้วส่งให้ตัว AJAX ที่หน้าลงทะเบียนสมาชิก และแก้ไขข้อมูลสมาชิก
$str_return = '';
if (!empty($_POST['obj']) and !empty($_POST['data'])) {
	if ($_POST['obj']=='province') {
		$query = 'select * from district where province_id = :pid';
		$result=$con->prepare($query);
		$result->execute(['pid'  => $_POST['data']]);
		if ($result->rowCount()>0) {
			$str_return = '<option value="">- เลือก -</option>';
			foreach ($result as $key => $value) {
				$str_return .= '<option value="'.$value['district_id'].'">'.$value['name_th'].'</option>';
			}
		}
	} else if ($_POST['obj']=='district') {
		$query = 'select * from subdistrict where district_id = :did';
		$result=$con->prepare($query);
		$result->execute(['did'  => $_POST['data']]);
		if ($result->rowCount()>0) {
			$str_return = '<option value="">- เลือก -</option>';
			foreach ($result as $key => $value) {
				$str_return .= '<option value="'.$value['subdistrict_id'].'">'.$value['name_th'].'</option>';
			}
		}
	} else if ($_POST['obj']=='subdistrict') {
		$query = 'select * from subdistrict where subdistrict_id = :sid';
		$result=$con->prepare($query);
		$result->execute(['sid'  => $_POST['data']]);
		if ($result->rowCount()>0) {
			$rs = $result->fetch();
			$str_return = $rs['zipcode'];
		}
	}
	echo $str_return;
}
?>