<?php

include('../class/db_Class.php');	
$obj = new db_class();
extract($_POST);

header("Content-type: application/json");

$arrayBanner=$obj->FlyQuery("SELECT * FROM sub_category WHERE category_id='$category_id'");
echo json_encode($arrayBanner);

?>