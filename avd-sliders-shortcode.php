<?php
add_shortcode( 'avd_slideshow', 'avd_slideshow_Shortcode' );

function avd_slideshow_Shortcode( $attr, $content = null )
{
   extract(shortcode_atts(array(
		'count' => '',
		'sliderid' => '',
		'orderby' => 'menu_order',
		'order' => 'DESC',
	), $attr));
	$args = array( 
		'post_type' => 'slideshow',
		'posts_per_page' => intval($count),
        'post_status'=> 'publish',
		'orderby' => $orderby,
		'order' => $order,	
		'ignore_sticky_posts' =>1,
		'tax_query' => array(
			    array(
			    'taxonomy' => 'Sliders',
			    'field' => 'term_id',
			    'terms' => $sliderid
			     )
			  )
	);
    $slides = new WP_Query( $args ); 
?>
    
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 100%;max-width: none;">
  <div class="carousel-inner">
   <?php
     $c = 0;
     $class = '';
     if ($slides->have_posts()) :
	 while ($slides->have_posts()) : $slides->the_post(); 
     $c++;
     $class = ($c == 1) ? 'active' : '';
   ?>
      <div class="item <?= $class ?>">
        <img src="<?= get_the_post_thumbnail_url(); ?>" style="width:100%;">
      </div>
   <?php 
      endwhile;
	  endif;
	  wp_reset_query(); 
   ?>
      
  </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
 </div>
		
<?php } ?>
