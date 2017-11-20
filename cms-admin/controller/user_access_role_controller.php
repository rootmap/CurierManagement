<?php
                            include("../class/auth.php");
                            header("Content-type: application/json");
                            $status=$_POST['acst'];
                            if ($status == 1) {
                                extract($_POST);
                                if ($cond == 0) {
                                    $arrayBanner=$obj->FlyQuery("SELECT 
                                                                uar.id,
                                                                u.name as user_type_id,
                                                                e.name as user_id,
                                                                uar.date,
                                                                uar.status
                                                                FROM user_access_role as uar
                                                                LEFT JOIN user_type as u ON uar.user_type_id=u.id
                                                                LEFT JOIN employee as e ON uar.user_id=e.id");
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