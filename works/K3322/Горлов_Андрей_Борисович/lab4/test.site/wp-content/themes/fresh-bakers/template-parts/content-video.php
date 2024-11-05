  <?php
  global $post;
  $post_author_id   = get_post_field( 'post_author', get_queried_object_id() );
  $fresh_bakers_get_post_column_layout = get_theme_mod( 'fresh_bakers_post_column_count', 2 );
  $fresh_bakers_post_column_layout = 'col-sm-12 col-md-6 col-lg-4';
  if ( $fresh_bakers_get_post_column_layout == 2 ) {
    $fresh_bakers_post_column_layout = 'col-lg-6 col-md-12';
  } else{
    $fresh_bakers_post_column_layout = 'col-sm-12 grid-layout';
  }
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;
  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<div class="<?php echo esc_attr($fresh_bakers_post_column_layout); ?> blog-grid-layout">
    <div id="post-<?php the_ID(); ?>" <?php post_class('post-box mb-4 p-3'); ?>>
         <?php
          if ( ! is_single() ) {
            // If not a single post, highlight the video file.
            if ( ! empty( $video ) ) {
              foreach ( $video as $video_html ) {
                echo '<div class="entry-video">';
                  echo $video_html;
                echo '</div>';
              }
            };
          };
        ?>
        <?php
        $fresh_bakers_archive_element_sortable = get_theme_mod('fresh_bakers_archive_element_sortable', array('option1', 'option2', 'option3'));
          foreach ($fresh_bakers_archive_element_sortable as $key => $value) {
            if($value === 'option1') { ?>
              <div class="post-meta my-3">
                <i class="far fa-user me-2"></i><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                <span class="ms-3"><i class="far fa-comments me-2"></i> <?php comments_number(esc_attr('0', 'fresh-bakers'), esc_attr('0', 'fresh-bakers'), esc_attr('%', 'fresh-bakers')); ?> <?php esc_html_e('comments', 'fresh-bakers'); ?></span>
              </div>
            <?php }
            if($value === 'option2') { ?>
              <h3 class="post-title mb-3 mt-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php }
            if($value === 'option3') { ?>
              <div class="post-content mb-2">
                <?php echo wp_trim_words(get_the_content(), get_theme_mod('fresh_bakers_post_excerpt_number', 15)); ?>
            </div>
            <?php }
          }
        ?>
    </div>
</div>