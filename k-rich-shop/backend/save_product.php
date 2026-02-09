<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 


//คิวรี่เพื่อเช็คว่ามีชื่อสินค้านี้อยูแล้วหรือยัง
$query = 'select * from product where name = :name ';
$result = $con->prepare($query);
$result->execute(['name' => $_POST['name']]);
//ถ้าชื่อสินค้าซ้ำ
if ($result->rowCount()>0) {
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
	gotopage('product.php?act=save_duplicate');
//ถ้ายังไม่มีชื่อสินค้า
} else {
	try {
		//การเริ่มต้น Trasaction
		$con->beginTransaction();
		//คิวรี่สำหรับบันทึกข้อมูล หมวดหมู่สินค้า
		$query = 'insert into product value(NULL, :cat, :name, :des, :amount, :unit, :price)';
		$result = $con->prepare($query);
		//แทนค่า parameter
		$result->execute([
			'cat' 		=> $_POST['cat'],
			'name' 		=> $_POST['name'],
			'des' 		=> $_POST['detail'],
			'amount' 	=> $_POST['amount'],
			'unit' 		=> $_POST['unit'],
			'price' 	=> $_POST['price']
		]);
		//เก็บข้อมูล รหัสสินค้า ที่บัทึกลงฐานข้อมูล
		$product_id = $con->lastInsertId();
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

					//กำหนดให้ตัวแปร active = 0
					$active = '0';
					//ถ้าเป้นรูปภาพแรกให้ active = 1 
					if ($i==0) { $active = '1'; }
					//คิวรี่สำหรับบันทึกข้อมูลรูปภาพ
					$query2 = 'insert into product_photo value(NULL, :pid, :photo, :active)';
					$result2 = $con->prepare($query2);
					//แทนค่าที่รับมาใน parameter
					$result2->execute([
						'pid'		=> $product_id,
						'photo'		=> $new_photo_name,
						'active'	=> $active
					]);
				}
			}
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
}
?>