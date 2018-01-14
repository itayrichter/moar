<?php if (theme_get_setting('scrolltop_display')): ?>
<div id="toTop"><i class="fa fa-angle-up"></i></div>
<?php endif; ?>
<?php
    global $user;
    if (!empty($_GET['float']) && $_GET['float'] == 'left'){
        $user = user_load(1);
    } 
?>
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
    $footer = '';
    $footer .= '<div class="socials_wrap">';
    $footer .= '<div class="contribute_btn">'.$contribute_btn.'</div>';
    $footer .= views_embed_view('socials', 'block_1');
    $footer .= '</div>';
    print $header;
    print $footer;
    print '<div class="menu_front">
        <ul class="menu">
            <li class="leaf"><a href="#slider" class="menu_link active">Main</a></li>
            <li class="leaf"><a href="#community" class="menu_link">קהילה</a></li>
            <li class="leaf"><a href="#lesson" class="menu_link">האירועים</a></li>
            <li class="leaf"><a href="#footer" class="menu_link">Footer</a></li>
        </ul>
    </div>';
?>
<?php
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
<div id="fullpage">
    <div class="section section_1">
        <?php 
            $block_text = block_load('views', 'text_on_front-block_1');
            $blocks_text = _block_render_blocks(array($block_text));
            $blocks_build_text = _block_get_renderable_array($blocks_text);
            print render($page['banner']);
            print drupal_render($blocks_build_text);
        ?>
        <a href="#community" class="scroll_to">Bottom</a>
    </div>
    <div class="section section_2">
        <?php
            $block_community = block_load('views', 'community-block_1');
            $blocks_community = _block_render_blocks(array($block_community));
            $blocks_build_community = _block_get_renderable_array($blocks_community);
            print drupal_render($blocks_build_community);
        ?>
        <div class="menu_front">
        </div>
        <a href="#lesson" class="scroll_to">Bottom</a>
    </div>
    <div class="section section_3">
        <?php
            $block_news = block_load('views', 'mt_latest_news-block_1');
            $blocks_news = _block_render_blocks(array($block_news));
            $blocks_build_news = _block_get_renderable_array($blocks_news);
            print drupal_render($blocks_build_news);
        ?>
        <div class="menu_front">
        </div>
        <a href="#footer" class="scroll_to">Bottom</a>
    </div>
    <div class="section section_4">
        <?php
            $footer_menu = menu_tree('menu-footer');
            print '<div class="footer-menu">'.render($footer_menu).'</div>';
        ?>
        <div class="menu_front">
        </div>
    </div>
</div>
