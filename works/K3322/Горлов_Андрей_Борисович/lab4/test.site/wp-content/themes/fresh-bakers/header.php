<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fresh-bakers' ); ?></a>

<?php if ( get_theme_mod('fresh_bakers_site_loader', false) == true ) : ?>
	<div class="cssloader">
    	<div class="sh1"></div>
    	<div class="sh2"></div>
    	<h1 class="lt"><?php esc_html_e( 'loading',  'fresh-bakers' ); ?></h1>
    </div>
<?php endif; ?>

<div class="<?php if( get_theme_mod( 'fresh_bakers_sticky_header', false) != '') { ?>sticky-header<?php } else { ?>close-sticky main-menus<?php } ?>">
	<header id="site-navigation">
		<div class="header-inner py-2">
			<div class="container">
				<div class="row m-0">
					<div class="col-xl-6 col-lg-5 col-md-12 align-self-center">
						<?php if ( get_theme_mod('fresh_bakers_header_inner_text')) : ?>
							<p class="mb-0 text-inner"><?php echo esc_html(get_theme_mod('fresh_bakers_header_inner_text'));?></p>
						<?php endif; ?>
					</div>
					<div class="col-xl-6 col-lg-7 col-md-12 align-self-center contact-box text-end">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-4 align-self-center">
								<?php if ( get_theme_mod('fresh_bakers_phone_number') ) : ?>
									<p class="mb-0 info-p"><i class="fas fa-phone me-2"></i><a href="tell:<?php echo esc_html(get_theme_mod('fresh_bakers_phone_number'));?>"><?php echo esc_html(get_theme_mod('fresh_bakers_phone_number'));?></a></p>
								<?php endif; ?>
							</div>
							<div class="col-lg-5 col-md-4 col-sm-4 align-self-center">
								<?php if ( get_theme_mod('fresh_bakers_email_id') ) : ?>
									<p class="mb-0 info-p"><i class="fas fa-envelope me-2"></i><a href="mailto:<?php echo esc_html(get_theme_mod('fresh_bakers_email_id'));?>"><?php echo esc_html(get_theme_mod('fresh_bakers_email_id'));?></a></p>
								<?php endif; ?>
							</div>
							<div class="col-lg-4 col-md-5 col-sm-4 align-self-center">
								<?php if ( get_theme_mod('fresh_bakers_location') ) : ?>
									<p class="mb-0 info-p"><i class="fas fa-map-marker-alt me-2"></i><?php echo esc_html(get_theme_mod('fresh_bakers_location'));?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-outter">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-12 menu-box">
						<button class="menu-toggle toggle-menu my-2 py-2 px-3" aria-controls="top-menu" aria-expanded="false" type="button">
							<span aria-hidden="true"><?php esc_html_e( 'Menu', 'fresh-bakers' ); ?></span>
						</button>
						<nav id="main-menu" class="close-panal main-menu">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'main-menu',
									'container' => 'false'
								));
							?>
							<button class="close-menu close-menu my-2 p-2" type="button">
								<span aria-hidden="true"><i class="fa fa-times"></i></span>
							</button>
						</nav>
					</div>
					<div class="col-lg-2 col-md-4 align-self-center">
						<div class="logo text-center text-center">
				    		<div class="logo-image">
				    			<?php the_custom_logo(); ?>
					    	</div>
					    	<div class="logo-content">
						    	<?php
						    		if ( get_theme_mod('fresh_bakers_display_header_title', true) == true ) :
							      		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
							      			echo esc_html(get_bloginfo('name'));
							      		echo '</a>';
							      	endif;

							      	if ( get_theme_mod('fresh_bakers_display_header_text', false) == true ) :
						      			echo '<span>'. esc_html(get_bloginfo('description')) . '</span>';
						      		endif;
					    		?>
							</div>
						</div>
					</div>
					<div class="col-lg-5 col-md-8 text-center text-md-end align-self-center">
						<div class="row">
							<?php if ( get_theme_mod('fresh_bakers_header_btn') || get_theme_mod('fresh_bakers_header_btn_link') ) : ?>
								<div class="col-lg-6 col-md-5 col-sm-5 col-9 align-self-center button-header">
									<a href="<?php echo esc_url(get_theme_mod('fresh_bakers_header_btn_link'));?>" class="mb-3 mb-md-0"><?php echo esc_html(get_theme_mod('fresh_bakers_header_btn'));?></a>
								</div>
							<?php endif; ?>
							<div class="col-lg-1 col-md-2 col-sm-2 col-3 text-center align-self-center">
								<?php if(class_exists('woocommerce')){ ?>
									<div class="cart-customlocation">
										<a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'View Shopping Cart','fresh-bakers' ); ?>"><i class="fas fa-shopping-bag"></i></a>
									</div>
								<?php }?>
							</div>
							<div class="col-lg-5 col-sm-5 col-sm-5 align-self-center">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
</div>