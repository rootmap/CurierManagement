<?php

include('../class/db_Class.php');	
$obj = new db_class();
extract($_POST);

header("Content-type: application/json");

$arrayBanner=$obj->FlyQuery("SELECT * FROM size WHERE unit_id='$unit_id'");
echo json_encode($arrayBanner);

?>