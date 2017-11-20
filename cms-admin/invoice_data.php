<?php $table = "invoice"; ?><?php
include('class/auth.php');
include('plugin/plugin.php');
$plugin = new cmsPlugin();
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
            <h1 class="content-heading bg-white border-bottom">Invoice Data</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li><a href="invoice.php">Create New Invoice</a></li>
                    <li class="active"><a href="#">Invoice Data List</a></li>
                </ul>
            </div>
            <div class="innerAll spacing-x2">
                <div class="col-sm-12" id="invoice_41"></div>
            </div>
        </div>
        <!-- // Invoice END -->

        <div class="clearfix"></div>
        <!-- // Sidebar menu & Invoice wrapper END -->

        <?php include('include/footer.php'); ?>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->
    <script id="edit_invoice" type="text/x-kendo-template">
        <a class="k-button k-button-icontext k-grid-edit" href="invoice.php?edit=#= id#"><span class="k-icon k-edit"></span>Edit</a>
        <a class="k-button k-button-icontext k-grid-edit" href="quriar.php?view=#= tracking_no#"><span class="k-icon k-edit"></span>View</a>
        <a class="k-button k-button-icontext k-grid-edit" href="quriar_status.php?qst=#= tracking_no#"><span class="k-icon k-edit"></span>New Status</a>
    </script>
    <script id="delete_invoice" type="text/x-kendo-template">
        <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
    </script>        
    <script type="text/javascript">
        function deleteClick(invoice_id) {
            var c = confirm("Do you want to delete?");
            if (c === true) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "./controller/invoice_controller.php",
                    data: {id: invoice_id, table: "invoice", acst: 3},
                    success: function (result) {
                        if (result == 1)
                        {
                            location.reload();
                        } else
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
            var postarray = {"id": 1};
            var dataSource = new kendo.data.DataSource({
                pageSize: 5,
                transport: {
                    read: {
                        url: "./controller/invoice_controller.php",
                        type: "POST",
                        data:
                                {
                                    "acst": 1, //action status sending to json file
                                    "table": "invoice",
                                    "cond": 0,
                                    "multi": postarray

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
                            id: {nullable: true}, 
                            tracking_no: {type: "string"}, 
                            receive_from: {type: "string"}, 
                            send_from: {type: "string"}, 
                            price: {type: "string"}, 
                            quriar_status: {type: "string"}, 
                            date: {type: "string"}
                        }
                    }
                }
            });
            jQuery("#invoice_41").kendoGrid({
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
                columns: [
                    {field: "id", title: "#"}, 
                    {field: "tracking_no", title: "Tracking No"}, 
                    {field: "price", title: "Price"}, 
                    {field: "quriar_status", title: "Quriar Status"},
                    {field: "date", title: "Record Added", width: "100px"},
                    {
                        title: "Edit",
                        width: "200px",
                        template: kendo.template($("#edit_invoice").html())
                    },
                    {
                        title: "Delete",
                        template: kendo.template($("#delete_invoice").html())
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