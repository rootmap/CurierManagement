<?php 
		include("class/auth.php");
		include("plugin/plugin.php");
		$plugin=new cmsPlugin();
		$table="branch"; ?>
		<?php 
		if(isset($_POST['create'])){
			extract($_POST);
			if(!empty($division_id) && !empty($district_id) && !empty($branch_name) && !empty($location) && !empty($contact_no) && !empty($contact_person))
			{  $insert=array('division_id'=>$division_id,'district_id'=>$district_id,'branch_name'=>$branch_name,'location'=>$location,'contact_no'=>$contact_no,'contact_person'=>$contact_person,'date'=>date('Y-m-d'),'status'=>1);
				if($obj->insert($table,$insert)==1)
				{
					$plugin->Success("Successfully Saved",$obj->filename());
				}
				else 
				{
					$plugin->Error("Failed",$obj->filename());
				}
			}
			else 
			{
				$plugin->Error("Fields is Empty",$obj->filename());
			}   
		}
		elseif(isset($_POST['update'])) 
		{
			extract($_POST);if(!empty($division_id) && !empty($district_id) && !empty($branch_name) && !empty($location) && !empty($contact_no) && !empty($contact_person))
			{$updatearray=array("id"=>$id);$upd2=array('division_id'=>$division_id,'district_id'=>$district_id,'branch_name'=>$branch_name,'location'=>$location,'contact_no'=>$contact_no,'contact_person'=>$contact_person,'date'=>date('Y-m-d'),'status'=>1);
						$update_merge_array=array_merge($updatearray,$upd2);
						if($obj->update($table,$update_merge_array)==1)
						{ 
							$plugin->Success("Successfully Updated",$obj->filename());
						} 
						else 
						{ 
							$plugin->Error("Failed",$obj->filename()); 
						}}}
		elseif(isset($_GET['del'])=="delete") 
		{
			$delarray=array("id"=>$_GET['id']);if($obj->delete($table,$delarray)==1)
			{ 
				$plugin->Success("Successfully Delete",$obj->filename());  
			} 
			else 
			{ 
				$plugin->Error("Failed",$obj->filename()); 
			}
		}
		?><!doctype html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head><?php  
    echo $plugin->softwareTitle("Branch");
    echo $plugin->TableCss();  ?></head>
    <body class="">
		<?php include('include/topnav.php'); include('include/mainnav.php'); ?>
        




        <div id="content">
        	<h1 class="content-heading bg-white border-bottom">Branch</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Branch</a></li>
                    <li><a href="branch_data.php">Branch List</a></li>
                </ul>
            </div>
          <div class="innerAll spacing-x2">
				<?php echo $plugin->ShowMsg(); ?>
                <!-- Widget -->

                        <!-- Widget -->
                        <div class="widget widget-inverse" >
							<?php 
							if(isset($_GET['edit']))
							{
							?>
                            <!-- Widget heading -->
                            <div class="widget-head">
                                <h4 class="heading">Update/Change - Branch</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
								<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Division  </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='division_id' class='form-control'><option value='0'>Please Select</option><?php 
                        $ex_division_id_data=$obj->SelectAllByVal($table,'id',$_GET['edit'],'division_id');
                        $sqldivision_id=$obj->FlyQuery('SELECT id,name FROM `division_or_state`');
                        if(!empty($sqldivision_id))
                        {
                            foreach ($sqldivision_id as $division_id): ?><option <?php if($division_id->id==$ex_division_id_data){ ?> selected='selected' <?php } ?> value='<?=$division_id->id?>'><?=$division_id->name?></option><?php endforeach; ?><?php } ?></select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> District  </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='district_id' class='form-control'>
                                        <option value='0'>Please Select</option>
                                        <?php 
                                        $ex_district_id_data=$obj->SelectAllByVal($table,'id',$_GET['edit'],'district_id');
                                        $sqldistrict_id=$obj->FlyQuery("SELECT id,name FROM `district` WHERE division_id='".$ex_division_id_data."'");
                                        if(!empty($sqldistrict_id))
                                        {
                                            foreach ($sqldistrict_id as $district_id): ?>
                                            <option <?php if($district_id->id==$ex_district_id_data){ ?> selected='selected' <?php } ?> value='<?=$district_id->id?>'><?=$district_id->name?></option>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Branch Name </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='branch_name' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"branch_name"); ?>' placeholder='Branch Name' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Location </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='location' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"location"); ?>' placeholder='Location' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Contact No </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='contact_no' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"contact_no"); ?>' placeholder='Contact No' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Contact Person </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='contact_person' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"contact_person"); ?>' placeholder='Contact Person' class='form-control' />
                            </div>
                    </div><div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button  onclick="javascript:return confirm('Do You Want change/update These Record?')"  type="submit" name="update" class="btn btn-primary">Save Change</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
							<?php }else{ ?>
                            <!-- Widget heading -->
                            <div class="widget-head">
                                <h4 class="heading">Create New Branch</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Division </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='division_id' class='form-control'>
                                        <option value='0'>Please Select</option>
                                        <?php $sqldivision_id=$obj->FlyQuery('SELECT id,name FROM `division_or_state`');
                                                if(!empty($sqldivision_id))
                                                {
                                                    foreach ($sqldivision_id as $division_id): ?>
                                        <option value='<?=$division_id->id?>'><?=$division_id->name?></option>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> District </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='district_id' class='form-control'>
                                        <option value='0'>Please Select</option>
                                        
                                    </select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Branch Name </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='branch_name' placeholder='Branch Name' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Location </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='location' placeholder='Location' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Contact No </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='contact_no' placeholder='Contact No' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Contact Person </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='contact_person' placeholder='Contact Person' class='form-control' />
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

            });
        </script>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->
    
    <?php echo $plugin->TableJs();  ?> </body>
</html>