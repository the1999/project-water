<?php

function connectDB() {


	$dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="admin_water";


$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($connection,"utf8");


return $connection;

}



function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST']."/demo";
}



function checkAdmin($user_id){


	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	if($connection){

		$sql = "SELECT admin_status FROM tbl_user WHERE user_id = '$user_id';";
		$rs = mysqli_query($connection, $sql);
		$row = mysqli_fetch_array($rs);

		$sql2 = "SELECT count(*) as count_check FROM tbl_admin_status WHERE admin_status = '".$row['admin_status']."';";
		$rs2 = mysqli_query($connection, $sql2);
		$row2 = mysqli_fetch_array($rs2);

		if($row2['count_check'] > 0){

			return 1;

		}
		else{

			return 0;

		}

	}
	else{

		return 0;

	}


}


function stringInsert($str,$insertstr,$pos)
{
    $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
    return $str;
}


function recheck_query($r){


	$search_array = array(";","'",chr(34));
	$new_string = str_replace($search_array,"",$r);

	$new_string = str_ireplace("SELECT","",$new_string);
	$new_string = str_ireplace("INSERT","",$new_string);
	$new_string = str_ireplace("UPDATE","",$new_string);
	$new_string = str_ireplace("DELETE","",$new_string);
	$new_string = str_ireplace("DROP","",$new_string);
	$new_string = str_ireplace("CREATE","",$new_string);
	$new_string = str_ireplace("TRUNCATE","",$new_string);
	$new_string = str_ireplace("TABLE","",$new_string);

	return $new_string;

}


function check_access($user_id,$access_id){

	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	$sql = "SELECT access_level FROM tbl_user WHERE user_id = '$user_id';";
	$rs = mysqli_query($connection ,$sql) or die(mysqli_error());
	$row = mysqli_fetch_array($rs);


	$page_id = $access_id;
	$level = $row['access_level'];

	$access_code = strrev(decbin($level));
	$accessible = substr($access_code,$page_id-1,1);


	if ($accessible) {
		return 1;
	} else {
		return 0;
		}


	mysqli_close($connection);
}


function getRandomID($size,$table,$column_name){


	$check_status = 0;
	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	while($check_status == 0){
	$random_id = randomCode($size);


	$sql = "SELECT count(*) as count FROM $table WHERE $column_name = '$random_id';";
	$rs_check = mysqli_query($connection,$sql) or die(mysqli_error());
	$row_check = mysqli_fetch_assoc($rs_check);
	$check_repeat = $row_check['count'];

		if($check_repeat == 0){

			$check_status = 1;
		}


	}


	return $random_id;



}



function getRandomID2($size,$table,$column_name){


	$check_status = 0;
	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	while($check_status == 0){
	$random_id = randomCode2($size);


	$sql = "SELECT count(*) as count FROM $table WHERE $column_name = '$random_id';";
	$rs_check = mysqli_query($connection,$sql) or die(mysqli_error());
	$row_check = mysqli_fetch_assoc($rs_check);
	$check_repeat = $row_check['count'];

		if($check_repeat == 0){

			$check_status = 1;
		}


	}


	return $random_id;



}


function check_access_dashboard($user_id,$access_id){


	$connection = connectDB();


	$sql = "SELECT dashboard_level FROM tbl_user WHERE user_id = '$user_id';";
	$rs = mysqli_query($connection ,$sql) or die(mysqli_error());
	$row = mysqli_fetch_array($rs);


	$page_id = $access_id;
	$level = $row['dashboard_level'];

	$access_code = strrev(decbin($level));
	$accessible = substr($access_code,$page_id-1,1);


	if ($accessible) {
		return 1;
	} else {
		return 0;
		}


	mysqli_close($connection);
}



function randomCode($length){
    	$possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghigklmnopqrstuvwxyz"; //ตัวอักษรที่ต้องการสุ่ม
	  		$str = "";
	  		while(strlen($str)<$length){
	      		$str.=substr($possible,(rand()%strlen($possible)),1);
	  		}
	  		return $str;
   	}


