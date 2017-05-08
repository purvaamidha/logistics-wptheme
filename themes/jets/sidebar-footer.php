<?php
/**
 * The Footer Sidebar
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */

?>
<?php if ( is_active_sidebar( 'newsletter' ) ) : ?>	
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					
						<?php dynamic_sidebar('newsletter'); ?>
				</div>
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' ) ||  is_active_sidebar( 'footer-3' ) ||  is_active_sidebar( 'footer-4' )  ) : ?>
<div class="footer-bottom">
	<div class="container">
		<div class="footer-bottom-inner row equal-height">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 border-right">
				
						<?php dynamic_sidebar('footer-1'); ?>
				
			</div>
			<?php endif; ?>				

			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 border-right space-padding-left-30">
				
						<?php dynamic_sidebar('footer-2'); ?>
				
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 space-padding-left-30">
				
						<?php dynamic_sidebar('footer-3'); ?>
				
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
				
						<?php dynamic_sidebar('footer-4'); ?>
				
			</div>
			<?php endif; ?>
		</div>
	</div>	
</div>
<?php endif; ?>
 