<?php
	the_posts_pagination( array(
		'prev_text' => esc_html__( 'Previous page', 'fresh-bakers' ),
		'next_text' => esc_html__( 'Next page', 'fresh-bakers' ),
	) );