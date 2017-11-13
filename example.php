<?php require_once("config.php");
require_once("connection.php");

$conn = new dbConnect();
$conn->connect();

/******************************/
#Get data from database.`example`
/******************************/

$res = $conn->getData(_TBLNAME,"*","1","res");
while($row = mysql_fetch_assoc($res)){
	
	echo $row['id'];
	echo $row['name'];
	
}// end while 



/******************************/
#Insert data from database.`example`
/******************************/
$age = "12";
$fields = array("name","age");
$values = array("syed Ali",$age);
$conn->insertData(_TBLNAME,$fields,$values); // return _TRUE for successful insertions




/******************************/
#Delete data from database.`example`
/******************************/
$id = 1; // OR $_REQUEST['id'];
$where = "id = '".$id."'";
$conn->deleteData(_TBLNAME,$where);



/******************************/
#Update data from database.`example`
/******************************/
$id = 1; // OR $_REQUEST['id'];
$where = "id = '".$id."'";
$fields = array("name","age");
$values = array("syed Ali",$age);

$conn->updateData(_TBLNAME,$fields,$values, $where);



$conn->destroy();
?>