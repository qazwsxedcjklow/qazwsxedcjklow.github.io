<?php
	get_header();
?>


<?php
	$impose_sidebar = 'with-sidebar';
	$impose_layout = 'layout-medium';
	
	if ( isset( $_GET['sidebar'] ) )
	{
		if ( $_GET['sidebar'] == 'no' )
		{
			$impose_sidebar = "";
			$impose_layout = 'layout-full';
		}
	}
	else
	{
		$blog_sidebar = get_option( 'impose_blog_sidebar', 'Yes' );
		
		if ( $blog_sidebar == 'No' )
		{
			$impose_sidebar = "";
			$impose_layout = 'layout-full';
		}
	}
?>

<div id="main" class="site-main">
	<?php
		impose_main_slider();
	?>
	
	<div class="<?php echo esc_attr( $impose_layout ); ?>">
		<div id="primary" class="content-area <?php echo esc_attr( $impose_sidebar ); ?>">
			<div id="content" class="site-content" role="main">
				<?php
					if ( have_posts() )
					{
						impose_archive_title();
					}
				?>
				
				<?php
					$impose_post_index = 1;
				?>
				<div class="blog-bold waterfall blog-stream">
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								?>
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php
											if ( $impose_post_index = 1 )
											{
												if ( $impose_sidebar != 'with-sidebar' )
												{
													$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_1' );
													$impose_post_index++;
												}
												else
												{
													$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_2' );
													$impose_post_index++;
												}
											}
											elseif (( $impose_post_index = 2 ) || ( $impose_post_index = 3 ))
											{
												if ( $impose_sidebar != 'with-sidebar' )
												{
													$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_2' );
													$impose_post_index++;
												}
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
													<?php
														if ( get_the_category() )
														{
															?>
																<span class="cat-links">
																	<?php
																		the_category( ' ' );
																	?>
																</span>
															<?php
														}
													?>
												</div>
												
												<h2 class="entry-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h2>
												
												<div class="entry-meta">
													<span class="entry-date">
														<time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>">
															<?php
																echo get_the_date();
															?>
														</time>
													</span>
													
													<?php
														if ( get_comments_number() )
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
												
												<p>
													<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Post', 'impose' ); ?></a>
												</p>
											</header>
										</div>
									</article>
								<?php
							endwhile;
						
						else :
						
							impose_content_none();
						
						endif;
					?>
				</div>
				
				<?php
					impose_blog_navigation();
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