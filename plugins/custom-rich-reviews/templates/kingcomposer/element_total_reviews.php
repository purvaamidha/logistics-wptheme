<?php 
$atts  = array_merge( array(
	'description'=> '',
), $atts); 
extract( $atts );

$reviews = new RichReviews();
$dbreviews = $reviews->db->get_average_rating('none');
$rRating = "";
$average = max(1,intval($dbreviews['average']));
$percent = ($average / 5 * 100);
for ($i=1; $i<=$average; $i++) {
			$rRating .= '&#9733;'; // orange star
		}
		for ($i=$average+1; $i<=5; $i++) {
		$rRating .= '&#9734;'; // white star
	}
$link = !empty($link) ? $link : "#";
?>

<div class="total-review">
	<div  class="reviews-cirle">
		<div class="c100 p<?php echo esc_attr($percent) ;?> small orange">
			<span><?php echo esc_html($percent) ;?>%</span> 
			<div class="slice">
				<div class="bar"></div>
				<div class="fill"></div>
			</div>
		</div>
	</div>
	<div class="description"><a href="<?php echo get_home_url('/').'/'.$link;?>"><?php esc_html_e($description,'jets');?></a></div>
	<div class="stars">
		<?php echo esc_html($rRating); ?> 
	</div>
</div>