function randomCode2($length){
	$possible = "0123456789"; //ตัวอักษรที่ต้องการสุ่ม
	$str = "";
	while(strlen($str)<$length){
		$str.=substr($possible,(rand()%strlen($possible)),1);
	}
	return $str;
}


function getBaseUrl(){
	if(isset($_SERVER['HTTPS'])){
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	}
	else{
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

//ทั้งหมด
function CanGetAll ($type, $id, $date) {
	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	// echo "Can get all...<br>";

	if( $type == 1 ){
		$conditionId .= "a.product_id = '$id' ";
	}else if($type == 2){
		$conditionId .= "a.set_id = '$id' ";
	}

	// นำเข้าธรรมดาแบบไม่ ref ใบสั่งซื้อทั้งหมด
	$sql = "SELECT
				SUM(a.quantity) as sum
			FROM
				tbl_import_product a
			JOIN tbl_import_head b ON b.import_id = a.import_id
			WHERE
				$conditionId
				AND b.active_status = '1'
				AND (a.purchase_product_id IS NULL || a.purchase_product_id = '') ";
	$rs  = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($rs);
	$importAll = $row['sum'];

	// สั่งซื้อ ถ้า วันนี้เกิน วันที่ของจะเข้า เอาเฉพาะ นำเข้าที่ ref ใบสั่งซื้อนี้แล้ว  สั่งซื้อไม่รวม เกินวันที่จอง วันสุดท้าย
	// สั่งซื้อ ถ้า วันนี้ ยังไม่เกิน วันที่ของจะเข้า เอา จำนวนที่สั่งซื้อ
	$sqlReserve = "SELECT
						*
					FROM
						tbl_reserve_product a
					LEFT JOIN tbl_reserve_head b ON b.reserve_id = a.reserve_id
					WHERE
						$conditionId
						AND b.active_status != '0'
						AND b.reserve_date > '$date'
					ORDER BY b.reserve_date DESC
					LIMIT 1 ";
	$rsReserve 	= mysqli_query($connection, $sqlReserve);
	$rowReserve = mysqli_fetch_assoc($rsReserve);

	if( $rowReserve['reserve_date'] != '' ){
		$lastDate = $rowReserve['reserve_date'];
		$sql = "SELECT
					*
				FROM
					tbl_purchase_product a
				LEFT JOIN tbl_purchase_head b ON b.purchase_id = a.purchase_id
				WHERE
					$conditionId
					AND b.status != '0'
					AND a.plan_delivery_date <= '$lastDate' ";
	}else{
		$lastDate = $date;
		$sql = "SELECT
					*
				FROM
					tbl_purchase_product a
				LEFT JOIN tbl_purchase_head b ON b.purchase_id = a.purchase_id
				WHERE
					$conditionId
					AND b.status != '0' ";
	}
	$rs = mysqli_query($connection, $sql);

	$purchase_1 = 0;
	$purchase_2 = 0;
	while($row = mysqli_fetch_assoc($rs)){
		if( date("Ymd", strtotime($date)) < date("Ymd", strtotime($row['plan_delivery_date'])) ){
			$purchase_product_id = $row['purchase_product_id'];

			$sqlPurchase = "SELECT
								SUM(a.quantity) AS sum
							FROM
								tbl_import_product a
							LEFT JOIN tbl_import_head c ON c.import_id = a.import_id
							WHERE
								a.purchase_product_id = '$purchase_product_id'
								AND c.active_status = '1' ";
			$rsPurchase  = mysqli_query($connection, $sqlPurchase);
			$rowPurchase = mysqli_fetch_assoc($rsPurchase);
			$purchase_1 += $rowPurchase['sum'];
		}else{
			$purchase_2 += $row['quantity'];
		}
	}
	// echo "purchase_1: " . $purchase_1 . "<br>";
	// echo "purchase_2: " . $purchase_2 . "<br>";

	// เบิกทั้งหมด
	$sql = "SELECT
				SUM(a.quantity) as sum
			FROM
				tbl_withdraw_product a
			LEFT JOIN tbl_withdraw_head b ON b.withdraw_id = a.withdraw_id
			WHERE
				$conditionId
				AND b.status != '0' ";
	$rs  = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($rs);
	$withdrawAll = $row['sum'];

	// จองทั้งหมด
	$sql = "SELECT
				SUM(a.quantity) as sum
			FROM
				tbl_reserve_product a
			LEFT JOIN tbl_reserve_head b ON b.reserve_id = a.reserve_id
			WHERE
				$conditionId
				AND b.active_status != '0' ";
	$rs  = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($rs);
	$reserveAll = $row['sum'];

	// เบิกผ่านจอง
	// $sql = "SELECT
	// 			SUM(a.quantity) as sum
	// 		FROM
	// 			tbl_withdraw_product a
	// 		LEFT JOIN tbl_withdraw_head b ON b.withdraw_id = a.withdraw_id
	// 		WHERE
	// 			$conditionId
	// 			AND b.status != '0'
	// 			AND (b.reserve_id IS NOT NULL AND b.reserve_id != '') ";
	// $rs  = mysqli_query($connection, $sql);
	// $row = mysqli_fetch_assoc($rs);
	// $withdrawByReserve = $row['sum'];
	$withdrawByReserve = 0;

	$result = $importAll + ($purchase_1 + $purchase_2) - ($withdrawAll - $reserveAll + $withdrawByReserve);

	// echo "all: " . $result . "<br><br><br>";
	return $result;
}

// ณ วันนั้น
function CanGetToCurrentDate ($type, $id, $date) {
	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	// echo "Can get current...<br>";

	if( $type == 1 ){
		$conditionId .= "a.product_id = '$id' ";
	}else if($type == 2){
		$conditionId .= "a.set_id = '$id' ";
	}

	// นำเข้าธรรมดาแบบไม่ ref ใบสั่งซื้อทั้งหมด
	$sql = "SELECT
				SUM(a.quantity) as sum
			FROM
				tbl_import_product a
			JOIN tbl_import_head b ON b.import_id = a.import_id
			WHERE
				$conditionId
				AND b.active_status = '1'
				AND b.import_date <= '$date' ";
	$rs  = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($rs);
	$importAll = $row['sum'];
	// echo "import: " . $importAll . "<br>";

	// สั่งซื้อ ถ้า วันนี้เกิน วันที่ของจะเข้า เอาเฉพาะ นำเข้าที่ ref ใบสั่งซื้อนี้แล้ว  สั่งซื้อไม่รวม เกินวันที่จอง วันสุดท้าย
	// สั่งซื้อ ถ้า วันนี้ ยังไม่เกิน วันที่ของจะเข้า เอา จำนวนที่สั่งซื้อ
	$sql = "SELECT
				a.*
			FROM
				tbl_purchase_product a
			LEFT JOIN tbl_purchase_head b ON b.purchase_id = a.purchase_id
			WHERE
				$conditionId
				AND b.status != '0'
				AND a.plan_delivery_date <= '$date' ";
	$rs = mysqli_query($connection, $sql);
	$purchase = 0;
	while( $row = mysqli_fetch_assoc($rs) ){
		$purchase_product_id = $row['purchase_product_id'];
		$quantity = $row['quantity'];

		$sqlImport = "SELECT
						SUM(a.quantity) as sum
					FROM
						tbl_import_product a
					JOIN tbl_import_head b ON b.import_id = a.import_id
					WHERE
						$conditionId
						AND b.active_status = '1'
						AND b.import_date <= '$date'
						AND a.purchase_product_id = '$purchase_product_id' ";
		$rsImport  = mysqli_query($connection, $sqlImport);
		$rowImport = mysqli_fetch_assoc($rsImport);
		$import    = $rowImport['sum'];

		if( $quantity == $import ){
			$purchase += $quantity;
		}else if($quantity > $import ){
			$purchase += ($quantity - $import);
		}else{
			$purchase += $import;
		}
	}
	// echo "purchase: " . $purchase . "<br>";

	// เบิกทั้งหมด
	$sql = "SELECT
				SUM(a.quantity) as sum
			FROM
				tbl_withdraw_product a
			LEFT JOIN tbl_withdraw_head b ON b.withdraw_id = a.withdraw_id
			WHERE
				$conditionId
				AND b.status != '0' ";
	$rs  = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($rs);
	$withdrawAll = $row['sum'];

	// จองทั้งหมด
	$sql = "SELECT
				SUM(a.quantity) as sum
			FROM
				tbl_reserve_product a
			LEFT JOIN tbl_reserve_head b ON b.reserve_id = a.reserve_id
			WHERE
				$conditionId
				AND b.active_status != '0'
				AND b.reserve_date <= '$date' ";
	$rs  = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($rs);
	$reserveAll = $row['sum'];

	// เบิกผ่านจอง
	// $sql = "SELECT
	// 			SUM(a.quantity) as sum
	// 		FROM
	// 			tbl_withdraw_product a
	// 		LEFT JOIN tbl_withdraw_head b ON b.withdraw_id = a.withdraw_id
	// 		WHERE
	// 			$conditionId
	// 			AND b.status != '0'
	// 			AND (b.reserve_id IS NOT NULL AND b.reserve_id != '') ";
	// $rs  = mysqli_query($connection, $sql);
	// $row = mysqli_fetch_assoc($rs);
	// $withdrawByReserve = $row['sum'];
	$withdrawByReserve = 0;

	$result = ($importAll + $purchase) - ($withdrawAll - $reserveAll + $withdrawByReserve);

	// echo "current: " . $result . "<br><br><br>";

	return $result;
}

//คำนวนเบิก และการจอง
function canGetItem($type, $id, $date) {
	$quantity_1 = CanGetAll($type, $id, $date);
	$quantity_2 = CanGetToCurrentDate($type, $id, $date);

	$return = ($quantity_1 > $quantity_2) ? $quantity_2 : $quantity_1;
	// echo "return: " . $return;
	// if( $quantity_1 == $quantity_2 ){
	// 	return $quantity_1;
	// }else if( $quantity_1 > $quantity_2 ){
	// 	return $quantity_1 - $quantity_2;
	// }else if( $quantity_1 < $quantity_2 ){
	// 	return $quantity_1 - $quantity_2;
	// }

	return $return;
}

function dateThai($date){
    $strYear = date("Y",strtotime($date))+543;
    $strMonth= date("m",strtotime($date));
    $strDay= date("d",strtotime($date));
    $strHour= date("H",strtotime($date));
    $strMinute= date("i",strtotime($date));
    $strSeconds= date("s",strtotime($date));
    $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strthaimounth = $thaimonth[$strMonth-1];
    return $strDay." ".$strthaimounth." ".$strYear;
}

function dateThai2($date){
    $strYear = date("Y",strtotime($date))+543;
    $strMonth= date("m",strtotime($date));
    $strDay= date("d",strtotime($date));
    $strHour= date("H",strtotime($date));
    $strMinute= date("i",strtotime($date));
    $strSeconds= date("s",strtotime($date));
    $thaimonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strthaimounth = $thaimonth[$strMonth-1];
    return $strDay." ".$strthaimounth." ".$strYear;
}

function dateEng($date){
    $strYear = date("Y",strtotime($date))+543;
    $strMonth= date("m",strtotime($date));
    $strDay= date("d",strtotime($date));
    $strHour= date("H",strtotime($date));
    $strMinute= date("i",strtotime($date));
    $strSeconds= date("s",strtotime($date));
    $thaimonth=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    $strthaimounth = $thaimonth[$strMonth-1];
    return $strDay." ".$strthaimounth." ".$strYear;
}


?>
