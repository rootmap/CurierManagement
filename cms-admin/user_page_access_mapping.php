<?php
include("class/auth.php");
include("plugin/plugin.php");
$plugin = new cmsPlugin();
$table = "user_page_access_mapping";
?>
<?php
if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($user_type_id)) {
        $record=0;
        $obj->delete($table,array('user_type_id' => $user_type_id));
        
//        echo "<pre>";
//        print_r($_POST);
        
        foreach($_POST['page_name'] as $pg):
            $exGP= explode("||",$pg);
            $insert = array('user_type_id' => $user_type_id, 
                'page_name' => $exGP[0], 
                'page_link_file_name' => $exGP[1], 
                'date' => date('Y-m-d'), 
                'status' => 1);
            
//            echo "<pre>";
//            print_r($insert);
            
        
            if ($obj->insert($table, $insert) == 1) {
                $record++;
            }
        endforeach;
        //exit();
        if($record==0)
        {
            $plugin->Error("Failed, Please try again.", $obj->filename());
        }
        else
        {
            $plugin->Success("Successfully added to role.", $obj->filename());
        }
        
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
} elseif (isset($_POST['update'])) {
    extract($_POST);
    if (!empty($user_type_id) && !empty($page_name) && !empty($page_link_file_name)) {
        $updatearray = array("id" => $id);
        $upd2 = array('user_type_id' => $user_type_id, 'page_name' => $page_name, 'page_link_file_name' => $page_link_file_name, 'date' => date('Y-m-d'), 'status' => 1);
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
        echo $plugin->softwareTitle("User Page Access Mapping");
        echo $plugin->TableCss();
        ?></head>
    <body class="">
        <?php
        include('include/topnav.php');
        include('include/mainnav.php');
        ?>





        <div id="content">
            <h1 class="content-heading bg-white border-bottom">User Page Access Mapping</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New User Page Access Mapping</a></li>
                    <li><a href="user_page_access_mapping_data.php">User Page Access Mapping List</a></li>
                </ul>
            </div>
            <div class="innerAll spacing-x2">
                <?php echo $plugin->ShowMsg(); ?>
                <!-- Widget -->

                <!-- Widget -->
                <div class="widget widget-inverse" >

                    <!-- Widget heading -->
                    <div class="widget-head">
                        <h4 class="heading">Create New User Page Access Mapping</h4>
                    </div>
                    <!-- // Widget heading END -->

                    <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                                <label  for="inputEmail3" class="col-sm-2 control-label"> User Type ID </label>

                                <div class='col-sm-9'>
                                    <select id='form-field-1' name='user_type_id' class='form-control'>
                                        <option value='0'>Please Select</option>
                                        <?php
                                        $sqluser_type_id = $obj->FlyQuery('SELECT id,name FROM `user_type`');
                                        if (!empty($sqluser_type_id)) {
                                            foreach ($sqluser_type_id as $user_type_id):
                                                ?>
                                                <option value='<?= $user_type_id->id ?>'><?= $user_type_id->name ?></option>
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class='form-group'>
                                <table border="1" width="90%" align="center" class="table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll" /></th>
                                            <th>Page Name</th>
                                            <th>Page Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlPagesInRole = $obj->FlyQuery("SELECT * FROM page_info");
                                        if (!empty($sqlPagesInRole)) {
                                            foreach ($sqlPagesInRole as $page):
                                            $jsonMk= "New ".$page->menu_name."||".$page->name.".php";    
                                            $jsonMkL=$page->menu_name." List"."||".$page->name."_data.php";    
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="page_name[]" value="<?=$jsonMk?>" />
                                                </td>
                                                <td>New <?=$page->menu_name?></td>
                                                <td><?=$page->name?>.php</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="page_name[]" value="<?=$jsonMkL?>" />
                                                </td>
                                                <td><?=$page->menu_name?> List</td>
                                                <td><?=$page->name?>_data.php</td>
                                            </tr>
                                            <?php
                                            
                                            endforeach;
                                        }
                                        ?>
                                        </body>
                                </table>
                            </div>
                            
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
<script>
    $(document).ready(function(){
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>    
</html>