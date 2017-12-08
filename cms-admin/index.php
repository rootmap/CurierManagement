<?php
include("class/auth.php");
include("plugin/plugin.php");
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
            <h1 class="content-heading bg-white border-bottom">Dashboard</h1>
            <!--                        <div class="innerAll bg-white border-bottom">
                                        <ul class="menubar">
                                            <li class="active"><a href="#">Create Info</a></li>
                                            <li><a href="#">Data List</a></li>
                                        </ul>
                                    </div>-->
            <div class="innerAll spacing-x2">
                <?php echo $plugin->ShowMsg(); ?>
                <!---------------------------- Start Here Box Design-------------------->
                <div class="row">
                    <style type="text/css">
                            tbody:empty:before {
                                content:'Data Not Found';
                                font-size: 19px; font-weight: bold;
                            }
                        </style>
                        <h3 class="content-heading">Today's Invoice</h3>
                    
                        <div class="col-sm-12" id="invoice_41"></div>
                        <div style="clear: both;"></div>
                        <h3 class="content-heading">This Month Invoice</h3>
                        <div class="col-sm-12" id="invoice_42"></div>
                         <div style="clear: both;"></div>
                        <h3 class="content-heading">This Year Invoice</h3>
                        <div class="col-sm-12" id="invoice_43"></div>
                </div>













            </div>
            <!------------------------------End Here Boxed design--------------------------->


            <!--start table-->

            <?php
            //include('include/topnav.php');
            //include('include/mainnav.php');
            ?>

            <!-- // Spare Parts END -->

            <!--                <div class="clearfix"></div>-->
            <!-- // Sidebar menu & Spare Parts wrapper END -->

            <?php include('include/footer.php'); ?>
            <!-- // Footer END -->

            <!-- // Main Container Fluid END -->
            <!-- Global -->



            <?php
            echo $plugin->TableJs();
            echo $plugin->KendoJS();
            ?>

            <!--end table-->
        </div>
        <!-- // Content END -->
        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->

        <!-- // Footer END -->
        <!-- // Main Container Fluid END -->
        <!-- Global -->
        <script id="edit_invoice" type="text/x-kendo-template">
            <a class="k-button k-button-icontext k-grid-edit" href="invoice.php?edit=#= id#"><span class="k-icon k-edit"></span>Edit</a>
            <a class="k-button k-button-icontext k-grid-edit" href="quriar.php?view=#= tracking_no#"><span class="k-icon k-edit"></span>View</a>
            <a class="k-button k-button-icontext k-grid-edit" href="quriar_status.php?qst=#= tracking_no#"><span class="k-icon k-edit"></span>New Status</a>
        </script>
               
        
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var postarray = {"id": 1};
                var dataSource = new kendo.data.DataSource({
                    pageSize: 5,
                    transport: {
                        read: {
                            url: "./ajax/todays_invoice.php",
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
                                conditional_price: {type: "string"},
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
                        messages: {
                            empty: "No data"
                        },
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
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var postarray = {"id": 1};
                var dataSource = new kendo.data.DataSource({
                    pageSize: 5,
                    transport: {
                        read: {
                            url: "./ajax/month_invoice.php",
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
                                conditional_price: {type: "string"},
                                quriar_status: {type: "string"},
                                date: {type: "string"}
                            }
                        }
                    }
                });
                jQuery("#invoice_42").kendoGrid({
                    dataSource: dataSource,
                    filterable: true,
                     pageable: {
                        refresh: true,
                        input: true,
                        numeric: false,
                        pageSizes: true,
                        pageSizes: [5, 10, 20, 50],
                        messages: {
                            empty: "No data"
                        },
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
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var postarray = {"id": 1};
                var dataSource = new kendo.data.DataSource({
                    pageSize: 5,
                    transport: {
                        read: {
                            url: "./ajax/year_invoice.php",
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
                                conditional_price: {type: "string"},
                                quriar_status: {type: "string"},
                                date: {type: "string"}
                            }
                        }
                    }
                });
                jQuery("#invoice_43").kendoGrid({
                    dataSource: dataSource,
                    filterable: true,
                     pageable: {
                        refresh: true,
                        input: true,
                        numeric: false,
                        pageSizes: true,
                        pageSizes: [5, 10, 20, 50],
                        messages: {
                            empty: "No data"
                        },
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
    </body>
</html>