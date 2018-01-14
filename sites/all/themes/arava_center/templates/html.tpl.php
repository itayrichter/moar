<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $GLOBALS['language']->language; ?>"> 
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
 </head>
 <body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $scripts; ?>
  <style>
  .view-courses-archive .ui-accordion .ui-accordion-content{
  padding:0px;
  }

  .view-courses-archive .ui-accordion .ui-accordion-header{
  color:#ffffff;
  background-color: #B63E3D;
  }

  .view-courses-archive table{
  margin: 5px 0px 5px 0px;
  }

  .view-courses-archive td.active{
  background-color: #BBBBBB;
  }
  </style>
  <script>
  jQuery(function($){
  	var _active = <?php print (arg(0) == 'teachings' && isset($_GET['title']) && $_GET['title']) ? 'true' : 'false'; ?>;
  	var opt = {
  				heightStyle: "content",
  				collapsible: true
  			};

  	if(!_active){
  		opt.active = false;
  	
  		jQuery(".view-courses-archive .views-table").each(function(index, item){
  			item = jQuery(item);
  			item.find(".views-field-title a").each(function(index2, item2){
  				if(jQuery(item2).hasClass("active")){
  				   opt.active = index;
  				   jQuery(item2).parent().addClass("active");
  				}
  			});
  		});
  	}

  	if($(".view-courses-archive .view-content").length > 0){
  		$(".view-courses-archive .view-content").accordion(opt);
  	}
  	
  	
  });
  </script>

  <style>
  .block-menu-menu-side-menu ul.menu li a{
  margin-bottom:1px;
  font-weight:bold;
  background-color:#E4E4E4;
  color:#B63E3D !important;
  padding-left:40px;
  padding-right:20px;
  font-size:16px;
  }

  .block-menu-menu-side-menu ul.menu li.level-1>a{
  background-color:#B63E3D;
  }

  .block-menu-menu-side-menu ul.menu li.level-2>a{
  background-color:#8a5463;
  }

  .block-menu-menu-side-menu ul.menu li.level-3>a{
  background-color:#9f6358;
  }

  .block-menu-menu-side-menu ul.menu li.level-4>a{
  background-color:#863729;
  }

  .block-menu-menu-side-menu ul.menu li.level-5>a{
  background-color:#b8858d;
  }

  .block-menu-menu-side-menu ul.menu li a:hover{
  color:#862527 !important;
  }

  .block-menu-menu-side-menu ul.menu li a.active-trail.active{
  background-color: #BBBBBB;
  }

  .block-menu-menu-side-menu ul.menu li.parent-menu > a:before{
  content:none;
  }

  .block-menu-menu-side-menu ul.menu li.parent-menu > a{
  background-image: url(/sites/all/themes/arava_center/Images/icon-close.png);
  background-repeat: no-repeat;
  background-position: 20px center;
  color: #FFFFFF !important;
  font-size:22px;
  }

  .block-menu-menu-side-menu ul.menu li.parent-menu.active-parent > a{
  background-image: url(/sites/all/themes/arava_center/Images/icon-open.png);
  color: #FFFFFF !important;
  }

  .block-menu-menu-side-menu ul.menu li.parent-menu ul{
  padding-left: 7px;
  padding-right: 7px;
  }

  .block-menu-menu-side-menu ul.menu ul.menu{
  display:none;
  }

  .block-menu-menu-side-menu ul.menu li.collapsed > a:before{
  display:none;
  }

  </style>
  <script>
  jQuery(function($){
  	$(".block-menu-menu-side-menu .content>ul.menu>li span").each(function(index, item){
  		var html = "<a href='#' class='"+$(item).attr('class')+"'>"+$(item).html()+"</a>";
  		$(item).after(html);
  		$(item).remove();
  	});
  	
  	$(".block-menu-menu-side-menu .content>ul.menu>li").addClass("parent-menu");
  	
  	$(".block-menu-menu-side-menu a").each(function(index, item){
  		item = $(item);
  		if(item.next().length > 0 && !item.parent().hasClass("parent-menu")){
  			item.parent().addClass("parent-menu");
  		}
  	});
  	
  	$(".block-menu-menu-side-menu li.parent-menu>a").click(function(){
  		if($(this).next().hasClass("active")){
  			$(this).next().removeClass("active").slideUp();
  			$(this).parent().removeClass("active-parent");
  			return false;
  		}
  		
  		$(this).parent().parent().children().each(function(index, item){
  			if($(item).hasClass('active-parent')){
  				$(item).removeClass('active-parent');
  				$(item).children('ul.menu').removeClass('active').slideUp();
  			}
  		});
  		
  		$(this).next().addClass("active").slideDown();
  		$(this).parent().addClass("active-parent");
  		
  		return false;
  	});
  	
  	$(".block-menu-menu-side-menu li.active-trail").each(function(){
  		var item = $(this);
  		item.parent().prev().click();
  	});
  	
  	var iterateMenuItem = function(ulMenu, level){
  		level = level % 5;
  		
  		ulMenu.children("li.parent-menu").each(function(index, item){
  			$(item).addClass('level-' + (level + 1));
  			iterateMenuItem($(item).children('ul.menu'), level + 1);
  		});
  	}
  	
  	iterateMenuItem($(".block-menu-menu-side-menu .content>ul.menu"), 0);
  });
  </script>
  <?php print $page_bottom; ?>
 </body>
</html>