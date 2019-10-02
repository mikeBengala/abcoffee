Main_calendar = {
	init:function(){
		var events = Main_calendar.get_events_array();
		Main_calendar.trigger_calendar(events);
		Main_calendar.trigger_nice_select();
	},
	trigger_nice_select:function(){
		if($(".calendar_filters_wrap").length > 0){
			$("#calendar_cat_filter, #calendar_level_filter, #calendar_tags_filter").niceSelect();
		}
	},
	get_events_array:function(){
		
		var filter_cat = $('#calendar_cat_filter :selected').val(),
			filter_level = $('#calendar_level_filter :selected').val(),
			filter_tag = $('#calendar_tags_filter :selected').val(),
			events_array = [];

		$(".calendar_course").each(function(index){
			
			var $_this = $(this),
				this_title = $_this.find("h2").html(),
				start = $_this.attr("data-start-date"),
				end = $_this.attr("data-end-date"),
				url = $_this.attr("href"),
				cat = $_this.attr("data-cat"),
				tag = $_this.attr("data-tag"),
				level = $_this.attr("data-level"),
				title = $_this.find("h2").html(),
				info = $_this.find(".content").html(),
				picture = $_this.find(".calendar_product_image_wrap img").attr("data-lazy-src"),
				description = $_this.attr("data-description"),
				availability = $_this.find(".availability p").html(),
				add_to_cart_href= $_this.attr("data-add-to-cart");

			if(end != false){
				end = end + "T01:00:00";
			}

			var this_event = {
				classNames:cat,
				url:url,
				id: index,
				title:this_title,
				start:start+"T00:00:00",
				end:end,
				extendedProps:{
					description: title,
					info: info,
					picture: picture,
					variation_description : description,
					availability: availability,
					add_to_cart_href: add_to_cart_href
				}
			};				

			var is_pushable = true;
			
			if(filter_cat != "all"){
				if(!cat.includes(filter_cat)){
					is_pushable = false;
				}
			}
			if(filter_level != "all"){
				if(filter_level == level){
					is_pushable = false;
				}
			}
			if(filter_tag != "all"){
				if(!tag.includes(filter_tag)){
					is_pushable = false;
				}
			}
			
			if(is_pushable){
				events_array.push(this_event);
			}

	        
		});
		return events_array;

	},
	trigger_calendar:function(events){
		var calendarEl = document.getElementById('calendar');
	    var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'interaction', 'dayGrid' ],
			defaultDate: new Date(),
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: events,
			eventRender: function(info) {
			    var tooltip = new Tooltip(info.el, {
					template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip_header"><div class="tooltip_picture_wrap"><img src="'+ info.event.extendedProps.picture +'"></div><div class="tooltip-inner"></div></div><div class="event_footer"><div>' + info.event.extendedProps.variation_description + '</div><div>'+ info.event.extendedProps.availability +'</div></div><div class="event_info">' + info.event.extendedProps.info + '</div><a class="event_add_to_cart" href="'+info.event.extendedProps.add_to_cart_href+'">Adicionar</a></div>',
					title: info.event.extendedProps.description,
					placement: 'bottom',
					trigger: 'hover',
					container: 'body'
			    });
			}
			
	    });
	    
	    if(!$("#calendar").hasClass("fc")){
	    	calendar.render();	
	    }else{
	    	calendar.destroy();
	    }

	    $("#calendar_cat_filter, #calendar_level_filter, #calendar_tags_filter").change(function(){
			calendar.destroy();
			var events = Main_calendar.get_events_array();
			Main_calendar.trigger_calendar(events);
		});
	}
}

var $ = jQuery;
$(function(){
	if($("#calendar").length > 0){
		Main_calendar.init();
	}
});