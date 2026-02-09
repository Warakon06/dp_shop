<?php
/*---------------- ประกาศตัวแปร ----------------*/
$shop_name='K-Rick-Shop'; //ชื่อร้านค้า
$curdate = date("Y-m-d"); //วันที่ปัจจุบัน 2025-03-01
$curmonth = date("m"); //เดือนปัจจุบัน
$curyear_th = date("Y")+543; //ปีปัจจุบัน พ.ศ.
$curyear_en = date("Y"); //ปีปัจจุบัน ค.ศ.
$curtime = date("H:i"); //เวลาปัจจุบัน นาที:วินาที

//เดือนไทย
$thaiMonths = [
	'01' => "มกราคม",
	'02' => "กุมภาพันธ์",
	'03' => "มีนาคม",
	'04' => "เมษายน",
	'05' => "พฤษภาคม",
	'06' => "มิถุนายน",
	'07' => "กรกฎาคม",
	'08' => "สิงหาคม",
	'09' => "กันยายน",
	'10' => "ตุลาคม",
	'11' => "พฤศจิกายน",
	'12' => "ธันวาคม"
];

/*------------------ function ----------------------*/
//เปลี่ยน format วันที่ที่รับค่ามาจาก form เช่น '01/10/2568' เป็น '2025-10-01' เพื่อให้เก็บลงฐานข้อมูลได้
function todate($date) {
	$exdate = explode('/',$date);
	$date = ($exdate[2]-543).'-'.$exdate[1].'-'.$exdate[0];
	return $date;
}

//เปลี่ยน format ที่ดึงมาจากฐานข้อมูลให้เป็นวันที่ไทย '2025-10-01' เป็น '01/10/2568'
function thaidate($date) {
	$exdate = explode('-',$date);
	$date = $exdate[2].'/'.$exdate[1].'/'.($exdate[0]+543);
	return $date;
}

//เปฃี่ยน format ที่ดึงมาจากฐานข้อมูลให้เป็นวันที่และเวลาไทย
function thaidatetime($date) {
	$exdate = explode(' ',$date);
	$exdate2 = explode('-',$exdate[0]);
	$date = $exdate2[2].'/'.$exdate2[1].'/'.($exdate2[0]+543).' '.$exdate[1];
	return $date;
}

//แสดงเดือนภาษาไทย
function thaiMonthName($monthNumber) {
    $thaiMonths = [
        '01' => "มกราคม",
        '02' => "กุมภาพันธ์",
        '03' => "มีนาคม",
        '04' => "เมษายน",
        '05' => "พฤษภาคม",
        '06' => "มิถุนายน",
        '07' => "กรกฎาคม",
        '08' => "สิงหาคม",
        '09' => "กันยายน",
        '10' => "ตุลาคม",
        '11' => "พฤศจิกายน",
        '12' => "ธันวาคม"
    ];

    return $thaiMonths[$monthNumber] ?? "เดือนไม่ถูกต้อง"; // Return default if invalid month
}

//คำนวณอายุ
function calage($birthdate) {
	$byear = explode('-',$birthdate);
	return $age = date('Y') - $byear[0];
}

//สุ่มตัวอักษรและตัวเลขตามจำนวนเที่เรากำหนด
function RandomString($length) {
    $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//ใช้ javascript load ไปหน้าที่ต้องการ
function gotopage($url) {
	echo "<script language='javascript'>"; 
	echo " parent.window.location='".$url."'; ";
	echo "</script>";
}
/*----------------------------------------*/
?>
