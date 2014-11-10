var total_days = 32;
                    alert();
                    $(document).ready(function() {
                        
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