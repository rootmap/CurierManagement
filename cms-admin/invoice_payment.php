<?php 
		include("class/auth.php");
		include("plugin/plugin.php");
		$plugin=new cmsPlugin();
		$table="invoice_payment"; ?>
		<?php 
		if(isset($_POST['create'])){
			extract($_POST);
			if(!empty($tracking_no) && !empty($status))
			{  $insert=array('tracking_no'=>$tracking_no,'status'=>$status,'date'=>date('Y-m-d'));
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
			extract($_POST);if(!empty($tracking_no) && !empty($status))
			{
                $updatearray=array("id"=>$id);
                $upd2=array('tracking_no'=>$tracking_no,'status'=>$status,'date'=>date('Y-m-d'));
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
    echo $plugin->softwareTitle("Invoice Payment");
    echo $plugin->TableCss();  ?></head>
    <body class="">
		<?php include('include/topnav.php'); include('include/mainnav.php'); ?>
        




        <div id="content">
        	<h1 class="content-heading bg-white border-bottom">Invoice Payment</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Invoice Payment</a></li>
                    <li><a href="invoice_payment_data.php">Invoice Payment List</a></li>
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
                                <h4 class="heading">Update/Change - Invoice Payment</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
								<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='tracking_no' class='form-control'><option value='0'>Please Select</option><?php 
                        $ex_tracking_no_data=$obj->SelectAllByVal($table,'id',$_GET['edit'],'tracking_no');
                        $sqltracking_no=$obj->FlyQuery('SELECT tracking_no,id FROM `invoice`');
                        if(!empty($sqltracking_no))
                        {
                            foreach ($sqltracking_no as $tracking_no): ?><option <?php if($tracking_no->tracking_no==$ex_tracking_no_data){ ?> selected='selected' <?php } ?> value='<?=$tracking_no->tracking_no?>'><?=$tracking_no->tracking_no?></option><?php endforeach; ?><?php } ?></select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Status </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='status' class='form-control'><option value='0'>Please Select</option><?php   
                        $ex_status=$obj->SelectAllByVal($table,'id',$_GET['edit'],'status');
                        $SSarrstatus='Unpaid,Paid';
                        $sqlstatus=explode(',',$SSarrstatus);
                        if(!empty($sqlstatus))
                        {
                            foreach ($sqlstatus as $status): ?><option <?php if($ex_status==$status){ ?> selected='selected' <?php } ?> value='<?=$status?>'><?=$status?></option><?php endforeach; ?><?php } ?></select>
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
                                <h4 class="heading">Create New Invoice Payment</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body">
                            <form  class="form-horizontal" method="post" action="" role="form">
                            <?php 
                            if(isset($_GET['qst']))
                            {
                                $qst=$_GET['qst'];
                            ?>
                            <div class='form-group'>
                                <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                                <div class='col-sm-9'>
                                        <select id='form-field-1' name='tracking_no' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php 
                                            $sqltracking_no=$obj->FlyQuery('SELECT tracking_no,id FROM `invoice`');
                                            if(!empty($sqltracking_no))
                                            {
                                            foreach ($sqltracking_no as $tracking_no): 
                                            ?>
                                            <option 
                                            <?php 
                                            if($qst==$tracking_no->tracking_no)
                                            {
                                                ?>
                                                 selected="selected" 
                                                <?php
                                            }
                                            ?>
                                             value='<?=$tracking_no->tracking_no?>'><?=$tracking_no->tracking_no?></option>
                                            <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label  for="inputEmail3" class="col-sm-2 control-label"> Status </label>

                                <div class='col-sm-9'>
                                <select id='form-field-1' name='status' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php   
                                            $SSarrstatus='Unpaid,Paid';
                                            $sqlstatus=explode(',',$SSarrstatus);
                                            if(!empty($sqlstatus))
                                            {
                                                $exstatus=$obj->SelectAllByVal("invoice_payment","tracking_no",$qst,"status");
                                                foreach ($sqlstatus as $status): 
                                                    ?>
                                                    <option 
                                                    <?php if($status==$exstatus){ ?>
                                                        selected="selected"    
                                                    <?php } ?>
                                                     value='<?=$status?>'><?=$status?></option>
                                                    <?php 
                                                endforeach; ?>
                                            <?php 
                                            } 
                                            ?>
                                </select>
                                </div>
                            </div>
                            <?php
                            }
                            else
                            {
                            ?>    
                            <div class='form-group'>
                                <label  for="inputEmail3" class="col-sm-2 control-label"> Tracking No </label>

                                <div class='col-sm-9'>
                                        <select id='form-field-1' name='tracking_no' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php 
                                            $sqltracking_no=$obj->FlyQuery('SELECT tracking_no,id FROM `invoice`');
                                            if(!empty($sqltracking_no))
                                            {
                                            foreach ($sqltracking_no as $tracking_no): 
                                            ?>
                                            <option value='<?=$tracking_no->tracking_no?>'><?=$tracking_no->tracking_no?></option>
                                            <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label  for="inputEmail3" class="col-sm-2 control-label"> Status </label>

                                <div class='col-sm-9'>
                                <select id='form-field-1' name='status' class='form-control'>
                                            <option value='0'>Please Select</option>
                                            <?php   
                                            $SSarrstatus='Unpaid,Paid';
                                            $sqlstatus=explode(',',$SSarrstatus);
                                            if(!empty($sqlstatus))
                                            {
                                                foreach ($sqlstatus as $status): 
                                                    ?>
                                                    <option value='<?=$status?>'><?=$status?></option>
                                                    <?php 
                                                endforeach; ?>
                                            <?php 
                                            } 
                                            ?>
                                </select>
                                </div>
                            </div>
                            <?php 
                            }
                            ?>
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
    
    <?php echo $plugin->TableJs();  ?> </body>
</html>