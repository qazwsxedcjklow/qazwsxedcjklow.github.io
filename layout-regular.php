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
		$blog_sidebar = get_option( 'impose_blog_sidebar', 'Yes' );
		
		if ( $blog_sidebar == 'No' )
		{
			$impose_sidebar = "";
		}
	}
?>

<div id="main" class="site-main">
	<?php
		impose_main_slider();
	?>
	
	<div class="layout-medium">
		<div id="primary" class="content-area <?php echo esc_attr( $impose_sidebar ); ?>">
			<div id="content" class="site-content" role="main">
				<?php
					if ( have_posts() )
					{
						impose_archive_title();
					}
				?>
				
				<div class="blog-regular blog-stream">
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								?>
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<header class="entry-header">
											<h2 class="entry-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2>
											
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
										</header>
										
										<?php
											if ( has_post_thumbnail() )
											{
												?>
													<div class="featured-image">
														<a href="<?php the_permalink(); ?>">
															<?php
																the_post_thumbnail( 'impose_image_size_2' );
															?>
														</a>
													</div>
												<?php
											}
										?>
										
										<div class="entry-content">
											<?php
												impose_content();
											?>
										</div>
									</article>
								<?php
							endwhile;
						
						else :
						
							impose_content_none();
						
						endif;
					?>
					
					<?php
						impose_blog_navigation();
					?>
				</div>
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