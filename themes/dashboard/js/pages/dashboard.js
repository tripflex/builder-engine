

var server_load;
var site_visitors;
function refresh_server_load()
{

	$.get("/admin/ajax/get_server_load", function(data){
		server_load.refresh(data);
	});
}

function refresh_site_visitors()
{
	$.get("/admin/ajax/get_site_visitors", function(data){
		site_visitors.refresh(data);
	});
}

$(document).ready(function() {

	

	//here we generate data for chart
    /*jQuery.ajax({
         url:    "/admin/ajax/dashboard_get_date_before_now_visits/all/" + 0,
         success: function(result) {

				d1.push([new Date(Date.today().days()).getTime(),parseInt(result)]);		
                  },
         async:   false
    });
    jQuery.ajax({
         url:    "/admin/ajax/dashboard_get_date_before_now_visits/unique/" + 0,
         success: function(result) {

				d2.push([new Date(Date.today().days()).getTime(),parseInt(result)]);
                  },
         async:   false
    });

	for (var i = 0; i < 32; i++) {
	    jQuery.ajax({
	         url:    "/admin/ajax/dashboard_get_date_before_now_visits/all/" + (i+1),
	         success: function(result) {

					d1.push([new Date(Date.today().add(-i).days()).getTime(),parseInt(result)]);		
	                  },
	         async:   false
	    });
	    jQuery.ajax({
	         url:    "/admin/ajax/dashboard_get_date_before_now_visits/unique/" + (i+1),
	         success: function(result) {

					d2.push([new Date(Date.today().add(-i).days()).getTime(),parseInt(result)]);
	                  },
	         async:   false
	    }); 
	}*/
 	//check if element exist and draw chart
	

	//check if element exist and draw chat pie
	if($(".chart-pie-social").length) {
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
						border: 30, //darken the main color with 30
						label: {
		                    show: true,
		                    radius: 2/3,
		                    formatter: function(label, series){
		                        return '<div class="pie-chart-label">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
		                    }
		                }
					}				
				},
				legend:{
					show:false
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
			    { label: "Facebook",  data: 64, color: chartColours[0]},
			    { label: "Twitter",  data: 25, color: chartColours[1]},
			    { label: "Google",  data: 11, color: chartColours[2]}
			];

		    $.plot($(".chart-pie-social"), data, options);

		});

	}//End of .cart-pie-social

	//Init campaign stats
	initPieChart();

	//------------- ToDo -------------//
	//toDo 
    function toDo () {
        var todos = $('.toDo');
        var items = todos.find('.task-item');
        var chboxes = items.find('input[type="checkbox"]');
        var close = items.find('.act');

        chboxes.change(function() {
           if ($(this).is(':checked')) {
                $(this).closest('.task-item').addClass('done');
            } else {
                $(this).closest('.task-item').removeClass('done');
            }
        });

        items.hover(
          function () {
            $(this).addClass('show');
          },
          function () {
            $(this).removeClass('show');
          }
        );

        close.click(function() {
            $(this).closest('.task-item').fadeOut('500');
            //Do other stuff here..
        });

    }

    toDo();

	//sortable
	$(function() {
	    $( "#today, #tomorrow" ).sortable({
	      connectWith: ".todo-list"
	    }).disableSelection();
	});

	//------------- Full calendar  -------------//

	$(function () {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		//calendar example
		$('#dashboard-calendar').fullCalendar({
			//isRTL: true,
			//theme: true,
			header: {
				left: '',
				center: 'title,today,prev,next,month,agendaWeek,agendaDay',
				right: ''
			},
			firstDay: 1,
			dayNamesShort: ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
 'Thursday', 'Friday', 'Saturday'],
			buttonText: {
	        	prev: '<i class="icon24 i-arrow-left-7"></i>',
	        	next: '<i class="icon24 i-arrow-right-8"></i>',
	        	today:'<i class="icon24 i-home-6"></i>'
	    	},
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
			
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				$(this).remove();
			},
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					color: '#25a7e8',
					borderColor: '#0d7fb8'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
					color: '#d8605f',
					borderColor: '#b72827'
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			],
			eventColor: '#72c380',
			eventBorderColor: '#379e49'
		});
	});

	//------------- Spark stats -------------//
	$('.spark>.positive').sparkline('html', { type:'bar', barColor:'#42b449'});
	$('.spark>.negative').sparkline('html', { type:'bar', barColor:'#db4a37'});

	//------------- Gauge -------------//
	server_load = new JustGage({
	    id: "gauge", 
	    value: 0, 
	    min: 0,
	    max: 100,
	    title: "server usage",
	    gaugeColor: '#6f7a8a',
	    labelFontColor: '#555',
	    titleFontColor: '#555',
	    valueFontColor: '#555',
	    showMinMax: false
	 });

	site_visitors = new JustGage({
	    id: "gauge1", 
	    value: 0, 
	    min: 0,
	    max: 6,
	    title: "Visitors now",
	    gaugeColor: '#6f7a8a',
	    labelFontColor: '#555',
	    titleFontColor: '#555',
	    valueFontColor: '#555',
	    showMinMax: false
	 });

	setInterval(function() {
		refresh_server_load();
		refresh_site_visitors();

    }, 2500);

});

//Setup campaign stats
var initPieChart = function() {
	$(".percentage").easyPieChart({
        barColor: '#62aeef',
        borderColor: '#227dcb',
        trackColor: '#d7e8f6',
        scaleColor: false,
        lineCap: 'butt',
        lineWidth: 20,
        size: 80,
        animate: 1500
    });
    $(".percentage-red").easyPieChart({
        barColor: '#d8605f',
        trackColor: '#f6dbdb',
        scaleColor: false,
        lineCap: 'butt',
        lineWidth: 20,
        size: 80,
        animate: 1500
    });

}