<?php

include('../class/db_Class.php');	
$obj = new db_class();
extract($_POST);

header("Content-type: application/json");

$arrayBanner=$obj->FlyQuery("SELECT * FROM branch WHERE division_id='$division_id' AND district_id='$district_id'");
echo json_encode($arrayBanner);
?>