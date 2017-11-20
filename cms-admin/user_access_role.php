<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "user_access_role";
?>
<?php
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($user_type_id) && !empty($user_id)) {
        $insert = array('user_type_id' => $user_type_id, 'user_id' => $user_id, 'date' => date('Y-m-d'), 'status' => 1);
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
    if (!empty($user_type_id) && !empty($user_id)) {
        $updatearray = array("id" => $id);
        $upd2 = array('user_type_id' => $user_type_id, 'user_id' => $user_id, 'date' => date('Y-m-d'), 'status' => 1);
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
        echo $plugin->softwareTitle("User Access Role");
        echo $plugin->TableCss();
        ?></head>
    <body class="">
        <?php
        include('include/topnav.php');
        include('include/mainnav.php');
        ?>





        <div id="content">
            <h1 class="content-heading bg-white border-bottom">User Access Role</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New User Access Role</a></li>
                    <li><a href="user_access_role_data.php">User Access Role List</a></li>
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
                            <h4 class="heading">Update/Change - User Access Role</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> User Type ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='user_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $ex_user_type_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'user_type_id');
                                            $sqluser_type_id = $obj->FlyQuery('SELECT id,name FROM `user_type`');
                                            if (!empty($sqluser_type_id)) {
                                                foreach ($sqluser_type_id as $user_type_id):
                                                    ?>
                                                    <option <?php if ($user_type_id->id == $ex_user_type_id_data) { ?> selected='selected' <?php } ?> value='<?= $user_type_id->id ?>'><?= $user_type_id->name ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> User ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='user_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $ex_user_id_data = $obj->SelectAllByVal($table, 'id', $_GET['edit'], 'user_id');
                                            $sqluser_id = $obj->FlyQuery('SELECT id,name FROM `employee`');
                                            if (!empty($sqluser_id)) {
                                                foreach ($sqluser_id as $user_id):
                                                    ?>
                                                    <option <?php if ($user_id->id == $ex_user_id_data) { ?> selected='selected' <?php } ?> value='<?= $user_id->id ?>'><?= $user_id->name ?></option>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
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
                            <h4 class="heading">Create New User Access Role</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> User Type ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='user_type_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $sqluser_type_id = $obj->FlyQuery('SELECT id,name FROM `user_type`');
                                            if (!empty($sqluser_type_id)) {
                                                foreach ($sqluser_type_id as $user_type_id):
                                                    ?><option value='<?= $user_type_id->id ?>'><?= $user_type_id->name ?></option><?php endforeach; ?><?php } ?></select>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> User ID </label>

                                    <div class='col-sm-9'>
                                        <select id='form-field-1' name='user_id' class='form-control'><option value='0'>Please Select</option><?php
                                            $sqluser_id = $obj->FlyQuery('SELECT id,name FROM `employee`');
                                            if (!empty($sqluser_id)) {
                                                foreach ($sqluser_id as $user_id):
                                                    ?><option value='<?= $user_id->id ?>'><?= $user_id->name ?></option><?php endforeach; ?><?php } ?></select>
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