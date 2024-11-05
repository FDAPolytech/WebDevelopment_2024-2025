<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<div class="feature-header">
  <div class="feature-post-thumbnail">
    <div class="slider-alternate">
      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
    </div>
    <h1 class="post-title feature-header-title"><?php echo(esc_html_e('Archive Product Page','fresh-bakers')); ?></h1>
    <?php if ( get_theme_mod('fresh_bakers_breadcrumb_enable',true) ) : ?>
      <div class="bread_crumb text-center">
        <?php fresh_bakers_breadcrumb();  ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="container main-wrapper py-4 px-0">
	<main role="main" id="content">
		<div class="row m-0">
			<?php if(get_theme_mod('fresh_bakers_shop_page_layout', 'Right Sidebar') == 'Right Sidebar'){ ?>
				<div class="<?php if( get_theme_mod( 'fresh_bakers_shop_sidebar',true) != '') { ?>col-lg-8 col-md-8"<?php } else { ?>col-lg-12 col-md-12 <?php } ?>>
					<?php
						/**
						 * Hook: woocommerce_before_main_content.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 * @hooked WC_Structured_Data::generate_website_data() - 30
						 */
						do_action( 'woocommerce_before_main_content' );

						/**
						 * Hook: woocommerce_shop_loop_header.
						 *
						 * @since 8.6.0
						 *
						 * @hooked woocommerce_product_taxonomy_archive_header - 10
						 */
						do_action( 'woocommerce_shop_loop_header' );

						if ( woocommerce_product_loop() ) {

							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked woocommerce_output_all_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );

							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							/**
							 * Hook: woocommerce_no_products_found.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
						}

						/**
						 * Hook: woocommerce_after_main_content.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' ); ?>
				</div>
				<?php if(get_theme_mod('fresh_bakers_shop_sidebar',true)){ ?>			
					<div class="col-lg-4 col-md-4 col-sm-4">
						<?php
						/**
						 * Hook: woocommerce_sidebar.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
						?>
					</div>
				<?php } ?>
				<?php } elseif(get_theme_mod('fresh_bakers_shop_page_layout', 'Right Sidebar') == 'Left Sidebar'){ ?>
				<?php if(get_theme_mod('fresh_bakers_shop_sidebar',true)){ ?>			
					<div class="col-lg-4 col-md-4 col-sm-4">
						<?php
						/**
						 * Hook: woocommerce_sidebar.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
						?>
					</div>
				<?php } ?>
				<div class="<?php if( get_theme_mod( 'fresh_bakers_shop_sidebar',true) != '') { ?>col-lg-8 col-md-8"<?php } else { ?>col-lg-12 col-md-12 <?php } ?>>
						<?php
						/**
						 * Hook: woocommerce_before_main_content.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 * @hooked WC_Structured_Data::generate_website_data() - 30
						 */
						do_action( 'woocommerce_before_main_content' );

						/**
						 * Hook: woocommerce_shop_loop_header.
						 *
						 * @since 8.6.0
						 *
						 * @hooked woocommerce_product_taxonomy_archive_header - 10
						 */
						do_action( 'woocommerce_shop_loop_header' );

						if ( woocommerce_product_loop() ) {

							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked woocommerce_output_all_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );

							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							/**
							 * Hook: woocommerce_no_products_found.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
						}

						/**
						 * Hook: woocommerce_after_main_content.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' ); ?>
				</div>
			<?php } ?>
		</div>
	</main>
</div>
<?php
get_footer( 'shop' );