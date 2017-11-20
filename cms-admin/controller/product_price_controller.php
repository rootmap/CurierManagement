<?php
                            include("../class/auth.php");
                            header("Content-type: application/json");
                            $status=$_POST['acst'];
                            if ($status == 1) {
                                extract($_POST);
                                if ($cond == 0) {
                                    $arrayBanner=$obj->FlyQuery("SELECT 
                                                                pp.id,
                                                                c.name as category_id,
                                                                sc.name as sub_category_id,
                                                                u.name as unit_id,
                                                                s.name as size_id,
                                                                pt.name as product_type_id,
                                                                pp.price,
                                                                pp.date
                                                                FROM product_price as pp
                                                                left join category as c on c.id = pp.category_id
                                                                left join sub_category as sc on sc.id = pp.sub_category_id
                                                                left join unit as u on u.id = pp.unit_id
                                                                left join size as s on s.id = pp.size_id
                                                                left join product_type as pt on pt.id = pp.product_type_id
                                                                 ");
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