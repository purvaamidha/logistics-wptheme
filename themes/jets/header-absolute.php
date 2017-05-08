<?php
/**
 * The Header for our theme: Main Darker Background. Logo left + Main menu and Right sidebar. Below Category Search + Mini Shopping basket.
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site"><div class="opal-page-inner row-offcanvas row-offcanvas-left">
	<?php if ( get_header_image() ) : ?>
	<div id="site-header" class="hidden-xs hidden-sm">
		<a href="<?php echo esc_url( get_option('header_image_link','#') ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>
	
	<?php get_template_part( 'page-templates/parts/topbar', 'mobile' ); ?>
	<header id="opal-masthead" class="site-header header-absolute" role="banner">
	<?php get_template_part( 'page-templates/parts/topbar-v1' ); ?>	
	<div class="header-main clearfix <?php echo jets_fnc_theme_options('keepheader') ? 'has-sticky' : ''; ?>">
		<div class="container">
		<div class="logo-wrapper pull-left">
 			<?php  if( jets_fnc_theme_options('logo2') ):  ?>
				<div id="opal-logo" class="logo">
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				        <img src="<?php echo jets_fnc_theme_options('logo2'); ?>" alt="<?php bloginfo( 'name' ); ?>">
				    </a>
				</div>
			<?php else: ?>
			    <div id="opal-logo" class="logo logo-transparent">
			        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			             <img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" />
			        </a>
			    </div>
			<?php endif; ?>
		</div>
		<section id="opal-mainmenu" class="opal-mainmenu">		
			<div class="pull-right">
				
				<div class="opal-header-right pull-right hidden-xs hidden-sm">
					<div class="header-inner">
						<div class="pull-right text-light">
							<?php do_action( "jets_template_header_right" ); ?>
						</div>
						<div id="search-container" class="search-box-wrapper pull-right">
							<div class="opal-dropdow-search dropdown">
							  	<a data-target=".bs-search-modal-lg" data-toggle="modal" class="text-light search-focus btn dropdown-toggle dropdown-toggle-overlay"> 
					                <i class="fa fa-search"></i>     
					            </a>
					            <div class="modal fade bs-search-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
					              <div class="modal-dialog modal-lg">
					                <div class="modal-content">
					                    <div class="modal-header">
					                      <button aria-label="Close" data-dismiss="modal" class="close btn btn-sm btn-primary pull-right" type="button"><span aria-hidden="true">x</span></button>
					                      <h4 id="gridSystemModalLabel" class="modal-title"><?php esc_html_e( 'Search', 'jets' ); ?></h4>
					                    </div>
					                    <div class="modal-body">
					                      <?php get_template_part( 'page-templates/parts/search-overlay' ); ?>
					                    </div>
					                </div>
					              </div>
					            </div>
							</div>
						</div>

					</div>
				</div>
				<div class="inner navbar-mega-light pull-right"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
			</div>	
							
		</section>	
		</div>			
	</div>	
	</header><!-- #masthead -->	

	<?php do_action( 'jets_template_header_after' ); ?>
	
	<section id="main" class="site-main">
