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

 echo get_header();?>

<link href="<?php echo get_theme_path()?>css/builderengine-theme/jquery.ui.widget.css" rel="stylesheet" /> 
<link href="<?php echo get_theme_path()?>js/plugins/ui/range-slider/rangeslider.css" rel="stylesheet" /> 
    <script src="<?php echo get_theme_path()?>js/plugins/ui/range-slider/rangeslider-ruler.js"></script>
    <script src="<?php echo get_theme_path()?>js/plugins/ui/animated-progress-bar/jquery.progressbar.js"></script>
 <script src="<?php echo get_theme_path()?>js/pages/ui-elements.js"></script><!-- Init plugins only for page -->        
                <script type="text/javascript">
                    var total_days = 32;
                    

                    $( document ).ready(function() {
                        //------------- jGrowl notification -------------//
                        
                        
                        
                        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
                        var chartColours = ['#62aeef', '#d8605f', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

                        //generate random number for charts
                        randNum = function(){
                            return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
                        }


                        var d1 = [];
                        var d2 = [];

                        $.ajax({
                            type: 'GET',
                            url: '/admin/ajax/dashboard_get_visitors_graph/' + total_days,
                            dataType: 'json',
                            success: function(data) { 
                            var items = [];

                             all_visits = jQuery.parseJSON(data.all);
                             unique_visits = jQuery.parseJSON(data.unique);

                             var i = 0;
                              $.each(all_visits, function(key, val) {
                                if(i == 0)
                                    d1.push([new Date(Date.today().days()).getTime(),parseInt(val)]);
                                else
                                    d1.push([new Date(Date.today().add(-(i-1)).days()).getTime(),parseInt(val)]);
                                i++;
                              });
                            var i = 0;
                              $.each(unique_visits, function(key, val) {
                                if(i == 0)
                                    d2.push([new Date(Date.today().days()).getTime(),parseInt(val)]);
                                else
                                    d2.push([new Date(Date.today().add(-(i-1)).days()).getTime(),parseInt(val)]);
                                i++;
                              });
                             
                              $('<ul/>', {
                                'class': 'my-new-list',
                                html: items.join('')
                              }).appendTo('body');
                            },
                            data: {},
                            async: false
                        });
                    

                    if($(".chart").length) {
                        $(function () {


                            var chartMinDate = d1[total_days-1][0]; //first day
                            var chartMaxDate = d1[0][0];//last day

                            var tickSize = [1, "day"];
                            var tformat = "%d/%m/%y";

                            //graph options
                            var options = {
                                    grid: {
                                        show: true,
                                        aboveData: true,
                                        color: "#3f3f3f" ,
                                        labelMargin: 5,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 5 ,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: true,
                                        mouseActiveRadius: 100
                                    },
                                    series: {
                                        lines: {
                                            show: true,
                                            fill: true,
                                            lineWidth: 2,
                                            steps: false
                                            },
                                        points: {
                                            show:true,
                                            radius: 2.8,
                                            symbol: "circle",
                                            lineWidth: 2.5
                                        }
                                    },
                                    legend: { 
                                        position: "ne", 
                                        margin: [0,-25], 
                                        noColumns: 0,
                                        labelBoxBorderColor: null,
                                        labelFormatter: function(label, series) {
                                            // just add some space to labes
                                            return label+'&nbsp;&nbsp;';
                                        },
                                        width: 40,
                                        height: 1
                                    },
                                    colors: chartColours,
                                    shadowSize:0,
                                    tooltip: true, //activate tooltip
                                    tooltipOpts: {
                                        content: "%s: %y.0<br>Date: %x",

                                        xDateFormat: "%d/%m",
                                        shifts: {
                                            x: -30,
                                            y: -50
                                        },
                                        defaultTheme: false
                                    },
                                    yaxis: { min: 0 },
                                    xaxis: { 
                                        mode: "time",
                                        minTickSize: tickSize,
                                        timeformat: tformat,
                                        min: chartMinDate,
                                        max: chartMaxDate
                                    }
                            };  
                            var plot = $.plot($(".chart"),
                               [{
                                    label: "Site Visits", 
                                    data: d1,
                                    lines: {fillColor: "#f3faff"},
                                    points: {fillColor: "#fff"}
                                }, 
                                {   
                                    label: "Unique Visits", 
                                    data: d2,
                                    lines: {fillColor: "#fff8f7"},
                                    points: {fillColor: "#fff"}
                                }], options);
                        });
                    }//End .chart if 
                    }); 
                </script> 
                <div class="container-fluid">
                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i> Dashboard</h1>
                    </div>
                    <?if($update_available):?>
                    <div class="row-fluid">
                        <div class="alert alert-block alert-info fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <h4 class="alert-heading"><i class="icon24 i-info"></i>Update available!</h4>
                            <p>We have an update for your website. Updates provide you with new features and security improvements. <br>We recommend you to always keep your website up to date.</p>
                            <p>
                                <a class="btn btn-success" href="/admin/update/index">Update your website</a> 
                            </p>
                        </div>
                    </div>
                    <?endif;?>
                    <div class="row-fluid">
                            

                        <div class="span8">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-stats"></i></div>
                                    <h4>Daily Visits Statistics</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">

                                    <div class="chart" style="width: 100%; height:250px; margin-top: 10px;">
                                        
                                    </div>

                              

                                    <div class="clearfix"></div>

                                </div><!-- End .widget-content -->
                            </div><!-- End .widget -->
                        </div><!-- End .span8  --> 
                        <div class="span4">
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-temperature"></i></div>
                                    <h4>Weather widget</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">
                                    <div class="weather">
                                        <div class="center"><div class="location"><i class="icon16 i-location"></i> <?php echo $weather['location']?></div></div>
                                        <div class="center clearfix">
                                             <div class="pull-left">
                                                <div class="icon"><i class="icon64 <?php echo $weather['now']['icon_class']?>"></i></div>
                                                <span class="today">currently</span>
                                            </div>
                                            <div class="pull-right"><span class="degree blue"><?php echo $weather['now']['temp']?>&deg;</span></div>
                                        </div>
                                        <ul class="clearfix">
                                        <?php for($i = 1; $i < 7; $i++): ?>
                                            <li>
                                                <span class="day"><?php echo date("D", $weather[$i]['time'])?></span>
                                                <span class="dayicon"><i class="icon24 <?php echo $weather[$i]['icon_class']?>"></i></span>
                                                <span class="max"><?php echo $weather[$i]['temp']['max']?>&deg;</span>
                                                <span class="min"><?php echo $weather[$i]['temp']['min']?>&deg;</span>
                                            </li>
                                            <?endfor;?>
                                            <!--<li>
                                                <span class="day">Tue</span>
                                                <span class="dayicon"><i class="icon24 i-cloud-2 dark"></i></span>
                                                <span class="max">24&deg;</span>
                                                <span class="min">10&deg;</span>
                                            </li>
                                            <li>
                                                <span class="day">Wed</span>
                                                <span class="dayicon"><i class="icon24 i-weather-rain dark"></i></span>
                                                <span class="max">17&deg;</span>
                                                <span class="min">8&deg;</span>
                                            </li>
                                            <li>
                                                <span class="day">Thu</span>
                                                <span class="dayicon"><i class="icon24 i-weather-lightning red-smooth"></i></span>
                                                <span class="max">20&deg;</span>
                                                <span class="min">11&deg;</span>
                                            </li>
                                            <li>
                                                <span class="day">Fri</span>
                                                <span class="dayicon"><i class="icon24 i-weather-snow blue"></i></span>
                                                <span class="max">4&deg;</span>
                                                <span class="min">-5&deg;</span>
                                            </li>
                                            <li>
                                                <span class="day">Sat</span>
                                                <span class="dayicon"><i class="icon24 i-snowflake blue"></i></span>
                                                <span class="max">0&deg;</span>
                                                <span class="min">-10&deg;</span>
                                            </li>   -->
                                            
                                        </ul>
                                    </div>
                                </div><!-- End .widget-content -->
                            </div><!-- End .widget -->                                                
                        </div><!-- End .span4  --> 

                    </div><!-- End .row-fluid  -->
<div class="row-fluid"> 
    <div class="span12"> 
        <div class="widget"> 
            <div class="widget-title"> 
                <div class="icon"><i class="icon20 i-power"></i></div> 
                <h4>Latest News</h4> 
                <a href="#" class="minimize"></a> 
            </div><!-- End .widget-title --> 
            <div class="widget-content noPadding"> 
                <ul class="recent-activity"> 
                    <?php foreach($news as $entry):?>
                    <li class="item"> 
                        <span class="icon gray"><i class="icon16 <?php echo $entry['icon']?>"></i></span> 
                        <div class="text">
                            <?php echo $entry['code']?>
                            <?if($entry['url'] != ""):?>
                            <a href="<?php echo $entry['url']?>"><?php echo $entry['title']?></a>
                            <?else:?>
                            <?php echo $entry['title']?>
                            <?endif;?>
                        </div> 
                        <span class="ago"><?php echo $entry['time']?></span> 
                    </li> 
                    <?endforeach;?>


            </ul> 
        </div><!-- End .widget-content --> 
    </div><!-- End .widget --> 
</div><!-- End .span6 --> 
 </div><!-- End .row-fluid -->

                </div> <!-- End .container-fluid  -->
<?php echo get_footer();?>