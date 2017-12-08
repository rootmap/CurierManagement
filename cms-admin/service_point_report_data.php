<?php $table = "service_point_report"; ?><?php
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
            <h1 class="content-heading bg-white border-bottom">Service Point Report Data</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li><a href="service_point_report.php">Create New Service Point Report</a></li>
                    <li class="active"><a href="#">Service Point Report Data List</a></li>
                </ul>
            </div>
            <div class="innerAll spacing-x2">
                <div class="col-sm-12" id="service_point_report_57"></div>
            </div>
        </div>
        <!-- // Service Point Report END -->

        <div class="clearfix"></div>
        <!-- // Sidebar menu & Service Point Report wrapper END -->

        <?php include('include/footer.php'); ?>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->
    <script id="edit_invoice" type="text/x-kendo-template">
        <a class="k-button k-button-icontext k-grid-edit" href="quriar.php?view=#= tracking_no#"><span class="k-icon k-edit"></span>View</a>
        <a class="k-button k-button-icontext k-grid-edit" href="quriar_status.php?qst=#= tracking_no#"><span class="k-icon k-edit"></span>New Status</a>
    </script>     

    <script type="text/javascript">
        jQuery(document).ready(function () {
        <?php
        if (!isset($_GET['tracking_no'])) {
            $tracking_no = '';
        } else {
            $tracking_no = $_GET['tracking_no'] ? $_GET['tracking_no'] : '';
        }
        
        if (!empty($tracking_no)) {
            ?>
                        var postarray = {"tracking_no": '<?= $tracking_no ?>'};
        <?php } else {
            ?>
                        var postarray = {"tracking_no": 0};
        <?php }
        ?>

            var dataSource = new kendo.data.DataSource({
                pageSize: 5,
                transport: {
                    read: {
                        url: "./controller/service_point_report_controller.php",
                        type: "POST",
                        data:
                                {
                                    "acst": 1, //action status sending to json file
                                    "table": "service_point_report",
                                    "cond":<?= $tracking_no ? '2' : 0 ?>,
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
                            conditional_price: {type: "string"},
                            quriar_status: {type: "string"},
                            date: {type: "string"}
                        }
                    }
                }
            });



            jQuery("#service_point_report_57").kendoGrid({
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
                    {field: "conditional_price", title: "Conditional Price"},
                    {field: "quriar_status", title: "Quriar Status"},
                    {field: "date", title: "Record Added", width: "100px"},
                    {
                        title: "Edit",
                        width: "200px",
                        template: kendo.template($("#edit_invoice").html())
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