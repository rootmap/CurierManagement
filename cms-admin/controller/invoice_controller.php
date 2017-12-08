<?php

include("../class/auth.php");
$branch_id = $obj->SelectAllByVal("employee", "id", $input_by, "branch_id");
$UserTypeID = $obj->SelectAllByVal("user_access_role", "id", $input_by, "user_type_id");
$UserType = $obj->SelectAllByVal("user_type", "id", $UserTypeID, "name");

header("Content-type: application/json");
$status = $_POST['acst'];
if ($status == 1) {
    extract($_POST);
    if ($cond == 0) {
        if ($UserType == "Super Admin") {
            $arrayBanner = $obj->FlyQuery("SELECT 
                                    i.id,
                                    i.tracking_no,
                                    qrs.receive_from,
                                    qrs.send_from,
                                    i.price,
                                    (SELECT qs.quriar_status FROM quriar_status as qs WHERE qs.tracking_no=i.tracking_no ORDER BY qs.id DESC LIMIT 1) as quriar_status,
                                    i.date,i.conditional_price
                                    FROM invoice as i
                                    LEFT JOIN quriar_send_and_receive as qrs ON i.tracking_no=qrs.tracking_no ORDER BY i.id DESC");
        } else {
            $arrayBanner = $obj->FlyQuery("SELECT 
                                    i.id,
                                    i.tracking_no,
                                    qrs.receive_from,
                                    qrs.send_from,
                                    i.price,
                                    (SELECT qs.quriar_status FROM quriar_status as qs WHERE qs.tracking_no=i.tracking_no ORDER BY qs.id DESC LIMIT 1) as quriar_status,
                                    i.date,i.conditional_price
                                    FROM invoice as i
                                    LEFT JOIN quriar_send_and_receive as qrs ON i.tracking_no=qrs.tracking_no 
                                    WHERE (i.delivery_from_branch_id=".$branch_id." OR i.send_from_branch_id=".$branch_id.")
                                    ORDER BY i.id DESC");
        }


        echo "{\"data\":" . json_encode($arrayBanner) . "}";
    } elseif ($cond == 1) {
        $arrayBanner = $obj->SelectAllByID_Multiple($table, $multi);
        echo "{\"data\":" . json_encode($arrayBanner) . "}";
    } elseif ($cond == 2) {
        $arrayBanner = $obj->FlyQuery($table);
        echo "{\"data\":" . json_encode($arrayBanner) . "}";
    }
} elseif ($status == 3) {
    extract($_POST);
    if ($obj->TotalRows($table) == 1) {
        $arrayBanner = $obj->delete($table, array("id" => $id));
        echo 1;
    } else {
        $arrayBanner = $obj->delete($table, array("id" => $id));
        echo 2;
    }
}
?>