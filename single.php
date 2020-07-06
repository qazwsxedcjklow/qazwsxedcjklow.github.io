<?php
	get_header();
?>

<?php
	$impose_sidebar = 'with-sidebar';
	
	if ( isset( $_GET['sidebar'] ) )
	{
		if ( $_GET['sidebar'] == 'no' )
		{
			$impose_sidebar = "";
		}
	}
	else
	{
		$post_sidebar = get_option( 'impose_post_sidebar', 'Yes' );
		
		if ( $post_sidebar == 'No' )
		{
			$impose_sidebar = "";
		}
	}
?>

<div id="main" class="site-main">
	<?php
		if ( isset( $_GET['single_layout'] ) )
		{
			if ( $_GET['single_layout'] == 'classic' )
			{
				$impose_featured_image_style = 'Classic';
			}
			else
			{
				$impose_featured_image_style = 'Default';
			}
		}
		else
		{
			$impose_single_post_layout = get_option( 'impose_single_post_layout', 'Default' );
			$impose_featured_image_style = get_option( 'impose_featured_image_style' . '__' . get_the_ID(), $impose_single_post_layout );
		}
		
		if (( $impose_featured_image_style != 'Classic' ) && has_post_thumbnail())
		{
			?>
				<div class="featured-top">
					<?php
						the_post_thumbnail( 'impose_image_size_1' );
					?>
					
					<?php
						$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_1' );
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
							
							<?php
								the_title( '<h1 class="entry-title">', '</h1>' );
							?>
							
							<div class="entry-meta">
								<span class="entry-date">
									<time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>">
										<?php
											echo get_the_date();
										?>
									</time>
								</span>
								
								<?php
									if ( comments_open() || get_comments_number() )
									{
										?>
											<span class="comment-link">
												<?php
													comments_popup_link(esc_html__( '0 Comments', 'impose' ),
																		esc_html__( '1 Comment', 'impose' ),
																		esc_html__( '% Comments', 'impose' ),
																		"",
																		'Comments Off' );
												?>
											</span>
										<?php
									}
								?>
								
								<?php
									edit_post_link( esc_html__( 'Edit', 'impose' ),
													'<span class="edit-link">',
													'</span>' );
								?>
							</div>
						</header>
					</div>
				</div>
			<?php
		}
	?>
	
	<div class="layout-medium"> 
		<div id="primary" class="content-area <?php echo esc_attr( $impose_sidebar ); ?>">
			<div id="content" class="site-content" role="main">
				<?php
					while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php
									if (( $impose_featured_image_style == 'Classic' ) || ( ! has_post_thumbnail() ))
									{
										?>
											<header class="entry-header">
												<?php
													the_title( '<h1 class="entry-title">', '</h1>' );
												?>
												
												<div class="entry-meta">
													<span class="cat-links">
														<?php
															the_category( ' ' );
														?>
													</span>
													<span class="entry-date">
														<time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>">
															<?php
																echo get_the_date();
															?>
														</time>
													</span>
													
													<?php
														if ( comments_open() || get_comments_number() )
														{
															?>
																<span class="comment-link">
																	<?php
																		comments_popup_link(esc_html__( '0 Comments', 'impose' ),
																							esc_html__( '1 Comment', 'impose' ),
																							esc_html__( '% Comments', 'impose' ),
																							"",
																							'Comments Off' );
																	?>
																</span>
															<?php
														}
													?>
													
													<?php
														edit_post_link( esc_html__( 'Edit', 'impose' ),
																		'<span class="edit-link">',
																		'</span>' );
													?>
												</div>
											</header>
										<?php
									}
								?>
								
								<?php
									if (( $impose_featured_image_style == 'Classic' ) && has_post_thumbnail())
									{
										?>
											<div class="featured-image">
												<?php
													the_post_thumbnail( 'impose_image_size_2' );
												?>
											</div>
										<?php
									}
								?>
								
								<div class="entry-content">
									<?php
										impose_content();
									?>
								</div>
								
								<?php
									if ( get_the_tags() != "" )
									{
										?>
											<div class="post-tags tagcloud">
												<?php
													the_tags( "", ' ', "" );
												?>
											</div>
										<?php
									}
								?>
								
								<?php
									impose_share_links();
								?>
								
								<?php
									impose_single_navigation();
								?>
								
								<?php
									impose_about_author();
								?>
							</article>
							
							<?php
								impose_related_posts();
							?>
							
							<?php
								comments_template( "", true );
							?>
						<?php
					endwhile;
				?>
			</div>
		</div>
		
		<?php
			if ( $impose_sidebar != "" )
			{
				impose_sidebar();
			}
		?>
	</div>
</div>

<?php
	get_footer();
?>