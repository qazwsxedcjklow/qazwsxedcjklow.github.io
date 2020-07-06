<?php
	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) )
	{
		header( 'X-UA-Compatible: IE=edge,chrome=1' );
	}
	
	
	$impose_selection_shareable = get_option( 'impose_selection_shareable', 'Yes' );
	
	if ( $impose_selection_shareable == 'No' )
	{
		$impose_selection_shareable = "";
	}
	else
	{
		$impose_selection_shareable = 'is-selection-shareable';
	}
	
	
	$impose_blog_scroll_animations = get_option( 'impose_blog_scroll_animations', 'Yes' );
	
	if ( $impose_blog_scroll_animations == 'No' )
	{
		$impose_blog_scroll_animations = "";
	}
	else
	{
		$impose_blog_scroll_animations = 'blog-animated';
		$impose_blog_scroll_animations_type = get_option( 'impose_blog_scroll_animations_type', 'fadeIn' );
		$impose_blog_scroll_animations_type = 'data-effect="' . esc_attr( $impose_blog_scroll_animations_type ) . '"';
	}
	
	
	$impose_header_menu = get_option( 'impose_header_menu', 'Smart Fixed' );
	
	if ( $impose_header_menu == 'Static' )
	{
		$impose_header_menu = "";
	}
	elseif ( $impose_header_menu == 'Fixed' )
	{
		$impose_header_menu = 'is-menu-fixed is-always-fixed';
	}
	else
	{
		$impose_header_menu = 'is-menu-fixed';
	}
	
	
	if ( isset( $_GET['header_type'] ) )
	{
		if ( $_GET['header_type'] == 'classic' )
		{
			$impose_header_type = 'header-big';
		}
		else
		{
			$impose_header_type = 'header-small';
		}
	}
	else
	{
		$impose_header_type = get_option( 'impose_header_type', 'header-small' );
	}
	
	
	if ( isset( $_GET['header_style'] ) )
	{
		if ( $_GET['header_style'] == 'dark' )
		{
			$impose_header_style = 'header-dark';
		}
		else
		{
			$impose_header_style = 'header-light';
		}
	}
	else
	{
		$impose_header_style = get_option( 'impose_header_style', 'header-light' );
	}
	
	
	if ( isset( $_GET['general_style'] ) )
	{
		if ( $_GET['general_style'] == 'plain' )
		{
			$impose_general_style = 'plain-style';
		}
		elseif ( $_GET['general_style'] == 'flat' )
		{
			$impose_general_style = 'flat-style';
		}
		else
		{
			$impose_general_style = 'minimal-style';
		}
	}
	else
	{
		$impose_general_style = get_option( 'impose_general_style', 'minimal-style' );
	}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="<?php echo esc_attr( $impose_general_style ); ?> <?php echo esc_attr( $impose_header_menu ); ?> <?php echo esc_attr( $impose_selection_shareable ); ?> <?php echo esc_attr( $impose_blog_scroll_animations ); ?> <?php echo esc_attr( $impose_header_style ); ?> <?php echo esc_attr( $impose_header_type ); ?>" <?php echo $impose_blog_scroll_animations_type; ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
		$impose_mobile_zoom = get_option( 'impose_mobile_zoom', 'Yes' );
		
		if ( $impose_mobile_zoom == 'No' )
		{
			?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<?php
		}
		else
		{
			?>
<meta name="viewport" content="width=device-width, initial-scale=1">
			<?php
		}
	?>
	<?php
		wp_head();
	?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="hfeed site">
        <header id="masthead" class="site-header" role="banner">
			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<div class="layout-medium">
					<?php
						function impose_site_logo()
						{
							$impose_logo_image = get_option( 'impose_logo_image', "" );
							
							if ( $impose_logo_image != "" )
							{
								?>
									<h1 class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
											<img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url( $impose_logo_image ); ?>">
											
											<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
										</a>
									</h1>
								<?php
							}
							else
							{
								$impose_theme_site_title = get_option( 'impose_theme_site_title', "" );
								
								if ( $impose_theme_site_title != "" )
								{
									?>
										<h1 class="site-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
												<?php
													echo esc_html( $impose_theme_site_title );
												?>
											</a>
										</h1>
									<?php
								}
								else
								{
									$wordpress_site_title = get_bloginfo( 'name' );
									
									if ( $wordpress_site_title != "" )
									{
										?>
											<h1 class="site-title">
												<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
													<?php
														echo esc_html( $wordpress_site_title );
													?>
												</a>
											</h1>
										<?php
									}
								}
							}
						}
						
						if ( $impose_header_type != 'header-big' )
						{
							impose_site_logo();
						}
					?>
					
					<a class="menu-toggle">
						<span class="lines"></span>
					</a>
					
					<div class="nav-menu">
						<?php
							wp_nav_menu( array( 'theme_location' => 'impose_theme_menu_location',
												'menu'           => 'impose_theme_menu_location',
												'menu_class'     => 'menu-custom',
												'container'      => false) );
						?>
					</div>
					
					<?php
						$impose_header_search = get_option( 'impose_header_search', 'Yes' );
						
						if ( $impose_header_search != 'No' )
						{
							?>
								<a class="search-toggle toggle-link"></a>
								
								<div class="search-container">
									<div class="search-box" role="search">
										<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<label>
												<?php esc_html_e( 'Search Here', 'impose' ); ?>
												
												<input type="search" id="search-field" name="s" placeholder="<?php esc_html_e( 'type and hit enter', 'impose' ); ?>">
											</label>
											
											<input type="submit" class="search-submit" value="<?php esc_html_e( 'Search', 'impose' ); ?>">
										</form>
									</div>
								</div>
							<?php
						}
					?>
					
					<?php
						if ( is_active_sidebar( 'impose_sidebar_4' ) )
						{
							?>
								<div class="social-container">
									<?php
										dynamic_sidebar( 'impose_sidebar_4' );
									?>
								</div>
							<?php
						}
					?>
				</div>
			</nav>
			
			<?php
				if ( $impose_header_type == 'header-big' )
				{
					?>
						<div class="site-title-wrap layout-medium">
							<?php
								impose_site_logo();
							?>
							
							<?php
								$impose_theme_tagline = get_option( 'impose_theme_tagline', "" );
								
								if ( $impose_theme_tagline != "" )
								{
									?>
										<p class="site-description">
											<?php
												echo esc_html( $impose_theme_tagline );
											?>
										</p>
									<?php
								}
								else
								{
									$wordpress_tagline = get_bloginfo( 'description' );
									
									if ( $wordpress_tagline != "" )
									{
										?>
											<p class="site-description">
												<?php
													echo esc_html( $wordpress_tagline );
												?>
											</p>
										<?php
									}
								}
							?>
						</div>
					<?php
				}
			?>
        </header>