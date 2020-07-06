<?php

	function impose_fonts_url()
	{
		global $impose_subset;
		$impose_subset  = '&subset=';
		$extra_char_set = false;
		$font_url       = "";
		
		if ( get_option( 'impose_char_set_latin', false ) ) { $impose_subset .= 'latin,'; $extra_char_set = true; }
		if ( get_option( 'impose_char_set_latin_ext', false ) ) { $impose_subset .= 'latin-ext,'; $extra_char_set = true; }
		if ( get_option( 'impose_char_set_cyrillic', false ) ) { $impose_subset .= 'cyrillic,'; $extra_char_set = true; }
		if ( get_option( 'impose_char_set_cyrillic_ext', false ) ) { $impose_subset .= 'cyrillic-ext,'; $extra_char_set = true; }
		if ( get_option( 'impose_char_set_greek', false ) ) { $impose_subset .= 'greek,'; $extra_char_set = true; }
		if ( get_option( 'impose_char_set_greek_ext', false ) ) { $impose_subset .= 'greek-ext,'; $extra_char_set = true; }
		if ( get_option( 'impose_char_set_vietnamese', false ) ) { $impose_subset .= 'vietnamese,'; $extra_char_set = true; }
		if ( $extra_char_set == false ) { $impose_subset = ""; } else { $impose_subset = substr( $impose_subset, 0, -1 ); }
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'impose' ) )
		{
			$font_url = add_query_arg(  'family',
										urlencode('Limelight|Lato:400,700|Poppins:300,400,500,600,700|Noto Sans:400,400italic,700,700italic' . $impose_subset),
										"//fonts.googleapis.com/css" );
		}
		
		return $font_url;
	}
	
	function impose_enqueue()
	{
		$theme_directory = get_template_directory_uri();
		
		wp_enqueue_style( 'impose-fonts', impose_fonts_url(), array(), '1.0.0' );
		wp_enqueue_style( 'bootstrap', $theme_directory . '/css/bootstrap.min.css', null, null );
		wp_enqueue_style( 'fontello', $theme_directory . '/css/fonts/fontello/css/fontello.css', null, null );
		wp_enqueue_style( 'magnific-popup', $theme_directory . '/js/jquery.magnific-popup/magnific-popup.css', null, null );
		wp_enqueue_style( 'fluidbox', $theme_directory . '/js/jquery.fluidbox/fluidbox.css', null, null );
		wp_enqueue_style( 'owl-carousel', $theme_directory . '/js/owl-carousel/owl.carousel.css', null, null );
		wp_enqueue_style( 'selection-sharer', $theme_directory . '/js/selection-sharer/selection-sharer.css', null, null );
		wp_enqueue_style( 'rotate-words', $theme_directory . '/css/rotate-words.css', null, null );
		wp_enqueue_style( 'impose-main', $theme_directory . '/css/main.css', null, null );
		wp_enqueue_style( 'impose-768', $theme_directory . '/css/768.css', null, null );
		wp_enqueue_style( 'impose-992', $theme_directory . '/css/992.css', null, null );
		wp_enqueue_style( 'impose-wp-fix', $theme_directory . '/css/wp-fix.css', null, null );
		wp_enqueue_style( 'impose-theme-style', get_stylesheet_uri(), null, null );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
		wp_enqueue_script( 'modernizr', $theme_directory . '/js/modernizr.min.js', array( 'jquery' ), null );
		wp_enqueue_script( 'fastclick', $theme_directory . '/js/fastclick.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'fitvids', $theme_directory . '/js/jquery.fitvids.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'viewport', $theme_directory . '/js/jquery.viewport.mini.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'waypoints', $theme_directory . '/js/jquery.waypoints.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jqueryvalidation', $theme_directory . '/js/jquery-validation/jquery.validate.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'imagesloaded', $theme_directory . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'isotope', $theme_directory . '/js/jquery.isotope.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'magnific-popup', $theme_directory . '/js/jquery.magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'fluidbox', $theme_directory . '/js/jquery.fluidbox/jquery.fluidbox.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'flexslider', $theme_directory . '/js/owl-carousel/owl.carousel.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'selection-sharer', $theme_directory . '/js/selection-sharer/selection-sharer.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'socialstream', $theme_directory . '/js/socialstream.jquery.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'collagePlus', $theme_directory . '/js/jquery.collagePlus/jquery.collagePlus.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'impose-main', $theme_directory . '/js/main.js', array( 'jquery' ), null, true );
	}
	
	function impose_after_setup_theme()
	{
		load_theme_textdomain( 'impose', get_template_directory() . '/languages' );
		
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
		
		register_nav_menus( array( 'impose_theme_menu_location' => esc_html__( 'Theme Navigation Menu', 'impose' ) ) );
		
		add_action( 'wp_enqueue_scripts', 'impose_enqueue' );
	}
	
	add_action( 'after_setup_theme', 'impose_after_setup_theme' );
	
	
	function impose_enqueue_admin()
	{
		wp_enqueue_style( 'impose-admin', get_template_directory_uri() . '/admin/admin.css' );
		wp_enqueue_style( 'thickbox' );
		
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
	}
	
	add_action( 'admin_enqueue_scripts', 'impose_enqueue_admin' );


/* ============================================================================================================================================= */


	function impose_pre_get_posts( $query )
	{
		$main_slider_activate = get_option( 'impose_main_slider_activate', 'no' );
		
		if (( $main_slider_activate == 'only_for_blog' ) || ( $main_slider_activate == 'for_all_archives' ))
		{
			$main_slider_sticky_posts = get_option( 'impose_main_slider_sticky_posts', 'exclude' );
			
			if ( $main_slider_sticky_posts != 'include' )
			{
				if ( ( $query->is_main_query() ) && ( ! is_admin() ) )
				{
					if ( is_home() || is_archive() )
					{
						$sticky_posts = get_option( 'sticky_posts' );
						$query->set( 'post__not_in', $sticky_posts );
					}
				}
			}
		}
	}
	
	add_action( 'pre_get_posts', 'impose_pre_get_posts' );


/* ============================================================================================================================================= */


	function impose_login_logo_url( $url )
	{
		return esc_url( home_url( '/' ) );
	}
	
	function impose_login_logo_title()
	{
		return get_bloginfo( 'name' );
	}
	
	function impose_login_logo()
	{
		$impose_logo_login_hide = get_option( 'impose_logo_login_hide', false );
		$impose_logo_login = get_option( 'impose_logo_login', "" );
		
		if ( $impose_logo_login_hide )
		{
			echo '<style type="text/css"> h1 { display: none; } </style>';
		}
		else
		{
			if ( $impose_logo_login != "" )
			{
				add_filter( 'login_headerurl', 'impose_login_logo_url' );
				add_filter( 'login_headertitle', 'impose_login_logo_title' );
				
				echo '<style type="text/css">
						h1 a {
							background-image: url( "' . esc_url( $impose_logo_login ) . '" ) !important;
						}
					</style>';
			}
		}
	}
	
	add_action( 'login_head', 'impose_login_logo' );


/* ============================================================================================================================================= */


	function impose_tinyplugin_register( $plugin_array )
	{
		$url = get_template_directory_uri() . '/admin/shortcode-generator.js';
		$plugin_array['tinyplugin'] = $url;
		return $plugin_array;
	}
	
	function impose_tinyplugin_add_button( $buttons )
	{
		array_push( $buttons, 'separator', 'tinyplugin' );
		return $buttons;
	}
	
	add_filter( 'mce_external_plugins', 'impose_tinyplugin_register' );
	add_filter( 'mce_buttons', 'impose_tinyplugin_add_button', 0 );


/* ============================================================================================================================================= */


	function impose_wp_title( $title, $sep )
	{
		global $paged, $page;
		
		if ( is_feed() )
		{
			return $title;
		}
		
		$title .= get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		
		if ( $site_description && ( is_home() || is_front_page() ) )
		{
			$title = "$title $sep $site_description";
		}
		
		if ( $paged >= 2 || $page >= 2 )
		{
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'impose' ), max( $paged, $page ) );
		}
		
		return $title;
	}
	
	add_filter( 'wp_title', 'impose_wp_title', 10, 2 );


/* ============================================================================================================================================= */


	add_image_size( 'impose_image_size_1', 1440 ); // (No Sidebar): blog-regular, single-post, gallery-type-slider, gallery-type-grid, main-slider-item-1, 1st-full, blog-bold, bog-waterfall-no-sidebar(1st post)
	add_image_size( 'impose_image_size_2', 800 ); // (With Sidebar): blog-regular, single-post, gallery-type-slider, main-slider-item-2, 1st-full, blog-bold, bog-waterfall-no-sidebar(2-3rd post), bog-waterfall-with-sidebar(1st post)
	add_image_size( 'impose_image_size_3', 550 ); // blog-grid-masonry, related-posts, main-slider-item-3+, bog-waterfall-no-sidebar(4+. post), bog-waterfall-with-sidebar(2+. post), homepage
	add_image_size( 'impose_image_size_4', 550, 362, true ); // blog-grid-fitRows, blog-creative(with or without sidebar)
	add_image_size( 'impose_image_size_5', 1920 ); // magnific-popup-width
	add_image_size( 'impose_image_size_6', null, 1080 ); // magnific-popup-height
	add_image_size( 'impose_image_size_7', null, 600 ); // gallery-type-grid
	add_image_size( 'impose_image_size_8', 550, 550, true ); // blog-list
	
	if ( ! isset( $content_width ) )
	{
		$content_width = 658;
	}


/* ============================================================================================================================================= */


	function impose_post_column_add( $columns )
	{
		return array_merge( $columns, array( 'impose_post_feat_img' => esc_html__( 'Featured Image', 'impose' ) ) );
	}
	
	add_filter( 'manage_posts_columns' , 'impose_post_column_add' );
	
	
	function impose_post_column_show( $column, $post_id )
	{
		if ( $column == 'impose_post_feat_img' )
		{
			the_post_thumbnail( 'thumbnail' );
		}
	}
	
	add_action( 'manage_posts_custom_column' , 'impose_post_column_show', 10, 2 );


