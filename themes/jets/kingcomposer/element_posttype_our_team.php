<?php 
  $atts  = array_merge( array(
        'items'     => 8,
        'columns'   => 4,
        'title'     => 'Team Grid',
        'el_class'  => ''
    ), $atts); 
  extract( $atts );
  $query = wpopal_fnc_team_query( $atts ); 

  $_id = rand();
  $_count = $query->post_count;
?>
<?php if($query->have_posts()){ ?>
  <div class="team-collection">
    <div id="carousel-<?php echo esc_attr($_id); ?>" class="owl-carousel-play" data-ride="owlcarousel">
      <?php if( $_count > $columns ) {  ?>
      <a class="left carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
        <span class="fa fa-angle-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="next">
        <span class="fa fa-angle-right"></span>
      </a>
      <?php } ?>
      <div class="owl-carousel " data-slide="<?php echo esc_attr($columns); ?>" data-pagination="true" data-navigation="true">
        <?php $_count=0; while($query->have_posts()):$query->the_post(); ?>
          <div class="item">  

            <!-- start items -->
            <?php 
              $data = array( 'google', 'job', 'email', 'phone_number', 'facebook', 'twitter', 'pinterest' );
              $info = array();
              foreach( $data as $item ){
                $info[$item] =  get_post_meta( get_the_ID(), 'team_'.$item, true ); 
              } 
            ?>
            <div class="team-v1">
              <div class="team-header">
              <?php if( has_post_thumbnail() ): ?>
              
                <a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail('full', '', 'class="radius-x"');?> </a>
                 
              <?php endif;  ?>
              <div class="bo-social-icons">
                  <?php if( $info['facebook'] ){  ?>
                  <a class="bo-social-white radius-x" href="<?php echo esc_url( $info['facebook'] ); ?>"> <i  class="fa fa-facebook"></i> </a>
                    <?php } ?>
                  <?php if( $info['twitter'] ){  ?>
                  <a class="bo-social-white radius-x" href="<?php echo esc_url( $info['twitter'] ); ?>"><i  class="fa fa-twitter"></i> </a>
                  <?php } ?>
                  <?php if( $info['pinterest'] ){  ?>
                  <a class="bo-social-white radius-x" href="<?php echo esc_url( $info['pinterest'] ); ?>"><i  class="fa fa-pinterest"></i> </a>
                  <?php } ?>
                  <?php if( $info['google'] ){  ?>
                  <a class="bo-social-white radius-x" href="<?php echo esc_url( $info['google'] ); ?>"> <i  class="fa fa-google"></i></a>
                  <?php } ?>  
              </div>
              </div>
              <div class="team-body">
                <div class="team-body-content">
                  <h3 class="team-name"><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h3>
                  <p><?php echo esc_html( $info['job'] ); ?></p>
                </div> 
                
              </div>  
            </div>
            <!-- end items -->


          </div>
          <?php $_count++; ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
 <?php } ?>

<?php   wp_reset_postdata(); ?>