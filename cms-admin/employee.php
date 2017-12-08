<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "employee";
?>
<?php
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($name) && !empty($gender) && !empty($blood_group) && !empty($dob) && !empty($contact_number) && !empty($address) && !empty($user_name) && !empty($password) && !empty($division_id) && !empty($district_id) && !empty($branch_id)) {
        include('class/login.php');
        $login = new loginClass();
        if ($obj->exists_multiple($table, array("username" => $user_name)) == 0) {

            $dob = date('Y-m-d', strtotime($dob));

            $insert = array('name' => $name,
                'gender' => $gender,
                'blood_group' => $blood_group,
                'dob' => $dob,
                'contactnumber' => $contact_number,
                'address' => $address,
                'division_id' => $division_id,
                'district_id' => $district_id,
                'branch_id' => $branch_id,
                'username' => $user_name,
                'password' => $login->MakePassword($password),
                'date' => date('Y-m-d'),
                'status' => 1);


            if ($obj->insert($table, $insert) == 1) {
                $plugin->Success("Successfully Saved", $obj->filename());
            } else {
                $plugin->Error("Failed", $obj->filename());
            }
        } else {
            $plugin->Error("Failed, Already Exists.", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
} elseif (isset($_POST['update'])) {
    extract($_POST);

    
    
    include('class/login.php');
    $login = new loginClass();
    if (!empty($full_name) && !empty($gender) && !empty($blood_group) && !empty($dob) && !empty($contact_number) && !empty($address) && !empty($password) && !empty($division_id) && !empty($district_id) && !empty($branch_id)) {
        
        if ($obj->exists_multiple($table, array("id" => $id)) == 1) {


            
            
            $dob = date('Y-m-d', strtotime($dob));

            if ($password != $expassword) {
                $npass = $login->MakePassword($password);
            } else {
                $npass = $expassword;
            }

            $updatearray = array("id" => $id);
            $upd2 = array('name' => $full_name,
                'gender' => $gender,
                'blood_group' => $blood_group,
                'dob' => $dob,
                'contactnumber' => $contact_number,
                'address' => $address,
                'division_id' => $division_id,
                'district_id' => $district_id,
                'branch_id' => $branch_id,
                'password' => $npass,
                'date' => date('Y-m-d'),
                'status' => 1);
            $update_merge_array = array_merge($updatearray, $upd2);


            if ($obj->update($table, $update_merge_array) == 1) {
                $plugin->Success("Successfully Updated", $obj->filename());
            } else {
                $plugin->Error("Failed", $obj->filename());
            }
        }
    }
    else
    {
        $plugin->Error("Failed, Some Field is empty.", $obj->filename());
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
        echo $plugin->softwareTitle();
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
            <h1 class="content-heading bg-white border-bottom">User Data</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New User Data</a></li>
                    <li><a href="employee_list.php">User Data List</a></li>
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
                            <h4 class="heading">Update/Change - User Data</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body">
                            <form  class="form-horizontal" method="post" action="" role="form">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Full Name </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='full_name' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "name"); ?>' placeholder='Full Name' class='form-control' />
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Gender </label>

                                    <div class='col-sm-9'>

                                        <select name='gender' class='form-control' >
                                            <option value="0">Please Select</option>
                                            <option <?php if ($obj->SelectAllByVal($table, "id", $_GET['edit'], "gender") == 1) { ?> selected="selected" <?php } ?> value="1">Male</option>
                                            <option <?php if ($obj->SelectAllByVal($table, "id", $_GET['edit'], "gender") == 2) { ?> selected="selected" <?php } ?> value="2">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Blood Group  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='blood_group' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `blood_group`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option <?php if ($obj->SelectAllByVal($table, "id", $_GET['edit'], "blood_group") == $quriar_receive_type_id->id) { ?> selected="selected" <?php } ?> value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> DOB </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='datePicker' name='dob' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "dob"); ?>' placeholder='DOB' class='form-control' />
                                    </div>
                                    <script>
                                            $(document).ready(function () {
                                        $("#datePicker").kendoDatePicker();
                                        });
                                    </script>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Contact Number </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='contact_number' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "contactnumber"); ?>' placeholder='Contact Number' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Address </label>

                                    <div class='col-sm-9'>
                                        <textarea id='form-field-1' name='address' placeholder='Address' class='form-control'><?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "address"); ?></textarea>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> User Name </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='user_name' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "username"); ?>' placeholder='User Name' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Password </label>

                                    <div class='col-sm-9'>
                                        <input type='password' id='form-field-1' name='password' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "password"); ?>' placeholder='Password' class='form-control' />
                                        <input type='hidden' id='form-field-1' name='expassword' value='<?php echo $obj->SelectAllByVal($table, "id", $_GET['edit'], "password"); ?>' placeholder='Password' class='form-control' />

                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Division/State  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='division_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `division_or_state`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option  <?php if ($obj->SelectAllByVal($table, "id", $_GET['edit'], "division_id") == $quriar_receive_type_id->id) { ?> selected="selected" <?php } ?>  value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> District  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='district_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $ex_district_id = $obj->SelectAllByVal($table, "id", $_GET['edit'], "district_id");
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `district`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option  <?php if ($ex_district_id == $quriar_receive_type_id->id) { ?> selected="selected" <?php } ?>  value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Branch  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='branch_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $ex_branch_id = $obj->SelectAllByVal($table, "id", $_GET['edit'], "branch_id");
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,branch_name FROM `branch`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option  <?php if ($ex_branch_id == $quriar_receive_type_id->id) { ?> selected="selected" <?php } ?>  value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->branch_name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
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
                            <h4 class="heading">Create New User Data</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Full Name </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='name' placeholder='Full Name' class='form-control' />
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Gender </label>

                                    <div class='col-sm-9'>

                                        <select name='gender' class='form-control' >
                                            <option value="0">Please Select</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Blood Group  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='blood_group' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php
                                            $sqlquriar_receive_type_id = $obj->FlyQuery('SELECT id,name FROM `blood_group`');
                                            if (!empty($sqlquriar_receive_type_id)) {
                                                foreach ($sqlquriar_receive_type_id as $quriar_receive_type_id):
                                                    ?>
                                                    <option  value='<?= $quriar_receive_type_id->id ?>'><?= $quriar_receive_type_id->name ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> DOB </label>

                                    <div class='col-sm-9' style="margin-left: -10px; ">
                                        <input type='text' id='datePicker' name='dob' placeholder='DOB' class='form-control' />
                                    </div>
                                    <script>
                                            $(document).ready(function () {
                                        $("#datePicker").kendoDatePicker();
                                        });
                                    </script>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Contact Number </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='contact_number' placeholder='Contact Number' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Address </label>

                                    <div class='col-sm-9'>
                                        <textarea id='form-field-1' name='address' placeholder='Address' class='form-control'></textarea>
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> User Name </label>

                                    <div class='col-sm-9'>
                                        <input type='text' id='form-field-1' name='user_name' placeholder='User Name' class='form-control' />
                                    </div>
                                </div><div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Password </label>

                                    <div class='col-sm-9'>
                                        <input type='password' id='form-field-1' name='password' placeholder='Password' class='form-control' />
                                    </div>
                                </div>


                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send Division/State  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='division_id' class='form-control'>
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

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send District  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='district_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label  for="inputEmail3" class="col-sm-2 control-label"> Send Branch  </label>

                                    <div class='col-sm-7'>
                                        <select id='form-field-1' name='branch_id' class='form-control'>
                                            <option value='0'>Please Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
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
    echo $plugin->KendoJs();
    ?>

    <script>
            $(document).ready(function () {
                $("select[name=division_id]").change(function () {

                var division_id = $(this).val();
                    $.post("./controller/district.php", {'division_id': division_id}, function (data) {
                    var htmlString = '<option value="0">Please Select</option>';
                        $.each(data, function (i, item) {
                        console.log(item.name);
                    htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                    });

                $("select[name=district_id]").html(htmlString);

            });

            });

                $("select[name=district_id]").change(function () {
                var division_id = $("select[name=division_id]").val();
                var district_id = $(this).val();
                    $.post("./controller/branch.php", {'division_id': division_id, 'district_id': district_id}, function (data) {
                    var htmlString = '<option value="0">Please Select</option>';
                        $.each(data, function (i, item) {
                        console.log(item.name);
                    htmlString += '<option value="' + item.id + '">' + item.branch_name + '</option>';
                    });

                $("select[name=branch_id]").html(htmlString);

            });
        });
    });
    </script>


</body>
</html>