(function ($) {
	$(document).ready(function() {
		if ($(window).width() > 1200 && $(window).height() > 560){
		    $('#fullpage').fullpage({
		        anchors: ['firstbBlock', 'secondBlock', '3rdBlock', '4thBlock'],
				scrollOverflow: true, 
				ccs3:true,
				scrollingSpeed: 1100,
				anchors:['slider', 'community', 'lesson', 'footer', 'news'],
		    });
		    $(window).scroll(function(){
		    	if ($(this).scrollTop() > 1){
		    		$('.not-front .header').addClass('active');
		    		$('.not-front #page').addClass('active');
		    	} else {
		    		$('.not-front .header').removeClass('active');	
		    		$('.not-front #page').removeClass('active');	
		    	}
		    });
		}
		if ($(window).width() < 1200){
			$('.sf-parent-children-0').append('<div class="arrow_mob"></div>');
			$('.arrow_mob:not(.active)').click(function(){
				$('.arrow_mob').removeClass('active');
				$('.sf-parent-children-0').removeClass('active');
				$('.sf-parent-children-0').find('ul').removeClass('active');
				$(this).addClass('active');
				$(this).parents('.sf-parent-children-0').addClass('active');
				$(this).parents('.sf-parent-children-0').find('ul').addClass('active');
			});
			$('.arrow_mob.active').livequery('click',function(){
				$(this).removeClass('active');
				$('.sf-parent-children-0').removeClass('active');
				$('.sf-parent-children-0').find('ul').removeClass('active');
				$(this).parents('.sf-parent-children-0').removeClass('active');
				$(this).parents('.sf-parent-children-0').find('ul').removeClass('active');
			});
		}
		$('.menu_btn').click(function(){
			$(this).toggleClass('active');
			$('.block_superfish_2').toggleClass('active');
		});
		$('.view-catalog .item-list ul').each(function(){
			var countLi = $(this).find('.views-row').length;
			if (countLi > 1){
				$(this).parents('.item-list').addClass('parents');
			}
		});
		$('.node_accomodation .field-slideshow-pager').wrap('<div class="dots_wrap"></div>');
		$('.view-grouping-header').click(function(){
			$('.view-grouping-header').removeClass('active');
			$(this).toggleClass('active');
		});
		$('.view-catalog .item-list .views-row').each(function(){
			var label = $(this).find('.views-label-field-teacher').html();
			var h2 = $(this).find('h2').html();
			// if (label.length != 0 && h2.length != 0){
				$(this).find('.field-name-field-mt-photo').append('<div class="text_wrap"><div class="label">'+label+'</div><h2>'+h2+'</h2></div>');
				$(this).find('tr:nth-child(2) td:last-child').append('<div class="text_wrap"><div class="label">'+label+'</div><h2>'+h2+'</h2></div>');
			// }
		});
		$('.node_3023 .field-name-field-text-full .field-item').wrap('<div class="field_wrap"></div>');
		$('.footer-menu .leaf:nth-child(2) a').click(function(e){
			$('.block_webform_client_block_3001, .popup').fadeIn();
			$('#fullpage').addClass('active');
			e.preventDefault();
		});
		$('.footer-menu .leaf:nth-child(3) a').click(function(e){
			$('.block_webform_client_block_3000, .popup').fadeIn();
			$('#fullpage').addClass('active');
			e.preventDefault();
		});
		// console.log('true');
		$('.popup').click(function(){
			$('.block_webform_client_block_3000, .block_webform_client_block_3001, .popup').fadeOut();
			$('#fullpage').removeClass('active');
		});
		$('.webform-confirmation').livequery(function(){
		   setTimeout(function() { 
		   $('.links a').mousedown();
		   $('.popup').click(); 
		   }, 4000)
		});
		$('.fix-sidebar-second li span + ul').each(function(){
			$(this).parents('ul').addClass('parent');
		});
		$('.fix-sidebar-second .block_content > ul > li > span:not(.active)').livequery('click',function(){
			$('.fix-sidebar-second .block_content > ul > li > span').next().slideUp();
			$('.fix-sidebar-second .block_content > ul > li').removeClass('current');
			$('.fix-sidebar-second .block_content > ul > li > span.active').removeClass('active');
			$(this).addClass('active');
			$(this).next().slideDown();
			$(this).parents('li').addClass('current');
		});	
		$('.fix-sidebar-second .block_content > ul > li > span.active').livequery('click',function(){
			$('.fix-sidebar-second .block_content > ul > li > span.active').removeClass('active');
			$(this).next().slideUp();
			$(this).parents('li').removeClass('current');
		});	
		$('.fix-sidebar-second .block_content > ul > li .parent > li > span:not(.active)').livequery('click',function(){
			$('.fix-sidebar-second .block_content > ul > li .parent > li > span').next().slideUp();
			$('.fix-sidebar-second .block_content > ul > li .parent > li').removeClass('current');
			$('.fix-sidebar-second .block_content > ul > li .parent > li > span.active').removeClass('active');
			$(this).next().slideDown();
			$(this).parent('li').addClass('active');
			$(this).addClass('active');
		});	

		$('.fix-sidebar-second .block_content > ul > li .parent > li > span.active').livequery('click',function(){
			$('.fix-sidebar-second .block_content > ul > li .parent > li > span.active').removeClass('active');
			$(this).next().slideUp();
			$(this).parent('li').removeClass('active');
			$(this).removeClass('active');
		});	

		if( $('.view-calendar').length != 0){
			var pager = $('.view-calendar:first-child .view-header').html();
			$('.view-calendar:first-child .view-content').livequery(function(){
				$('<div class="view-header second_header">'+pager+'</div>').insertAfter($(this));
			});
			var pager2 = $('.view-calendar:nth-child(2) .view-header').html();
			$('.view-calendar:nth-child(2) .view-content').livequery(function(){
				$('<div class="view-header second_header">'+pager2+'</div>').insertAfter($(this));
			});
			var pager3 = $('.view-calendar:nth-child(3) .view-header').html();
			$('.view-calendar:nth-child(3) .view-content').livequery(function(){
				$('<div class="view-header second_header">'+pager2+'</div>').insertAfter($(this));
			});
			$('.view-calendar .view-content + .view-header .date-prev a').livequery('mousedown',function(e){
				e.preventDefault();
				$(this).parents('.view-calendar').find('.view-header:not(.second_header) .date-prev a').click();
			});
			$('.view-calendar .view-content + .view-header .date-next a').livequery('mousedown',function(e){
				e.preventDefault();
				$(this).parents('.view-calendar').find('.view-header:not(.second_header) .date-next a').click();
			});
		}
		$(window).scroll(function(){
			if ($(this).scrollTop() > 600){
				$('.to_up').addClass('active');
			} else {
				$('.to_up').removeClass('active');	
			}
		});
		$('.to_up').click(function(){
			$("html, body").animate({ scrollTop: 0 }, "1000");
		});
		$('.node-type-course .fix-sidebar-second .block_content a.active').livequery(function(){
			$(this).parents('.menu').slideDown(500).addClass('active');
			$(this).parents('li').addClass('current');
			$(this).parents('li').find('span').addClass('active');
		});
		$('.block_superfish_2 a.active').click(function(e){
			e.preventDefault();
		});
		$('.views-field-field-teacher').livequery(function(){
			var teacher = $(this).find('.node_teacher').length;
			if (teacher === 0){
				$(this).addClass('empty');
			}
		});
		$('.view-catalog .views-field-body').livequery(function(){
			var teacher = $(this).find('.field-content').text();
			console.log(teacher.length)
			if (teacher.length < 1){
				$(this).addClass('empty');
			}
		});
		$('.view-catalog .node_48').livequery(function(){
			$(this).parents('.item-list').addClass('parents_48');
		});
		$('.block_views_community_block_1 .views-row .views-field-field-community-link a').livequery(function(){
			var link = $(this).attr('href');
			$(this).parents('.views-row').find('.views-field-title a').attr('href', link);
		});
		$('.view-catalog table img').livequery(function(){
			$(this).parents('td').width(300);
		});
	});
})(jQuery);