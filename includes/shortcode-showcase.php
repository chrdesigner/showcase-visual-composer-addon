<?php
function showcase_box($attributes, $content){
	
extract(shortcode_atts(	array(
	'title'=> __('Showcases', 'sc-carousel-vc-addon'),
	'show_content' => 'vc_below',
	'sc_lazyload' => 'false',
	'sc_loop_infinite' => 'false',
	'sc_order' => 'DESC',
	'post_count' => '4',
	'showcase_responsive' => 'false',
	'showcase_range' => '10',
	'auto_play' => 'true',
	'auto_play_timeout' => '8000',
	'pagination_speed' => '800',
	'stop_hover' => 'false',
	'navigation' => 'false',
	'pagination' => 'true',
	'pagination_numbers' => 'false',
	'image_thumbnail' => 'showcase-circle',
	'showcase_thumb' => '',
	'base_class' => '',
	'showcase_color_title' => '#333333',
	'showcase_size_title' => '30',
	'showcase_size_align_title' => 'left',
	'showcase_border_color' => '#F4F4F4',
	'showcase_border_width' => '6',
	'showcase_border_radius' => '0',
	'showcase_border_style' => 'solid',
	'showcase_bg_color' => '#FCFCFC',
	'sc_pagination' => 'false',
	'sc_title_next_prev' => 'false',
	'sc_thumb_next_prev' => 'false'
), $attributes));

ob_start();	

if( empty($showcase_thumb) ) : $showcase_thumb = 'thumb-brand-testimonial'; else : $showcase_thumb; endif;
if ($sc_order == 'rand'){ $value_order = 'orderby'; }else{ $value_order = 'order'; };

;?>

<script type="text/javascript">
	jQuery(document).ready(function($) {

		$.ajaxSetup({cache:false});

	 	$(".showcase-post-link").click(function(){
 			<?php if ($show_content == 'vc_floats' ){ ?>
 			$("body").prepend('<div id="single-showcase" class="row vc_floats"></div>');
 			$("body").addClass('vc-floats-fixed');
 			$("#single-showcase.vc_floats").wrap( '<div id="box_vc_floats"></div>');
			$("#single-showcase").after('<div id="overlay-vc-floats"></div>');
			<?php } ?>

			$( "#single-showcase" ).show();
	 		$('#showcase-carousel a.current').removeClass('current');
    		$(this).addClass('current');

    		$( "#showcase-carousel a" ).fadeTo( "fast", 0.33 );
			$( "#showcase-carousel a.showcase-post-link.current" ).fadeTo( "fast", 1 );

			var post_link = $(this).attr("href");
	        var post_id = $(this).attr("rel");
			    $("#single-showcase").html('<div class="vc_col-sm-12 vc_span12 row vc-loading">Loading...</div>');
			    $("#single-showcase").load( post_link , function() {<?php
			    if ($sc_pagination == 'false' ){ ?>
			    	$('.showcase-post-nav').remove();<?php
			    }
			    if ($sc_title_next_prev == 'false' ){ ?>
			    	$('.showcase-post-nav .showcase-arrows figcaption').remove();<?php
			    }
			    if ($sc_thumb_next_prev == 'false' ){ ?>
			    	$('.showcase-post-nav .showcase-arrows img').remove();<?php
			    } ?>
			    });
			return false;

		});

	});
</script>
<style type="text/css">
	.showcase-post-title{
		color: <?php echo $showcase_color_title;?>;
		font-size: <?php echo $showcase_size_title;?>px;
		text-align: <?php echo $showcase_size_align_title;?>;
	}
	#post-showcase{
		background-color: <?php echo $showcase_bg_color;?>;
		border: <?php echo $showcase_border_width . 'px ' . $showcase_border_style . ' ' . $showcase_border_color;?> ;
		border-radius: <?php echo $showcase_border_radius;?>px;
		-moz-border-radius: <?php echo $showcase_border_radius;?>px;
		-webkit-border-radius: <?php echo $showcase_border_radius;?>px;
	}
	.nav-showcase{
		background-color: <?php echo $showcase_border_color;?>;
		color: <?php echo $showcase_color_title;?>;
	}
	<?php if ($sc_pagination == 'false' ){ ?>
	.showcase-post-nav{
		display: none;
	}
	<?php } ; if ($sc_title_next_prev == 'false' ){ ?>
	.showcase-post-nav .showcase-arrows figcaption{
		display: none;
	}
	<?php }; if ($sc_thumb_next_prev == 'false' ){ ?>
	.showcase-post-nav .showcase-arrows img{
		display: none;
	}
	<?php } ?>
