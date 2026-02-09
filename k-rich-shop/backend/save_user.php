<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//เช้คว่ามีการเข้าสู่ระบบหรือไม่
if (empty($_SESSION['role'])) {
	//ถ้าไม่มีการเข้าสู่ระบบให้กลับไปที่หน้า index และแสดงกล่องข้อความแจ้งเตือน
	gotopage('index.php?act=login_pls');
}

$query = 'select * from user_account where email = :email ';
$result = $con->prepare($query);
$result->execute(['email' => $_POST['email']]);
if ($result->rowCount()) {
	gotopage('user.php?act=save_duplicate');
} else {
	try {
		$con->beginTransaction();

		$chk = $con->query("SHOW COLUMNS FROM user_account LIKE 'photo'");
		if ($chk->rowCount()==0) {
			$con->exec("ALTER TABLE user_account ADD COLUMN photo VARCHAR(255) NULL");
		}

		$photoName = null;
		if (!empty($_FILES['photo']['name'])) {
			if (!is_dir("../img/user")) { @mkdir("../img/user", 0777, true); }
			$oldName = $_FILES['photo']['name'];
			$ext = pathinfo($oldName, PATHINFO_EXTENSION);
			$photoName = RandomString(20).".".$ext;
			move_uploaded_file($_FILES["photo"]["tmp_name"], "../img/user/".$photoName);
		}

		$query = 'insert into user_account (role_id, first_name, last_name, email, password, photo) 
			values (:role, :fname, :lname, :email, :pass, :photo)';
		$result = $con->prepare($query);
		$result->execute([
			'role'	=> $_POST['role'],
			'fname'	=> $_POST['fname'],
			'lname'	=> $_POST['lname'],
			'email'	=> $_POST['email'],
			'pass'	=> password_hash($_POST['pass'],  PASSWORD_BCRYPT, ['cost' => 10]),
			'photo'	=> $photoName
		]);

		$con->commit();

		gotopage('user.php?act=save_success');
	} catch (PDOException $e) {
		$con->rollBack();
		echo $e->getMessage();

		gotopage('user.php?act=save_error');
	}
}
?>
