<?php 

/* Template Name: Full Width Template */

get_header(); ?>

<div id="content">
  <div class="container">
    <?php
      while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', get_post_type());

        wp_link_pages(
          array(
            'before' => '<div class="fresh-bakers-pagination">',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>'
          )
        );
        comments_template();
      endwhile;
    ?>
  </div>
</div>

<?php get_footer(); ?>