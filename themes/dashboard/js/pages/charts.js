$(document).ready(function() {

	//define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
 	var chartColours = ['#62aeef', '#d8605f', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

 	//generate random number for charts
	randNum = function(){
		return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
	}


 	//check if element exist and draw chart
	if($(".chart").length) {
		$(function () {
			var d1 = [];
			var d2 = [];

			//here we generate data for chart
			for (var i = 0; i < 32; i++) {
				d1.push([new Date(Date.today().add(i).days()).getTime(),randNum()+i+i]);
				d2.push([new Date(Date.today().add(i).days()).getTime(),randNum()]);
			}

			var chartMinDate = d1[0][0]; //first day
    		var chartMaxDate = d1[31][0];//last day
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
						content: "%s: %y.0",
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
	    			label: "Visitors", 
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
	  
	//check if element exist and draw chart line
	if($(".chart-line").length) {

		//generate some example data for chart replace with actual data
		var d1 = [[1, 3+randNum()], [2, 6+randNum()], [3, 9+randNum()], [4, 12+randNum()],[5, 15+randNum()],[6, 18+randNum()],[7, 21+randNum()],[8, 15+randNum()],[9, 18+randNum()],[10, 21+randNum()],[11, 24+randNum()],[12, 27+randNum()],[13, 30+randNum()],[14, 33+randNum()],[15, 24+randNum()],[16, 27+randNum()],[17, 30+randNum()],[18, 33+randNum()],[19, 36+randNum()],[20, 39+randNum()],[21, 42+randNum()],[22, 45+randNum()],[23, 36+randNum()],[24, 39+randNum()],[25, 42+randNum()],[26, 45+randNum()],[27,38+randNum()],[28, 51+randNum()],[29, 55+randNum()], [30, 60+randNum()]];
		var d2 = [[1, randNum()-5], [2, randNum()-4], [3, randNum()-4], [4, randNum()],[5, 4+randNum()],[6, 4+randNum()],[7, 5+randNum()],[8, 5+randNum()],[9, 6+randNum()],[10, 6+randNum()],[11, 6+randNum()],[12, 2+randNum()],[13, 3+randNum()],[14, 4+randNum()],[15, 4+randNum()],[16, 4+randNum()],[17, 5+randNum()],[18, 5+randNum()],[19, 2+randNum()],[20, 2+randNum()],[21, 3+randNum()],[22, 3+randNum()],[23, 3+randNum()],[24, 2+randNum()],[25, 4+randNum()],[26, 4+randNum()],[27,5+randNum()],[28, 2+randNum()],[29, 2+randNum()], [30, 3+randNum()]];
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
			    mouseActiveRadius: 20
			},
	        series: {
	            lines: {
            		show: true,
            		fill: true,
            		lineWidth: 2,
            		steps: false
	            	},
	            points: {show:false}
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
	        yaxis: { min: 0 },
	        xaxis: {ticks:11, tickDecimals: 0},
	        colors: chartColours,
	        shadowSize:1,
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.0",
				shifts: {
					x: -30,
					y: -50
				},
				defaultTheme: false
			}
	    };   

    	$.plot($(".chart-line"), [ 

    		{
    			label: "Email send", 
    			data: d1,
    			lines: {fillColor: "#f3faff"}
    		}, 
    		{	
    			label: "Email open", 
    			data: d2,
    			lines: {fillColor: "#fff8f7"}
    		} 

    	], options);
	}//End of .cart-line

	//check if element exist and draw chart donut
	if($(".chart-donut").length) {
		$(function () {
			var options = {
				series: {
					pie: { 
						show: true,
						innerRadius: 0.5,
						highlight: {
							opacity: 0.1
						},
						radius: 1,
						stroke: {
							width: 2
						},
						startAngle: 2, 
						border: 30 //darken the main color with 30
					}					
				},
				legend:{
					show:true,
					labelFormatter: function(label, series) {
					    // series is the series object for the label
					    return '<a href="#' + label + '">' + label + '</a>';
					},
					margin: 50,
					width: 20,
					padding: 1
				},
				grid: {
		            hoverable: true,
		            clickable: true
		        },
		        tooltip: true, //activate tooltip
				tooltipOpts: {
					content: "%s : %y.1"+"%",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			};
			var data = [
			    { label: "USA",  data: 38, color: chartColours[0]},
			    { label: "Brazil",  data: 23, color: chartColours[1]},
			    { label: "India",  data: 15, color: chartColours[2]},
			    { label: "Turkey",  data: 9, color: chartColours[3]},
			    { label: "France",  data: 7, color: chartColours[4]},
			    { label: "China",  data: 5, color: chartColours[5]},
			    { label: "Germany",  data: 3, color: chartColours[6]}
			];

		    $.plot($(".chart-donut"), data, options);

		});

	}//End of .cart-donut

	//check if element exist and draw chat pie
	if($(".chart-pie").length) {
		$(function () {
			var options = {
				series: {
					pie: { 
						show: true,
						highlight: {
							opacity: 0.1
						},
						radius: 1,
						stroke: {
							width: 2
						},
						startAngle: 2,
						border: 30 //darken the main color with 30
					}				
				},
				legend:{
					show:true,
					labelFormatter: function(label, series) {
					    // series is the series object for the label
					    return '<a href="#' + label + '">' + label + '</a>';
					},
					margin: 50,
					width: 20,
					padding: 1
				},
				grid: {
		            hoverable: true,
		            clickable: true
		        },
		        tooltip: true, //activate tooltip
				tooltipOpts: {
					content: "%s : %y.1"+"%",
					shifts: {
						x: -30,
						y: -50
					},
					defaultTheme: false
				}
			};
			var data = [
			    { label: "USA",  data: 38, color: chartColours[0]},
			    { label: "Brazil",  data: 23, color: chartColours[1]},
			    { label: "India",  data: 15, color: chartColours[2]},
			    { label: "Turkey",  data: 9, color: chartColours[3]},
			    { label: "France",  data: 7, color: chartColours[4]},
			    { label: "China",  data: 5, color: chartColours[5]},
			    { label: "Germany",  data: 3, color: chartColours[6]}
			];

		    $.plot($(".chart-pie"), data, options);

		});

	}//End of .cart-pie

	//check if element exist and draw chart ordered bars
	if($(".chart-bars-ordered").length) {
		$(function () {
			//generate some data
			var d1 = [];
		    for (var i = 0; i <= 10; i += 1)
		        d1.push([i, parseInt(Math.random() * 30)]);
		 
		    var d2 = [];
		    for (var i = 0; i <= 10; i += 1)
		        d2.push([i, parseInt(Math.random() * 30)]);
		 
		    var d3 = [];
		    for (var i = 0; i <= 10; i += 1)
		        d3.push([i, parseInt(Math.random() * 30)]);
		 
		    var data = new Array();
		 
		     data.push({
		     	label: "Data One",
		        data:d1,
		        bars: {order: 1}
		    });
		    data.push({
		    	label: "Data Two",
		        data:d2,
		        bars: {order: 2}
		    });
		    data.push({
		    	label: "Data Three",
		        data:d3,
		        bars: {order: 3}
		    });

			var options = {
					bars: {
						show:true,
						barWidth: 0.2,
						fill:1
					},
					grid: {
						show: true,
					    aboveData: false,
					    color: "#3f3f3f" ,
					    labelMargin: 5,
					    axisMargin: 0, 
					    borderWidth: 0,
					    borderColor:null,
					    minBorderMargin: 5 ,
					    clickable: true, 
					    hoverable: true,
					    autoHighlight: false,
					    mouseActiveRadius: 20
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
			        tooltip: true, //activate tooltip
					tooltipOpts: {
						content: "%s : %y.0",
						shifts: {
							x: -30,
							y: -50
						}
					}
			};

			$.plot($(".chart-bars-ordered"), data, options);
		});

	}//End of .cart-bars-ordered

	//check if element exist and draw chart stacked bars
	if($(".chart-bars-stacked").length) {
		$(function () {
			//some data
			var d1 = [];
		    for (var i = 0; i <= 10; i += 1)
		        d1.push([i, parseInt(Math.random() * 30)]);
		 
		    var d2 = [];
		    for (var i = 0; i <= 10; i += 1)
		        d2.push([i, parseInt(Math.random() * 30)]);
		 
		    var d3 = [];
		    for (var i = 0; i <= 10; i += 1)
		        d3.push([i, parseInt(Math.random() * 30)]);
		 
		    var data = new Array();
		 
		    data.push({
		     	label: "Data One",
		        data:d1
		    });
		    data.push({
		    	label: "Data Two",
		        data:d2
		    });
		    data.push({
		    	label: "Data Tree",
		        data:d3
		    });

			var stack = 0, bars = true, lines = false, steps = false;

			var options = {
					grid: {
						show: true,
					    aboveData: false,
					    color: "#3f3f3f" ,
					    labelMargin: 5,
					    axisMargin: 0, 
					    borderWidth: 0,
					    borderColor:null,
					    minBorderMargin: 5 ,
					    clickable: true, 
					    hoverable: true,
					    autoHighlight: true,
					    mouseActiveRadius: 20
					},
			        series: {
			        	stack: stack,
		                lines: { show: lines, fill: true, steps: steps },
		                bars: { show: bars, barWidth: 0.5, fill:1}
				    },
			        xaxis: {ticks:11, tickDecimals: 0},
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
			        shadowSize:1,
			        tooltip: true, //activate tooltip
					tooltipOpts: {
						content: "%s : %y.0",
						shifts: {
							x: -30,
							y: -50
						}
					}
			};

			$.plot($(".chart-bars-stacked"), data, options);
		});

	}//End of .cart-bars-stacked

	//check if element exist and draw chart horizontal bars
	if($(".chart-bars-horizontal").length) {
		$(function () {
			//some data
			//Display horizontal graph
		    var d1 = [];
		    for (var i = 0; i <= 5; i += 1)
		        d1.push([parseInt(Math.random() * 30),i ]);

		    var d2 = [];
		    for (var i = 0; i <= 5; i += 1)
		        d2.push([parseInt(Math.random() * 30),i ]);

		    var d3 = [];
		    for (var i = 0; i <= 5; i += 1)
		        d3.push([ parseInt(Math.random() * 30),i]);
		                
		    var data = new Array();
		    data.push({
		        data:d1,
		        bars: {
		            horizontal:true, 
		            show: true, 
		            barWidth: 0.2, 
		            order: 1
		        }
		    });
			data.push({
			    data:d2,
			    bars: {
			        horizontal:true, 
			        show: true, 
			        barWidth: 0.2, 
			        order: 2
			    }
			});
			data.push({
			    data:d3,
			    bars: {
			        horizontal:true, 
			        show: true, 
			        barWidth: 0.2, 
			        order: 3
			    }
			});


			var options = {
					grid: {
						show: true,
					    aboveData: false,
					    color: "#3f3f3f" ,
					    labelMargin: 5,
					    axisMargin: 0, 
					    borderWidth: 0,
					    borderColor:null,
					    minBorderMargin: 5 ,
					    clickable: true, 
					    hoverable: true,
					    autoHighlight: false,
					    mouseActiveRadius: 20
					},
			        series: {			        	
				        bars: {
				        	show:true,
							horizontal: true,
							barWidth:0.2,
							fill:1
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
			        tooltip: true, //activate tooltip
					tooltipOpts: {
						content: "%s : %y.0",
						shifts: {
							x: -30,
							y: -50
						}
					}
			};

			$.plot($(".chart-bars-horizontal"), data, options);
		});
	}//End of .cart-bars-horizontal

	//check if element exist and draw auto updating chart
	if($(".chart-updating").length) {
		$(function () {
			// we use an inline data source in the example, usually data would
		    // be fetched from a server
		    var data = [], totalPoints = 50;
		    function getRandomData() {
		        if (data.length > 0)
		            data = data.slice(1);

		        // do a random walk
		        while (data.length < totalPoints) {
		            var prev = data.length > 0 ? data[data.length - 1] : 50;
		            var y = prev + Math.random() * 10 - 5;
		            if (y < 0)
		                y = 0;
		            if (y > 100)
		                y = 100;
		            data.push(y);
		        }

		        // zip the generated y values with the x values
		        var res = [];
		        for (var i = 0; i < data.length; ++i)
		            res.push([i, data[i]])
		        return res;
		    }

		    // Update interval
		    var updateInterval = 250;

		    // setup plot
		    var options = {
		        series: { 
		        	shadowSize: 0, // drawing is faster without shadows
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
		        grid: {
					show: true,
				    aboveData: false,
				    color: "#3f3f3f" ,
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: false,
				    mouseActiveRadius: 20
				}, 
				colors: chartColours,
		        tooltip: true, //activate tooltip
				tooltipOpts: {
					content: "Value is : %y.0",
					shifts: {
						x: -30,
						y: -50
					}
				},	
		        yaxis: { min: 0, max: 100 },
		        xaxis: { show: true}
		    };
		    var plot = $.plot($(".chart-updating"), [ getRandomData() ], options);

		    function update() {
		        plot.setData([ getRandomData() ]);
		        // since the axes don't change, we don't need to call plot.setupGrid()
		        plot.draw();
		        
		        setTimeout(update, updateInterval);
		    }

		    update();
		});
	}//End of .cart-updating

});

