<?php if ( get_theme_mod('fresh_bakers_blog_box_enable',false) ) : ?>

<?php $fresh_bakers_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('fresh_bakers_blog_slide_category'),
  'posts_per_page' => get_theme_mod('fresh_bakers_blog_slide_number'),
); ?>

<div class="slider pb-5">
  <div class="slider-inner-banner">
    <div class="owl-carousel">
      <?php $fresh_bakers_arr_posts = new WP_Query( $fresh_bakers_args );
      $i = 1;
      if ( $fresh_bakers_arr_posts->have_posts() ) :
        while ( $fresh_bakers_arr_posts->have_posts() ) :
          $fresh_bakers_arr_posts->the_post();
          ?>
          <div class="sldier-box">
            <?php
              if ( has_post_thumbnail() ) :
                the_post_thumbnail();
              else:
                ?>
                <div class="slider-alternate">
                  <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/slide1.png'; ?>">
                </div>
                <?php
              endif;
            ?>
            <div class="slider-owl-position">
              <div class="container">
                <div class="row">
                  <div class="col-lg-7 col-md-6 align-self-center">
                    <div class="blog_box_inner">
                      <h3 class="m-0"><?php the_title(); ?></h3>
                      <p class="mb-4 content"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                      <p class="slider-button mb-0">
                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','fresh-bakers'); ?></a>
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-6 align-self-center text-center">
                    <?php if ( get_theme_mod('fresh_bakers_custmom_text' .$i) 
                    || get_theme_mod('fresh_bakers_slider_date_time_1' .$i) || get_theme_mod('fresh_bakers_slider_date_time_2' .$i)  ) : ?>
                      <div class="blog_inner_box">
                        <?php if ( get_theme_mod('fresh_bakers_custmom_text' .$i)) : ?>
                        <p class="timmer"><?php echo esc_html(get_theme_mod('fresh_bakers_custmom_text'.$i));?></p>
                        <?php endif; ?>
                        <?php if ( get_theme_mod('fresh_bakers_slider_date_time_1' .$i)) : ?>
                        <p class="timmer"><?php echo esc_html(get_theme_mod('fresh_bakers_slider_date_time_1'.$i));?></p>
                        <?php endif; ?>
                        <?php if ( get_theme_mod('fresh_bakers_slider_date_time_2' .$i)) : ?>
                        <p class="timmer"><?php echo esc_html(get_theme_mod('fresh_bakers_slider_date_time_2'.$i));?></p>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
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