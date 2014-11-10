<?php
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/
 if(!is_installed()): ?>
<script>
$(document).ready(function(){
  $("#collapse-nav").addClass('collapse');
                    $("#collapse-nav").text("");
                    
                    $('#sidebar').addClass('isCollapse');
                    $('.sidebar-widget').addClass('hided');
                    $('#content').addClass('isCollapse');  
                    localStorage.setItem("collapseNav", 0); 
    
});
</script>
<?php endif?>
<aside id="sidebar" >
            <div class="side-options">
                <ul>
                    <li>
                    <a href="#" id="collapse-nav" class="act act-primary tip" title="Collapse navigation" style><i class="icon16 i-arrow-left-7"></i></a></li>
                </ul>
            </div>

            <div class="sidebar-wrapper" <?php if(!is_installed()): ?>style="visibility: hidden"<?php endif;?>>
            
                <nav id="mainnav">
                    <?php if(is_installed()): ?>
                    <ul class="nav nav-list">
                        <li>
                            <a <?php echo href("admin", "main/dashboard")?>>
                                <span class="icon"><i class="icon20 i-screen"></i></span>
                                <span class="txt">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="icon20 i-users"></i></span>
                                <span class="txt">Users</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a <?php echo href("admin", "user/add")?>>
                                        <span class="icon"><i class="icon20 i-user-plus"></i></span>
                                        <span class="txt">Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a <?php echo href("admin", "user/search")?>>
                                        <span class="icon"><i class="icon20  i-search-5"></i></span>
                                        <span class="txt">Search Users</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon"><i class="icon20 i-users-4"></i></span>
                                        <span class="txt">User Groups</span>
                                    </a>
                                    <ul class="sub">
                                <li>
                                    <a <?php echo href("admin", "user/add_group")?>>
                                        <span class="icon"><i class="icon20 i-user-plus"></i></span>
                                        <span class="txt">Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a <?php echo href("admin", "user/groups")?>>
                                        <span class="icon"><i class="icon20  i-search-5"></i></span>
                                        <span class="txt">All Groups</span>
                                    </a>
                                </li>

                                
                            </ul>
                                </li>
                                
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#">
                                <span class="icon"><i class="icon20 i-link"></i></span>
                                <span class="txt">Main Menu Links</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a <?php echo href("admin", "links/add")?>>
                                        <span class="icon"><i class="icon20 i-user-plus"></i></span>
                                        <span class="txt">Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a <?php echo href("admin", "links/show")?>>
                                        <span class="icon"><i class="icon20  i-search-5"></i></span>
                                        <span class="txt">Show All</span>
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#">
                                <span class="icon"><i class="icon20 i-cogs"></i></span>
                                <span class="txt">Settings</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a <?php echo href("admin", "main/settings")?>>
                                        <span class="icon"><i class="icon20 i-cog-3"></i></span>
                                        <span class="txt">General</span>
                                    </a>
                                </li>

                                <li>
                                    <a <?php echo href("admin", "themes/show")?>>
                                        <span class="icon"><i class="icon20  i-palette"></i></span>
                                        <span class="txt">Themes</span>
                                    </a>
                                </li>
                                <li>
                                    <a <?php echo href("admin", "modules/show")?>>
                                        <span class="icon"><i class="icon20  i-cube-3"></i></span>
                                        <span class="txt">Modules</span>
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </li>

                        <li>
                            <a <?php echo href("admin", "files/show")?>>
                                <span class="icon"><i class="icon20 i-cloud-upload"></i></span>
                                <span class="txt">File Manager</span>
                            </a>
         
                        </li>

                        <li>
                            <a <?php echo href("admin", "modules/market")?>>
                                <span class="icon"><i class="icon20 i-cart-4"></i></span>
                                <span class="txt">Builder Market</span>
                            </a>
                        </li>
                            
                        
                        <?php 
                        
                        $links = get_admin_links();
                        foreach($links as $key => $menu):
                        $module = $key;
                        $module[0] = strtoupper($module[0]); 
                        ?>
                            <li>
                                    <a href="#">
                                        <span class="icon"><i class="icon20 i-table-2"></i></span>
                                        <span class="txt"><?php echo $module?></span>
                                    </a>
                                    <ul class="sub">
                                       <?php foreach( $links[$key] as $sub_key => $link): 
                                            
                                       ?>
                                        <li>
                                            <?php if(is_array($links[$key][$sub_key])): ?>
                                            <a href="#">
                                            <?php else: ?>
                                            <a href="<?php echo $links[$key][$sub_key]?>">
                                            <?php endif;?>
                                                <span class="icon"><i class="icon20 i-table"></i></span>
                                                <span class="txt"><?php echo $sub_key?></span>
                                            </a>
                                            <?php if(is_array($links[$key][$sub_key])): ?>
                                                <ul class="sub">
                                                    <?php foreach($links[$key][$sub_key] as $sub_sub_key => $link): ?>
                                                        <li>
                                                            <a href="<?php echo $link?>">
                                                                <span class="icon"><i class="icon20 i-table-2"></i></span>
                                                                <span class="txt"><?php echo $sub_sub_key?></span>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>        
                                            <?php endif; ?>
                                        </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </li>

                       
                                
                        <?php endforeach; ?>
                           <?php 
                            /*$modules = get_modules();
                            foreach($modules as $module): ?>
                                <li>
                                    <a href="#">
                                        <span class="icon"><i class="icon20 i-table-2"></i></span>
                                        <span class="txt"><?php echo $module->name?></span>
                                    </a>
                                    <ul class="sub">
                                       <?php foreach( get_admin_links($module->folder_name) as $link): ?>
                                        <li>
                                            <a href="/index.php/admin/module<?php echo $link['handle']?>">
                                                <span class="icon"><i class="icon20 i-table"></i></span>
                                                <span class="txt"><?php echo $link['name']?></span>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </li>
                            
                        <?php  endforeach; ?> */
                        ?>
                        
                        
                    </ul>
                    <?php endif?>
                </nav> <!-- End #mainnav -->

                <div class="sidebar-widget center">
                    <h4 class="sidebar-widget-header"><i class="icon i-pie-2"></i> Basic stats</h4>
                    <div class="spark-stats">
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="txt">Visits</span>
                                    <?php 
                            $day = 86400;
                            $this_week = $this->BuilderEngine->get_total_site_visits(time()-(7*$day),time(), "all");
                            $last_week = $this->BuilderEngine->get_total_site_visits(time()-(14*$day),time()-(7*$day), "all");
                            
                            if($last_week == 0)
                                $percent = 0;
                            else
                                $percent = round($this_week / $last_week * 100);
                            if($percent > 9999)
                                $percent = 9999;
                            if($percent < 100)
                                $percent = -(100 - $percent);
                                        ?>

                                    <?php if($percent > 0):?>
                                            <span class="positive">
                                        <?php else:?>
                                            <span class="negative">
                                        <?php endif;?>
                                        
                                        <?php if($percent > 0):?>
                                            <span class="up"></span>
                                        <?php else:?>
                                            <span class="down"></span>
                                        <?php endif;?>
                                        

                                        <span class="number"><?php echo abs($percent)?><small>%</small></span>
                                    </span>
                                    <span class="spark">
                                        <?php 
                                        $visits = $BuilderEngine->get_site_visits("all", 10, false);
                                        ?>
                                        <?php if($percent > 0):?>
                                            <span class="positive">
                                        <?php else:?>
                                            <span class="negative">
                                        <?php endif;?>

                                        
                                            <?php 
                                            if($visits > 0)
                                            {
                                                $string = "";
                                                foreach ( array_reverse($visits) as $day){
                                                    $string .= $day.",";
                                                }
                                                echo trim($string, ",");
                                            }
                                            ?>

                                           
                                            </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="txt">Unique Visitors</span>
                                    <?php 
                            $day = 86400;
                            $this_week = $this->BuilderEngine->get_total_site_visits(time()-(7*$day),time(), "unique");
                            $last_week = $this->BuilderEngine->get_total_site_visits(time()-(14*$day),time()-(7*$day), "unique");
                            
                            if($last_week == 0)
                                $percent = 0;
                            else
                                $percent = round($this_week / $last_week * 100);
                            if($percent > 9999)
                                $percent = 9999;
                            if($percent < 100)
                                $percent = -(100 - $percent);
                                        ?>
                                        
                                    <?php if($percent > 0):?>
                                            <span class="positive">
                                        <?php else:?>
                                            <span class="negative">
                                        <?php endif;?>
                                        
                                        <?php if($percent > 0):?>
                                            <span class="up"></span>
                                        <?php else:?>
                                            <span class="down"></span>
                                        <?php endif;?>
                                        

                                        <span class="number"><?php echo abs($percent)?><small>%</small></span>
                                    </span>
                                    <span class="spark">
                                        <?php 
                                        $visits = $BuilderEngine->get_site_visits("unique", 10, false);
                                        ?>
                                        <?php if($percent > 0):?>
                                            <span class="positive">
                                        <?php else:?>
                                            <span class="negative">
                                        <?php endif;?>

                                        
                                            <?php 
                                            if($visits > 0)
                                            {
                                                $string = "";
                                                foreach ( array_reverse($visits) as $day){
                                                    $string .= $day.",";
                                                }
                                                echo trim($string, ",");
                                            }
                                            ?>

                                           
                                            </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div><!-- End .spark-stats -->
                </div><!-- end .sidebar-widget -->

                <div class="sidebar-widget center">
                    <h4 class="sidebar-widget-header"><i class="icon i-fire-2"></i> Site overload</h4>
                    <div id="gauge" style="width:200px; height:150px;"></div>
                    <div id="gauge1" style="width:200px; height:150px;"></div>
                </div><!-- end .sidebar-widget -->
             
            </div> <!-- End .sidebar-wrapper  -->
        </aside><!-- End #sidebar  -->