/* ============================================================================================================================================= */


	/*
		To override this walker in a child theme without modifying the comments template
		simply create your own impose_theme_comments(), and that function will be used instead.
		
		Used as a callback by wp_list_comments() for displaying the comments.
	*/
	
	function impose_theme_comments( $comment, $args, $depth )
	{
		$GLOBALS['comment'] = $comment;
		
		
		switch ( $comment->comment_type )
		{		
			case 'pingback' :
			
			case 'trackback' :
			
				?>
					<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
						<p>
							<?php
								esc_html_e( 'Pingback:', 'impose' );
							?>
							
							<?php
								comment_author_link();
							?>
							
							<?php
								edit_comment_link( esc_html__( '(Edit)', 'impose' ), '<span class="edit-link">', '</span>' );
							?>
						</p>
				<?php
			
			break;
			
			default :
			
				global $post;
				
				?>
					<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
						<article id="comment-<?php comment_ID(); ?>" class="comment">
							<header class="comment-meta comment-author vcard">
								<?php
									echo get_avatar( $comment, 132 );
								?>
								
								<cite class="fn">
									<?php
										echo get_comment_author_link();
									?>
									
									<?php
										if ( $comment->user_id === $post->post_author )
										{
											?>
												<i>- <?php esc_html_e( 'Site Author', 'impose' ); ?></i>
											<?php
										}
									?>
								</cite>
								
								<span class="comment-date">
									<?php
										echo get_comment_date();
									?>
									
									<?php
										esc_html_e( 'at', 'impose' );
									?>
									
									<?php
										echo get_comment_time();
									?>
									
									<?php
										edit_comment_link( esc_html__( 'Edit', 'impose' ), '<span class="comment-edit-link">', '</span>' );
									?>
								</span>
							</header>
							
							<section class="comment-content comment">
								<?php
									if ( '0' == $comment->comment_approved )
									{
										?>
											<p class="comment-awaiting-moderation">
												<?php
													esc_html_e( 'Your comment is awaiting moderation.', 'impose' );
												?>
											</p>
										<?php
									}
								?>
								
								<?php
									comment_text();
								?>
							</section>
							
							<div class="reply">
								<?php
									comment_reply_link( array_merge($args,
																	array(  'reply_text' => esc_html__( 'Reply', 'impose' ),
																			'after'      => ' <span>&#8595;</span>',
																			'depth'      => $depth,
																			'max_depth'  => $args['max_depth'] ) ) );
								?>
							</div>
						</article>
				<?php
			
			break;
		}
	}


/* ============================================================================================================================================= */
/* ============================================================================================================================================= */


	class impose_Flickr_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('impose_flickr_widget',
								esc_html__( '- Flickr', 'impose' ),
								array( 'description' => esc_html__( 'Flickr widget.', 'impose' ) ) );
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = ""; }
			if ( isset( $instance[ 'impose_user' ] ) ) { $impose_user = $instance[ 'impose_user' ]; } else { $impose_user = ""; }
			if ( isset( $instance[ 'impose_number_of_items' ] ) ) { $impose_number_of_items = $instance[ 'impose_number_of_items' ]; } else { $impose_number_of_items = '8'; }
			
			?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
						<?php
							echo esc_html__( 'Title:', 'impose' );
						?>
					</label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('impose_user') ); ?>">
						<?php
							echo esc_html__( 'User:', 'impose' );
						?>
					</label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('impose_user') ); ?>" name="<?php echo esc_attr( $this->get_field_name('impose_user') ); ?>" value="<?php echo esc_attr( $impose_user ); ?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('impose_number_of_items') ); ?>">
						<?php
							echo esc_html__( 'Number of items to show:', 'impose' );
						?>
					</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id('impose_number_of_items') ); ?>" name="<?php echo esc_attr( $this->get_field_name('impose_number_of_items') ); ?>" size="3" value="<?php echo esc_attr( $impose_number_of_items ); ?>">
				</p>
			<?php
		}
		
		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['impose_user'] = strip_tags( $new_instance['impose_user'] );
			$instance['impose_number_of_items'] = strip_tags( $new_instance['impose_number_of_items'] );
			
			return $instance;
		}
		
		public function widget( $args, $instance )
		{
			extract( $args );
			$title = apply_filters( 'widget_title', $instance['title'] );
			$impose_user = apply_filters( 'impose_user', $instance['impose_user'] );
			$impose_number_of_items = apply_filters( 'impose_number_of_items', $instance['impose_number_of_items'] );
			
			echo $before_widget;
			
				if ( ! empty( $title ) )
				{
					echo $before_title . $title . $after_title;
				}
				
				?>
					<div class="flickr-badges flickr-badges-s">
						<script src="http://www.flickr.com/badge_code_v2.gne?size=s&amp;count=<?php echo esc_attr( $impose_number_of_items ); ?>&amp;display=random&amp;layout=x&amp;source=user&amp;user=<?php echo esc_attr( $impose_user ); ?>"></script>
					</div>
				<?php
			
			echo $after_widget;
		}
	}
	
	add_action('widgets_init', function() { register_widget('impose_Flickr_Widget'); });


/* ============================================================================================================================================= */


	class impose_Social_Feed_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('impose_social_feed_widget',
								esc_html__( '- Social Feed', 'impose' ),
								array( 'description' => esc_html__( 'Social feed widget.', 'impose' ) ) );
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = ""; }
			if ( isset( $instance[ 'impose_network' ] ) ) { $impose_network = $instance[ 'impose_network' ]; } else { $impose_network = ""; }
			if ( isset( $instance[ 'impose_user' ] ) ) { $impose_user = $instance[ 'impose_user' ]; } else { $impose_user = ""; }
			if ( isset( $instance[ 'impose_number_of_items' ] ) ) { $impose_number_of_items = $instance[ 'impose_number_of_items' ]; } else { $impose_number_of_items = '8'; }
			
			?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
						<?php
							echo esc_html__('Title:', 'impose');
						?>
					</label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('impose_network') ); ?>">
						<?php
							echo esc_html__('Network:', 'impose');
						?>
					</label>
					<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('impose_network') ); ?>" name="<?php echo esc_attr( $this->get_field_name('impose_network') ); ?>">
						<option></option>
						<option <?php if ( $impose_network == 'pinterest' ) { echo 'selected="selected"'; } ?> value="pinterest">Pinterest</option>
						<option <?php if ( $impose_network == 'picasa' ) { echo 'selected="selected"'; } ?> value="picasa">Picasa</option>
					</select>
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('impose_user') ); ?>">
						<?php
							echo esc_html__( 'User:', 'impose' );
						?>
					</label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('impose_user') ); ?>" name="<?php echo esc_attr( $this->get_field_name('impose_user') ); ?>" value="<?php echo esc_attr( $impose_user ); ?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('impose_number_of_items') ); ?>">
						<?php
							echo esc_html__('Number of items to show:', 'impose');
						?>
					</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id('impose_number_of_items') ); ?>" name="<?php echo esc_attr( $this->get_field_name('impose_number_of_items') ); ?>" size="3" value="<?php echo esc_attr( $impose_number_of_items ); ?>">
				</p>
			<?php
		}
		
		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['impose_network'] = strip_tags( $new_instance['impose_network'] );
			$instance['impose_user'] = strip_tags( $new_instance['impose_user'] );
			$instance['impose_number_of_items'] = strip_tags( $new_instance['impose_number_of_items'] );
			
			return $instance;
		}
		
		public function widget( $args, $instance )
		{
			extract( $args );
			$title = apply_filters( 'widget_title', $instance['title'] );
			$impose_network = apply_filters( 'impose_network', $instance['impose_network'] );
			$impose_user = apply_filters( 'impose_user', $instance['impose_user'] );
			$impose_number_of_items = apply_filters( 'impose_number_of_items', $instance['impose_number_of_items'] );
			
			echo $before_widget;
			
				if ( ! empty( $title ) )
				{
					echo $before_title . $title . $after_title;
				}
				
				?>
					<div class="social-feed" data-social-network="<?php echo esc_attr( $impose_network ); ?>" data-username="<?php echo esc_attr( $impose_user ); ?>" data-limit="<?php echo esc_attr( $impose_number_of_items ); ?>"></div>
				<?php
			
			echo $after_widget;
		}
	}
	
	add_action('widgets_init', function() { register_widget('impose_Social_Feed_Widget'); });


