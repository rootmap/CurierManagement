<?php
                            include("../class/auth.php");
                            header("Content-type: application/json");
                            $status=$_POST['acst'];
                            if ($status == 1) {
                                extract($_POST);
                                if ($cond == 0) {
                                    $arrayBanner=$obj->FlyQuery("SELECT 
d.id,
ds.name as division_id,
d.name,
d.date
FROM district as d
 LEFT JOIN division_or_state as ds ON ds.id = d.division_id ");
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