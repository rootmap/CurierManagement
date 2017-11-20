<?php
include('../class/db_Class.php');	
$obj = new db_class();
extract($_POST);

header("Content-type: application/json");

$arrayBanner=$obj->FlyQuery("SELECT price FROM product_price WHERE category_id='$category_id' AND sub_category_id='$sub_category_id' AND unit_id='$unit_id' AND size_id='$size_id' AND product_type_id='$product_type_id'");
echo json_encode($arrayBanner);

?>