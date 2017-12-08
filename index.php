<?php 
session_start();
include './cms-admin/class/db_Class.php';
$obj=new db_class();

include("./cms-admin/plugin/plugin.php");
$plugin = new cmsPlugin();

$siteSettings=$obj->FlyQuery("SELECT * FROM site_settings");

?>
<!DOCTYPE html>
<html lang="en" class="wide smoothscroll wow-animation">
<head>
    <!-- Site Title -->
    <title>Home</title>
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
    <header class="page-header page-header--main">
        <!-- RD Navbar -->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar" data-md-device-layout="rd-navbar-fixed" data-rd-navbar-lg="rd-navbar-static" data-lg-device-layout="rd-navbar-static">
                <div class="rd-navbar-inner">
                    <!-- RD Navbar Panel -->
                    <?php 
                    include './include/header_nav.php';
                    ?>
                </div>
            </nav>
        </div>
        <!-- END RD Navbar -->

        <!-- Swiper -->
        <div class="swiper-container swiper-slider" data-height="100vh" data-min-height="350px">
            <div class="swiper-wrapper text-center">
                <div class="swiper-slide" data-slide-title="International delivery" data-slide-bg="images/slide-1.jpg">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <h1><span class="text-primary">International delivery</span>
                                <span class="heading-3">4 days - 150 countries</span></h1>
                            <p class="inset-1">Delivery Co. provides international express delivery of documents, parcels and freight to
                                more than 150 countries around the world within 4 to 7 business days.</p>
                            <a href="booking.php" class="btn btn-sm btn-primary">
                                <i class="icon fa-angle-right"></i>
				                <span>Make Your Booking</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-title="We are proud to be always on demand"
                     data-slide-bg="images/slide-2.jpg">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <h1><span class="text-primary">We are proud to</span>
                                <span class="heading-3">be always on demand</span></h1>
                            <p class="inset-1">Delivery Co. provides international express delivery of documents, parcels and freight to more than 150 countries around the world with a choice of delivery periods of 4 or 7 days.</p>
                            <a href="booking.php" class="btn btn-sm btn-primary">
                                <i class="icon fa-angle-right"></i>
				                <span>Make Your Booking</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-title="Providing the highest" data-slide-bg="images/slide-3.jpg">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <h1><span class="text-primary">Providing the highest</span>
                                <span class="heading-3">quality service 24 hours a day</span></h1>
                            <p class="inset-1">Delivery Co. provides international express delivery of documents, parcels and freight to more than 150 countries around the world with a choice of delivery periods of 4 or 7 days.</p>
                            <a href="booking.php" class="btn btn-sm btn-primary">
                                <i class="icon fa-angle-right"></i>
				                <span>Make Your Booking</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Navigation -->
            <div class="swiper-button swiper-button-prev">
                <span class="swiper-button__arrow fa-angle-left"></span>

                <div class="preview">
                    <p class="title"></p>
                </div>
            </div>
            <div class="swiper-button swiper-button-next">
                <span class="swiper-button__arrow fa-angle-right"></span>

                <div class="preview">
                    <p class="title"></p>
                </div>
            </div>
        </div>
        <!-- END Swiper -->
    </header>
    <!--========================================================
                              CONTENT
    =========================================================-->
    <main class="page-content text-center">
        <!-- Fast and reliable -->
        
        <!-- END Fast and reliable-->

        <!-- Track search -->
        <section class="well-sm bg-primary">
            <div class="container">
                <div class="row">
                    <?=$plugin->ShowMsg()?>
                    <div class="col-sm-10 col-sm-preffix-1 col-md-8 col-md-preffix-2 col-lg-6 col-lg-preffix-3">
                        <h2>Track search</h2>
                        <form action="invoice.php" class="search-form" method="get">
                            <label><input type="text" name="view" placeholder="Enter the invoice number"/></label>
                            <button class="btn btn-sm btn-default" type="submit">
                                <i class="icon fa-angle-right"></i>
                                <span>Search</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- END Track search-->

        <section>
            <div class="row row-no-gutter">
                <div class="col-md-6 bg-img-1">
                    <!-- Event post -->
                    <div class="event-post">
                        <h2>For Private Customers</h2>
                        <p>It’s totally pure and simple. All you have to do is to drop into the nearest DeliveryCo. depot or book a courier to your home or office.</p>
                    </div>
                    <!-- END Event post -->
                </div>
                <div class="col-md-6 bg-img-2">
                    <!-- Event post -->
                    <div class="event-post">
                        <h2>For Business Customers</h2>
                        <p>Manage your time and expenses by selecting the option that suits you best. The service is available for shipments from all over the world to US and vice versa.</p>
                    </div>
                    <!-- END Event post -->
                </div>
            </div>
        </section>

        <!-- Nearest Depot -->
        
        <!-- END Nearest Depot-->

    </main>
    <!--========================================================
                              FOOTER
    ==========================================================-->
    <?php include './include/fotter.php'; ?>
    
</div>

<!-- Core Scripts -->
<script src="js/core.min.js"></script>
<!-- Additional Functionality Scripts -->
<script src="js/script.js"></script>
</body><!-- Google Tag Manager --><noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P9FT69"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-P9FT69');</script><!-- End Google Tag Manager -->
</html>
