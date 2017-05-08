
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $service, $post;
$service = new Opalservice_Service( get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Property" <?php post_class(); ?>>
	<div class="row">
		<div class="col-lg-12">
			<?php
				/**
				 * opalservice_single_service_preview hook by template-functions.php
				 * @hooked opalservice_show_product_images - 10
				 * @hooked opalservice_show_product_images - 15
				 * @hooked opalservice_show_content - 20
				 */
				do_action( 'opalservice_single_service_content' );
			?>
		</div>
		 
	</div> <!-- //.row -->
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</article><!-- #post-## -->