/* ============================================================================================================================================= */
/* ============================================================================================================================================= */


	function impose_gallery_type__slider( $atts )
	{
		extract( shortcode_atts( array( 'ids'     => "",
										'orderby' => "",
										'link'    => "",
										'size'    => 'thumbnail' ), $atts ) );
		
		$output = "";
		$items_with_commas = $ids;
		
		if ( $items_with_commas != "" )
		{
			$items_in_array = preg_split( "/[\s]*[,][\s]*/", $items_with_commas );
			
			if ( $orderby == 'rand' )
			{
				shuffle( $items_in_array );
			}
			
			$output .= '<div class="owl-carousel" data-items="1" data-loop="true" data-center="false" data-mouse-drag="true" data-nav="true" data-dots="true" data-autoplay="false" data-autoplay-speed="600" data-autoplay-timeout="2000">';
			
				if ( isset( $_GET['sidebar'] ) )
				{
					if ( $_GET['sidebar'] == 'no' )
					{
						$size = 'impose_image_size_1';
					}
					else
					{
						$size = 'impose_image_size_2';
					}
				}
				else
				{
					if ( is_page_template( 'template-full_width_page.php' ) )
					{
						$size = 'impose_image_size_5';
					}
					elseif ( is_page_template( 'template-page_with_sidebar.php' ) )
					{
						$size = 'impose_image_size_2';
					}
					elseif ( is_singular( 'page' ) )
					{
						$size = 'impose_image_size_1';
					}
					elseif ( is_singular() )
					{
						$post_sidebar = get_option( 'impose_post_sidebar', 'Yes' );
						
						if ( $post_sidebar == 'No' )
						{
							$size = 'impose_image_size_1';
						}
						else
						{
							$size = 'impose_image_size_2';
						}
					}
					else
					{
						$blog_sidebar = get_option( 'impose_blog_sidebar', 'Yes' );
						
						if ( $blog_sidebar == 'No' )
						{
							$size = 'impose_image_size_1';
						}
						else
						{
							$size = 'impose_image_size_2';
						}
					}
				}
				
				foreach ( $items_in_array as $item )
				{
					$image = wp_get_attachment_image_src( $item, $size );
					$image_alt = get_post_meta( $item, '_wp_attachment_image_alt', true );
					$image_caption = get_post_field( 'post_excerpt', $item );
					
					if ( $image_caption != "" )
					{
						$image_caption = '<p class="owl-title">' . $image_caption . '</p>';
					}
					
					$output .= '<div><img alt="' . esc_attr( $image_alt ) . '" src="' . esc_url( $image[0] ) . '">' . $image_caption . '</div>';
				}
			
			$output .= '</div>';
		}
		
		return $output;
	}
	
	
	function impose_gallery_type__grid( $atts )
	{
		extract( shortcode_atts( array( 'ids'     => "",
										'orderby' => "",
										'link'    => "",
										'size'    => 'thumbnail' ), $atts ) );
		
		$output = "";
		$items_with_commas = $ids;
		
		if ( $items_with_commas != "" )
		{
			$items_in_array = preg_split( "/[\s]*[,][\s]*/", $items_with_commas );
			
			if ( $orderby == 'rand' )
			{
				shuffle( $items_in_array );
			}
			
			$output .= '<div class="gallery ' . ( ( $link == "" ) ? 'link-to-attachment-page' : 'link-to-' . $link ) . '">';
			
				foreach ( $items_in_array as $item )
				{
					$image_big_width_cropped = wp_get_attachment_image_src( $item, 'impose_image_size_5' );
					$image_big = "";
					
					if ( $image_big_width_cropped[1] > $image_big_width_cropped[2] )
					{
						$image_big = $image_big_width_cropped[0];
					}
					else
					{
						$image_big_height_cropped = wp_get_attachment_image_src( $item, 'impose_image_size_6' );
						$image_big = $image_big_height_cropped[0];
					}
					
					$image_small = "";
					
					if ($size == 'full')
					{
						$image_small = wp_get_attachment_image_src( $item, 'impose_image_size_1' ); // gallery-type-grid
					}
					else
					{
						$image_small = wp_get_attachment_image_src( $item, 'impose_image_size_7' ); // gallery-type-grid
					}
					
					$image_alt = get_post_meta( $item, '_wp_attachment_image_alt', true );
					$image_caption = get_post_field( 'post_excerpt', $item );
					
					if ( $link == 'file' )
					{
						if ( $image_caption != "" )
						{
							$image_caption = '<figcaption class="wp-caption-text gallery-caption">' . $image_caption . '</figcaption>';
						}
						
						$output .= '<figure class="gallery-item">';
						$output .= '<div class="gallery-icon landscape">';
						$output .= '<a href="' . esc_url( $image_big ) . '">';
						$output .= '<img class="attachment-thumbnail" alt="' . esc_attr( $image_alt ) . '" src="' . esc_url( $image_small[0] ) . '">';
						$output .= '</a>';
						$output .= '</div>';
						$output .= $image_caption;
						$output .= '</figure>';
					}
					elseif ( $link == 'none' )
					{
						if ( $image_caption != "" )
						{
							$image_caption = '<figcaption class="wp-caption-text gallery-caption">' . $image_caption . '</figcaption>';
						}
						
						$output .= '<figure class="gallery-item">';
						$output .= '<div class="gallery-icon landscape">';
						$output .= '<img class="attachment-thumbnail" alt="' . esc_attr( $image_alt ) . '" src="' . esc_url( $image_small[0] ) . '">';
						$output .= '</div>';
						$output .= $image_caption;
						$output .= '</figure>';
					}
					else
					{
						$attachment_page = get_attachment_link( $item );
						
						if ( $image_caption != "" )
						{
							$image_caption = '<figcaption class="wp-caption-text gallery-caption">' . $image_caption . '</figcaption>';
						}
						
						$output .= '<figure class="gallery-item">';
						$output .= '<div class="gallery-icon landscape">';
						$output .= '<a href="' . esc_url( $attachment_page ) . '">';
						$output .= '<img class="attachment-thumbnail" alt="' . esc_attr( $image_alt ) . '" src="' . esc_url( $image_small[0] ) . '">';
						$output .= '</a>';
						$output .= '</div>';
						$output .= $image_caption;
						$output .= '</figure>';
					}
				}
			
			$output .= '</div>';
		}
		
		return $output;
	}
	
	
	function impose_post_gallery( $output = "", $atts, $content = false, $tag = false )
	{
		$new_output = $output;
		
		$gallery_type = get_option( 'impose_gallery_type' . '__' . get_the_ID(), 'grid' );
		
		if ( $gallery_type == 'slider' )
		{
			$new_output = impose_gallery_type__slider( $atts );
		}
		else
		{
			$new_output = impose_gallery_type__grid( $atts );
		}
		
		return $new_output;
	}
	
	add_filter( 'post_gallery', 'impose_post_gallery', 10, 4 );


/* ============================================================================================================================================= */


	register_sidebar( array('name'          => esc_html__( 'Blog Sidebar', 'impose' ),
							'id'            => 'impose_sidebar_1',
							'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Post Sidebar', 'impose' ),
							'id'            => 'impose_sidebar_2',
							'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Page Sidebar', 'impose' ),
							'id'            => 'impose_sidebar_3',
							'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Header Social Icons', 'impose' ),
							'id'            => 'impose_sidebar_4',
							'description'   => esc_html__( 'Use social icon shortcodes with the "Custom HTML" widget.', 'impose' ),
							'before_widget' => "",
							'after_widget'  => "",
							'before_title'  => '<span style="display: none;">',
							'after_title'   => '</span>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Author Social Icons', 'impose' ),
							'id'            => 'impose_sidebar_8',
							'description'   => esc_html__( 'Use social media shortcodes with the Text widget here.', 'impose' ),
							'before_widget' => "",
							'after_widget'  => "",
							'before_title'  => '<span style="display: none;">',
							'after_title'   => '</span>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Footer Social Icons', 'impose' ),
							'id'            => 'impose_sidebar_5',
							'description'   => esc_html__( 'Use social media shortcodes with the Text widget here.', 'impose' ),
							'before_widget' => "",
							'after_widget'  => "",
							'before_title'  => '<span style="display: none;">',
							'after_title'   => '</span>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Footer Instagram', 'impose' ),
							'id'            => 'impose_sidebar_6',
							'description'   => esc_html__( 'Use Social Feed widget here.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Footer 1', 'impose' ),
							'id'            => 'impose_sidebar_9',
							'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Footer 2', 'impose' ),
							'id'            => 'impose_sidebar_10',
							'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Footer 3', 'impose' ),
							'id'            => 'impose_sidebar_11',
							'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>' ) );
	
	
	register_sidebar( array('name'          => esc_html__( 'Footer Copyright Text', 'impose' ),
							'id'            => 'impose_sidebar_7',
							'description'   => esc_html__( 'Use Text widget here.', 'impose' ),
							'before_widget' => "",
							'after_widget'  => "",
							'before_title'  => '<span style="display: none;">',
							'after_title'   => '</span>' ) );
	
	
	$impose_sidebars_with_commas = get_option( 'impose_sidebars_with_commas' );
	
	if ( $impose_sidebars_with_commas != "" )
	{
		$sidebars = preg_split("/[\s]*[,][\s]*/", $impose_sidebars_with_commas);
		
		foreach ( $sidebars as $sidebar_name )
		{
			register_sidebar( array('name'          => $sidebar_name,
									'id'            => $sidebar_name,
									'description'   => esc_html__( 'Add one or more widget.', 'impose' ),
									'before_widget' => '<aside id="%1$s" class="widget %2$s">',
									'after_widget'  => '</aside>',
									'before_title'  => '<h3 class="widget-title">',
									'after_title'   => '</h3>' ) );
		}
	}


/* ============================================================================================================================================= */
/* ============================================================================================================================================= */


	function impose_meta_box__sidebar( $post )
	{
		?>
			<div class="admin-inside-box">
				<?php
					wp_nonce_field( 'impose_meta_box__sidebar', 'impose_meta_box_nonce__sidebar' );
				?>
				<p>
					<?php
						$select_page_sidebar = get_option( 'impose_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar' );
					?>
					<select name="impose_select_page_sidebar">
						<option <?php if ( $select_page_sidebar == 'No Sidebar' ) { echo 'selected="selected"'; } ?> value="No Sidebar"><?php esc_html_e( 'No Sidebar', 'impose' ); ?></option>
						<option <?php if ( $select_page_sidebar == 'impose_sidebar_3' ) { echo 'selected="selected"'; } ?> value="impose_sidebar_3"><?php esc_html_e( 'Page Sidebar', 'impose' ); ?></option>
						<option <?php if ( $select_page_sidebar == 'impose_sidebar_1' ) { echo 'selected="selected"'; } ?> value="impose_sidebar_1"><?php esc_html_e( 'Blog Sidebar', 'impose' ); ?></option>
						<option <?php if ( $select_page_sidebar == 'impose_sidebar_2' ) { echo 'selected="selected"'; } ?> value="impose_sidebar_2"><?php esc_html_e( 'Post Sidebar', 'impose' ); ?></option>
						
						<?php
							$impose_sidebars_with_commas = get_option( 'impose_sidebars_with_commas' );
							
							if ( $impose_sidebars_with_commas != "" )
							{
								$sidebars = preg_split( "/[\s]*[,][\s]*/", $impose_sidebars_with_commas );

								foreach ( $sidebars as $sidebar_name )
								{
									$selected = "";
									
									if ( $select_page_sidebar == $sidebar_name )
									{
										$selected = 'selected="selected"';
									}
									
									echo '<option ' . $selected . ' value="' . esc_attr( $sidebar_name ) . '">' . $sidebar_name . '</option>';
								}
							}
						?>
					</select>
				</p>
			</div>
		<?php
	}
	
	function impose_save_meta_box__sidebar( $post_id )
	{
		if ( ! isset( $_POST['impose_meta_box_nonce__sidebar'] ) )
		{
			return $post_id;
		}
		
		$nonce = $_POST['impose_meta_box_nonce__sidebar'];
		
		if ( ! wp_verify_nonce( $nonce, 'impose_meta_box__sidebar' ) )
        {
			return $post_id;
		}
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        {
			return $post_id;
		}
		
		if ( 'page' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_page', $post_id ) )
			{
				return $post_id;
			}
		}
		else
		{
			if ( ! current_user_can( 'edit_post', $post_id ) )
			{
				return $post_id;
			}
		}
		
		update_option( 'impose_select_page_sidebar' . '__' . $post_id, $_POST['impose_select_page_sidebar'] );
	}
	
	add_action( 'save_post', 'impose_save_meta_box__sidebar' );
	
	
	/* ================================================== */
	
	
	function impose_meta_box__gallery_type( $post )
	{
		?>
			<div class="admin-inside-box">
				<?php
					wp_nonce_field( 'impose_meta_box__gallery_type', 'impose_meta_box_nonce__gallery_type' );
				?>
				<p>
					<?php
						$gallery_type = get_option( 'impose_gallery_type' . '__' . get_the_ID(), 'grid' );
					?>
					<select name="impose_gallery_type">
						<option <?php if ( $gallery_type == 'grid' ) { echo 'selected="selected"'; } ?> value="grid"><?php esc_html_e( 'Grid', 'impose' ); ?></option>
						<option <?php if ( $gallery_type == 'slider' ) { echo 'selected="selected"'; } ?> value="slider"><?php esc_html_e( 'Slider', 'impose' ); ?></option>
					</select>
				</p>
			</div>
		<?php
	}
	
	function impose_save_meta_box__gallery_type( $post_id )
	{
		if ( ! isset( $_POST['impose_meta_box_nonce__gallery_type'] ) )
		{
			return $post_id;
		}
		
		$nonce = $_POST['impose_meta_box_nonce__gallery_type'];
		
		if ( ! wp_verify_nonce( $nonce, 'impose_meta_box__gallery_type' ) )
        {
			return $post_id;
		}
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        {
			return $post_id;
		}
		
		if ( 'page' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_page', $post_id ) )
			{
				return $post_id;
			}
		}
		else
		{
			if ( ! current_user_can( 'edit_post', $post_id ) )
			{
				return $post_id;
			}
		}
		
		update_option( 'impose_gallery_type' . '__' . $post_id, $_POST['impose_gallery_type'] );
	}
	
	add_action( 'save_post', 'impose_save_meta_box__gallery_type' );
	
	
	/* ================================================== */
	
	
	function impose_meta_box__featured_image_style( $post )
	{
		?>
			<div class="admin-inside-box">
				<?php
					wp_nonce_field( 'impose_meta_box__featured_image_style', 'impose_meta_box_nonce__featured_image_style' );
				?>
				<p>
					<?php
						$single_post_layout = get_option( 'impose_single_post_layout', 'Default' );
						$featured_image_style = get_option( 'impose_featured_image_style' . '__' . get_the_ID(), $single_post_layout );
					?>
					<select name="impose_featured_image_style">
						<option <?php if ( $featured_image_style == 'Default' ) { echo 'selected="selected"'; } ?> value="Default"><?php esc_html_e( 'Default', 'impose' ); ?></option>
						<option <?php if ( $featured_image_style == 'Classic' ) { echo 'selected="selected"'; } ?> value="Classic"><?php esc_html_e( 'Classic', 'impose' ); ?></option>
					</select>
				</p>
			</div>
		<?php
	}
	
	function impose_save_meta_box__featured_image_style( $post_id )
	{
		if ( ! isset( $_POST['impose_meta_box_nonce__featured_image_style'] ) )
		{
			return $post_id;
		}
		
		$nonce = $_POST['impose_meta_box_nonce__featured_image_style'];
		
		if ( ! wp_verify_nonce( $nonce, 'impose_meta_box__featured_image_style' ) )
        {
			return $post_id;
		}
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        {
			return $post_id;
		}
		
		if ( 'page' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_page', $post_id ) )
			{
				return $post_id;
			}
		}
		else
		{
			if ( ! current_user_can( 'edit_post', $post_id ) )
			{
				return $post_id;
			}
		}
		
		update_option( 'impose_featured_image_style' . '__' . $post_id, $_POST['impose_featured_image_style'] );
	}
	
	add_action( 'save_post', 'impose_save_meta_box__featured_image_style' );
	
	
	/* ================================================== */
	
	
	function impose_add_meta_boxes()
	{
		add_meta_box( 'impose_add_meta_box__sidebar', esc_html__( 'Sidebar', 'impose' ), 'impose_meta_box__sidebar', 'page', 'side', 'low' );
		add_meta_box( 'impose_add_meta_box__gallery_type__page', esc_html__( 'Gallery Type', 'impose' ), 'impose_meta_box__gallery_type', 'page', 'side', 'low' );
		add_meta_box( 'impose_add_meta_box__gallery_type__post', esc_html__( 'Gallery Type', 'impose' ), 'impose_meta_box__gallery_type', 'post', 'side', 'low' );
		add_meta_box( 'impose_add_meta_box__featured_image_style', esc_html__( 'Featured Image Style', 'impose' ), 'impose_meta_box__featured_image_style', 'post', 'side', 'low' );
	}
	
	add_action( 'add_meta_boxes', 'impose_add_meta_boxes' );


