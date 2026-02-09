<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	//การเริ่มต้น Trasaction
	$con->beginTransaction();
	$chk = $con->query("SHOW COLUMNS FROM member LIKE 'photo'");
	if ($chk->rowCount()==0) {
		$con->exec("ALTER TABLE member ADD COLUMN photo VARCHAR(255) NULL");
	}

	$currentPhoto = null;
	$st = $con->prepare('select photo from member where member_id = :mid');
	$st->execute(['mid' => $_POST['id_edit']]);
	$rsp = $st->fetch();
	if ($rsp) { $currentPhoto = $rsp['photo']; }

	$newPhoto = $currentPhoto;
	if (!empty($_FILES['photo']['name'])) {
		if (!is_dir("../img/member")) { @mkdir("../img/member", 0777, true); }
		if (!empty($currentPhoto) && file_exists("../img/member/".$currentPhoto)) { @unlink("../img/member/".$currentPhoto); }
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		$newPhoto = RandomString(20).".".$ext;
		move_uploaded_file($_FILES["photo"]["tmp_name"], "../img/member/".$newPhoto);
	}

	//คิวรี่สำหรับบันทึกข้อมูล หมวดหมู่สินค้า
	$query = 'update member set first_name = :fname, last_name = :lname, 
		village = :village, home_no = :home, soi = :soi, road = :road, 
		subdistrict_id = :subid, district_id = :distid, province_id = :pid, 
		post_code = :pcode, phone_number = :tel, photo = :photo 
		where member_id = :mid ';
	$result = $con->prepare($query);
	//แทนค่า parameter
	$result->execute([
		'fname' 	=> $_POST['fname'],
		'lname' 	=> $_POST['lname'],
		'village' 	=> $_POST['village'],
		'home' 		=> $_POST['home'],
		'soi' 		=> $_POST['soi'],
		'road' 		=> $_POST['road'],
		'subid' 	=> $_POST['subdistrict'],
		'distid' 	=> $_POST['district'],
		'pid' 		=> $_POST['province'],
		'pcode' 	=> $_POST['postcode'],
		'tel' 		=> isset($_POST['tel']) ? $_POST['tel'] : '',
		'photo'		=> $newPhoto,
		'mid'		=> $_POST['id_edit']
	]);
	//ยืนยันกระบวนการการเปลี่ยนข้อมูล
	$con->commit();

	if (!empty($_POST['pass'])) {
		$query2 = 'update member set password = :pass where member_id = :mid ';
		$result2 = $con->prepare($query2);
		$result2->execute([
			'pass'	=> password_hash($_POST['pass'],  PASSWORD_BCRYPT, ['cost' => 10]),
			'mid'	=> $_POST['id_edit']
		]);
	}

	//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
	gotopage('member.php?act=save_success');
} catch(PDOException $e) {
	//ดึงข้อมูลกับไปตอนที่เริ่ม
	if ($con->inTransaction()) { $con->rollBack(); }
	//เก็บค่าเออเร่อแมสเซส
	echo $e->getMessage();
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
	gotopage('member.php?act=save_error');
}
?>
