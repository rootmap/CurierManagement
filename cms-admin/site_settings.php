<?php 
		include("class/auth.php");
		include("plugin/plugin.php");
		$plugin=new cmsPlugin();
		$table="site_settings"; ?>
		<?php 
		if(isset($_POST['create'])){
			extract($_POST);
			if(!empty($site_name) && !empty($site_title) && !empty($contact_number) && !empty($facebook) && !empty($twitter) && !empty($google_plus) && !empty($_FILES['site_logo']['name']))
			{  include('class/uploadImage_Class.php'); $imgclassget=new image_class();  
                                          $site_logo=$imgclassget->upload_fiximage("upload","site_logo","site_logo_upload_".$table_name."_".time());  $insert=array('site_name'=>$site_name,'site_title'=>$site_title,'contact_number'=>$contact_number,'facebook'=>$facebook,'twitter'=>$twitter,'google_plus'=>$google_plus,'site_logo'=>$site_logo,'date'=>date('Y-m-d'),'status'=>1);
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
			extract($_POST);if(!empty($site_name) && !empty($site_title) && !empty($contact_number) && !empty($facebook) && !empty($twitter) && !empty($google_plus))
			{$updatearray=array("id"=>$id); include('class/uploadImage_Class.php'); $imgclassget=new image_class(); 
                                                    if(!empty($_FILES['site_logo']['name']))
                                                    { 
                                                            $site_logo_1=$imgclassget->upload_fiximage("upload","site_logo","site_logo_upload_".$table_name."_".time()); 
                                                            $site_logo=$site_logo_1; 
                                                            @unlink("upload/".$ex_site_logo);      
                                                    }
                                                    else
                                                    { 
                                                            $site_logo=$ex_site_logo; 
                                                    }$upd2=array('site_name'=>$site_name,'site_title'=>$site_title,'contact_number'=>$contact_number,'facebook'=>$facebook,'twitter'=>$twitter,'google_plus'=>$google_plus,'site_logo'=>$site_logo,'date'=>date('Y-m-d'),'status'=>1);
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
			$delarray=array("id"=>$_GET['id']);$photolink=$obj->SelectAllByVal($table,'id',$_GET['id'],'site_logo'); @unlink("upload/".$photolink);if($obj->delete($table,$delarray)==1)
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
    echo $plugin->softwareTitle("Site Settings");
    echo $plugin->TableCss();  echo $plugin->FileUploadCss();  ?></head>
    <body class="">
		<?php include('include/topnav.php'); include('include/mainnav.php'); ?>
        




        <div id="content">
        	<h1 class="content-heading bg-white border-bottom">Site Settings</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Site Settings</a></li>
                    <li><a href="site_settings_data.php">Site Settings List</a></li>
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
                                <h4 class="heading">Update/Change - Site Settings</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form enctype='multipart/form-data' class="form-horizontal" method="post" action="" role="form">
								<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Site Name </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='site_name' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"site_name"); ?>' placeholder='Site Name' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Site Title </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='site_title' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"site_title"); ?>' placeholder='Site Title' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Contact Number </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='contact_number' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"contact_number"); ?>' placeholder='Contact Number' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Facebook </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='facebook' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"facebook"); ?>' placeholder='Facebook' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Twitter </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='twitter' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"twitter"); ?>' placeholder='Twitter' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Google Plus </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='google_plus' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"google_plus"); ?>' placeholder='Google Plus' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Site Logo </label>

                            <div class='col-sm-3'>
                                    <?php 
                    $ex_site_logo_data=$obj->SelectAllByVal($table, "id", $_GET['edit'], "site_logo");
                    echo $plugin->FileUploadBox(1,$ex_site_logo_data,'site_logo');
                    ?>
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
                                <h4 class="heading">Create New Site Settings</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form enctype='multipart/form-data' class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Site Name </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='site_name' placeholder='Site Name' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Site Title </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='site_title' placeholder='Site Title' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Contact Number </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='contact_number' placeholder='Contact Number' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Facebook </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='facebook' placeholder='Facebook' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Twitter </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='twitter' placeholder='Twitter' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Google Plus </label>

                            <div class='col-sm-9'>
                                    <input type='text' id='form-field-1' name='google_plus' placeholder='Google Plus' class='form-control' />
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Site Logo </label>

                            <div class='col-sm-3'>
                                    <?php 
                    echo $plugin->FileUploadBox(0,'','site_logo');
                    ?>
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
    
    <?php echo $plugin->TableJs();  echo $plugin->FileUploadJS();  ?> <script type='text/javascript'>
				jQuery(function($) {
					$('#id-input-file-1').ace_file_input({
                                            no_file:'No File ...',
                                            btn_choose:'Choose',
                                            btn_change:'Change',
                                            droppable:true,
                                            onchange:null,
                                            thumbnail:true
					});
	
				})
			</script></body>
</html>