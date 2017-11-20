<div id="menu" class="hidden-print hidden-xs">
    <div class="sidebar sidebar-inverse">
        <div class="sidebarMenuWrapper" style="top:0px !important;">
            <ul class="list-unstyled">
                <li><a href="index.php"><i class=" icon-projector-screen-line"></i><span>Dashboard</span></a></li>
                <!--                <li class="hasSubmenu">
                                    <a href="#" data-target="#menu-style" data-toggle="collapse"><i class="icon-compose"></i><span>Menu &amp; Navbar</span></a>
                                    <ul class="collapse" id="menu-style">
                                        <li><a href=""><span class="pull-right badge badge-primary"><i class="fa fa-check"></i></span>Sidebar Menu Dark</a></li>
                                        <li><a href="">Sidebar Menu Light</a></li>
                                        <li><a href="">Top Menu Dark</a></li>
                                        <li><a href="">Top Menu Light</a></li>
                                        <li><a href=""><span class="pull-right badge badge-primary"><i class="fa fa-check"></i></span>Top Menu Primary</a></li>
                                    </ul>
                                </li>-->

                <li><a href="setting.php"><i class="icon-cogs"></i><span> Setting</span></a></li>

                <?php
                $sqlpage = $obj->FlyQuery("SELECT 
                                            upam.id,
                                            upam.page_name, 
                                            upam.page_link_file_name 
                                            FROM user_access_role as uar
                                            LEFT JOIN user_page_access_mapping as upam ON uar.user_type_id=upam.user_type_id 
                                            WHERE uar.user_id='".$formula_id."'");
                if (!empty($sqlpage))
                    foreach ($sqlpage as $page):
                        ?>
                        <li>
                            <a href="<?php echo $page->page_link_file_name; ?>">
                                <i class="fa fa-folder-o"></i>
                                <span> <?php echo $page->page_name; ?></span>
                            </a>
                        </li> 
                                    <?php
                                endforeach;
                            ?>


            </ul>
        </div>
    </div>
</div>