/* ============================================================================================================================================= */
/* ============================================================================================================================================= */


	function impose_sidebar()
	{
		?>
			<div id="secondary" class="widget-area sidebar" role="complementary">
				<?php
					if ( is_page() )
					{
						$select_page_sidebar = get_option( 'impose_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar' );
						
						dynamic_sidebar( $select_page_sidebar );
					}
					elseif ( is_singular( 'post' ) )
					{
						if ( is_active_sidebar( 'impose_sidebar_2' ) )
						{
							dynamic_sidebar( 'impose_sidebar_2' );
						}
						else
						{
							dynamic_sidebar( 'impose_sidebar_1' );
						}
					}
					else
					{
						dynamic_sidebar( 'impose_sidebar_1' );
					}
				?>
			</div>
		<?php
	}


/* ============================================================================================================================================= */


	function impose_excerpt_length( $length )
	{
		if ( isset( $_GET['excerpt_length'] ) )
		{
			return $_GET['excerpt_length'];
		}
		else
		{
			return get_option( 'impose_excerpt_length', '90' );
		}
	}
	
	add_filter( 'excerpt_length', 'impose_excerpt_length', 999 );
	
	
	function impose_excerpt_more( $more )
	{
		return '... <span class="more"><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__( 'Read More', 'impose' ) . '</a></span>';
	}
	
	add_filter( 'excerpt_more', 'impose_excerpt_more' );
	
	
	function impose_content()
	{
		if ( is_home() || is_archive() || is_search() )
		{
			if ( has_excerpt() )
			{
				the_excerpt();
				
				echo '<span class="more"><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__( 'Read More', 'impose' ) . '</a></span>';
			}
			else
			{
				$theme_excerpt = get_option( 'impose_theme_excerpt', 'No' );
				
				if ( $theme_excerpt == 'Yes' )
				{
					the_excerpt();
				}
				elseif ( $theme_excerpt == 'standard' )
				{
					$format = get_post_format();
					
					if ( $format == false )
					{
						the_excerpt();
					}
					else
					{
						the_content( esc_html__( 'Read More', 'impose' ) );
					}
				}
				else
				{
					the_content( esc_html__( 'Read More', 'impose' ) );
				}
			}
		}
		else
		{
			the_content();
		}
		
		wp_link_pages( array(   'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'impose' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="page-number">',
								'link_after'  => '</span>' ) );
	}


/* ============================================================================================================================================= */


	function impose_archive_title()
	{
		if ( is_category() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Posts in', 'impose' ); ?></i>
						
						<span class="cat-title"><?php echo single_cat_title(); ?></span>
					</h1>
				</header>
			<?php
		}
		elseif ( is_tag() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Posts tagged', 'impose' ); ?></i>
						
						<span class="cat-title"><?php echo single_tag_title(); ?></span>
					</h1>
				</header>
			<?php
		}
		elseif ( is_author() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Posts by', 'impose' ); ?></i>
						
						<span class="cat-title"><?php the_author(); ?></span>
					</h1>
				</header>
			<?php
		}
		elseif ( is_search() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Searched for', 'impose' ); ?></i>
						
						<span class="cat-title"><?php the_search_query(); ?></span>
					</h1>
				</header>
			<?php
		}
		elseif ( is_date() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Date Archives', 'impose' ); ?></i>
						
						<span class="cat-title">
							<?php
								if ( is_day() )
								{
									printf( get_the_date() );
								}
								elseif ( is_month() )
								{
									printf( get_the_date( _x( 'F Y', 'monthly archives date format', 'impose' ) ) );
								}
								elseif ( is_year() )
								{
									printf( get_the_date( _x( 'Y', 'yearly archives date format', 'impose' ) ) );
								}
								else
								{
									esc_html_e( 'Archives', 'impose' );
								}
							?>
						</span>
					</h1>
				</header>
			<?php
		}
		elseif ( is_post_type_archive() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Archives', 'impose' ); ?></i>
						
						<span class="cat-title"><?php echo post_type_archive_title(); ?></span>
					</h1>
				</header>
			<?php
		}
		elseif ( is_archive() )
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title">
						<i><?php esc_html_e( 'Archives', 'impose' ); ?></i>
						
						<span class="cat-title"><?php echo single_term_title(); ?></span>
					</h1>
				</header>
			<?php
		}
		else
		{
			if ( ! is_front_page() )
			{
				?>
					<header class="entry-header">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
					</header>
				<?php
			}
		}
	}


/* ============================================================================================================================================= */


	function impose_about_author()
	{
		$impose_about_the_author_module = get_option( 'impose_about_the_author_module', 'Yes' );
		
		if ( ( $impose_about_the_author_module != 'No' ) && ( is_singular( 'post' ) ) )
		{
			?>
				<aside class="about-author">
					<h3><?php echo esc_html__( 'About The Author', 'impose' ); ?></h3>
					
					<div class="author-bio">
						<div class="author-img">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php
									echo get_avatar( get_the_author_meta( 'user_email' ), 180, "", get_the_author_meta( 'display_name' ) );
								?>
							</a>
						</div>
						
						<div class="author-info">
							<h4 class="author-name"><?php the_author(); ?></h4>
							
							<p>
								<?php	
									echo get_the_author_meta( 'description' );
								?>
							</p>
							
							<?php
								dynamic_sidebar( 'impose_sidebar_8' );
							?>
						</div>
					</div>
				</aside>
			<?php
		}
	}


/* ============================================================================================================================================= */


	function impose_share_links()
	{
		$share_links = get_option( 'impose_share_links', 'Yes' );
		
		if ( $share_links != 'No' )
		{
			?>
				<div class="share-links">
					<h3><?php echo esc_html__( 'Share This Post', 'impose' ); ?></h3>
					
					<a rel="nofollow" target="_blank" href="mailto:?subject=<?php echo urlencode( esc_html__( 'I wanted you to see this post', 'impose' ) ); ?>&amp;body=<?php echo urlencode( esc_html__( 'Check out this post', 'impose' ) ); ?>%20:%20<?php echo urlencode( the_title_attribute( 'echo=0' ) ); ?>%20-%20<?php the_permalink(); ?>" title="<?php echo esc_html__( 'Email this post to a friend', 'impose' ); ?>">
						<i class="pw-icon-mail"></i>
					</a>
					
					<a rel="nofollow" target="_blank" href="https://twitter.com/home?status=<?php echo esc_html__( 'Currently%20reading', 'impose' ); ?>:%20'<?php echo urlencode( the_title_attribute( 'echo=0' ) ); ?>'%20<?php the_permalink(); ?>" title="<?php echo esc_html__( 'Share this post with your followers', 'impose' ); ?>">
						<i class="pw-icon-twitter"></i>
					</a>
					
					<a rel="nofollow" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo urlencode( the_title_attribute( 'echo=0' ) ); ?>" title="<?php echo esc_html__( 'Share this post on Facebook', 'impose' ); ?>">
						<i class="pw-icon-facebook"></i>
					</a>
				</div>
			<?php
		}
	}


/* ============================================================================================================================================= */


	function impose_related_posts()
	{
		$related_posts = get_option( 'impose_related_posts', 'Yes' );
		
		if ( ( $related_posts != 'No' ) && ( ! is_attachment() ) )
		{
			$categories = get_the_category();
			$category_ids = "";
			
			if ( $categories )
			{
				foreach ( $categories as $category )
				{
					$category_ids .= $category->cat_ID . ',';
				}
				
				$category_ids = trim( $category_ids, ',' );
			}
			
			$exclude_ids = array( get_the_ID() );
			
			$args = array(  'post_type'      => 'post',
							'cat'            => $category_ids,
							'post__not_in'   => $exclude_ids,
							'posts_per_page' => 3 );
			
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) :
			
				?>
					<aside class="related-posts">
						<h3><?php echo esc_html__( 'You May Also Like', 'impose' ); ?></h3>
						
						<?php
							while ( $query->have_posts() ) : $query->the_post();
							
								$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_3' );
								$featured_image_url = $featured_image[0];
								
								?>
									<div class="post-thumbnail" style="background-image: url( <?php echo esc_url( $featured_image_url ); ?> );">
										<header class="entry-header">
											<h2 class="entry-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2>
											
											<p>
												<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Post', 'impose' ); ?></a>
											</p>
										</header>
									</div>
								<?php
							endwhile;
						?>
					</aside>
				<?php
			
			endif;
			wp_reset_postdata();
		}
	}


