<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "quriar_status";
$qst='';
if(isset($_GET['qst']))
{
    @$qst=$_GET['qst']?$_GET['qst']:'';
}
?>
<?php
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($quriar_status)) {
        $insert = array('tracking_no' => $tracking_no, 'quriar_status' => $quriar_status, 'date' => date('Y-m-d'), 'status' => 1);
        if ($obj->insert("quriar_status", $insert) == 1) {
            $plugin->Success("Successfully Saved", $obj->filename());
        } else {
            $plugin->Error("Failed", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
} elseif (isset($_POST['update'])) {
    extract($_POST);
    if (!empty($tracking_no) && !empty($quriar_status)) {
        $updatearray = array("id" => $id);
        $upd2 = array('tracking_no' => $tracking_no, 'quriar_status' => $quriar_status, 'date' => date('Y-m-d'), 'status' => 1);
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
echo $plugin->softwareTitle("Quriar Status");
echo $plugin->TableCss();
?></head>
    <body class="">
<?php include('include/topnav.php');
include('include/mainnav.php'); ?>





        <div id="content">
            <h1 class="content-heading bg-white border-bottom">Quriar Status</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Quriar Status</a></li>
                    <li><a href="quriar_status_data.php">Quriar Status List</a></li>
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
                            <h4 class="heading">Update/Change - Quriar Status</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='tracking_no' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "tracking_no"); ?>' placeholder='Tracking No' class='form-control' />
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
                            <h4 class="heading">Create New Quriar Status</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                                    <div class='col-sm-9'>
                                        <input type='text' value="<?=$qst?>" id='form-field-1' name='tracking_no' placeholder='Tracking No' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Quriar Status </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='quriar_status' class='form-control'><option value='0'>Please Select</option><?php
    $SSarrquriar_status = 'User Quriar Request Approved,Received At Service Point,Loaded For Transport,On The Way,Delivered At Service Centre,Ready For Delivery,Delivered';
    $sqlquriar_status = explode(',', $SSarrquriar_status);
    if (!empty($sqlquriar_status)) {
        foreach ($sqlquriar_status as $quriar_status):
            ?><option value='<?= $quriar_status ?>'><?= $quriar_status ?></option><?php endforeach; ?><?php } ?></select>
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

<?php echo $plugin->TableJs(); ?> </body>
</html>