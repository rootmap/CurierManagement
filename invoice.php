<?php
include './cms-admin/class/db_Class.php';
$obj = new db_class();

$siteSettings = $obj->FlyQuery("SELECT * FROM site_settings");

include("./cms-admin/plugin/plugin.php");
$plugin = new cmsPlugin();
?>
<!DOCTYPE html>
<html lang="en" class="wide smoothscroll wow-animation">
    <head>
        <?php
        echo $plugin->softwareTitle("Quriar Receive Type");
        echo $plugin->TableCss();
        ?>
    </head>
    <body>
        <!-- The Main Wrapper -->
        <div class="page">

            <!--For older internet explorer-->

            <!--========================================================
                                                              CONTENT
            =========================================================-->
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
        </style>    
        <main class="page-content text-center">
            <!-- Contact Form -->
            <section class="well-lg well-lg--inset-1">
                <div class="container">
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
                                    <h2 align="left">Quriar Info</h2><h3 class="pull-right">Tracking No # <?= $_GET['view'] ?></h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <address>
                                            <strong>Sender Detail:</strong><br>
                                            <?= html_entity_decode($quriar_detail[0]->send_from) ?>
                                        </address>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <address>
                                            <strong>Receive From:</strong><br>
                                            <?= html_entity_decode($quriar_detail[0]->receive_from) ?>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <address>
                                            <strong>Quriar Date:</strong><br>
                                            <?= date('M d,Y', strtotime($quriar_detail[0]->date)) ?><br><br>
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
                                                    if ($quriar_detail[0]->quriar_receive_type_id == 2) {
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
                                                    if ($quriar_detail[0]->delivery_type_id == 2) {
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
                    <!-- END RD Mailform -->
                </div>
            </section>
            <!-- END Contact Form -->

            <!-- Nearest Depot -->

            <!-- END Nearest Depot-->
        </main>
        <!--========================================================
                                                          FOOTER
        ==========================================================-->

    </div>

    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Core Scripts -->

</body><!-- End Google Tag Manager -->
</html>
