<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ดึงข้อมูลฃสมาชิก
$query = 'select * from member where email = :email ';
$result = $con->prepare($query);
$result->execute(['email' => $_POST['email']]);
//ถ้าอีเมลซ้ำ
if ($result->rowCount()>0) {
	//ำแที่หน้าลงทะเบียน
	gotopage('register.php?act=email_duplicate');
//ถ้าอีเมลไม่ซ้ำ
} else {
	try {
		$con->beginTransaction();
		//บันทึกข้อมูล
		$query = 'insert into member 
			(first_name, last_name, village, home_no, soi, road, 
			 subdistrict_id, district_id, province_id, post_code, 
			 phone_number, email, password) 
			values 
			(:fname, :lname, :vill, :no, :soi, :road, 
			 :subdis, :dis, :pro, :post, 
			 :phone, :email, :pass)';
		$result = $con->prepare($query);
		$result->execute([
			'fname'		=> $_POST['fname'],
			'lname'		=> $_POST['lname'],
			'vill'		=> $_POST['village'],
			'no'		=> $_POST['homeno'],
			'soi'		=> $_POST['soi'],
			'road'		=> $_POST['road'],
			'subdis'	=> $_POST['subdistrict'],
			'dis'		=> $_POST['district'],
			'pro'		=> $_POST['province'],
			'post'		=> $_POST['postcode'],
			'phone'		=> $_POST['pnumber'],
			'email'		=> $_POST['email'],
			'pass'		=> password_hash($_POST['pass'],  PASSWORD_BCRYPT, ['cost' => 10])
		]);
		$con->commit();

		//ไปที่หน้าลงทะเบียน
		gotopage('register.php?act=save_success');
	//ถ้า error
	} catch (PDOException $e) {
		$con->rollBack();
		echo $e->getMessage();

		//ไปที่หน้าลงทะเบียน
		gotopage('register.php?act=save_error');
	}
}
?>
