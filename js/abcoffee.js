Main_abcoffee = {
	init:function(){
		
		Main_abcoffee.convert_dates_to_string_attract(".woocommerce .woocommerce-cart-form__cart-item .variation-date:last-child p");
		Main_abcoffee.live_translations();
		if($("#calendar").length > 0){
			var events = Main_abcoffee.get_events_array();
			Main_abcoffee.trigger_calendar(events);
			Main_abcoffee.trigger_nice_select();
			Main_abcoffee.set_calendar_next_prev_click_event();
		}
	},
	live_translations:function(){
		

		if(Main_abcoffee.current_lang() == "pt-PT"){

			var the_words = {
				Foundation : {
					pt:"Iniciado"
				},
				Intermediate: {
					pt:"Intermédio"
				},
				Professional: {
					pt:"Profissional"
				}
			};
			
			if($(".translatable_term_label").length > 0){
				$(".translatable_term_label").each(function(){
					
					var $_this = $(this),
						translatable_text = $_this.html();
					//console.log(translatable_text);

					$.each(the_words , function(key, value){
						if(key == translatable_text){
							$_this.html(value.pt);
						}
						
					});
				});
			}

			if($("h1.main_title.entry-title").html() == "Registrations" && Main_abcoffee.current_lang() == "pt-PT"){
				$("h1.main_title.entry-title").html("Inscrições")
			}

			if($("h1.main_title.entry-title").html() == "Confirm Registration" && Main_abcoffee.current_lang() == "pt-PT"){
				$("h1.main_title.entry-title").html("Confirmar inscrição")
			}

		}
	},
	convert_dates_to_string_attract:function(selector){
		if($(selector).length > 0){
			
			var original_string = $(selector).html();
			if(original_string.includes(" ")){
				var response = original_string.split(" ");
			}else{
				var response = [original_string];
			}
			
			Main_abcoffee.convert_dates_to_string_append(response, selector);
		}
		
	},
	convert_dates_to_string_append:function(the_dates, where_to_append_selector){
		var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		if(Main_abcoffee.current_lang() == "pt-PT"){
			var months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];	
		}
		var days_array = [];
		var month_array = [];
		var year_array = [];
		$.each(the_dates, function(index, value){
			
			var date = new Date(value);
			var day = date.getDate();
			var month = months[date.getMonth()];
			var year = date.getFullYear();
			
			days_array.push(day);
			month_array.push(month);
			year_array.push(year);
			
		});
		
		
		
		var unique_days_array = $.unique(days_array);
		var unique_month_array = $.unique(month_array);
		var unique_year_array = $.unique(year_array);
		
		var final_date = unique_days_array.join(" ") + " " + unique_month_array.join("/") + " " + unique_year_array.join("/");
		
		$(where_to_append_selector).html(final_date);
	},
	current_lang:function(){
		return $("html").attr("lang");
	},
	trigger_nice_select:function(){
		if($(".calendar_filters_wrap").length > 0){
			$("#calendar_cat_filter, #calendar_level_filter, #calendar_tags_filter").niceSelect();
		}
	},
	setup_calendar_colors_on_filter:function(){
		var colors_arr = [];
		$("#calendar_tags_filter option").each(function(){
			$color = $(this).attr("data-background");
			colors_arr.push($color);
		});


		$(".nice-select.has_colors span").css("background", colors_arr[0]);
		$(".nice-select.has_colors .list li").each(function(index){
			
			var color = Main_abcoffee.choose_bg_color_by_font_color(colors_arr[index]);
			$(this).css({
				"background": colors_arr[index],
				"color": color
			});
			
		});
		
	},
	choose_bg_color_by_font_color:function(font_color){
		var rgb_arr = Main_abcoffee.hexToRgb(font_color),
			red = rgb_arr.r,
			green = rgb_arr.g,
			blue = rgb_arr.b;
		
		var L1 = L2 = red;
		if(green > L1){
			L1 = green;
		}
		if(blue > L1){
			L1 = blue;
		}
		if(green < L2){
			L2 = green;
		}
		if(blue < L2){
			L2 = blue;
		}
		var L = (L1 + 0.05) / (L2 + 0.05);

		if (L > 2){
			return "#ffffff";
		}else{
			return "#000000";
		}
	},
	hexToRgb:function(hex) {
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		} : null;
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
				description = $_this.find(".description").html(),
				availability = $_this.find(".availability p").html(),
				add_to_cart_href= $_this.attr("data-add-to-cart"),
				bg_color = $_this.attr("data-color");

			if(availability == undefined){
				availability = "Available";
				if(Main_abcoffee.current_lang() == "pt-PT"){
					availability = "Disponível";
				}
			}
			if(end != false){
				end = end + "T01:00:00";
			}

			var this_event = {
				classNames:bg_color,
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
					add_to_cart_href: add_to_cart_href,
					bg_color: bg_color
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
	get_locale:function(){
		var locale = "en";

		if(Main_abcoffee.current_lang() == "pt-PT"){
			var locale = "pt";
		}

		return locale;
	},
	trigger_calendar:function(events){
		var add_to_cart_text_button = "Add";
		if(Main_abcoffee.current_lang() == "pt-PT"){
			var add_to_cart_text_button = "Adicionar";
		}

		var calendarEl = document.getElementById('calendar');
	    var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'interaction', 'dayGrid' ],
			defaultDate: new Date(),
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: events,
			locale: Main_abcoffee.get_locale(),
			height: "auto",
			eventRender: function(info) {
			    var tooltip = new Tooltip(info.el, {
					template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip_header"><div class="tooltip_picture_wrap"><img src="'+ info.event.extendedProps.picture +'"></div><div class="tooltip-inner"></div></div><div class="event_footer"><div>' + info.event.extendedProps.variation_description + '</div><div>'+ info.event.extendedProps.availability +'</div></div><div class="event_info">' + info.event.extendedProps.info + '</div><a class="event_add_to_cart" href="'+info.event.extendedProps.add_to_cart_href+'">'+ add_to_cart_text_button +'</a></div>',
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
			var events = Main_abcoffee.get_events_array();
			Main_abcoffee.trigger_calendar(events);
		});

		Main_abcoffee.set_calendar_events_colors();
	},
	set_calendar_events_colors:function(){
		$("a.fc-day-grid-event").each(function(){
			var $_this = $(this),
				html_class = $_this.attr("class"),
				bg_color = "#fffff";

			if(html_class.includes("#")){
				bg_color = "#" + html_class.split("#")[1];
			}				
			
			var color = Main_abcoffee.choose_bg_color_by_font_color(bg_color);
			$(this).css({
				"background": bg_color,
				"color": color
			});
		});
	},
	set_calendar_next_prev_click_event:function(){
		$(".fc-prev-button, .fc-next-button").click(function(){
			Main_abcoffee.set_calendar_events_colors();
		});
	}
}

var $ = jQuery;
$(function(){
	Main_abcoffee.init();
});
$(window).load(function(){
	Main_abcoffee.setup_calendar_colors_on_filter();
});