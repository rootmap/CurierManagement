<div class="rd-navbar-panel">

    <!-- RD Navbar Toggle -->
    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar"><span></span></button>
    <!-- END RD Navbar Toggle -->

    <!-- RD Navbar Brand -->
    <div class="rd-navbar-brand">
        <a href="index.php" class="brand-name">
            <img src="cms-admin/upload/<?=$siteSettings[0]->site_logo?>" alt="" width="70" height="56">
            <?=$siteSettings[0]->site_name?>
        </a>
    </div>
    <!-- END RD Navbar Brand -->
</div>
<!-- END RD Navbar Panel -->
<?php 
$Nav=$obj->FlyQuery("SELECT * FROM other_pages");
?>
<div class="rd-navbar-nav-wrap">

    <!-- RD Navbar Nav -->
    <ul class="rd-navbar-nav">
        <li class="active">
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="booking.php">Booking</a>
        </li>
        <?php 
        foreach ($Nav as $navs):
        ?>
        <li>
            <a href="page.php?page=<?=$navs->id?>"><?=$navs->name?></a>
        </li>
        <?php 
        endforeach;
        ?>
       
        <li>
            <a href="contact.php">Contacts</a>
        </li>
    </ul>
    <!-- END RD Navbar Nav -->
</div>

<!-- RD Navbar Panel -->
<div class="rd-navbar-panel">
    <!-- Contact info -->
    <address class="contact-info">
        <a href="callto:#"><span class="icon icon-xs icon-primary fa-phone"></span><?=$siteSettings[0]->contact_number?></a>
    </address>
    <!-- END Contact info -->
</div>
<!-- END RD Navbar Panel -->