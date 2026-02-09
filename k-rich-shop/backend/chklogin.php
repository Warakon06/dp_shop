<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//เช็คค่าที่ป้อนเข้ามาในแบบฟอร์มถ้า username และ password ถูกต้อง
if (!empty($_POST['user']) and !empty($_POST['pass'])) {
	//คิวนี่สำหรับดึงข้อมูลผู้ดูแลระบบค้นหาจาก email
	$query = 'select account_id, email, password from user_account where email = :email ';
	$result = $con->prepare($query);
	$result->execute(['email' => $_POST['user']]);

	//ถ้ามีข้อมูล email
	if ($result->rowCount()>0) {
		//เอาข้อมูลมาเก้บไว้ใน array
		$rs = $result->fetch();
		//ตรวจสอบรหัสผ่านที่ป้อนเข้ามาด้วยการเข้ารหัส
		$verify_password = password_verify($_POST['pass'], $rs['password']);
		//กรณีที่รหัสผ่านตรงกัน
		if ($verify_password) {
			//คิวรี่เพื่อดึงข้อมูลผู้ใช้งาน
			$query = 'select 
				account_id, first_name, last_name, role_id, 
				case when role_id = 1 then "ผู้ดูแลระบบ" 
				when role_id = 2 then "พนักงาน" 
				else "" end as role_name 
				from user_account 
				where account_id = :aid  ';
			$result = $con->prepare($query);
			$result->execute(['aid'	=> $rs['account_id']]);
			if ($result->rowCount()>0) {
				$rs = $result->fetch();

				//ประกาศใช้ตัวแปร session และนำค่าที่ดึงออกจากแทนที่
				$_SESSION['sess_id'] = session_id();
				$_SESSION['role'] = $rs['role_id'];
				$_SESSION['role_name'] = $rs['role_name'];
				$_SESSION['account_id'] = $rs['account_id'];
				$_SESSION['account_name'] = $rs['first_name'].' '.$rs['last_name'];

				//ไปที่หน้าจอ แดชบอร์ด
				gotopage('dashboard.php');
			} else {
				//กลับไปที่หน้า login และแสดงกล่องข้อความ
				gotopage('index.php?act=login_error');
			}
		} else {
			//กลับไปที่หน้า login และแสดงกล่องข้อความ
			gotopage('index.php?act=login_error');
		}
	} else {
		//กลับไปที่หน้า login และแสดงกล่องข้อความ
		gotopage('index.php?act=login_error');
	}

//ถ้าไม่ค่า email และ password ส่งมา
} else {
	//กลับไปที่หน้า login และแสดงกล่องข้อความ
	gotopage('index.php?act=login_error');
}
?>