/* ============================================================================================================================================= */


	function impose_blog_navigation()
	{
		$impose_pagination = get_option( 'impose_pagination', 'No' );
		
		if ( $impose_pagination == 'Yes' )
		{
			?>
				<nav class="post-pagination">
					<?php
						oxo_pagination( array() );
					?>
				</nav>
			<?php
		}
		else
		{
			$next_posts_link = get_next_posts_link();
			$previous_posts_link = get_previous_posts_link();
			
			if (( $next_posts_link != "" ) || ( $previous_posts_link != "" ))
			{
				?>
					<nav class="navigation" role="navigation">
						<div class="nav-previous">
							<?php
								next_posts_link( esc_html__( 'Older posts', 'impose' ) );
							?>
						</div>
						
						<div class="nav-next">
							<?php
								previous_posts_link( esc_html__( 'Newer posts', 'impose' ) );
							?>
						</div>
					</nav>
				<?php
			}
		}
	}


/* ============================================================================================================================================= */


	function impose_single_navigation()
	{
		if ( wp_attachment_is_image() )
		{
			?>
				<nav class="nav-single row">
					<div class="nav-previous col-xs-6">
						<?php
							previous_image_link( false, esc_html__( 'Previous Image', 'impose' ) );
						?>
					</div>
					
					<div class="nav-next col-xs-6">
						<?php
							next_image_link( false, esc_html__( 'Next Image', 'impose' ) );
						?>
					</div>
				</nav>
			<?php
		}
		else
		{
			?>
				<nav class="nav-single row">
					<div class="nav-previous col-xs-6">
						<?php
							previous_post_link( '<h4>' . esc_html__( 'Previous Post', 'impose' ) . '</h4>' . '%link', '%title' );
						?>
					</div>
					
					<div class="nav-next col-xs-6">
						<?php
							next_post_link( '<h4>' . esc_html__( 'Next Post', 'impose' ) . '</h4>' . '%link', '%title' );
						?>
					</div>
				</nav>
			<?php
		}
	}


/* ============================================================================================================================================= */


	function impose_content_none()
	{
		if ( is_404() )
		{
			?>
				<article class="hentry page page-404">
					<header class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'sorry, page not found', 'impose' ); ?></h1>
					</header>
					
					<div class="entry-content">
						<p>
							<?php
								esc_html_e( 'But you can always search for what you are looking.', 'impose' );
							?>
						</p>
						
						<?php
							get_search_form();
						?>
					</div>
				</article>
			<?php
		}
		elseif ( is_search() )
		{
			?>
				<article class="hentry page page-404">
					<header class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'nothing found', 'impose' ); ?></h1>
					</header>
					
					<div class="entry-content">
						<p>
							<?php
								esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'impose' );
							?>
						</p>
						
						<?php
							get_search_form();
						?>
					</div>
				</article>
			<?php
		}
		else
		{
			?>
				<article class="hentry page page-404">
					<header class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'nothing found', 'impose' ); ?></h1>
					</header>
					
					<div class="entry-content">
						<p>
							<?php
								esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'impose' );
							?>
						</p>
						
						<?php
							get_search_form();
						?>
					</div>
				</article>
			<?php
		}
	}


