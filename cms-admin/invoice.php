<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "invoice";
?>
<?php
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($send_from) && !empty($receive_from) && !empty($category_id) && !empty($sub_category_id) && !empty($unit_id) && !empty($size_id) && !empty($product_type_id) && !empty($quriar_receive_type_id) && !empty($delivery_type_id) && !empty($price) && !empty($quriar_status)) {


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

            $insertQuri = array('tracking_no' => $tracking_no, 'send_from' => $send_from, 'receive_from' => $receive_from, 'date' => date('Y-m-d'), 'status' => 1);
            $obj->insert("quriar_send_and_receive", $insertQuri);

            $insert_st = array('tracking_no' => $tracking_no, 'quriar_status' => $quriar_status, 'date' => date('Y-m-d'), 'status' => 1);
            $obj->insert("quriar_status", $insert_st);
            
            $checkAlreadyPriceAdded = $obj->FlyQuery("SELECT * FROM product_price WHERE category_id='$category_id' AND sub_category_id='$sub_category_id' AND unit_id='$unit_id' AND size_id='$size_id' AND product_type_id='$product_type_id'");
            if (empty($checkAlreadyPriceAdded)) {
                $obj->insert("product_price", array("category_id" => $category_id, "sub_category_id" => $sub_category_id, "unit_id" => $unit_id, "size_id" => $size_id, "product_type_id" => $product_type_id, "price" => $price));
            }
            $plugin->Success("Successfully Saved", $obj->filename());
        } else {
            $plugin->Error("Failed", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
} elseif (isset($_POST['update'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($send_from) && !empty($receive_from)  && !empty($category_id) && !empty($sub_category_id) && !empty($unit_id) && !empty($size_id) && !empty($product_type_id) && !empty($quriar_receive_type_id) && !empty($delivery_type_id) && !empty($price) && !empty($quriar_status)) {
        
        $updatearray = array("id" => $id);
        $upd2 = array('tracking_no' => $tracking_no, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'unit_id' => $unit_id, 'size_id' => $size_id, 'product_type_id' => $product_type_id, 'quriar_receive_type_id' => $quriar_receive_type_id, 'delivery_type_id' => $delivery_type_id, 'delivery_area' => $delivery_area, 'price' => $price, 'quriar_detail' => $quriar_detail, 'special_remarks' => $special_remarks, 'quriar_status' => $quriar_status, 'date' => date('Y-m-d'), 'status' => 1);
        $update_merge_array = array_merge($updatearray, $upd2);
        if ($obj->update($table, $update_merge_array) == 1) {
            
            $insert_st = array('tracking_no' => $tracking_no, 'quriar_status' => $quriar_status, 'date' => date('Y-m-d'), 'status' => 1);
            $obj->insert("quriar_status", $insert_st);
            //01748 703877
            $updatearrayQuri = array("tracking_no" => $tracking_no);
            $insertQuri = array('send_from' => $send_from, 'receive_from' => $receive_from, 'date' => date('Y-m-d'), 'status' => 1);
            $update_merge_array_quri = array_merge($updatearrayQuri, $insertQuri);
            $obj->update("quriar_send_and_receive", $insertQuri);
            
            
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
    <head>
        <?php
        echo $plugin->softwareTitle("Invoice");
        echo $plugin->TableCss();
        echo $plugin->KendoCss();
        ?>
    </head>
    <body class="">
        <?php
        include('include/topnav.php');
        include('include/mainnav.php');
        ?>





        <div id="content">
            <h1 class="content-heading bg-white border-bottom">Invoice</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Invoice</a></li>
                    <li><a href="invoice_data.php">Invoice List</a></li>
                </ul>
            </div>
            <div class="innerAll spacing-x2">
                <?php echo $plugin->ShowMsg(); ?>
                <!-- Widget -->

                <!-- Widget -->
                <div class="widget widget-inverse" >
                    <?php
                    if (isset($_GET['edit'])) {
                        ?>
                        <!-- Widget heading -->
                        <div class="widget-head">
                            <h4 class="heading">Update/Change - Invoice</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='tracking_no' value='<?php 
                                        echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "tracking_no");
                                        $tracking_no=$obj->SelectAllByVal($table, "id", $_GET['edit'], "tracking_no");
                                        ?>' placeholder='Tracking No' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send From </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='send_from' value='<?php echo $obj->SelectAllByVal("quriar_send_and_receive", "tracking_no", $tracking_no, "send_from"); ?>' placeholder='Send From' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Receive From </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='receive_from' value='<?php echo $obj->SelectAllByVal("quriar_send_and_receive", "tracking_no", $tracking_no, "receive_from"); ?>' placeholder='Receive From' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Category ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='category_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_category_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'category_id');
                                            $sqlcategory_id = $obj->FlyQuery('SELECT id,name FROM `category`');
                                            if (!empty($sqlcategory_id)) {
                                                foreach ($sqlcategory_id as $category_id):
                                                    ?><option <?php if ($category_id->id == $ex_category_id_data) { ?> selected='selected' <?php } ?> value='<?= $category_id->id ?>'><?= $category_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Sub Category ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='sub_category_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_sub_category_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'sub_category_id');
                                            $sqlsub_category_id = $obj->FlyQuery('SELECT id,name FROM `sub_category`');
                                            if (!empty($sqlsub_category_id)) {
                                                foreach ($sqlsub_category_id as $sub_category_id):
                                                    ?><option <?php if ($sub_category_id->id == $ex_sub_category_id_data) { ?> selected='selected' <?php } ?> value='<?= $sub_category_id->id ?>'><?= $sub_category_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Unit ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='unit_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_unit_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'unit_id');
                                            $sqlunit_id = $obj->FlyQuery('SELECT id,name FROM `unit`');
                                            if (!empty($sqlunit_id)) {
                                                foreach ($sqlunit_id as $unit_id):
                                                    ?><option <?php if ($unit_id->id == $ex_unit_id_data) { ?> selected='selected' <?php } ?> value='<?= $unit_id->id ?>'><?= $unit_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Size ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='size_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_size_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'size_id');
                                            $sqlsize_id = $obj->FlyQuery('SELECT id,name FROM `size`');
                                            if (!empty($sqlsize_id)) {
                                                foreach ($sqlsize_id as $size_id):
                                                    ?><option <?php if ($size_id->id == $ex_size_id_data) { ?> selected='selected' <?php } ?> value='<?= $size_id->id ?>'><?= $size_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Product Type ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='product_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_product_type_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'product_type_id');
                                            $sqlproduct_type_id = $obj->FlyQuery('SELECT id,name FROM `product_type`');
                                            if (!empty($sqlproduct_type_id)) {
                                                foreach ($sqlproduct_type_id as $product_type_id):
                                                    ?><option <?php if ($product_type_id->id == $ex_product_type_id_data) { ?> selected='selected' <?php } ?> value='<?= $product_type_id->id ?>'><?= $product_type_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Receive Type ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='quriar_receive_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_quriar_receive_type_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'quriar_receive_type_id');
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `quriar_receive_type`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?><option <?php if ($quriar_receive_type_id->id == $ex_quriar_receive_type_id_data) { ?> selected='selected' <?php } ?> value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery Type ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='delivery_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_delivery_type_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'delivery_type_id');
                                            $sqldelivery_type_id = $obj->FlyQuery('SELECT id,name FROM `delivery_type`');
                                            if (!empty($sqldelivery_type_id)) {
                                                foreach ($sqldelivery_type_id as $delivery_type_id):
                                                    ?><option <?php if ($delivery_type_id->id == $ex_delivery_type_id_data) { ?> selected='selected' <?php } ?> value='<?= $delivery_type_id->id ?>'><?= $delivery_type_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery Area </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='delivery_area' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "delivery_area"); ?>' placeholder='Delivery Area' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Price </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='price' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "price"); ?>' placeholder='Price' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Detail </label>

                                    <div class='col-sm-9'>
                                        <textarea id='form-field-1' name='quriar_detail' placeholder='Quriar Detail' class='summernote'><?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "quriar_detail"); ?></textarea>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Special Remarks </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='special_remarks' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "special_remarks"); ?>' placeholder='Special Remarks' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Status </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='quriar_status' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_quriar_status = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'quriar_status');
                                            $SSarrquriar_status = 'Received At Service Point,Loaded For Transport,On The Way,Delivered At Service Centre,Ready For Delivery,Delivered';
                                            $sqlquriar_status = explode(',', $SSarrquriar_status);
                                            if (!empty($sqlquriar_status)) {
                                                foreach ($sqlquriar_status as $quriar_status):
                                                    ?><option <?php if ($ex_quriar_status == $quriar_status) { ?> selected='selected' <?php } ?> value='<?= $quriar_status ?>'><?= $quriar_status ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button  onclick="javascript:return confirm('Do You Want change/update These Record?')"  type="submit" name="update" class="btn btn-primary">Save Change</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <!-- Widget heading -->
                        <div class="widget-head">
                            <h4 class="heading">Create New Invoice</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body">
                            <form  class="form-horizontal" method="post" action="" role="form">
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                                    <div class='col-sm-9'>
                                        <input type='text' value="<?= 'Q' . time() ?>" id='form-field-1' name='tracking_no' placeholder='Tracking No' class='form-control' />
                                    </div>
                                </div>
                                
                                
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Category  </label>

                                    <div class='col-sm-9'>
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
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Sub Category </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='sub_category_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Unit  </label>

                                    <div class='col-sm-9'>
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
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Size  </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='size_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Product Type  </label>

                                    <div class='col-sm-9'>
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
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send Type  </label>

                                    <div class='col-sm-9'>
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
                                
                                <div class='form-group quriar_receive_type_id'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send Division/State  </label>

                                    <div class='col-sm-9'>
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
                                <div class='form-group quriar_receive_type_id'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send District  </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='quriar_receive_type_district_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group quriar_receive_type_id'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send Additional Cost  </label>

                                    <div class='col-sm-9'>
                                        <input type='number' id='form-field-1' name='quriar_receive_type_price' value="0" placeholder='Type Cost/Price' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Sender Detail </label>

                                    <div class='col-sm-9'>
                                        <textarea name='send_from'></textarea>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery Type  </label>

                                    <div class='col-sm-9'>
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
                                <div class='form-group delivery_type_id'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery Division/State  </label>

                                    <div class='col-sm-9'>
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
                                <div class='form-group delivery_type_id'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery District  </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='delivery_type_district_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group delivery_type_id'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery Cost  </label>

                                    <div class='col-sm-9'>
                                        <input type='number' id='form-field-1' name='delivery_type_price' value="0" placeholder='Type Cost/Price' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Receiver Detail </label>

                                    <div class='col-sm-9'>
                                        <textarea name='receive_from'></textarea>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Delivery Area </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='delivery_area' placeholder='Delivery Area' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Price </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' value="0" name='price' placeholder='Price' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Detail </label>

                                    <div class='col-sm-9'>
                                        <textarea id='form-field-1' name='quriar_detail' placeholder='Quriar Detail' class='summernote'></textarea>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Special Remarks </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='special_remarks' placeholder='Special Remarks' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Status </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='quriar_status' class='form-control'><option value='0'>Please Select</option><?php
                                            $SSarrquriar_status = 'Received At Service Point,Loaded For Transport,On The Way,Delivered At Service Centre,Ready For Delivery,Delivered';
                                            $sqlquriar_status = explode(',', $SSarrquriar_status);
                                            if (!empty($sqlquriar_status)) {
                                                foreach ($sqlquriar_status as $quriar_status):
                                                    ?>
                                                    <option value='<?= $quriar_status ?>'><?= $quriar_status ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div><div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit"   onclick="javascript:return confirm('Do You Want Create/save These Record?')"  name="create" class="btn btn-info">Save</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <!-- // Widget END -->




                <!-- // Widget END -->
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

    <?php
    echo $plugin->TableJs();
    echo $plugin->KendoJS();
    echo $plugin->TextAreaJS();
    ?> 
    <script>
        $(document).ready(function () {
            $(".quriar_receive_type_id").fadeOut();
            $(".delivery_type_id").fadeOut();
            $("select[name=category_id]").change(function () {
                var category_id = $(this).val();
                $.post("./controller/sub-category.php", {'category_id': category_id}, function (data) {
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
                $.post("./controller/size.php", {'unit_id': unit_id}, function (data) {
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
                $.post("./controller/district.php", {'division_id': division_id}, function (data) {
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
                $.post("./controller/receive_or_delivery.php", {
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
                $.post("./controller/district.php", {'division_id': division_id}, function (data) {
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

                $.post("./controller/receive_or_delivery.php", {
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

            total += (quriar_prices - 0)

            if (count_receive_cost != 0)
            {
                total += (receive_cost - 0);
            }

            if (count_delivery_cost != 0)
            {
                total += (delivery_cost - 0);
            }

            $("input[name='price']").val(total);
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



            $.post("./controller/estimated-price.php", dataParam, function (data) {
                if (data != 0)
                {
                    var quriar_price = data[0].price;
                    $("input[name='price']").val(quriar_price);

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

</body>
</html>