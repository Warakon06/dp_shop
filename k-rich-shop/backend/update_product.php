<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	//การเริ่มต้น Trasaction
	$con->beginTransaction();
	//คิวรี่สำหรับบันทึกข้อมูล หมวดหมู่สินค้า
	$query = 'update product set category_id = :cat,
	name = :name, description = :des, amount = :amount,
	unit = :unit, price = :price where product_id = :pid ';
	$result = $con->prepare($query);
	//แทนค่า parameter
	$result->execute([
		'cat' 		=> $_POST['cat'],
		'name' 		=> $_POST['name'],
		'des' 		=> $_POST['detail'],
		'amount' 	=> $_POST['amount'],
		'unit' 		=> $_POST['unit'],
		'price' 	=> $_POST['price'],
		'pid' 		=> $_POST['id_edit']
	]);
	//ยืนยันกระบวนการการเปลี่ยนข้อมูล
	$con->commit();

	//ถ้ามีการแนบไฟล์รูปภาพเข้ามา
	if (!empty($_FILES["fileupload"]["tmp_name"])) {
		//นับจำนวนไฟล์ที่ถูกอัปโหลดเข้ามา
		$length = count($_FILES["fileupload"]);
		//วนลูป for เพื่อดึงรูปที่อัปโหลดเข้ามา
		for ($i=0; $i<=($length-1); $i++) { 
			if (!empty($_FILES['fileupload']['name'][$i])) {
				$new_photo_name = RandomString(20); //gen ชื่อรูปภาพขึ้นมาใหม่แบบสุ่ม
				$old_name = $_FILES['fileupload']['name'][$i]; //รับค่าชื่อรูปภาพ
				$file_surname = explode(".", $old_name); //นำชื่อรูปภาพมาตัดเอาเฉพาะนามสกุลรูปภาพ
				$new_photo_name.=".".$file_surname[1]; //นำชื่อรูปภาพใหม่ และนามสกุลรูปภาพมาประกอบกัน
				//อัปโหลดไฟล์รูปภาพเข้าสู่เซิร์ฟเวอร์
				move_uploaded_file($_FILES["fileupload"]["tmp_name"][$i],"../img/product/".$new_photo_name);

				//คิวรี่สำหรับบันทึกข้อมูลรูปภาพ
				$query2 = 'insert into product_photo value(NULL, :pid, :photo, "0")';
				$result2 = $con->prepare($query2);
				//แทนค่าที่รับมาใน parameter
				$result2->execute([
					'lid'		=> $_POST['id_edit'],
					'photo'		=> $new_photo_name,
					'active'	=> $active
				]);
			}
		}
	}
	//update active photo
	if (!empty($_POST['active'])) {
		$query2 = 'update product_photo set active = "1" where photo_id = :pid ';
		$result2 = $con->prepare($query2);
		$result2->execute(['pid' => $_POST['active']]);
	}

	//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
	gotopage('product.php?act=save_success');
} catch(PDOException $e) {
	//ดึงข้อมูลกับไปตอนที่เริ่ม
	$con->rollBack();
	//เก็บค่าเออเร่อแมสเซส
	$e->getMessage();

	//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
	gotopage('product.php?act=save_error');
}
?>