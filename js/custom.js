jQuery(document).ready(function($) {
	
	"use strict";
	//Bx Sliders
	if($('.bxslider').length){
		$('.bxslider').bxSlider({
		 pager:false,
		});
	}
	
	//Time Picker
	if($('#timepicker1').length){
		$('#timepicker1').timepicker();
	}
        if($('#timepicker2').length){
		$('#timepicker2').timepicker();
	}
        if($('#timepicker3').length){
		$('#timepicker3').timepicker();
	}
        if($('#timepicker4').length){
		$('#timepicker4').timepicker();
	}
	
	//Bx Slider
	if($('.bxslider-2').length){
		$('.bxslider-2').bxSlider({
			mode: 'fade',
			captions: true
		});
	}
   
	//Hover Menu
	$(".navbar-inner ul >li").hover(
		function() {
			$(this).addClass('open');
		},
		function() {
			$(this).removeClass('open');
		}
	);
	
	//Gallery Script
	if($('.gallery_fun').length){
		$(".gallery_fun:first a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal',
			slideshow: 10000,
			autoplay_slideshow: true
		});
		$(".gallery_fun:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'slow',
			slideshow: 10000,
			hideflash: true
		});
	}
	
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$('#calendar').fullCalendar({
		editable: true,
		//weekends: false, // will hide Saturdays and Sundays
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
				allDay: false
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		]
	});
		
	if($('#map_canvas').length){
		var map;
		var myLatLng = new google.maps.LatLng(40.676498, -73.623132)
		//Initialize MAP
		var myOptions = {
		  zoom: 16,
		  center: myLatLng,
		  disableDefaultUI: true,
		  zoomControl: true,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);
		//End Initialize MAP
		//Set Marker
		var marker = new google.maps.Marker({
		  position: map.getCenter(),
		  map: map
		});
		marker.getPosition();
		//End marker
		
		//Set info window
		var infowindow = new google.maps.InfoWindow({
			content: '',
			position: myLatLng
		});
		infowindow.open(map);
	}

		
		
	//Percent Script
	if($('.percentage').length){
		$('.percentage').easyPieChart({
			animate: 1000,
			
			onStep: function(value) {
				this.$el.find('span').text(~~value);
			}
		});
	}
		
	//Scroll Script
	if($('.scroll').length){
		$(".scroll").mCustomScrollbar({
			set_width:false, /*optional element width: boolean, pixels, percentage*/
			set_height:false, /*optional element height: boolean, pixels, percentage*/
			horizontalScroll:false, /*scroll horizontally: boolean*/
			scrollInertia:950, /*scrolling inertia: integer (milliseconds)*/
			mouseWheel:true, /*mousewheel support: boolean*/
			mouseWheelPixels:"auto", /*mousewheel pixels amount: integer, "auto"*/
			autoDraggerLength:true, /*auto-adjust scrollbar dragger length: boolean*/
			autoHideScrollbar:false, /*auto-hide scrollbar when idle*/
			scrollButtons:{ /*scroll buttons*/
				enable:false, /*scroll buttons support: boolean*/
				scrollType:"continuous", /*scroll buttons scrolling type: "continuous", "pixels"*/
				scrollSpeed:"auto", /*scroll buttons continuous scrolling speed: integer, "auto"*/
				scrollAmount:40 /*scroll buttons pixels scroll amount: integer (pixels)*/
			},
			advanced:{
				updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
				updateOnContentResize:false, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
				autoExpandHorizontalScroll:false, /*auto-expand width for horizontal scrolling: boolean*/
				autoScrollOnFocus:true, /*auto-scroll on focused elements: boolean*/
				normalizeMouseWheelDelta:false /*normalize mouse-wheel delta (-1/1)*/
			},
			contentTouchScroll:true, /*scrolling by touch-swipe content: boolean*/
			callbacks:{
				onScrollStart:function(){}, /*user custom callback function on scroll start event*/
				onScroll:function(){}, /*user custom callback function on scroll event*/
				onTotalScroll:function(){}, /*user custom callback function on scroll end reached event*/
				onTotalScrollBack:function(){}, /*user custom callback function on scroll begin reached event*/
				onTotalScrollOffset:0, /*scroll end reached offset: integer (pixels)*/
				onTotalScrollBackOffset:0, /*scroll begin reached offset: integer (pixels)*/
				whileScrolling:function(){} /*user custom callback function on scrolling event*/
			},
			theme:"light" /*"light", "dark", "light-2", "dark-2", "light-thick", "dark-thick", "light-thin", "dark-thin"*/
		});
	}
	
	//Datepicker Script
	var date_picker_CP = $('#dp3');
	if(date_picker_CP.length){
		$('#dp3').datepicker({
			format: 'mm-dd-yyyy'
		});
	}

	
	window.onload=function(){
		if($('#mycarousel').length){
			$('#mycarousel').jcarousel();  
		}
	};
	//Carousel Script
	

	//Bootstrap Tab Script
	if($('#myTab').length){
		$('#myTab a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
	}
	
	// hide #back-top first
	if($('#back-top').length){
		$("#back-top").hide();
		
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#back-top').fadeIn();
				} else {
					$('#back-top').fadeOut();
				}
			});

			// scroll body to 0px on click
			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
	}
	if($('.accordion-body').length){
		$('.accordion-body').on('show',
		  function(e){
			$(e.currentTarget).parent().find('.accordion-heading').addClass('active') 
		  }
		)

		$('.accordion-body').on('hide',
		  function(e){
			$(e.currentTarget).parent().find('.accordion-heading').removeClass('active') 
		  }
		)
	}
});
