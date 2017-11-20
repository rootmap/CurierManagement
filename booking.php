<?php
session_start();
include("./cms-admin/plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "invoice";

include './cms-admin/class/db_Class.php';
$obj = new db_class();

$siteSettings = $obj->FlyQuery("SELECT * FROM site_settings");
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($send_from) && !empty($receive_from) && !empty($category_id) && !empty($sub_category_id) && !empty($unit_id) && !empty($size_id) && !empty($product_type_id) && !empty($quriar_receive_type_id) && !empty($delivery_type_id) && !empty($price) && !empty($quriar_detail) && !empty($special_remarks)) {

        $quriar_status = "Created By User";
        $delivery_area = "";
        $insert = array('tracking_no' => $tracking_no,
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
            'unit_id' => $unit_id,
            'size_id' => $size_id,
            'product_type_id' => $product_type_id,
            'quriar_receive_type_id' => $quriar_receive_type_id,
            'delivery_type_id' => $delivery_type_id,
            'delivery_area' => $delivery_area,
            'quriar_receive_type_price' => $quriar_receive_type_price,
            'delivery_type_price' => $delivery_type_price,
            'price' => $price,
            'quriar_detail' => $quriar_detail,
            'special_remarks' => $special_remarks,
            'quriar_status' => $quriar_status,
            'date' => date('Y-m-d'),
            'status' => 1);
        if ($obj->insert($table, $insert) == 1) {
            
            if($quriar_receive_type_id==2)
            {
                $insertReceveDistrict=array('tracking_no'=>$tracking_no,'division_id'=>$quriar_receive_type_division_id,'district_id'=>$quriar_receive_type_district_id,'date'=>date('Y-m-d'),'status'=>1);
                $obj->insert("receive_product_detail",$insertReceveDistrict);
            }
            
            if($delivery_type_id==2)
            {
                $insertDelivery=array('tracking_no'=>$tracking_no,'division_id'=>$delivery_type_division_id,'district_id'=>$delivery_type_district_id,'date'=>date('Y-m-d'),'status'=>1);
		$obj->insert("delivery_product_detail",$insertDelivery);
            }
            
            $insertQuri = array('tracking_no' => $tracking_no, 'send_from' => $send_from, 'receive_from' => $receive_from, 'date' => date('Y-m-d'), 'status' => 1);
            $obj->insert("quriar_send_and_receive", $insertQuri);

            $insert_st = array('tracking_no' => $tracking_no, 'quriar_status' => $quriar_status, 'date' => date('Y-m-d'), 'status' => 1);
            $obj->insert("quriar_status", $insert_st);

            $checkAlreadyPriceAdded = $obj->FlyQuery("SELECT * FROM product_price WHERE category_id='$category_id' AND sub_category_id='$sub_category_id' AND unit_id='$unit_id' AND size_id='$size_id' AND product_type_id='$product_type_id'");
            if (empty($checkAlreadyPriceAdded)) {
                $obj->insert("product_price", array("category_id" => $category_id, "sub_category_id" => $sub_category_id, "unit_id" => $unit_id, "size_id" => $size_id, "product_type_id" => $product_type_id, "price" => $price));
            }
            $plugin->Success("Quriar Request Saved, Admin willl approved this shortly.", $obj->filename());
        } else {
            $plugin->Error("Failed, Please Try Again.", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="wide smoothscroll wow-animation">
    <head>
        <!-- Site Title -->
        <title>Contacts</title>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="viewport"
              content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

        <!-- Stylesheets -->
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <link href='//fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">

        <!--[if lt IE 10]>
        <script src="js/html5shiv.min.js"></script>
        <![endif]-->
        <?= $plugin->KendoCss() ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <!-- The Main Wrapper -->
        <div class="page">

            <!--For older internet explorer-->
            <div class="old-ie"
                 style='background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;'>
                <a href="https://windows.microsoft.com/en-US/internet-explorer/..">
                    <img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
                         alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
                </a>
            </div>
            <!--END block for older internet explorer-->

            <!--========================================================
                                                              HEADER
            =========================================================-->
            <header class="page-header">
                <!-- RD Navbar -->
                <div class="rd-navbar-wrap">
                    <nav class="rd-navbar" data-md-device-layout="rd-navbar-fixed" data-rd-navbar-lg="rd-navbar-static" data-lg-device-layout="rd-navbar-static">
                        <div class="rd-navbar-inner">
                            <!-- RD Navbar Panel -->
                            <?php
                            include './include/header_nav.php';
                            ?>
                            <!-- END RD Navbar Panel -->
                        </div>
                    </nav>
                </div>
                <!-- END RD Navbar -->
            </header>
            <!--========================================================
                                                              CONTENT
            =========================================================-->
            <main class="page-content text-center">
                <!-- Contact Form -->
                <section class="well-lg well-lg--inset-1">
                    <div class="container">
                        <h2>Quriar Booking Form</h2>
                        <!-- RD Mailform -->

                        <div class="widget-body">
                            <?php echo $plugin->ShowMsg(); ?>
                            <form  class="form-horizontal" method="post" action="" role="form">
                                <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                                <hr>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Tracking No </label>

                                    <div class='col-sm-7'>
                                        <input type='text' readonly="readonly" value="<?= 'Q' . time() ?>" id='form-field-1' name='tracking_no' placeholder='Tracking No' class='form-control' />
                                    </div>
                                </div>
                                
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-12 control-label text-center" style="text-align: center !important;"> 
                                        <code> Please keep this tracking no for further query. </code> 
                                    </label>
                                </div>

                                <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                                <hr>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Category  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='category_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $sqlcategory_id = $obj->FlyQuery('SELECT id,name FROM `category`');
                                            if (!empty($sqlcategory_id)) {
                                                foreach ($sqlcategory_id as $category_id):
                                                    ?>
                                                    <option value='<?= $category_id->id ?>'><?= $category_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Sub Category </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='sub_category_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Unit  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='unit_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $sqlunit_id = $obj->FlyQuery('SELECT id,name FROM `unit`');
                                            if (!empty($sqlunit_id)) {
                                                foreach ($sqlunit_id as $unit_id):
                                                    ?>
                                                    <option value='<?= $unit_id->id ?>'><?= $unit_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Size  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='size_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Product Type  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='product_type_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqlproduct_type_id = $obj->FlyQuery('SELECT id,name FROM `product_type`');
                                            if (!empty($sqlproduct_type_id)) {
                                                foreach ($sqlproduct_type_id as $product_type_id):
                                                    ?>
                                                    <option value='<?= $product_type_id->id ?>'><?= $product_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Price </label>

                                    <div class='col-sm-7'>
                                        <input type='text' readonly="readonly" id='form-field-1' value="0" name='price' placeholder='Price' class='form-control' />
                                    </div>
                                </div>
                                <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                                <hr />
                                <div class="clearfix"></div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Send Type  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='quriar_receive_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `quriar_receive_type`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group quriar_receive_type_id  col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Send Division/State  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='quriar_receive_type_division_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `division_or_state`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group quriar_receive_type_id  col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Send District  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='quriar_receive_type_district_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>



                                <div class='form-group quriar_receive_type_id col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Pickup Cost  </label>

                                    <div class='col-sm-7'>
                                        <input type='number' readonly="readonly" id='form-field-1' name='quriar_receive_type_price' value="0" placeholder='Type Cost/Price' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Sender Detail </label>

                                    <div class='col-sm-7'>
                                        <textarea name='send_from'></textarea>
                                    </div>
                                </div>     

                                <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                                <hr />
                                <div class="clearfix"></div>     

                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Delivery Type  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='delivery_type_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqldelivery_type_id = $obj->FlyQuery('SELECT id,name FROM `delivery_type`');
                                            if (!empty($sqldelivery_type_id)) {
                                                foreach ($sqldelivery_type_id as $delivery_type_id):
                                                    ?>
                                                    <option value='<?= $delivery_type_id->id ?>'><?= $delivery_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group delivery_type_id col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Delivery Division/State  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='delivery_type_division_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `division_or_state`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group delivery_type_id col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Delivery District  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='delivery_type_district_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group delivery_type_id col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Delivery Cost  </label>

                                    <div class='col-sm-7'>
                                        <input type='number' readonly="readonly" id='form-field-1' name='delivery_type_price' value="0" placeholder='Type Cost/Price' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Receiver Detail </label>

                                    <div class='col-sm-7'>
                                        <textarea name='receive_from'></textarea>
                                    </div>
                                </div>
                                <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                                <hr />
                                <div class="clearfix"></div>     

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Detail </label>

                                    <div class='col-sm-9'>
                                        <textarea id='form-field-1' name='quriar_detail' placeholder='Quriar Detail' class='summernote'></textarea>
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Special Remarks </label>

                                    <div class='col-sm-7'>
                                        <input type='text' id='form-field-1' name='special_remarks' placeholder='Special Remarks' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label  for="inputEmail3" class="col-sm-4 control-label"> Total Quriar Cost  </label>

                                    <div class='col-sm-7'>
                                        <input type='number' readonly="readonly" id='form-field-1' name='total_quriar_cost' value="0" placeholder='Type Quriar Cost/Price' class='form-control' />
                                    </div>
                                </div>      


                                <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                                <hr />
                                <div class="clearfix"></div>  

                                <div class="form-group" style="padding-top: 20px;">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <button class="btn btn-sm btn-primary" onclick="javascript:return confirm('Do You Want Create/save These Record?')"  name="create" type="submit">Send Quriar Request</button>
                                    </div>
                                </div>
                            </form>

                            <div class="clearfix" style="width: 100%; display: block; height: 1px; clear: both;"></div>
                            <hr />
                            <div class="clearfix"></div>
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
            <?php include './include/fotter.php'; ?>
        </div>

        <!-- Global Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        <!-- Core Scripts -->
        <script src="js/core.min.js"></script>
        <!-- Additional Functionality Scripts -->
        <script src="js/script.js"></script>
        <?php
        echo $plugin->KendoJS();
        ?>

        <script>
                                            $(document).ready(function () {
                                                $(".quriar_receive_type_id").fadeOut();
                                                $(".delivery_type_id").fadeOut();
                                                $("select[name=category_id]").change(function () {
                                                    var category_id = $(this).val();
                                                    $.post("./cms-admin/controller/sub-category.php", {'category_id': category_id}, function (data) {
                                                        var htmlString = '<option value="0">Please Select</option>';
                                                        $.each(data, function (i, item) {
                                                            console.log(item.name);
                                                            htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                                                        });

                                                        $("select[name=sub_category_id]").html(htmlString);

                                                    });
                                                    CalculatePrice();
                                                    SetDefaultSomeFeild();

                                                });

                                                $("select[name=unit_id]").change(function () {
                                                    var unit_id = $(this).val();
                                                    $.post("./cms-admin/controller/size.php", {'unit_id': unit_id}, function (data) {
                                                        var htmlString = '<option value="0">Please Select</option>';
                                                        $.each(data, function (i, item) {
                                                            console.log(item.name);
                                                            htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                                                        });

                                                        $("select[name=size_id]").html(htmlString);

                                                    });
                                                    CalculatePrice();
                                                    SetDefaultSomeFeild();
                                                });

                                                $("select[name=sub_category_id]").change(function () {
                                                    CalculatePrice();
                                                    SetDefaultSomeFeild();
                                                });

                                                $("select[name=size_id]").change(function () {
                                                    CalculatePrice();
                                                    SetDefaultSomeFeild();
                                                });

                                                $("select[name=product_type_id]").change(function () {
                                                    CalculatePrice();
                                                    SetDefaultSomeFeild();

                                                });

                                                $("select[name=quriar_receive_type_id]").change(function () {
                                                    if ($(this).val() == 2)
                                                    {
                                                        $(".quriar_receive_type_id").fadeIn();
                                                    }
                                                });

                                                $("select[name=delivery_type_id]").change(function () {
                                                    console.log(1);
                                                    if ($(this).val() == 2)
                                                    {
                                                        $(".delivery_type_id").fadeIn();
                                                    }
                                                });

                                                $("select[name=quriar_receive_type_division_id]").change(function () {
                                                    var division_id = $(this).val();
                                                    $.post("./cms-admin/controller/district.php", {'division_id': division_id}, function (data) {
                                                        var htmlString = '<option value="0">Please Select</option>';
                                                        $.each(data, function (i, item) {
                                                            console.log(item.name);
                                                            htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                                                        });

                                                        $("select[name=quriar_receive_type_district_id]").html(htmlString);

                                                    });
                                                });

                                                $("select[name=quriar_receive_type_district_id]").change(function () {
                                                    var division_id = $("select[name=quriar_receive_type_division_id]").val();
                                                    var district_id = $(this).val();
                                                    CalculatePrice();
                                                    $.post("./cms-admin/controller/receive_or_delivery.php", {
                                                        'division_id': division_id,
                                                        'district_id': district_id
                                                    },
                                                            function (data) {
                                                                //console.log(data);
                                                                if (data != 0)
                                                                {
                                                                    $("input[name='quriar_receive_type_price']").val(data[0].price);
                                                                } else
                                                                {
                                                                    $("input[name='quriar_receive_type_price']").val(0);
                                                                }

                                                                //calculateOnlyExtraCalc();

                                                            });

                                                });

                                                $("select[name=delivery_type_division_id]").change(function () {
                                                    var division_id = $(this).val();
                                                    $.post("./cms-admin/controller/district.php", {'division_id': division_id}, function (data) {
                                                        var htmlString = '<option value="0">Please Select</option>';
                                                        $.each(data, function (i, item) {
                                                            console.log(item.name);
                                                            htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                                                        });

                                                        $("select[name=delivery_type_district_id]").html(htmlString);

                                                    });
                                                });

                                                $("select[name=delivery_type_district_id]").change(function () {
                                                    var division_id = $("select[name=delivery_type_division_id]").val();
                                                    var district_id = $(this).val();
                                                    CalculatePrice();

                                                    $.post("./cms-admin/controller/receive_or_delivery.php", {
                                                        'division_id': division_id,
                                                        'district_id': district_id
                                                    },
                                                            function (data) {
                                                                //console.log(data);
                                                                if (data != 0)
                                                                {
                                                                    $("input[name='delivery_type_price']").val(data[0].price);
                                                                } else
                                                                {
                                                                    $("input[name='delivery_type_price']").val(0);
                                                                }

                                                                //calculateOnlyExtraCalc();

                                                            });

                                                });



                                                //            $("input[name='quriar_receive_type_price']").keyUp(function(){
                                                //                CalculatePrice();
                                                //            });
                                                //            
                                                //            $("input[name='delivery_type_price']").keyUp(function(){
                                                //                CalculatePrice();
                                                //            });


                                            });


                                            function SetDefaultSomeFeild()
                                            {
                                                $('select[name="quriar_receive_type_id"] option[value="0"]').attr("selected", true);
                                                $('select[name="delivery_type_id"] option[value="0"]').attr("selected", true);

                                                $('select[name="quriar_receive_type_division_id"] option[value="0"]').attr("selected", true);
                                                $('select[name="quriar_receive_type_district_id"] option[value="0"]').attr("selected", true);

                                                $('select[name="delivery_type_division_id"] option[value="0"]').attr("selected", true);
                                                $('select[name="delivery_type_district_id"] option[value="0"]').attr("selected", true);

                                                $(".quriar_receive_type_id").fadeOut();
                                                $(".delivery_type_id").fadeOut();
                                                $("input[name='quriar_receive_type_price']").val(0);
                                                $("input[name='delivery_type_price']").val(0);
                                            }



                                            function calculateOnlyExtraCalc()
                                            {
                                                var total = 0;

                                                var receive_cost = $("input[name='quriar_receive_type_price']").val();
                                                var count_receive_cost = receive_cost.length;

                                                var delivery_cost = $("input[name='delivery_type_price']").val();
                                                var count_delivery_cost = delivery_cost.length;

                                                var quriar_prices = $("input[name='price']").val();
                                                var count_quriar_prices = quriar_prices.length;
                                                //alert(quriar_prices);
                                                total += (quriar_prices - 0)

                                                if (count_receive_cost != 0)
                                                {
                                                    total += (receive_cost - 0);
                                                }

                                                if (count_delivery_cost != 0)
                                                {
                                                    total += (delivery_cost - 0);
                                                }

                                                $("input[name='total_quriar_cost']").val(total);
                                                console.log(total);
                                            }



                                            function CalculatePrice()
                                            {
                                                var category_id = $("select[name='category_id']").val();
                                                var sub_category_id = $("select[name='sub_category_id']").val();
                                                var unit_id = $("select[name='unit_id']").val();
                                                var size_id = $("select[name='size_id']").val();
                                                var product_type_id = $("select[name='product_type_id']").val();
                                                var dataParam = {
                                                    'category_id': category_id,
                                                    'sub_category_id': sub_category_id,
                                                    'unit_id': unit_id,
                                                    'size_id': size_id,
                                                    'product_type_id': product_type_id
                                                };



                                                $.post("./cms-admin/controller/estimated-price.php", dataParam, function (data) {
                                                    if (data != 0)
                                                    {
                                                        var quriar_price = data[0].price;
                                                        $("input[name='price']").val(quriar_price);
                                                        calculateOnlyExtraCalc();

                                                    } else
                                                    {
                                                        $("input[name='price']").val(0);
                                                    }
                                                });


                                            }


                                            function calculateExtraPrice()
                                            {
                                                CalculatePrice();
                                                calculateOnlyExtraCalc();
                                            }

        </script>


        <script>
            $(document).ready(function () {
                
                
                setInterval(function(){
                    calculateOnlyExtraCalc();
                },100);
                
                $("textarea").kendoEditor({
                    tools: [
                        "bold",
                        "italic",
                        "underline",
                        "strikethrough",
                        "justifyLeft",
                        "justifyCenter",
                        "justifyRight",
                        "justifyFull",
                        "outdent",
                        "unlink"
                    ],
                    resizable: {
                        content: true,
                        toolbar: true
                    },
                    style: [
                        {text: "Highlight Error", value: "hlError"},
                        {text: "Highlight OK", value: "hlOK"},
                        {text: "Inline Code", value: "inlineCode"}
                    ],
                });
            });
        </script>
    </body><!-- End Google Tag Manager -->
</html>
