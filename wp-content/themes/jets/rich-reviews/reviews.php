
<div class="opal-rich-reviews">
	<div class="opal-new-review">
      <div class="text-right">
          <a class="btn btn-primary" id="open-review-box"><?php esc_html_e('Write a Review','jets');?></a>
          <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
               	<span class="glyphicon glyphicon-remove"></span><?php esc_html_e('Cancel','jets');?>
               </a>
      </div>
      <div class="row" id="post-review-box" style="display:none;">
          <div class="col-md-12">
              <div class="review-form">
              		<span ><?php esc_html_e('WRITE A REVIEW','jets');?> </span>
              		<hr>
						<?php echo do_shortcode( '[RICH_REVIEWS_FORM]' ); ?>
				</div>
          </div>
      </div>
  </div> 

	<div class="opal-review">
		<?php
		$reviews = new RichReviews();
		$dbreviews = $reviews->db->get_average_rating('none');
		$rRating = "";
		$average = max(1,intval($dbreviews['average']));
		for ($i=1; $i<=$average; $i++) {
			$rRating .= '&#9733;'; // orange star
		}
		for ($i=$average+1; $i<=5; $i++) {
			$rRating .= '&#9734;'; // white star
		}
		?>
		<div class="stars">
			<?php echo $rRating; ?> <span class="txt-total"><?php echo $dbreviews['reviewsCount']; ?> <?php esc_html_e('Reviews','jets');?></span>
		</div>
	</div>
	<div class="opal-review-title">
     <hr>
     		<h4><?php esc_html_e('Site Reviews','jets');?></h4>
     	<hr>	
  </div>
	<div class="opal-review-item">
		<?php echo do_shortcode( '[RICH_REVIEWS_SHOW category="all" num="all"]' ); ?>
	</div>

</div>

