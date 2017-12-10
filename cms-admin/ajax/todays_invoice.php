<?php
	include('../class/auth.php');

	$branch_id = $obj->SelectAllByVal("employee", "id", $input_by, "branch_id");
$UserTypeID = $obj->SelectAllByVal("user_access_role", "id", $input_by, "user_type_id");
$UserType = $obj->SelectAllByVal("user_type", "id", $UserTypeID, "name");
	header("Content-type: application/json");
	if ($UserType == "Super Admin") {
	$sqlenquiry = $obj->FlyQuery("SELECT i.id,i.tracking_no,i.price,(SELECT qs.quriar_status FROM quriar_status as qs WHERE qs.tracking_no=i.tracking_no ORDER BY qs.id DESC LIMIT 1) as quriar_status,
		(SELECT qs.status FROM invoice_payment as qs WHERE qs.tracking_no=i.tracking_no ORDER BY qs.id DESC LIMIT 1) as payment_status,
                                    i.date,i.conditional_price FROM `invoice` as i WHERE i.`date` = CURDATE()");
	}
	else
	{
		$sqlenquiry = $obj->FlyQuery("SELECT i.id,i.tracking_no,i.price,(SELECT qs.quriar_status FROM quriar_status as qs WHERE qs.tracking_no=i.tracking_no ORDER BY qs.id DESC LIMIT 1) as quriar_status,
			(SELECT qs.status FROM invoice_payment as qs WHERE qs.tracking_no=i.tracking_no ORDER BY qs.id DESC LIMIT 1) as payment_status,
                                    i.date,i.conditional_price FROM `invoice` as i WHERE (i.delivery_from_branch_id=".$branch_id." OR i.send_from_branch_id=".$branch_id.")
                                     AND  i.`date` = CURDATE()");
	}


	$var=array("data"=>$sqlenquiry);
echo json_encode($var);
	
?>