<?php 
include './cms-admin/class/db_Class.php';
$obj=new db_class();

$siteSettings=$obj->FlyQuery("SELECT * FROM site_settings");
?>
<!DOCTYPE html>
<html lang="en" class="wide smoothscroll wow-animation">
    <head>
        <!-- Site Title -->
        <title>Contacts</title>
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
                        <h2>Contact Form</h2>
                        <!-- RD Mailform -->
                        <form class="rd-mailform" data-form-output="form-output-global" data-form-type="form" method="post" action="bat/rd-mailform.php">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-wrap form-wrap-validation">
                                        <label class="form-label" for="name">Name</label>
                                        <input class="form-input" id="name" type="text" name="name" data-constraints="@Required">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-wrap form-wrap-validation">
                                        <label class="form-label" for="email">E-mail</label>
                                        <input class="form-input" id="email" type="email" name="email" data-constraints="@Email @Required">
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-wrap form-wrap-validation">
                                        <label class="form-label" for="phone">Telephone</label>
                                        <input class="form-input" id="phone" type="text" name="phone" data-constraints="@Numeric @Required">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-wrap form-wrap-validation">
                                        <label class="form-label" for="comment">Comment</label>
                                        <textarea class="form-input" id="comment" name="comment" data-constraints="@Required"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button class="btn btn-sm btn-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
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
