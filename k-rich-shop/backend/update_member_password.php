<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	$con->beginTransaction();
	$query = 'update member set password = :npass where member_id = :mid ';
	$result = $con->prepare($query);
	$result->execute([
		'npass'	=> password_hash($_POST['newpass1'],  PASSWORD_BCRYPT, ['cost' => 10]), 
		'mid'	=> $_POST['id_edit']
	]);
	$con->commit();

	gotopage('member.php?act=save_success');
} catch (PDOException $e) {
	$con->rollBack();
	$e->getMessage();
	gotopage('member.php?act=save_error');
}
?>