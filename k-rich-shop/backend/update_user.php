<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	$con->beginTransaction();
	$chk = $con->query("SHOW COLUMNS FROM user_account LIKE 'photo'");
	if ($chk->rowCount()==0) {
		$con->exec("ALTER TABLE user_account ADD COLUMN photo VARCHAR(255) NULL");
	}

	$currentPhoto = null;
	$st = $con->prepare('select photo from user_account where account_id = :aid');
	$st->execute(['aid' => $_POST['id_edit']]);
	$rsp = $st->fetch();
	if ($rsp) { $currentPhoto = $rsp['photo']; }

	$newPhoto = $currentPhoto;
	if (!empty($_FILES['photo']['name'])) {
		if (!is_dir("../img/user")) { @mkdir("../img/user", 0777, true); }
		if (!empty($currentPhoto) && file_exists("../img/user/".$currentPhoto)) { @unlink("../img/user/".$currentPhoto); }
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		$newPhoto = RandomString(20).".".$ext;
		move_uploaded_file($_FILES["photo"]["tmp_name"], "../img/user/".$newPhoto);
	}

	$query = 'update user_account set role_id = :role, 
		first_name = :fname, last_name = :lname, email = :email, photo = :photo 
		where account_id = :aid ';
	$result = $con->prepare($query);
	$result->execute([
		'role'	=> $_POST['role'],
		'fname'	=> $_POST['fname'],
		'lname'	=> $_POST['lname'],
		'email'	=> $_POST['email'],
		'photo' => $newPhoto,
		'aid'	=> $_POST['id_edit'],
	]);
	$con->commit(); 

	if (!empty($_POST['pass'])) {
		$query2 = 'update user_account set password = :pass where account_id = :aid ';
		$result2 = $con->prepare($query2);
		$result2->execute([
			'pass'	=> password_hash($_POST['pass'],  PASSWORD_BCRYPT, ['cost' => 10]),
			'aid'	=> $_POST['id_edit']
		]);
	}

	gotopage('user.php?act=save_success');
} catch (PDOException $e) {
	$con->rollBack();
	$e->getMessage();
	gotopage('user.php?act=save_error');
}
?>
