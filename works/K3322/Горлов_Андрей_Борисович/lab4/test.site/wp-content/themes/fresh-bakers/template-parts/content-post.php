<?php
  global $post;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-single mb-4'); ?>>
  <div class="post-content">
    <?php
      the_content();
      the_tags('<div class="post-tags"><strong>'.esc_html__('Tags:','fresh-bakers').'</strong> ', ', ', '</div>');
    ?>
  </div>
</div>