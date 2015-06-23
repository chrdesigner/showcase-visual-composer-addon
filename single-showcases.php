<?php
	$post = get_post($_POST['id']);
	
	global $post;
	
	$vc_showcase_facebook = get_post_meta(get_the_ID(), 'vc_showcase_facebook', true); 
	$vc_showcase_google_plus = get_post_meta(get_the_ID(), 'vc_showcase_google_plus', true); 
	$vc_showcase_linkedin = get_post_meta(get_the_ID(), 'vc_showcase_linkedin', true); 
	$vc_showcase_custom_link = get_post_meta(get_the_ID(), 'vc_showcase_custom_link', true); 

?>
<div id="post-showcase" class="row">
<?php while (have_posts()) : the_post();?>
	<section id="showcase-post-<?php the_ID(); ?>">
		<a id="showcase-closebtn">X</a>
		<article class="vc_col-sm-12 vc_span12 section-showcase">
		<?php
		if ( has_post_thumbnail() ) { echo '
			<figure class="vc_col-sm-4 vc_span4">
				' . get_the_post_thumbnail( get_the_ID(), 'brand-testimonial' , array('class' => 'showcase-brand')) . '
			</figure>
		';}
		?>
			<blockquote class="vc_col-sm-7 vc_span7">
		 		<h4 class="showcase-post-title"><?php the_title(); ?></h4>
		    	<div class="showcase-blog-detail">
		    	<?php

		    		the_content();
					
					if( !empty($vc_showcase_facebook) || !empty($vc_showcase_google_plus) || !empty($vc_showcase_linkedin) || !empty($vc_showcase_custom_link) ) : ?>
					<dl id="showcase-icons">
						<dt><?php _e('Links:', 'showcase-vc-addon');?></dt>
						<?php if( !empty($vc_showcase_facebook) ) : ?><dd class="sc-icon-link sc-icon-facebook"><?php echo '<a href="'.$vc_showcase_facebook.'" title="'.$vc_showcase_facebook.'" target="_blank">' . $vc_showcase_facebook . '</a>';?></dd><?php endif; ?>
						<?php if( !empty($vc_showcase_google_plus) ) : ?><dd class="sc-icon-link sc-icon-google-plus"><?php echo '<a href="'.$vc_showcase_google_plus.'" title="'.$vc_showcase_google_plus.'" target="_blank">' . $vc_showcase_google_plus . '</a>';?></dd><?php endif; ?>
						<?php if( !empty($vc_showcase_linkedin) ) : ?><dd class="sc-icon-link sc-icon-linkedin"><?php echo '<a href="'.$vc_showcase_linkedin.'" title="'.$vc_showcase_linkedin.'" target="_blank">' . $vc_showcase_linkedin . '</a>';?></dd><?php endif; ?>
						<?php if( !empty($vc_showcase_custom_link) ) : ?><dd class="sc-icon-link sc-icon-custom-link"><?php echo '<a href="'.$vc_showcase_custom_link.'" title="'.$vc_showcase_custom_link.'" target="_blank">' . $vc_showcase_custom_link . '</a>';?></dd><?php endif; ?>
					</dl><?php
					endif;
	    		?>
		    	</div>
	    	</blockquote>
	    	<div id="showcase-pagination" class="showcase-post-nav">
	    	<?php
		    	$p = get_adjacent_post(false, '', true);
		    	$src_p = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), thumbnail );
		    	if(!empty($p)) {  ?>
		    		<a href="<?php echo get_permalink($p->ID) ;?>" title="<?php $p->post_title ;?>" class="nav-showcase nav-left" rel="prev">
		    			<i>&#9668;</i>
		    			<figure class="showcase-arrows">
		    				<figcaption><?php echo $p->post_title;?></figcaption>
		    				<img src="<?php echo $src_p[0]; ?>" alt="<?php echo $p->post_title;?>" title="<?php echo $p->post_title;?>" />
		    			</figure>
		    		</a>
		    <?php };?>
			<?php
				$n = get_adjacent_post(false, '', false);
				$src_n = wp_get_attachment_image_src( get_post_thumbnail_id( $n->ID ), thumbnail );
				if(!empty($n)){ ?>
 					<a href="<?php echo get_permalink($n->ID);?>" title="<?php echo $n->post_title;?>" class="nav-showcase nav-right" rel="next">
 						<i>&#9658;</i>
 						<figure class="showcase-arrows">
 							<figcaption><?php echo $n->post_title ;?></figcaption>
 							<img src="<?php echo $src_n[0]; ?>" alt="<?php echo $n->post_title;?>" title="<?php echo $n->post_title;?>" />
 						</figure> 						
 						
 					</a>
				<?php
				}
			?>
			</div>
		</article>
		
	</section>
		
	<script id="showcase-pagination-js" type="text/javascript">
		jQuery(document).on('click', '#showcase-pagination a', function(e){  
			e.preventDefault();
		    var nav_link = jQuery(this).attr("href");	
		    jQuery("#single-showcase").html('<div class="vc_col-sm-12 vc_span12 row vc-loading">Loading...</div>');
		    jQuery("#single-showcase").load( nav_link );
		}); 
	</script>
	<?php

	echo sprintf( '<script type="text/javascript" src="%1$s"></script>', plugins_url('/assets/js/single.showcase.js' , __FILE__ ) );
	
endwhile; ?>
	
</div>