/* ============================================================================================================================================= */


	function impose_main_slider_content()
	{
		$slides = get_option('impose_main_slider_slides', 'sticky');
		$slides_count = get_option('impose_main_slider_latest_posts_count', '5');
		
		if ($slides != 'latest')
		{
			$slides = get_option('sticky_posts');
		}
		else
		{
			$slides = "";
		}
		
		$args = array('post_type'      => 'post',
					  'post__in'       => $slides,
					  'posts_per_page' => $slides_count);
		
		$query = new WP_Query($args);
		
		if ( $query->have_posts() ) :
		
			if ( isset( $_GET['main_slider_items'] ) )
			{
				$items = $_GET['main_slider_items'];
			}
			else
			{
				$items = get_option( 'impose_homepage_owl_carousel_items', '3' );
			}
			
			if ( isset( $_GET['main_slider_nav_links'] ) )
			{
				if ( $_GET['main_slider_nav_links'] == 'no' )
				{
					$nav_links = 'false';
				}
				else
				{
					$nav_links = 'true';
				}
			}
			else
			{
				$nav_links = get_option( 'impose_homepage_owl_carousel_nav_links', 'true' );
			}
			
			if ( isset( $_GET['main_slider_nav_dots'] ) )
			{
				if ( $_GET['main_slider_nav_dots'] == 'yes' )
				{
					$nav_dots = 'true';
				}
				else
				{
					$nav_dots = 'false';
				}
			}
			else
			{
				$nav_dots = get_option( 'impose_homepage_owl_carousel_nav_dots', 'false' );
			}
			
			$loop = get_option( 'impose_homepage_owl_carousel_loop', 'true' );
			$center = get_option( 'impose_homepage_owl_carousel_center', 'false' );
			$mouse_drag = get_option( 'impose_homepage_owl_carousel_mouse_drag', 'true' );
			$autoplay = get_option( 'impose_homepage_owl_carousel_autoplay', 'false' );
			$autoplay_speed = get_option( 'impose_homepage_owl_carousel_autoplay_speed', '600' );
			$autoplay_timeout = get_option( 'impose_homepage_owl_carousel_autoplay_timeout', '2000' );
			
			?>
				<div class="post-slider owl-carousel" data-items="<?php echo esc_attr( $items ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-center="<?php echo esc_attr( $center ); ?>" data-mouse-drag="<?php echo esc_attr( $mouse_drag ); ?>" data-nav="<?php echo esc_attr( $nav_links ); ?>" data-dots="<?php echo esc_attr( $nav_dots ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>" data-autoplay-timeout="<?php echo esc_attr( $autoplay_timeout ); ?>">
					<?php
						while ( $query->have_posts() ) : $query->the_post();
						
							if ( $items == '1' )
							{
								$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_1' );
							}
							elseif ( $items == '2' )
							{
								$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_2' );
							}
							else
							{
								$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_3' );
							}
							
							$featured_image_url = $featured_image[0];
							
							?>
								<div class="post-thumbnail" style="background-image: url( <?php echo esc_url( $featured_image_url ); ?> );">
									<header class="entry-header">
										<div class="entry-meta">
											<span class="cat-links">
												<?php
													the_category( ' ' );
												?>
											</span>	
										</div>
										
										<h2 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
										
										<p>
											<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Post', 'impose' ); ?></a>
										</p>
									</header>
								</div>
							<?php
						endwhile;
					?>
				</div>
			<?php
		endif;
		wp_reset_postdata();
	}
	
	
	function impose_main_slider()
	{
		if ( isset( $_GET['main_slider'] ) )
		{
			if ( $_GET['main_slider'] == 'yes' )
			{
				impose_main_slider_content();
			}
		}
		else
		{
			$main_slider_activate = get_option( 'impose_main_slider_activate', 'no' );
			
			if ( $main_slider_activate == 'only_for_blog' )
			{
				if ( is_home() )
				{
					impose_main_slider_content();
				}
			}
			elseif ( $main_slider_activate == 'for_all_archives' )
			{
				impose_main_slider_content();
			}
		}
	}


/* ============================================================================================================================================= */


	/*
		This function filters the post content when viewing a post with the "chat" post format.  It formats the 
		content with structured HTML markup to make it easy for theme developers to style chat posts. The 
		advantage of this solution is that it allows for more than two speakers (like most solutions). You can 
		have 100s of speakers in your chat post, each with their own, unique classes for styling.
		
		@author David Chandra
		@link http://www.turtlepod.org
		@author Justin Tadlock
		@link http://justintadlock.com
		@copyright Copyright (c) 2012
		@license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
		@link http://justintadlock.com/archives/2012/08/21/post-formats-chat
		
		@global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
		@param string $content The content of the post.
		@return string $chat_output The formatted content of the post.
	*/
	
	function impose_theme_post_format_chat_content( $content )
	{
		global $_post_format_chat_ids;
		
		/* If this is not a 'chat' post, return the content. */
		if ( !has_post_format( 'chat' ) )
		{
			return $content;
		}
		
		/* Set the global variable of speaker IDs to a new, empty array for this chat. */
		$_post_format_chat_ids = array();
		
		/* Allow the separator (separator for speaker/text) to be filtered. */
		$separator = apply_filters( 'my_post_format_chat_separator', ':' );
		
		/* Open the chat transcript div and give it a unique ID based on the post ID. */
		$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';
		
		/* Split the content to get individual chat rows. */
		$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
		
		/* Loop through each row and format the output. */
		foreach ( $chat_rows as $chat_row )
		{
			/* If a speaker is found, create a new chat row with speaker and text. */
			if ( strpos( $chat_row, $separator ) )
			{
				/* Split the chat row into author/text. */
				$chat_row_split = explode( $separator, trim( $chat_row ), 2 );
				
				/* Get the chat author and strip tags. */
				$chat_author = strip_tags( trim( $chat_row_split[0] ) );
				
				/* Get the chat text. */
				$chat_text = trim( $chat_row_split[1] );
				
				/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
				$speaker_id = impose_theme_post_format_chat_row_id( $chat_author );
				
				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
				
				/* Add the chat row author. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';
				
				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text"><p>' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</p></div>';
				
				/* Close the chat row. */
				$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
			}
			/*
				If no author is found, assume this is a separate paragraph of text that belongs to the
				previous speaker and label it as such, but let's still create a new row.
			*/
			else
			{
				/* Make sure we have text. */
				if ( !empty( $chat_row ) )
				{
					/* Open the chat row. */
					$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
					
					/* Don't add a chat row author.  The label for the previous row should suffice. */
					
					/* Add the chat row text. */
					$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text"><p>' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</p></div>';
					
					/* Close the chat row. */
					$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
				}
			}
		}
		
		/* Close the chat transcript div. */
		$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";
		
		/* Return the chat content and apply filters for developers. */
		return apply_filters( 'my_post_format_chat_content', $chat_output );
	}
	
	/*
		This function returns an ID based on the provided chat author name. It keeps these IDs in a global 
		array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
		that will be used in an HTML class for individual chat rows so they can be styled. So, speaker "John" 
		will always have the same class each time he speaks. And, speaker "Mary" will have a different class 
		from "John" but will have the same class each time she speaks.
		
		@author David Chandra
		@link http://www.turtlepod.org
		@author Justin Tadlock
		@link http://justintadlock.com
		@copyright Copyright (c) 2012
		@license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
		@link http://justintadlock.com/archives/2012/08/21/post-formats-chat
		
		@global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
		@param string $chat_author Author of the current chat row.
		@return int The ID for the chat row based on the author.
	*/
	
	function impose_theme_post_format_chat_row_id( $chat_author )
	{
		global $_post_format_chat_ids;
		
		/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
		$chat_author = strtolower( strip_tags( $chat_author ) );
		
		/* Add the chat author to the array. */
		$_post_format_chat_ids[] = $chat_author;
		
		/* Make sure the array only holds unique values. */
		$_post_format_chat_ids = array_unique( $_post_format_chat_ids );
		
		/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
		return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
	}
	
	/* Filter the content of chat posts. */
	add_filter( 'the_content', 'impose_theme_post_format_chat_content' );


/* ============================================================================================================================================= */
/* ============================================================================================================================================= */


	// https://github.com/franz-josef-kaiser/Easy-Pagination-Deamon
	// https://github.com/marke123/Easy-Pagination-Deamon
	
	
	if ( ! class_exists('WP') ) 
	{
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit;
	}
	
	
	/**
	 * TEMPLATE TAG
	 * 
	 * A wrapper/template tag for the pagination builder inside the class.
	 * Write a call for this function with a "range" 
	 * inside your template to display the pagination.
	 * 
	 * @param integer $range
	 */
	
	function oxo_pagination( $args ) 
	{
		return new oxoPagination( $args );
	}
	
	
	if ( ! class_exists( 'oxoPagination' ) ) 
	{
		class oxoPagination 
		{
			/**
			 * Plugin root path
			 * @var unknown_type
			 */
			protected $path;
			
			/**
			 * Plugin version
			 * @var integer
			 */
			protected $version;
			
			/**
			 * Default arguments
			 * @var array
			 */
			protected $defaults = array( 'classes'			=> ""
										,'range'			=> 5
										,'wrapper'			=> 'li' // element in which we wrap the link 
										,'highlight'		=> 'current' // class for the current page
										,'before'			=> ""
										,'after'			=> ""
										,'link_before'		=> ""
										,'link_after'		=> ""
										,'next_or_number'	=> 'number'
										,'nextpagelink'		=> 'Next'
										,'previouspagelink'	=> 'Prev'
										,'pagelink'			=> '%'
										# only for attachment img pagination/navigation
										,'attachment_size'	=> 'thumbnail'
										,'show_attachment'	=> true );

			/**
			 * Input arguments
			 * @var array
			 */
			protected $args;
			
			/**
			 * Constant for the texdomain (i18n)
			 */
			const LANG = 'impose';
			
			
			public function __construct( $args ) 
			{
				// Set root path variable
				$this->path = $this->get_root_path();

				// Set version
				# $this->version = get_plugin_data();

				# >>>> defaults & arguments

					// apply the "wp_list_pages_args" wordpress native filter also to the custom "page_links" function.
					$this->defaults = apply_filters( 'wp_link_pages_args', $this->defaults );

					// merge defaults with input arguments
					$this->args = wp_parse_args( $args, $this->defaults );

				# <<<< defaults & arguments

				// Help placing the template tag at the right position (inside/outside loop).
				$this->help();

				// Css
				$this->register_styles();
				// Load stylesheet into the 'wp_head()' hook of your theme.
				add_action( 'wp_head', array( &$this, 'print_styles' ) );

				// RENDER
				$this->render( $this->args );
			}


			/**
			 * Plugin root
			 */
			function get_root_path() 
			{
				$path = trailingslashit( WP_PLUGIN_URL.'/'.str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );
				$path = apply_filters( 'config_pagination_url', $path );

				return $this->path = $path;
			}


			/**
			 * Return plugin comment data
			 * 
			 * @since 0.1.3.3
			 * 
			 * @param $value string | default = 'Version' (Other input values: Name, PluginURI, Version, Description, Author, AuthorURI, TextDomain, DomainPath, Network, Title)
			 * 
			 * @return string
			 */
			private function get_plugin_data( $value = 'Version' )
			{	
				$plugin_data = get_plugin_data( __FILE__ );

				return $plugin_data[ $value ];
			}

			/**
			 * Register styles
			 */
			function register_styles() 
			{
				if ( ! is_admin() )
				{
					// Search for a stylesheet
					$name = '/pagination.css';

					if ( file_exists( get_stylesheet_directory() . $name ) )
					{
						$file = get_stylesheet_directory() . $name;
					}
					elseif ( file_exists( get_template_directory() . $name ) )
					{
						$file = get_template_directory() . $name;
					}
					elseif ( file_exists( $this->path.$name ) )
					{
						$file = $this->path.$name;
					}
					else 
					{
						return;
					}

					// try to avoid caching stylesheets if they changed
					$version = filemtime( $file );
					
					// If no change was found, use the plugins version number
					if ( ! $version )
						$version = $this->version;

					wp_register_style( 'pagination', $file, false, $version, 'screen' );
				}
			}

			/**
			 * Print styles
			 */
			function print_styles() 
			{
				if ( ! is_admin() )
				{
					wp_enqueue_style( 'pagination' );
				}
			}

			/**
			 * Help with placing the template tag right
			 */
			function help() 
			{
				/*
				if ( is_single() && ! in_the_loop() )
				{
					$output = sprintf( esc_html__( 'You should place the %1$s template tag inside the loop on singular templates.', self::LANG ), __CLASS__ );
				}
				else

				_doing_it_wrong( 'Class: '.__CLASS__.' function: '.__FUNCTION__, 'error message' );
				*/
				if ( ! is_single() && in_the_loop() )
				{
					// $output = sprintf( esc_html__( 'You shall not place the %1$s template tag inside the loop on list/archives/search/etc templates.', self::LANG ), __CLASS__ );
					
					$output = sprintf( esc_html__( 'You shall not place the %1$s template tag inside the loop on list/archives/search/etc templates.', 'impose' ), __CLASS__ );
				}

				if ( ! isset( $output ) )
					return;

				// error
				$message = new WP_Error( 
					 __CLASS__
					,$output 
				);
				
				// render
				if ( is_wp_error( $message ) ) 
				{ 
					?>
						<div id="oxo-error-<?php echo esc_attr( $message->get_error_code() ); ?>" class="error oxo-error prepend-top clear">
							<strong>
								<?php
									echo esc_html( $message->get_error_message() );
								?>
							</strong>
						</div>
					<?php 
				}
			}
			
			
			/**
			 * Replacement for the native wp_link_page() function
			 * 
			 * @author original version: Thomas Scholz (toscho.de)
			 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages/14460#14460
			 * 
			 * @param (mixed) array $args
			 */
			public function page_links( $args )
			{
				global $page, $numpages, $multipage, $more, $pagenow;

				$args = wp_parse_args( $args, $this->defaults );
				extract( $args, EXTR_SKIP );

				if ( ! $multipage )
					return;
				
				# ============================================== #
				
				# >>>> css classes wrapper
				$start_classes = isset( $classes ) ? ' class="' : '';
				$end_classes = isset( $classes ) ? '"' : '';
				# <<<< css classes wrapper

				$output  = $before;
				
				switch ( $next_or_number ) 
				{
					case 'next' :
					
						if ( $more ) 
						{
							# >>>> [prev]
							$i = $page - 1;
							if ( $i && $more ) 
							{
								# >>>> <li class="custom-class">
								$output .= '<'.$wrapper.$start_classes.$classes.$end_classes.'>';
									$output .= _wp_link_page( $i ).$link_before.$previouspagelink.$link_after.'</a>';
								$output .= '</'.$wrapper.'>';
								# <<<< </li>
							}
							# <<<< [prev]

							# >>>> [next]
							$i = $page + 1;
							if ( $i <= $numpages && $more ) 
							{
								# >>>> <li class="custom-class">
								$output .= '<'.$wrapper.$start_classes.$classes.$end_classes.'>';
									$output .= _wp_link_page( $i ).$link_before.$nextpagelink.$link_after.'</a>';
								$output .= '</'.$wrapper.'>';
								# <<<< </li>
							}
							# <<<< [next]
						}
						
						break;

					case 'number' :
					
						for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
						{
							$classes = isset( $this->args['classes'] ) ? $this->args['classes'] : '';
							
							if ( $page === $i && isset( $this->args['highlight'] ) )
								 $classes .= ' '.$this->args['highlight'];

							# >>>> <li class="current custom-class">
							$output .= '<'.$wrapper.$start_classes.$classes.$end_classes.'>';

								# >>>> [1] [2] [3] [4]
								$j = str_replace( '%', $i, $pagelink );

								if ( $page !== $i || ( ! $more && $page == true ) )
								{
									$output .= _wp_link_page( $i ).$link_before.$j.$link_after.'</a>';
								}

								// the current page must not have a link to itself
								else
								{
									$output .= $link_before.'<span>'.$j.'</span>'.$link_after;
								}
								# <<<< [next]/[prev] | [1] [2] [3] [4]

							$output .= '</'.$wrapper.'>';
							# <<<< </li>
						}
						
						break;

					default :
					
						// in case you can imagine some funky way to paginate
						do_action( 'hook_pagination_next_or_number', $page_links, $classes );
						break;
				}
				
				$output .= $after;

				return $output;
			}


			/**
			 * Navigation for image attachments
			 * 
			 * @param unknown_type $args
			 */
			public function attachment_links( $args )
			{
				global $post, $page;

				$args = wp_parse_args( $args, $this->defaults );
				extract( $args, EXTR_SKIP );

				# ============================================== #

				$attachments = array_values( get_children( array( 
					 'post_parent'		=> $post->post_parent
					,'post_status'		=> 'inherit'
					,'post_type'		=> 'attachment'
					,'post_mime_type'	=> 'image'
					,'order'			=> 'ASC'
					,'orderby'			=> 'menu_order ID' 
				) ) );

				// setup the keys for our links
				foreach ( $attachments as $key => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}

				# ============================================== #
				# @todo implement rel="next/prev" for links

				# >>>> css classes wrapper
				$start_classes = isset( $classes ) ? ' class="' : '';
					$classes = isset( $classes ) ? ' '.$classes : '';
				$end_classes = isset( $classes ) ? '"' : '';
				# <<<< css classes wrapper

				$output  = $before;
					# >>>> [prev]
					if ( isset( $attachments[ $key - 1 ] ) )
					{
						$prev_href = get_attachment_link( $attachments[ $key - 1 ]->ID );

						$prev_title = str_replace( "_", " ", $attachments[ $key - 1 ]->post_title );
						$prev_title = str_replace( "-", " ", $prev_title );

						if ( $show_attachment === true )
						{
							if ( ( is_int( $attachment_size ) && $attachment_size != 0 ) || ( is_string( $attachment_size ) && $attachment_size != 'none' ) || $attachment_size != false )
								$prev_img = wp_get_attachment_image( $attachments[ $key - 1 ]->ID, $attachment_size, false );
						}

						# >>>> <li class="custom-class">
						$output .= '<'.$wrapper. $start_classes.$classes.$end_classes .'>';
							$output .= $link_before.'<a href="'.$prev_href.'" title="'.esc_attr( $prev_title ).'" rel="attachment prev">'.$prev_img.$previouspagelink.'</a>'.$link_after;
						$output .= '</'.$wrapper.'>';
						# <<<< </li>
					}
					# <<<< [prev]

					# >>>> [next]
					if ( isset( $attachments[ $key + 1 ] ) )
					{
						$next_href = get_attachment_link( $attachments[ $key + 1 ]->ID );

						$next_title = str_replace( "_", " ", $attachments[ $key + 1 ]->post_title );
						$next_title = str_replace( "-", " ", $next_title );

						if ( $show_attachment === true )
						{
							if ( ( is_int( $attachment_size ) && $attachment_size != 0 ) || ( is_string( $attachment_size ) && $attachment_size != 'none' ) || $attachment_size != false )
								$next_img = wp_get_attachment_image( $attachments[ $key + 1 ]->ID, $attachment_size, false );
						}

						# >>>> <li class="custom-class">
						$output .= '<'.$wrapper. $start_classes.$classes.$end_classes .'>';
							$output .= $link_before.'<a href="'.$next_href.'" title="'.esc_attr( $next_title ).'" rel="attachment prev">'.$next_img.$nextpagelink.'</a>'.$link_after;
						$output .= '</'.$wrapper.'>';
						# <<<< </li>
					}
					# <<<< [next]
				$output .= $after;

				#echo '<pre>';print_r($k);echo '</pre>';
				return $output;
			}


			/**
			 * Wordpress pagination for archives/search/etc.
			 * 
			 * Semantically correct pagination inside an unordered list
			 * 
			 * Displays: [First] [<<] [1] [2] [3] [4] [>>] [Last]
			 *	+ First/Last only appears if not on first/last page
			 *	+ Shows next/previous links [<<]/[>>]
			 * 
			 * Accepts a range attribute (default = 5) to adjust the number
			 * of direct page links that link to the pages above/below the current one.
			 * 
			 * @param (integer) $range
			 */
			function render( $args = array( 'classes', 'range' ) ) 
			{
				// $paged - number of the current page
				global $wp_query, $paged, $numpages;

				extract( $args, EXTR_SKIP );

				# ============================================== #

				// How much pages do we have?
				$max_page = (int) $wp_query->max_num_pages;

				// We need the pagination only if there is more than 1 page
				if ( $max_page > (int) 1 )
					$paged = ! $wp_query->query_vars['paged'] ? (int) 1 : $wp_query->query_vars['paged'];

				$classes = isset( $classes ) ? ' '.$classes : '';
				?>
				
				<ul class="pagination">
					<?php 
					// *******************************************************
					// To the first / previous page
					// On the first page, don't put the first / prev page link
					// *******************************************************
					if ( $paged !== (int) 1 && $paged !== (int) 0 && ! is_page() ) 
					{
						?>
							<li class="pagination-first <?php echo esc_attr( $classes ); ?>">
								<?php
									$first_post_link = get_pagenum_link( 1 ); 
								?>
								<a href="<?php echo esc_url( $first_post_link ); ?>">
									<?php
										esc_html_e( 'First', 'impose' );
									?>
								</a>
							</li>
							
							<li class="pagination-prev <?php echo esc_attr( $classes ); ?>">
								<?php 
									# let's use the native fn instead of the previous_/next_posts_link() alias
									# get_adjacent_post( $in_same_cat = false, $excluded_categories = '', $previous = true )
									
									// Get the previous post object
									$in_same_cat	= is_category() || is_tag() || is_tax() ? true : false;
									$prev_post_obj	= get_adjacent_post( $in_same_cat );
									// Get the previous posts ID
									$prev_post_ID	= isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
									
									// Set title & link for the previous post
									if ( is_single() )
									{
										if ( isset( $prev_post_obj ) )
										{
											$prev_post_link		= get_permalink( $prev_post_ID );
											$prev_post_title	= '&laquo;';
											// $prev_post_title	= esc_html__( 'Prev', self::LANG ) . ': ' . mb_substr( $prev_post_obj->post_title, 0, 6 );
										}
									}
									else
									{
										$prev_post_link		= home_url().'/?s='.get_search_query().'&paged='.( $paged-1 );
										// $prev_post_title	= '&laquo;';
										$prev_post_title	= "";
									}
								?>
								
								<!-- Render Link to the previous post -->
								<a href="<?php echo esc_url( $prev_post_link ); ?>" rel="prev">
									<?php
										echo esc_html( $prev_post_title );
									?>
								</a>
								<?php # previous_posts_link(' &laquo; '); // ?>
							</li>
						<?php 
					}
					
					// Render, as long as there are more posts found, than we display per page
					if ( ! $wp_query->query_vars['posts_per_page'] < $wp_query->found_posts )
					{

						// *******************************************************
						// We need the sliding effect only if there are more pages than is the sliding range
						// *******************************************************
						if ( $max_page > $range ) 
						{
							// When closer to the beginning
							if ( $paged < $range ) 
							{
								for ( $i = 1; $i <= ( $range+1 ); $i++ ) 
								{ 
									$current = '';
									// Apply the css class "current" if it's the current post
									if ( $paged === (int) $i )
									{
										$current = ' current';
										# echo _wp_link_page( $i ).'</a>';
									}
									
									?>
										<li class="pagination-num<?php echo esc_attr( $classes.$current ); ?>">
											<!-- Render page number Link -->
											<a href="<?php echo get_pagenum_link( $i ); ?>">
												<?php
													echo esc_html( $i );
												?>
											</a>
										</li>
									<?php 
								}
							}
							// When closer to the end
							elseif ( $paged >= ( $max_page - ceil ( $range/2 ) ) ) 
							{
								for ( $i = $max_page - $range; $i <= $max_page; $i++ )
								{ 
									$current = '';
									// Apply the css class "current" if it's the current post
									$current = ( $paged === (int) $i ) ? ' current' : '';

									?>
									<li class="pagination-num<?php echo esc_attr( $classes.$current ); ?>">
										<!-- Render page number Link -->
										<a href="<?php echo get_pagenum_link( $i ); ?>">
											<?php
												echo esc_html( $i );
											?>
										</a>
									</li>
									<?php 
								}
							}
							// Somewhere in the middle
							elseif ( $paged >= $range && $paged < ( $max_page - ceil( $range/2 ) ) ) 
							{
								for ( $i = ( $paged - ceil( $range/2 ) ); $i <= ( $paged + ceil( $range/2 ) ); $i++ ) 
								{
									$current = '';
									// Apply the css class "current" if it's the current post
									$current = ( $paged === (int) $i ) ? ' current' : '';
									
									?>
										<li class="pagination-num<?php echo esc_attr( $classes.$current ); ?>">
											<!-- Render page number Link -->
											<a href="<?php echo get_pagenum_link( $i ); ?>">
												<?php
													echo esc_html( $i );
												?>
											</a>
										</li>
									<?php 
								}
							}
						}
						// Less pages than the range, no sliding effect needed
						else 
						{
							for ( $i = 1; $i <= $max_page; $i++ ) 
							{
								$current = '';
								// Apply the css class "current" if it's the current post
								$current = ( $paged === (int) $i ) ? ' current' : '';
								
								?>
									<li class="pagination-num<?php echo esc_attr( $classes.$current ); ?>">
										<!-- Render page number Link -->
										<a href="<?php echo get_pagenum_link( $i ); ?>">
											<?php
												echo esc_html( $i );
											?>
										</a>
									</li>
								<?php 
							}
						}
					}
					
					
					// *******************************************************
					// to the last / next page of a paged post
					// This only get's used on posts/pages that use the <!--nextpage--> quicktag
					// *******************************************************
					if ( is_singular() )
					{
						$echo = false;

						if ( wp_attachment_is_image() === true )
						{ 
							echo $this->attachment_links( $this->args );
						}
						elseif ( $numpages > 1 )
						{
							echo $this->page_links( $this->args );
						}
					}


					// *******************************************************
					// to the last / next page
					// On the last page: don't show the link to the last/next page
					// *******************************************************
					if ( $paged !== (int) 0 && $paged !== (int) $max_page && $max_page !== (int) 0 && ! is_page() )
					{
						?>
						<li class="pagination-next<?php echo esc_attr( $classes ); ?>">
							<?php 
							# let's use the native fn instead of the previous_/next_posts_link() alias
							# get_adjacent_post( $in_same_cat = false, $excluded_categories = '', $previous = true )

							// Get the next post object
							$in_same_cat	= is_category() || is_tag() || is_tax() ? true : false;
							$next_post_obj	= get_adjacent_post( $in_same_cat, '', false );
							// Get the next posts ID
							$next_post_ID	= isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';

							// Set title & link for the next post
							if ( is_single() )
							{
								if ( isset( $next_post_obj ) )
								{
									# $next_post_link = get_next_posts_link();
									# $next_post_paged_link = get_next_posts_page_link();
									$next_post_link		= get_permalink( $next_post_ID );
									$next_post_title	= '&raquo;';
									// $next_post_title	= esc_html__( 'Next', self::LANG ) . mb_substr( $next_post_obj->post_title, 0, 6 );
								}
							}
							else 
							{
								$next_post_link		= home_url().'/?s='.get_search_query().'&paged='.( $paged+1 );
								// $next_post_title	= '&raquo;';
								$next_post_title	= "";
							}
							
							if ( isset ( $next_post_obj ) )
							{
								?>
									<!-- Render Link to the next post -->
									<a href="<?php echo esc_url( $next_post_link ); ?>" rel="next">
										<?php
											echo esc_html( $next_post_title );
										?>
									</a>
								<?php
							} 
							else 
							{
								next_posts_link(' &raquo; ');
							}
							?>
						</li>
						
						<li class="pagination-last<?php echo esc_attr( $classes ); ?>">
							<?php
								$last_post_link = get_pagenum_link( $max_page ); 
							?>
							<!-- Render Link to the last post -->
							<a href="<?php echo esc_url( $last_post_link ); ?>">
								<?php
									esc_html_e( 'Last', 'impose' );
								?>
							</a>
						</li>
						<?php 
					}
				?>
				</ul>
				<?php
			}
		}
	}


/* ============================================================================================================================================= */
/* ============================================================================================================================================= */


	function impose_customize_register( $wp_customize )
	{
		$wp_customize->add_section( 'impose_section_fonts', array('title'       => esc_html__( 'Fonts', 'impose' ),
																			'description' => esc_html__( 'Change theme fonts.', 'impose' ),
																			'priority'    => 30 ) );
		
		$wp_customize->add_section( 'impose_section_colors', array('title'       => esc_html__( 'Colors', 'impose' ),
																			 'description' => esc_html__( 'Change theme colors.', 'impose' ),
																			 'priority'    => 31 ) );
		
		$wp_customize->add_section( 'impose_section_layout', array('title'       => esc_html__( 'Layout', 'impose' ),
																			 'description' => esc_html__( 'Change content width in pixels. Default: 940', 'impose' ),
																			 'priority'    => 32 ) );
		
		$wp_customize->add_section( 'impose_section_custom_css', array('title'       => esc_html__( 'Custom CSS', 'impose' ),
																				 'description' => esc_html__( 'Quickly add custom css.', 'impose' ),
																				 'priority'    => 33 ) );
		
		/* ================================================== */
		
		include_once( get_template_directory() . '/fonts.php' );
		
		$wp_customize->add_setting( 'impose_setting_font_1', array('default'           => 'Limelight',
																			 'sanitize_callback' => 'impose_sanitize',
																			 'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( 'impose_control_font_1', array('label'    => 'Text Logo Font',
																			 'section'  => 'impose_section_fonts',
																			 'settings' => 'impose_setting_font_1',
																			 'type'     => 'select',
																			 'choices'  => $impose_all_fonts ) );
		
		$wp_customize->add_setting( 'impose_setting_font_2', array('default'           => 'Lato',
																			 'sanitize_callback' => 'impose_sanitize',
																			 'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( 'impose_control_font_2', array('label'    => 'Menu Font',
																			 'section'  => 'impose_section_fonts',
																			 'settings' => 'impose_setting_font_2',
																			 'type'     => 'select',
																			 'choices'  => $impose_all_fonts ) );
		
		$wp_customize->add_setting( 'impose_setting_font_3', array('default'           => 'Poppins',
																			 'sanitize_callback' => 'impose_sanitize',
																			 'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( 'impose_control_font_3', array('label'    => 'Heading Font',
																			 'section'  => 'impose_section_fonts',
																			 'settings' => 'impose_setting_font_3',
																			 'type'     => 'select',
																			 'choices'  => $impose_all_fonts ) );
		
		$wp_customize->add_setting( 'impose_setting_font_4', array('default'           => 'Noto Sans',
																			 'sanitize_callback' => 'impose_sanitize',
																			 'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( 'impose_control_font_4', array('label'    => 'Body Font',
																			 'section'  => 'impose_section_fonts',
																			 'settings' => 'impose_setting_font_4',
																			 'type'     => 'select',
																			 'choices'  => $impose_all_fonts ) );
		
		/* ================================================== */
		
		$wp_customize->add_setting( 'impose_setting_color_1', array(  'default'           => '#2bbe8d',
																				'sanitize_callback' => 'sanitize_hex_color',
																				'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'impose_control_color_1', array('label'    => esc_html__( 'Link Color', 'impose' ),
																															 'section'  => 'impose_section_colors',
																															 'settings' => 'impose_setting_color_1' ) ) );
		
		$wp_customize->add_setting( 'impose_setting_color_2', array(  'default'           => '#009966',
																				'sanitize_callback' => 'sanitize_hex_color',
																				'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'impose_control_color_2', array('label'    => esc_html__( 'Link Hover Color', 'impose' ),
																															 'section'  => 'impose_section_colors',
																															 'settings' => 'impose_setting_color_2' ) ) );
		
		$wp_customize->add_setting( 'impose_setting_color_3', array(  'default'           => '#212933',
																				'sanitize_callback' => 'sanitize_hex_color',
																				'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'impose_control_color_3', array('label'    => esc_html__( 'Menu Background Color', 'impose' ),
																															 'section'  => 'impose_section_colors',
																															 'settings' => 'impose_setting_color_3' ) ) );
		
		$wp_customize->add_setting( 'impose_setting_color_4', array(  'default'           => '#2bbe8d',
																				'sanitize_callback' => 'sanitize_hex_color',
																				'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'impose_control_color_4', array('label'    => esc_html__( 'Primary Color', 'impose' ),
																															 'section'  => 'impose_section_colors',
																															 'settings' => 'impose_setting_color_4' ) ) );
		
		/* ================================================== */
		
		$wp_customize->add_setting( 'impose_setting_content_width', array('default'           => '940',
																					'sanitize_callback' => 'impose_sanitize',
																					'transport'         => 'refresh' ) );
		
		$wp_customize->add_control( 'impose_control_content_width', array('label'    => 'Content Width',
																					'section'  => 'impose_section_layout',
																					'settings' => 'impose_setting_content_width',
																					'type'     => 'number' ) );
		
		/* ================================================== */
		
		$wp_customize->add_setting( 'impose_setting_custom_css', array('default'           => "",
																				 'sanitize_callback' => 'impose_sanitize',
																				 'capability'        => 'edit_theme_options' ) );
		
		$wp_customize->add_control( 'impose_control_custom_css', array('label'    => esc_html__( 'Custom CSS', 'impose' ),
																				 'section'  => 'impose_section_custom_css',
																				 'settings' => 'impose_setting_custom_css',
																				 'type'     => 'textarea' ) );
		
		/* ================================================== */
		
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_font_1' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_font_2' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_font_3' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_font_4' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_color_1' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_color_2' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_color_3' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_color_4' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_content_width' )->transport = 'postMessage';
		$wp_customize->get_setting( 'impose_setting_custom_css' )->transport = 'postMessage';
	}
	
	add_action( 'customize_register', 'impose_customize_register' );
	
	
	function impose_sanitize( $value )
	{
		return $value;
	}
	
	
	function impose_customize_css()
	{
		global $impose_subset;
		$font_styles = ':400,400italic,700,700italic';
		
		$extra_font_styles = get_option( 'impose_extra_font_styles', 'No' );
		
		if ( $extra_font_styles == 'Yes' )
		{
			$font_styles = ':300,400,500,600,700,800,900,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_font_1 = get_theme_mod( 'impose_setting_font_1', "" );
		
		if ( $impose_setting_font_1 != "" )
		{
			?>

<!-- Text Logo Font -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $impose_setting_font_1 ) . $font_styles . $impose_subset; ?>">
<style type="text/css">
.site-title { font-family: "<?php echo $impose_setting_font_1; ?>"; }
</style>
			<?php
		}
		
		
		$impose_setting_font_2 = get_theme_mod( 'impose_setting_font_2', "" );
		
		if ( $impose_setting_font_2 != "" )
		{
			?>

<!-- Menu Font -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $impose_setting_font_2 ) . $font_styles . $impose_subset; ?>">
<style type="text/css">
.nav-menu, .widget-title, .nav-single h4, .about-author h3, .share-links h3, .related-posts h3, .comments-area h3, .entry-title i { font-family: "<?php echo $impose_setting_font_2; ?>"; }
</style>
			<?php
		}
		
		
		$impose_setting_font_3 = get_theme_mod( 'impose_setting_font_3', "" );
		
		if ( $impose_setting_font_3 != "" )
		{
			?>

<!-- Heading Font -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $impose_setting_font_3 ) . $font_styles . $impose_subset; ?>">
<style type="text/css">
h1, h2, h3, h4, h5, h6, #search-field, .nav-single, .comment-meta .fn, .yarpp-thumbnail-title, .widget_categories ul li,.widget_recent_entries ul li, .tptn_title, .blog-simple .day, .intro .wp-caption-text { font-family: "<?php echo $impose_setting_font_3; ?>"; }
</style>
			<?php
		}
		
		
		$impose_setting_font_4 = get_theme_mod( 'impose_setting_font_4', "" );
		
		if ( $impose_setting_font_4 != "" )
		{
			?>

<!-- Body Font -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $impose_setting_font_4 ) . $font_styles . $impose_subset; ?>">

