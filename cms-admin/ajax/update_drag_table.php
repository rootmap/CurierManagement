<?php
include("../class/auth.php");
//echo '<pre>';
//print_r($_POST['pr']);
//$pr=$_POST['pr'][0];

         
foreach ($_POST['pr'] as $key => $value) {
         	//echo $value."#".$key."<br>";
         	echo $obj->update("product",array("id"=>$value,"priority"=>$key));
         }         

?>
