<?php
$table="quriar_status"; ?><?php 
include('class/auth.php');
include('plugin/plugin.php');
$plugin=new cmsPlugin(); 
?>
<!doctype html>
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
        	<h1 class="content-heading bg-white border-bottom">Quriar Status Data</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li><a href="quriar_status.php">Create New Quriar Status</a></li>
                    <li class="active"><a href="#">Quriar Status Data List</a></li>
                </ul>
            </div>
          <div class="innerAll spacing-x2">
                <div class="col-sm-12" id="quriar_status_44"></div>
            </div>
        </div>
        <!-- // Quriar Status END -->

        <div class="clearfix"></div>
        <!-- // Sidebar menu & Quriar Status wrapper END -->
        
        <?php include('include/footer.php'); ?>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->
    <script id="edit_quriar_status" type="text/x-kendo-template">
             <a class="k-button k-button-icontext k-grid-edit" href="quriar_status.php?edit=#= id#"><span class="k-icon k-edit"></span>Edit</a>
            </script>
    <script id="delete_quriar_status" type="text/x-kendo-template">
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
            </script>        
    <script type="text/javascript">
                function deleteClick(quriar_status_id) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "./controller/quriar_status_controller.php",
                            data: {id: quriar_status_id,table:"quriar_status",acst:3},
                            success: function (result) {
							if(result==1)
							{
								location.reload();
							}
							else
							{
								$(".k-i-refresh").click();
							}
                            }
                        });
                    }
                }

            </script>
            <script type="text/javascript">
                jQuery(document).ready(function () {
					var postarray={"id":1};
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "./controller/quriar_status_controller.php",
                                type: "POST",
								data:
								{
									"acst":1, //action status sending to json file
									"table":"quriar_status",
									"cond":0,
									"multi":postarray
									
								}
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "id",
                                fields: {
                                    id: {nullable: true},tracking_no: {type: "string"},quriar_status: {type: "string"},
									date: {type: "string"}
                                }
                            }
                        }
                    });
                    jQuery("#quriar_status_44").kendoGrid({
                        dataSource: dataSource,
                        filterable: true,
                        pageable: {
                            refresh: true,
                            input: true,
                            numeric: false,
                            pageSizes: true,
                            pageSizes: [5, 10, 20, 50],
                        },
                        sortable: true,
                        groupable: true,
                        columns: [{field: "id", title: "#"},{field: "tracking_no", title: "Tracking No"},{field: "quriar_status", title: "Quriar Status"},
							{field: "date", title: "Record Added", width: "150px"},
							{
                                title: "Edit",
                                template: kendo.template($("#edit_quriar_status").html())
                            },
							{
                                title: "Delete",
                                template: kendo.template($("#delete_quriar_status").html())
                            }
                        ]
                    });
                });

            </script>    
    <?php 
	echo $plugin->TableJs(); 
	echo $plugin->KendoJS(); 
	?>
    
</body>
</html>