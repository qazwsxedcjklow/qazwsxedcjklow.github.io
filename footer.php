        <footer id="colophon" class="site-footer" role="contentinfo">
			<div class="layout-medium">
				<div class="site-title-wrap">
					<?php
						$impose_logo_image = get_option( 'impose_logo_image', "" );
						
						if ( $impose_logo_image != "" )
						{
							?>
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url( $impose_logo_image ); ?>">
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
					?>
					
					<?php
						$impose_theme_tagline = stripcslashes(get_option('impose_theme_tagline', ""));
						
						if ($impose_theme_tagline != "")
						{
							?>
								<p class="site-description">
									<?php
										echo esc_html($impose_theme_tagline);
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
					if ( is_active_sidebar( 'impose_sidebar_5' ) )
					{
						?>
							<div class="footer-social">
								<?php
									dynamic_sidebar( 'impose_sidebar_5' );
								?>
							</div>
						<?php
					}
				?>
				
				<?php
					if ( is_active_sidebar( 'impose_sidebar_9' ) || is_active_sidebar( 'impose_sidebar_10' ) || is_active_sidebar( 'impose_sidebar_11' ) )
					{
						?>
							<div class="widget-area" role="complementary">
								<div class="row">
									<div class="col-sm-6 col-md-4">
										<?php
											dynamic_sidebar( 'impose_sidebar_9' );
										?>
									</div>
									<div class="col-sm-6 col-md-4">
										<?php
											dynamic_sidebar( 'impose_sidebar_10' );
										?>
									</div>
									<div class="col-sm-12 col-md-4">
										<?php
											dynamic_sidebar( 'impose_sidebar_11' );
										?>
									</div>
								</div>
							</div>
						<?php
					}
				?>
				
				<div class="footer-instagram">
					<?php
						dynamic_sidebar( 'impose_sidebar_6' );
					?>
				</div>
			</div>
			
			<div class="site-info">
				<div class="layout-medium">
					<?php
						dynamic_sidebar( 'impose_sidebar_7' );
					?>
				</div>
			</div>
		</footer>
	</div>
    
	
	<?php
		wp_footer();
	?>
</body>
</html>