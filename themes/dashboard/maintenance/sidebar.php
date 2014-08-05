
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

<aside id="sidebar" >
            <div class="side-options">
                <ul>
                    <li>
                    <a href="#" id="collapse-nav" class="act act-primary tip" title="Collapse navigation" style><i class="icon16 i-arrow-left-7"></i></a></li>
                </ul>
            </div>

            <div class="sidebar-wrapper" <?php if(!is_installed()): ?>style="visibility: hidden"<?endif;?>>
            
                <nav id="mainnav">
                    
                </nav> <!-- End #mainnav -->

                <div class="sidebar-widget center">
                    <h4 class="sidebar-widget-header"><i class="icon i-pie-2"></i> Basic stats</h4>
                    <div class="spark-stats">
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="txt">Visits</span>
                                    <span class="positive">
                                        <span class="up"></span>
                                        <span class="number">20<small>%</small></span>
                                    </span>
                                    <span class="spark">
                                        <span class="positive">5,3,9,6,5,9,7,3,5,2</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="txt">Invoices</span>
                                    <span class="negative">
                                        <span class="down"></span>
                                        <span class="number">3<small>%</small></span>
                                    </span>
                                    <span class="spark">
                                        <span class="negative">5,3,9,6,5,9,7,3,5,2</span>
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