</style>

<div id="showcases" class="vc_col-sm-12 vc_span12 row " role="main">

	<?php if($show_content == 'vc_above') { ?>
	<div id="single-showcase" class="vc_col-sm-12 vc_span12 row"></div>
	<?php };?>
	
	<div id="showcase-carousel" class="vc_col-sm-12 vc_span12 row owl-carousel">
<?php
	$qParams = array( 'post_type' => 'showcases', $value_order => $sc_order, 'posts_per_page' => -1, 'caller_get_posts'=> 1 );	$wpbp = new WP_Query( $qParams );
	if ($wpbp->have_posts()) : 
		while ($wpbp->have_posts()) : $wpbp->the_post();
		if ( has_post_thumbnail() ) {
			$get_url_img_brand = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $showcase_thumb ); ?>
			<figure class="<?php echo $image_thumbnail;?> showcase-border">
				<a class="showcase-post-link stop" rel="<?php the_ID();?>" href="<?php the_permalink();?>" title="<?php the_title();?>">
					<img <?php if($sc_lazyload == 'true'){ ?>class="owl-lazy" data-src="<?php echo $get_url_img_brand[0];?>" data-src-retina="<?php echo $get_url_img_brand[0];?>"<?php }else{ ?>src="<?php echo $get_url_img_brand[0];?>"<?php } ;?> alt="<?php the_title();?>" title="<?php the_title();?>" />
				</a>
			</figure>
		<?php }
		endwhile;
	wp_reset_query();
	endif;
?>

	</div>
	
	<a class="play">Play</a>
	<a class="stop">Stop</a>

	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var owl = $('.owl-carousel');
		owl.owlCarousel({
			autoplay			: <?php echo $auto_play;?>,
			autoplayTimeout		: <?php echo $auto_play_timeout;?> ,
			autoplayHoverPause	: <?php echo $stop_hover;?>,
			autoplaySpeed		: <?php echo $pagination_speed;?>,
			loop				: <?php echo $sc_loop_infinite;?>,
			lazyLoad			: <?php echo $sc_lazyload;?>,
			responsiveClass		: <?php echo $showcase_responsive;?>,
			margin				: <?php echo $showcase_range;?>,
			items				: <?php echo $post_count;?>,
			dots				: <?php echo $pagination;?>,
			dotsEach			: <?php echo $pagination_numbers;?>,
			navRewind			: true,
			navSpeed			: <?php echo $pagination_speed;?>,
			nav					: <?php echo $navigation;?>,
			navText				: ["<?php _e( 'Previous', 'showcase-vc-addon' );?>", "<?php _e( 'Next', 'showcase-vc-addon' );?>"]
		});
		$('.play').on('click', function() {
			owl.trigger('play.owl.autoplay', [1000])
		})
		$('.stop').on('click', function() {
			owl.trigger('stop.owl.autoplay')
		})
    });
	</script>
	<?php if($show_content == 'vc_below') { ?>
	<div id="single-showcase" class="vc_col-sm-12 vc_span12 row"></div>
	<?php };?>

	
</div>

<?php 
$output = ob_get_contents();
ob_end_clean();	
return $output;
}

add_shortcode('sc_showcase_box', 'showcase_box');