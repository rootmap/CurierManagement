<?php
include("../class/auth.php");
header("Content-type: application/json");
$status=$_POST['acst'];
if ($status == 1) {
    extract($_POST);
    if ($cond == 0) {
        $arrayBanner=$obj->FlyQuery("SELECT 
                                    i.id,
                                    i.tracking_no,
                                    qrs.receive_from,
                                    qrs.send_from,
                                    i.price,
                                    i.quriar_status,
                                    i.date
                                    FROM invoice as i
                                    LEFT JOIN quriar_send_and_receive as qrs ON i.tracking_no=qrs.tracking_no ORDER BY i.id DESC");
        echo "{\"data\":" . json_encode($arrayBanner) . "}";
    }elseif ($cond == 1) {
        $arrayBanner=$obj->SelectAllByID_Multiple($table, $multi);
        echo "{\"data\":" . json_encode($arrayBanner) . "}";
    }elseif ($cond == 2) {
        $arrayBanner=$obj->FlyQuery($table);
        echo "{\"data\":" . json_encode($arrayBanner) . "}";
    }
}elseif ($status == 3) {
    extract($_POST);
    if ($obj->TotalRows($table) == 1) {
        $arrayBanner=$obj->delete($table, array("id"=>$id));
        echo 1;
    }else {
        $arrayBanner=$obj->delete($table, array("id"=>$id));
        echo 2;
    }
}
                            ?>