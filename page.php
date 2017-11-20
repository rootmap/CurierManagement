<?php 
include './cms-admin/class/db_Class.php';
$obj=new db_class();

$siteSettings=$obj->FlyQuery("SELECT * FROM site_settings");


$PageDetail=$obj->FlyQuery("SELECT * FROM `other_pages` WHERE id='".$_GET['page']."'");

?>
<!DOCTYPE html>
<html lang="en" class="wide smoothscroll wow-animation">
    <head>
        <!-- Site Title -->
        <title><?=$PageDetail[0]->name?> Page</title>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="viewport"
              content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

        <!-- Stylesheets -->
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <link href='//fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">

        <!--[if lt IE 10]>
        <script src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- The Main Wrapper -->
        <div class="page">

            <!--For older internet explorer-->
            <div class="old-ie"
                 style='background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;'>
                <a href="https://windows.microsoft.com/en-US/internet-explorer/..">
                    <img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
                         alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
                </a>
            </div>
            <!--END block for older internet explorer-->

            <!--========================================================
                                                              HEADER
            =========================================================-->
            <header class="page-header">
                <!-- RD Navbar -->
                <div class="rd-navbar-wrap">
                    <nav class="rd-navbar" data-md-device-layout="rd-navbar-fixed" data-rd-navbar-lg="rd-navbar-static" data-lg-device-layout="rd-navbar-static">
                        <div class="rd-navbar-inner">
                            <!-- RD Navbar Panel -->
                            <?php
                            include './include/header_nav.php';
                            ?>
                            <!-- END RD Navbar Panel -->
                        </div>
                    </nav>
                </div>
                <!-- END RD Navbar -->
            </header>
            <!--========================================================
                                                              CONTENT
            =========================================================-->
            <main class="page-content text-center">
                <!-- Contact Form -->
                <section class="well-lg well-lg--inset-1">
                    <div class="container">
                        <h2><?=$PageDetail[0]->name?></h2>
                        <?= html_entity_decode($PageDetail[0]->detail)?>
                        <!-- END RD Mailform -->
                    </div>
                </section>
                <!-- END Contact Form -->

                <!-- Nearest Depot -->

                <!-- END Nearest Depot-->
            </main>
            <!--========================================================
                                                              FOOTER
            ==========================================================-->
            <?php include './include/fotter.php'; ?>
        </div>

        <!-- Global Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        <!-- Core Scripts -->
        <script src="js/core.min.js"></script>
        <!-- Additional Functionality Scripts -->
        <script src="js/script.js"></script>

    </body><!-- End Google Tag Manager -->
</html>
