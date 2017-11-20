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

                    <?php
                    $sqlmenu_custom = $obj->FlyQuery("SELECT 
                                            upam.id,
                                            upam.page_name, 
                                            upam.page_link_file_name 
                                            FROM user_access_role as uar
                                            LEFT JOIN user_page_access_mapping as upam ON uar.user_type_id=upam.user_type_id 
                                            WHERE uar.user_id='".$formula_id."'");
                    if (!empty($sqlmenu_custom))
                        foreach ($sqlmenu_custom as $custom):
                            ?>

                            <div class="col-md-3 col-sm-6">
                                <div class="panel-3d">
                                    <div class="front">

                                        <div class="widget text-center">
                                            <div class="widget-body padding-none">
                                                <div>
                                                    <div class="innerAll bg-info innerAll">
                                                        <p class="lead text-white strong margin-none"><i class="icon-user-1"></i></p>
                                                    </div>
                                                    <div class="innerAll">
                                                        <a href="<?php echo $custom->page_link_file_name; ?>"><b style="color: brown;"> View <?php echo $custom->page_name; ?> </b></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <?php
                        endforeach;
                    ?>





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

    </body>
</html>