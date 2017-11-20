<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "product_price";

if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($category_id) && !empty($sub_category_id) && !empty($unit_id) && !empty($size_id) && !empty($product_type_id) && !empty($price)) {
        $insert = array('category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'unit_id' => $unit_id, 'size_id' => $size_id, 'product_type_id' => $product_type_id, 'price' => $price, 'date' => date('Y-m-d'), 'status' => 1);
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
    if (!empty($category_id) && !empty($sub_category_id) && !empty($unit_id) && !empty($size_id) && !empty($product_type_id) && !empty($price)) {
        $updatearray = array("id" => $id);
        $upd2 = array('category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'unit_id' => $unit_id, 'size_id' => $size_id, 'product_type_id' => $product_type_id, 'price' => $price, 'date' => date('Y-m-d'), 'status' => 1);
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
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head><?php
        echo $plugin->softwareTitle("Product Price");
        echo $plugin->TableCss();
        ?></head>
    <body class="">
        <?php
        include('include/topnav.php');
        include('include/mainnav.php');
        ?>





        <div id="content">
            <h1 class="content-heading bg-white border-bottom">Product Price</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Product Price</a></li>
                    <li><a href="product_price_data.php">Product Price List</a></li>
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
                            <h4 class="heading">Update/Change - Product Price</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Category </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='category_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_category_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'category_id');
                                            $sqlcategory_id = $obj->FlyQuery('SELECT id,name FROM `category`');
                                            if (!empty($sqlcategory_id)) {
                                                foreach ($sqlcategory_id as $category_id):
                                                    ?>
                                                    <option <?php if ($category_id->id == $ex_category_id_data) { ?> selected='selected' <?php } ?> value='<?= $category_id->id ?>'><?= $category_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Sub Category </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='sub_category_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_sub_category_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'sub_category_id');
                                            $sqlsub_category_id = $obj->FlyQuery('SELECT id,name FROM `sub_category`');
                                            if (!empty($sqlsub_category_id)) {
                                                foreach ($sqlsub_category_id as $sub_category_id):
                                                    ?><option <?php if ($sub_category_id->id == $ex_sub_category_id_data) { ?> selected='selected' <?php } ?> value='<?= $sub_category_id->id ?>'><?= $sub_category_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Unit </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='unit_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_unit_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'unit_id');
                                            $sqlunit_id = $obj->FlyQuery('SELECT id,name FROM `unit`');
                                            if (!empty($sqlunit_id)) {
                                                foreach ($sqlunit_id as $unit_id):
                                                    ?><option <?php if ($unit_id->id == $ex_unit_id_data) { ?> selected='selected' <?php } ?> value='<?= $unit_id->id ?>'><?= $unit_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Size </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='size_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_size_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'size_id');
                                            $sqlsize_id = $obj->FlyQuery('SELECT id,name FROM `size`');
                                            if (!empty($sqlsize_id)) {
                                                foreach ($sqlsize_id as $size_id):
                                                    ?><option <?php if ($size_id->id == $ex_size_id_data) { ?> selected='selected' <?php } ?> value='<?= $size_id->id ?>'><?= $size_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Product Type </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='product_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_product_type_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'product_type_id');
                                            $sqlproduct_type_id = $obj->FlyQuery('SELECT id,name FROM `product_type`');
                                            if (!empty($sqlproduct_type_id)) {
                                                foreach ($sqlproduct_type_id as $product_type_id):
                                                    ?><option <?php if ($product_type_id->id == $ex_product_type_id_data) { ?> selected='selected' <?php } ?> value='<?= $product_type_id->id ?>'><?= $product_type_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Price </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='price' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "price"); ?>' placeholder='Price' class='form-control' />
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
                            <h4 class="heading">Create New Product Price</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Category </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='category_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
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
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Sub Category </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='sub_category_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Unit </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='unit_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
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
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Size </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='size_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Product Type </label>

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
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Price </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='price' placeholder='Price' class='form-control' />
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

    <?php echo $plugin->TableJs(); ?> 
    <script>
        $(document).ready(function () {
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
            });

        });
    </script>
</body>
</html>





















