<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

try {
	$con->beginTransaction();
	$chk = $con->query("SHOW COLUMNS FROM member LIKE 'photo'");
	if ($chk->rowCount()==0) {
		$con->exec("ALTER TABLE member ADD COLUMN photo VARCHAR(255) NULL");
	}

	$currentPhoto = null;
	$st = $con->prepare('select photo from member where member_id = :mid');
	$st->execute(['mid' => $_SESSION['member_id']]);
	$rsp = $st->fetch();
	if ($rsp) { $currentPhoto = $rsp['photo']; }

	$newPhoto = $currentPhoto;
	if (!empty($_POST['remove_photo'])) {
		if (!empty($currentPhoto) && file_exists("img/member/".$currentPhoto)) { @unlink("img/member/".$currentPhoto); }
		$newPhoto = null;
	} else if (!empty($_FILES['photo']['name'])) {
		if (!is_dir("img/member")) { @mkdir("img/member", 0777, true); }
		if (!empty($currentPhoto) && file_exists("img/member/".$currentPhoto)) { @unlink("img/member/".$currentPhoto); }
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		$newPhoto = RandomString(20).".".$ext;
		move_uploaded_file($_FILES["photo"]["tmp_name"], "img/member/".$newPhoto);
	}
	$query = 'update member set first_name = :fname, last_name = :lname, 
		village = :vill, home_no = :no, soi = :soi, road = :road,
		subdistrict_id = :subdis, district_id = :dis, province_id = :pro,
		post_code = :post, phone_number = :phone, photo = :photo
		where member_id = :mid ';
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
		'photo'		=> $newPhoto,
		'mid'		=> $_SESSION['member_id'],
	]);
		$con->commit();


		//ถ้ามีการเปลี่ยนรหัสผ่านมาหรือไม่
		if (!empty($_POST['pass'])) {
			$query2 = 'update member set password = :pass where member_id = :mid ';
			$result2 = $con->prepare($query2);
			$result2->execute([
				'pass'	=> password_hash($_POST['pass'],  PASSWORD_BCRYPT, ['cost' => 10]),
				'mid'	=> $_SESSION['member_id']
			]);
		}

		//ไปที่หน้าข้อมูลสมาชิก
		gotopage('my_profile.php?act=save_success');
	//ถ้ามี error
	} catch (PDOException $e) {
		$con->rollBack();
		echo $e->getMessage();

		//ไปที่หน้าข้อมูลสมาชิก
		gotopage('my_profile.php?act=save_error');
	}
?>
