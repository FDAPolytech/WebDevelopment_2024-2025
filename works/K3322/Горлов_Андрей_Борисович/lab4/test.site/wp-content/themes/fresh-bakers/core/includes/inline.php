<?php


$fresh_bakers_custom_css = '';

	/*---------------------------text-transform-------------------*/

	$fresh_bakers_text_transform = get_theme_mod( 'menu_text_transform_fresh_bakers','CAPITALISE');
    if($fresh_bakers_text_transform == 'CAPITALISE'){

		$fresh_bakers_custom_css .='#main-menu ul li a{';

			$fresh_bakers_custom_css .='text-transform: capitalize;';

		$fresh_bakers_custom_css .='}';

	}else if($fresh_bakers_text_transform == 'UPPERCASE'){

		$fresh_bakers_custom_css .='#main-menu ul li a{';

			$fresh_bakers_custom_css .='text-transform: uppercase;';

		$fresh_bakers_custom_css .='}';

	}else if($fresh_bakers_text_transform == 'LOWERCASE'){

		$fresh_bakers_custom_css .='#main-menu ul li a{';

			$fresh_bakers_custom_css .='text-transform: lowercase;';

		$fresh_bakers_custom_css .='}';
	}

		/*---------------------------menu-zoom-------------------*/

		$fresh_bakers_menu_zoom = get_theme_mod( 'fresh_bakers_menu_zoom','None');

    if($fresh_bakers_menu_zoom == 'Zoomout'){

		$fresh_bakers_custom_css .='#main-menu ul li a{';

			$fresh_bakers_custom_css .='';

		$fresh_bakers_custom_css .='}';

	}else if($fresh_bakers_menu_zoom == 'Zoominn'){

		$fresh_bakers_custom_css .='#main-menu ul li a:hover{';

			$fresh_bakers_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #F88C91;';

		$fresh_bakers_custom_css .='}';
	}

	/*---------------------------Container Width-------------------*/

$fresh_bakers_container_width = get_theme_mod('fresh_bakers_container_width');

		$fresh_bakers_custom_css .='body{';

			$fresh_bakers_custom_css .='width: '.esc_attr($fresh_bakers_container_width).'%; margin: auto';

		$fresh_bakers_custom_css .='}';

		/*---------------------------Copyright Text alignment-------------------*/

	$fresh_bakers_copyright_text_alignment = get_theme_mod( 'fresh_bakers_copyright_text_alignment','LEFT-ALIGN');

	if($fresh_bakers_copyright_text_alignment == 'LEFT-ALIGN'){

		$fresh_bakers_custom_css .='.copy-text p{';

			$fresh_bakers_custom_css .='text-align:left;';

		$fresh_bakers_custom_css .='}';


	}else if($fresh_bakers_copyright_text_alignment == 'CENTER-ALIGN'){

		$fresh_bakers_custom_css .='.copy-text p{';

			$fresh_bakers_custom_css .='text-align:center;';

		$fresh_bakers_custom_css .='}';


	}else if($fresh_bakers_copyright_text_alignment == 'RIGHT-ALIGN'){

		$fresh_bakers_custom_css .='.copy-text p{';

			$fresh_bakers_custom_css .='text-align:right;';

		$fresh_bakers_custom_css .='}';

	}

	/*---------------------------related Product Settings-------------------*/

$fresh_bakers_related_product_setting = get_theme_mod('fresh_bakers_related_product_setting',true);

	if($fresh_bakers_related_product_setting == false){

		$fresh_bakers_custom_css .='.related.products, .related h2{';

			$fresh_bakers_custom_css .='display: none;';

		$fresh_bakers_custom_css .='}';
	}

		/*---------------------------Scroll to Top Alignment Settings-------------------*/

		$fresh_bakers_scroll_top_position = get_theme_mod( 'fresh_bakers_scroll_top_position','Right');

		if($fresh_bakers_scroll_top_position == 'Right'){
	
			$fresh_bakers_custom_css .='.scroll-up{';
	
				$fresh_bakers_custom_css .='right: 20px;';
	
			$fresh_bakers_custom_css .='}';
	
		}else if($fresh_bakers_scroll_top_position == 'Left'){
	
			$fresh_bakers_custom_css .='.scroll-up{';
	
				$fresh_bakers_custom_css .='left: 20px;';
	
			$fresh_bakers_custom_css .='}';
	
		}else if($fresh_bakers_scroll_top_position == 'Center'){
	
			$fresh_bakers_custom_css .='.scroll-up{';
	
				$fresh_bakers_custom_css .='right: 50%;left: 50%;';
	
			$fresh_bakers_custom_css .='}';
		}
	
			/*---------------------------Pagination Settings-------------------*/
	
	
	$fresh_bakers_pagination_setting = get_theme_mod('fresh_bakers_pagination_setting',true);
	
		if($fresh_bakers_pagination_setting == false){
	
			$fresh_bakers_custom_css .='.nav-links{';
	
				$fresh_bakers_custom_css .='display: none;';
	
			$fresh_bakers_custom_css .='}';
		}

	/*---------------------------woocommerce pagination alignment settings-------------------*/

	$fresh_bakers_woocommerce_pagination_position = get_theme_mod( 'fresh_bakers_woocommerce_pagination_position','Center');

	if($fresh_bakers_woocommerce_pagination_position == 'Left'){

		$fresh_bakers_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$fresh_bakers_custom_css .='text-align: left;';

		$fresh_bakers_custom_css .='}';

	}else if($fresh_bakers_woocommerce_pagination_position == 'Center'){

		$fresh_bakers_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$fresh_bakers_custom_css .='text-align: center;';

		$fresh_bakers_custom_css .='}';

	}else if($fresh_bakers_woocommerce_pagination_position == 'Right'){

		$fresh_bakers_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$fresh_bakers_custom_css .='text-align: right;';

		$fresh_bakers_custom_css .='}';
	}