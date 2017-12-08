<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "quriar_receive_type";

if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($name)) {
        $insert = array('name' => $name, 'date' => date('Y-m-d'), 'status' => 1);
        if ($obj->insert($table, $insert) == 1) {
            $plugin->Success("Successfully Saved", $obj->filename());
        } else {
            $plugin->Error("Failed", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
} elseif (isset($_POST['update'])) {
    extract($_POST);
    if (!empty($name)) {
        $updatearray = array("id" => $id);
        $upd2 = array('name' => $name, 'date' => date('Y-m-d'), 'status' => 1);
        $update_merge_array = array_merge($updatearray, $upd2);
        if ($obj->update($table, $update_merge_array) == 1) {
            $plugin->Success("Successfully Updated", $obj->filename());
        } else {
            $plugin->Error("Failed", $obj->filename());
        }
    }
} elseif (isset($_GET['del']) == "delete") {
    $delarray = array("id" => $_GET['id']);
    if ($obj->delete($table, $delarray) == 1) {
        $plugin->Success("Successfully Delete", $obj->filename());
    } else {
        $plugin->Error("Failed", $obj->filename());
    }
}
?><!doctype html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head><?php
        echo $plugin->softwareTitle("Quriar Receive Type");
        echo $plugin->TableCss();
        ?>
        <style type="text/css">
            .invoice-title h2, .invoice-title h3 {
                display: inline-block;
            }

            .table > tbody > tr > .no-line {
                border-top: none;
            }

            .table > thead > tr > .no-line {
                border-bottom: none;
            }

            .table > tbody > tr > .thick-line {
                border-top: 2px solid;
            }
        </style>    
    </head>
    <body class="">


        <?php
                    $quriar_string = "SELECT 
                        i.id, 
                        i.tracking_no, 
                        i.category_id, 
                        c.name as category,
                        i.sub_category_id, 
                        sc.name as sub_category,
                        i.unit_id, 
                        u.name as unit,
                        i.size_id, 
                        s.name as size,
                        i.product_type_id, 
                        pt.name as product_type,
                        i.quriar_receive_type_id, 
                        qrt.name as quriar_receive_type,
                        i.delivery_type_id, 
                        dt.name as delivery_type,
                        i.delivery_area, 
                        i.price, 
                        i.conditional_price, 
                        i.quriar_detail, 
                        i.special_remarks, 
                        i.quriar_status, 
                        i.date, 
                        i.quriar_receive_type_price,
                        i.delivery_type_price,
                        i.status,
                        qrs.receive_from,
                        qrs.send_from
                        FROM invoice as i
                        LEFT JOIN quriar_send_and_receive as qrs ON i.tracking_no=qrs.tracking_no 
                        LEFT JOIN category as c ON i.category_id=c.id
                        LEFT JOIN sub_category as sc ON i.sub_category_id=sc.id
                        LEFT JOIN unit as u ON i.unit_id=u.id 
                        LEFT JOIN Size as s ON i.size_id=s.id 
                        LEFT JOIN product_type as pt ON i.product_type_id=pt.id 
                        LEFT JOIN quriar_receive_type as qrt ON i.quriar_receive_type_id=qrt.id 
                        LEFT JOIN delivery_type as dt ON i.delivery_type_id=dt.id WHERE i.tracking_no='" . $_GET['view'] . "'";

                    //echo $quriar_string;
                    //exit();
                    $quriar_detail = $obj->FlyQuery($quriar_string);

                    //print_r($quriar_detail);
                    //exit();
                    ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice-title">
                        <h2>Quriar Detail</h2><h3 class="pull-right">Tracking No # <?=$_GET['view']?></h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                                        <address>
                                            <strong>Sender Detail:</strong><br>
                                            <?php 
                                            $jsonSendFrom=json_decode($quriar_detail[0]->send_from,true);
                                            //print_r($jsonSendFrom);
                                            ?>
                                            <div class="pull-left">
                                            <div class="row">
                                                <div class="col-md-4 text-left bolder">Name</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonSendFrom['send_from_full_name']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 text-left bolder">Phone</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonSendFrom['send_from_phone']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-left bolder">Email</div>
                                                <div class="col-md-10 text-right"> : <?=$jsonSendFrom['send_from_email']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 text-left bolder">Address</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonSendFrom['send_from_address']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 text-left bolder">Branch Name</div>
                                                <div class="col-md-7 text-right"> : 
                                                    <?=$obj->SelectAllByVal("branch","id",$jsonSendFrom['send_from_branch_id'],"branch_name")?>
                                                        
                                                
                                                </div>
                                            </div>
                                        </div>
                                        </address>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <address>
                                            <strong>Receive From:</strong><br>
                                            <?php 
                                            $jsonReceiverFrom=json_decode($quriar_detail[0]->receive_from,true);
                                            //print_r($jsonReceiverFrom);
                                            ?>
                                             <div class="pull-left">
                                            <div class="row">
                                                <div class="col-md-2 text-right  bolder">Name</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonReceiverFrom['receiver_from_full_name']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right  bolder">Phone</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonReceiverFrom['receiver_from_phone']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right bolder">Email</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonReceiverFrom['receiver_from_email']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right bolder">Address</div>
                                                <div class="col-md-8 text-right"> : <?=$jsonReceiverFrom['receiver_from_address']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right bolder">Branch Name</div>
                                                <div class="col-md-8 text-right"> : 
                                                    <?=$obj->SelectAllByVal("branch","id",$jsonReceiverFrom['receiver_from_branch_id'],"branch_name")?>
                                                        
                                                
                                                </div>
                                            </div>
                                        </div>
                                        </address>
                                    </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Quriar Date:</strong><br>
                                <?=date('M d,Y', strtotime($quriar_detail[0]->date))?><br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Quriar Detail</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                    <tr>
                                                        <td class="text-left">Tracking No</td>
                                                        <td class="text-left"><?= $quriar_detail[0]->tracking_no ?></td>
                                                        <td class="text-right">Category</td>
                                                        <td class="text-right"><?= $quriar_detail[0]->category ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Sub Category</td>
                                                        <td class="text-left"><?= $quriar_detail[0]->sub_category ?></td>
                                                        <td class="text-right">Unit</td>
                                                        <td class="text-right"><?= $quriar_detail[0]->unit ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Size</td>
                                                        <td class="text-left"><?= $quriar_detail[0]->size ?></td>
                                                        <td class="text-right">Product Type</td>
                                                        <td class="text-right"><?= $quriar_detail[0]->product_type ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Send Type</td>
                                                        <td class="text-left"><?= $quriar_detail[0]->quriar_receive_type ?></td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <?php
                                                    
                                                        $rpd=$obj->FlyQuery("SELECT 
                                                                        rpd.id,
                                                                        rpd.tracking_no,
                                                                        dos.name as division,
                                                                        d.name as district,
                                                                        rpd.date,
                                                                        rpd.status
                                                                        FROM receive_product_detail as rpd
                                                                        LEFT JOIN division_or_state as dos ON rpd.division_id=dos.id
                                                                        LEFT JOIN district as d ON rpd.district_id=d.id
                                                                        WHERE rpd.tracking_no='".$quriar_detail[0]->tracking_no."'");
                                                        if(!empty($rpd))
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td class="text-left">Division</td>
                                                            <td class="text-left"><?=$rpd[0]->division?></td>
                                                            <td class="text-right">District</td>
                                                            <td class="text-right"><?=$rpd[0]->district?></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    
                                                    ?>
                                                    <tr>
                                                        <td class="text-left">Delivery Type</td>
                                                        <td class="text-left"><?= $quriar_detail[0]->delivery_type ?></td>
                                                        <td class="text-left"></td>
                                                        <td class="text-left"></td>
                                                    </tr>
                                                    <?php
                                                   
                                                        $rpd=$obj->FlyQuery("SELECT 
                                                                        rpd.id,
                                                                        rpd.tracking_no,
                                                                        dos.name as division,
                                                                        d.name as district,
                                                                        rpd.date,
                                                                        rpd.status
                                                                        FROM delivery_product_detail as rpd
                                                                        LEFT JOIN division_or_state as dos ON rpd.division_id=dos.id
                                                                        LEFT JOIN district as d ON rpd.district_id=d.id
                                                                        WHERE rpd.tracking_no='".$quriar_detail[0]->tracking_no."'");
                                                        if(!empty($rpd))
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td class="text-left">Division</td>
                                                            <td class="text-left"><?=$rpd[0]->division?></td>
                                                            <td class="text-right">District</td>
                                                            <td class="text-right"><?=$rpd[0]->district?></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    ?>
                                                    <tr>
            
                                                        <td class="text-left" colspan="4">Quriar Detail
                                                            <br>    
                                                            <?= html_entity_decode($quriar_detail[0]->quriar_detail) ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Special Remarks</td>
                                                        <td class="text-left"><?= $quriar_detail[0]->special_remarks ?></td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"></td>
                                                    </tr>




                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line text-center"><strong>Product Receive Cost </strong></td>
                                                        <td class="thick-line text-right">Tk. <?php
                                                            $quriar_receive_type_price = $quriar_detail[0]->quriar_receive_type_price;
                                                            echo $quriar_detail[0]->quriar_receive_type_price;
                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="no-line text-center"><strong>Product Delivery Cost</strong></td>
                                                        <td class="no-line text-right">Tk. <?php
                                                            $delivery_type_price = $quriar_detail[0]->delivery_type_price;
                                                            echo $quriar_detail[0]->delivery_type_price;
                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="no-line text-center"><strong>Quriar Price</strong></td>
                                                        <td class="no-line text-right">Tk. <?php
                                                            $price = $quriar_detail[0]->price;
                                                            echo $quriar_detail[0]->price;
                                                            $total = $quriar_receive_type_price + $delivery_type_price + $price;
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                    if(!empty((int)$quriar_detail[0]->conditional_price))
                                                    {
                                                    ?>
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="no-line text-center"><strong>Conditional Price</strong></td>
                                                        <td class="no-line text-right">Tk. <?php
                                                            echo $quriar_detail[0]->conditional_price;
                                                            $total += $quriar_detail[0]->conditional_price;
                                                            ?></td>
                                                    </tr>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="no-line text-center"><strong>Total</strong></td>
                                                        <td class="no-line text-right">Tk. <?= $total ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Quriar Status</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center"><strong>Tracking No</strong></td>
                                                        <td class="text-center"><strong>Status</strong></td>
                                                        <td class="text-center"><strong>Date</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                    <?php
                                                    $sqlQurST = $obj->FlyQuery("SELECT * FROM `quriar_status` WHERE tracking_no='" . $_GET['view'] . "'");
                                                    foreach ($sqlQurST as $qrst):
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?= $qrst->tracking_no ?></td>
                                                            <td class="text-center"><?= $qrst->quriar_status ?></td>
                                                            <td class="text-center"><?= date('M d,Y', strtotime($qrst->date)) ?></td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>



        <!-- // Content END -->

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include('include/footer.php'); ?>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->

    <?php echo $plugin->TableJs(); ?> </body>
</html>