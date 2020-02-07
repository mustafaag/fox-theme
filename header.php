<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();</script>
    
	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>
<div id="wi-all">

    <div id="wi-wrapper">
        
        <div id="topbar-wrapper">
            <div class="wi-topbar" id="wi-topbar">
                <div class="container">

                    <div class="topbar-inner">

                        <?php if (has_nav_menu('primary')):?>

                        <a class="toggle-menu" id="toggle-menu"><i class="fa fa-align-justify"></i> <span><?php _e('Menu','wi');?></span></a>

                        <nav id="wi-mainnav" class="navigation-ele wi-mainnav" role="navigation">
                            <?php wp_nav_menu(array(
                                'theme_location'	=>	'primary',
                                'depth'				=>	3,
                                'container_class'	=>	'menu',
                                'walker'            =>  new wi_mainnav_walker(),
                            ));?>
                        </nav><!-- #wi-mainnav -->

                        <?php else: ?>

                        <?php echo '<div id="wi-mainnav"><em class="no-menu">'.sprintf(__('Go to <a href="%s">Appearance > Menu</a> to set "Primary Menu"','wi'),get_admin_url('','nav-menus.php')).'</em></div>'; ?>

                        <?php endif; ?>

                        <?php if (!get_theme_mod('wi_disable_header_social')):?>
                        <div id="header-social" class="social-list">
                            <ul>
                                <?php wi_social_list(!get_theme_mod('wi_disable_header_search')); ?>
                            </ul>
                        </div><!-- #header-social -->
                        <?php endif; // footer social ?>

                    </div><!-- .topbar-inner -->

                </div><!-- .container -->

            </div><!-- #wi-topbar -->
        </div><!-- #topbar-wrapper -->
        
        <header id="wi-header" class="wi-header">
            
            <div class="container">
                
                <?php if (!get_theme_mod('wi_disable_header_search')):?>
                <div class="header-search" id="header-search">
                    <form role="search" method="get" action="<?php echo home_url();?>">
                        <input type="text" name="s" class="s" value="<?php echo get_search_query();?>" placeholder="<?php _e('Type & hit enter...','wi');?>" />
                        <button class="submit" role="button" title="<?php _e('Go','wi');?>"><span><?php _e('Go','wi');?></span></button>
                    </form>
                </div><!-- .header-search -->
                <?php endif; ?>
                
                <div id="logo-area">
                    <div id="wi-logo">
                        <h2>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <?php if (!get_theme_mod('wi_logo')):?>

                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo" data-retina="<?php echo get_template_directory_uri(); ?>/images/logo@2x.png" />

                                <?php else: ?>

                                    <img src="<?php echo get_theme_mod('wi_logo');?>" alt="Logo"<?php echo get_theme_mod('wi_logo_retina') ? ' data-retina="'.get_theme_mod('wi_logo_retina').'"' : '';?> />

                                <?php endif; // logo ?>
                            </a>
                        </h2>

                    </div><!-- #wi-logo -->
                    
                    <?php if (!get_theme_mod('wi_disable_header_slogan') ):?>
                    <h3 class="slogan"><?php bloginfo('description');?></h3>
                    <?php endif; ?>
                    
                </div><!-- #logo-area -->
            
                <div class="clearfix"></div>
                
            </div><!-- .container -->
        </header><!-- #wi-header -->
    
        <div id="wi-main">