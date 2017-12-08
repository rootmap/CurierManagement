<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "service_point_report";
?>
<?php
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($employee_id)) {
        $insert = array('tracking_no' => $tracking_no, 'employee_id' => $employee_id, 'date' => date('Y-m-d'), 'status' => 1);
        if ($obj->insert($table, $insert) == 1) {
            $plugin->Success("Successfully Saved","service_point_report_data.php?tracking_no=".$tracking_no);
        } else {
            $plugin->Error("Failed", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
} elseif (isset($_POST['update'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($employee_id)) {
        $updatearray = array("id" => $id);
        $upd2 = array('tracking_no' => $tracking_no, 'employee_id' => $employee_id, 'date' => date('Y-m-d'), 'status' => 1);
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
        echo $plugin->softwareTitle("Service Point Report");
        echo $plugin->TableCss();
        ?></head>
    <body class="">
        <?php
        include('include/topnav.php');
        include('include/mainnav.php');
        ?>





        <div id="content">
            <h1 class="content-heading bg-white border-bottom">Service Point Report</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Service Point Report</a></li>
                    <li><a href="service_point_report_data.php">Service Point Report List</a></li>
                </ul>
            </div>
            <div class="innerAll spacing-x2">
                <?php echo $plugin->ShowMsg(); ?>
                <!-- Widget -->

                <!-- Widget -->
                <div class="widget widget-inverse" >

                    <!-- Widget heading -->
                    <div class="widget-head">
                        <h4 class="heading">Create New Service Point Report</h4>
                    </div>
                    <!-- // Widget heading END -->

                    <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                                <label  for="inputEmail3" class="col-sm-2 control-label"> tracking_no </label>

                                <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='tracking_no' placeholder='tracking_no' class='form-control' />
                                </div>
                            </div>


                            <input type="hidden" id='form-field-1' name='employee_id' value="<?= $input_by ?>" />


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit"   onclick="javascript:return confirm('Do You Want Create/save These Record?')"  name="create" class="btn btn-info">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>

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

    <?php echo $plugin->TableJs(); ?> </body>
</html>