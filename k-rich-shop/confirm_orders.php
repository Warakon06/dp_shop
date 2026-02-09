<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ถ้ามีรายการอาหารและเครื่องดื่มในตะกร้าสินค้า
if (!empty($_SESSION['cart'])) {
	//เช็คสต็อกสินค้าก่อนบันทึกข้อมูล
	foreach ($_SESSION['cart'] as $product_id => $amount) {
		//ดึงข้อมูลสินค้า
		$query = 'select * from product where product_id = :pid';
		$result = $con->prepare($query);
		$result->execute(['pid'  => $product_id]);
		$rs = $result->fetch();

		if ($rs['amount']=='-1') { 
			//ถ้าจำนวนิสนค้าเป็น -1 คือไม่มีสต็อกหรือไม่จำกัดจำนวน คือปล่อยผ่าน
		} else { 
			//ถ้าจำนวนสินค้าน้อยกว่าจำนวนที่สั่งซื้อ
			if ($rs['amount']<$amount) { 
				//กลับไปที่หน้าตะกร้าสนิค้าและแจ้งว่าสินค้าไม่พอ
				gotopage('cart.php?act=no_stock');
			}
		}
	}
	
	//บันทึกข้อมูลการสั่งซื้อ
	try {
		//ประกาศตัวแปร
		$sum_price = $sum_total = 0;
		//ประกาศเริ่ม transaction
		$con->beginTransaction();

		//ชำระผ่านบัญชีธนาคาร
		$new_slip_name = NULL;
		if ($_POST['pmethod']==1) { //ชำระเงินแบบโอนผ่านธนาคาร
			//ถ้ามีการแนบไฟล์รูปภาพเข้ามา
			if (!empty($_FILES["fileupload1"]["tmp_name"])) {
				if (!empty($_FILES['fileupload1']['name'])) {
					$new_slip_name = RandomString(20); //gen ชื่อรูปภาพขึ้นมาใหม่แบบสุ่ม
					$old_name = $_FILES['fileupload1']['name']; //รับค่าชื่อรูปภาพ
					$file_surname = explode(".", $old_name); //นำชื่อรูปภาพมาตัดเอาเฉพาะนามสกุลรูปภาพ
					$new_slip_name.=".".$file_surname[1]; //นำชื่อรูปภาพใหม่ และนามสกุลรูปภาพมาประกอบกัน
					//อัปโหลดไฟล์รูปภาพเข้าสู่เซิร์ฟเวอร์
					move_uploaded_file($_FILES["fileupload1"]["tmp_name"],"img/slip/".$new_slip_name);
				}
			}
		//ชำระผ่านคิวอาร์โค้ด
		} else if ($_POST['pmethod']==3) { //ชำระเงินผ่านพร้อมเพย์
			//ถ้ามีการแนบไฟล์รูปภาพเข้ามา
			if (!empty($_FILES["fileupload2"]["tmp_name"])) {
				if (!empty($_FILES['fileupload2']['name'])) {
					$new_slip_name = RandomString(20); //gen ชื่อรูปภาพขึ้นมาใหม่แบบสุ่ม
					$old_name = $_FILES['fileupload2']['name']; //รับค่าชื่อรูปภาพ
					$file_surname = explode(".", $old_name); //นำชื่อรูปภาพมาตัดเอาเฉพาะนามสกุลรูปภาพ
					$new_slip_name.=".".$file_surname[1]; //นำชื่อรูปภาพใหม่ และนามสกุลรูปภาพมาประกอบกัน
					//อัปโหลดไฟล์รูปภาพเข้าสู่เซิร์ฟเวอร์
					move_uploaded_file($_FILES["fileupload2"]["tmp_name"],"img/slip/".$new_slip_name);
				}
			}
		}

		//คิวรี่บัทึกข้อมูล
		$query = 'insert into orders value(NULL, :mid, :odt, NULL 
			, :pm, :slip, :cno, :exm, :exy, :cname, :ccode 
			, :rname, :tel, :home, :vill, :soi, :road, :sdisid 
			, :disid, :proid, :pcode
			, NULL, NULL, NULL, NULL, NULL, NULL, 2)';
		$result = $con->prepare($query);
		//แทนค่าตัวแปรในคิวรี่
		$result->execute([
			'mid'		=> $_SESSION['member_id'], 
			'odt'		=> date("Y-m-d H:i"), 
			'pm'		=> $_POST['pmethod'],
			'slip'		=> $new_slip_name,
			'cno'		=> $_POST['cno'],
			'exm'		=> $_POST['cm'],
			'exy'		=> $_POST['cy'],
			'cname'		=> $_POST['cname'],
			'ccode'		=> $_POST['cs'],
			'rname'		=> $_POST['rname'],
			'tel'		=> $_POST['pnumber'],
			'home'		=> $_POST['homeno'],
			'vill'		=> $_POST['village'],
			'soi'		=> $_POST['soi'],
			'road'		=> $_POST['road'],
			'sdisid'	=> $_POST['subdistrict'],
			'disid'		=> $_POST['district'],
			'proid'		=> $_POST['province'],
			'pcode'		=> $_POST['postcode']
		]);
		//เก็บค่ารหัสรายการสั่งซื้อที่บันทึกเข้าไปล่าสุด
		$orders_id = $con->lastInsertId();
		$con->commit();

		//บันทึกข้อมูลรายการอาหารและเครื่องดื่ม
		foreach ($_SESSION['cart'] as $product_id => $amount) {
			//วนลูปเพื่อดึงข้อมูลรายการอาหารและเครื่องดื่ม
			$query2 = 'select * from product where product_id = :pid';
			$result2 = $con->prepare($query2);
			$result2->execute(['pid' => $product_id]);
			//ถ้ามีข้อมูล
			if ($result2->rowCount()>0) {
				$rs2 = $result2->fetch();
				//คำนวณราคารวมสินค้า
				$sum_price = $rs2['price'] * $amount;
				$sum_total += $sum_price;

				//บันทึกข้อมูลรายการอาหารและเครื่องดื่ม
				$query3 = 'insert into orders_detail value(NULL, :orid, :pid, :amt, :price, :sprice)';
				$result3 = $con->prepare($query3);
				$result3->execute([
					'orid'		=> $orders_id, 
					'pid'		=> $product_id, 
					'amt'		=> $amount,
					'price'		=> $rs2['price'],
					'sprice'	=> $sum_price
				]);

				//ถ้าจำนวนสินค้าเป้น -1 คือมีจำนวนไม่จำกัด
				if ($rs2['amount']=='-1') {
				} else {
					//ตัดสต็อกสินค้า
					$new_stock = $rs2['amount'] - $amount;
					$query4 = 'update product set amount = :amt where product_id = :pid ';
					$result4 = $con->prepare($query4);
					$result4->execute([
						'amt'	=> $new_stock,
						'pid'	=> $rs2['product_id']
					]);
				}
			}	
		}

		//อัปเดทราคารวมของคำสั่งซื้อนี้
		$query4 = 'update orders set sum_total = :sumt where orders_id = :orid ';
		$result4 = $con->prepare($query4);
		$result4->execute([
			'sumt'	=> $sum_total,
			'orid'	=> $orders_id 
		]);

		//ลบค่าในตัวแปร session ตะกร้าสินค้า
		unset($_SESSION['cart']);

		//แสดงกล่องข้อความและไปที่หน้ารายการสั่งซื้อ
		gotopage('my_orders.php?act=save_success');
	//
	} catch (PDOException $e) {
		//ให้ rollback ข้อมูลกลับ
		$con->rollBack();
		//แสดง error
		echo $e->getMessage();
		//กลับไปที่หน้าตะกร้าสินค้า
		//gotopage('cart.php?act=save_error');
	}
//ถ้าไม่มีรายการอาหารและเครื่องดื่ม
} else {
	//กลับไปที่หน้าตะกร้าสินค้า
	gotopage('cart.php?act=save_error');
}
?>