<style type="text/css">
body, input, textarea, select, button, .event h5, .event h6 { font-family: "<?php echo $impose_setting_font_4; ?>"; }
</style>
			<?php
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_color_1 = get_theme_mod( 'impose_setting_color_1', "" );
		
		if ( $impose_setting_color_1 != "" )
		{
			?>

<!-- Link Color -->
<style type="text/css">
a { color: <?php echo $impose_setting_color_1; ?>; }
</style>
			<?php
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_color_2 = get_theme_mod( 'impose_setting_color_2', "" );
		
		if ( $impose_setting_color_2 != "" )
		{
			?>

<!-- Link Hover Color -->
<style type="text/css">
a:hover { color: <?php echo $impose_setting_color_2; ?>; }
</style>
			<?php
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_color_3 = get_theme_mod( 'impose_setting_color_3', "" );
		
		if ( $impose_setting_color_3 != "" )
		{
			?>

<!-- Menu Background Color -->
<style type="text/css">
.site-navigation { background: <?php echo $impose_setting_color_3; ?>; }
</style>
			<?php
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_color_4 = get_theme_mod( 'impose_setting_color_4', "" );
		
		if ( $impose_setting_color_4 != "" )
		{
			?>

<!-- Menu Background Color -->
<style type="text/css">
.flat-style .entry-meta .cat-links a, .flay-style .owl-theme .owl-dots .owl-dot.active span, .flat-style input[type=submit], .flat-style input[type=button], .flat-style button, .flat-style a.button, .flat-style .button, .flat-style .skill-unit .bar .progress span, .flat-style .event [class*="pw-icon-"], .flat-style .owl-theme .owl-dots .owl-dot.active span { background: <?php echo $impose_setting_color_4; ?>; }
.flat-style .format-link .entry-content > p:first-child a:first-child, .flat-style .event.current:after, .flat-style input:not([type=submit]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]):focus, .flat-style textarea:focus, .flat-style select:focus { border-color: <?php echo $impose_setting_color_4; ?>; }
</style>
			<?php
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_content_width = get_theme_mod( 'impose_setting_content_width', '940' );
		
		if ( $impose_setting_content_width != '940' )
		{
			?>

<!-- Content Width -->
<style type="text/css">
.layout-medium { max-width: <?php echo $impose_setting_content_width; ?>; }
</style>
			<?php
		}
		
		
		/* ================================================== */
		
		
		$impose_setting_custom_css = get_theme_mod( 'impose_setting_custom_css', "" );
		
		if ( $impose_setting_custom_css != "" )
		{
			?>

<!-- Custom CSS -->
<style type="text/css">
<?php echo $impose_setting_custom_css; ?>
</style>

			<?php
		}
		
		
		/* ================================================== */
	}
	
	add_action( 'wp_head', 'impose_customize_css' );
	
	
	function impose_customize_preview()
	{
		wp_enqueue_script( 'impose_theme_customizer', get_template_directory_uri() . '/js/wp-theme-customizer.js?v=1.0.2', null, null, true );
	}
	
	add_action( 'customize_preview_init', 'impose_customize_preview' );


/* ============================================================================================================================================= */


	if (is_admin())
	{
		include_once(get_template_directory() . '/admin/theme-options.php');
	}
	
	
	include_once(get_template_directory() . '/admin/install-plugins.php');
	include_once(get_template_directory() . '/admin/demo-import.php');

?>