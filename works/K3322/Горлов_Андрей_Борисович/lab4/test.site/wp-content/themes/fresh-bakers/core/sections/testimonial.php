<?php if ( get_theme_mod('fresh_bakers_testimonial_section_enable',false) ) : ?>

<?php $fresh_bakers_left_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('fresh_bakers_testimonial_category'),
  'posts_per_page' => get_theme_mod('fresh_bakers_testimonial_number'),
);

?>
	<div id="trending" class="py-5 mt-5">
		<div class="container">
	  		<div class="owl-carousel">
					<?php $fresh_bakers_arr_posts = new WP_Query( $fresh_bakers_left_args );
						$i=1;
				    if ( $fresh_bakers_arr_posts->have_posts() ) :
			      while ( $fresh_bakers_arr_posts->have_posts() ) :
		        $fresh_bakers_arr_posts->the_post(); ?>
		        <div class="trending_post mb-3">
		        	<div class="trending_image">
	                <?php
			            if ( has_post_thumbnail() ) :
			              the_post_thumbnail();
			            else:
			              ?>
			              <div class="slider-alternate">
			                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
			              </div>
			              <?php
			            endif;
				        ?>
							</div>
	        		<div class="post-content text-center p-3">
	    					<h3><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></h3>
	    					<p class="mb-0 client_box">
			        		<?php echo wp_trim_words(get_the_content(), 20); ?>
			        	</p>
	        		</div>
		        </div>
			    <?php
			    $i++;
			    endwhile;
			    wp_reset_postdata();
			    endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>