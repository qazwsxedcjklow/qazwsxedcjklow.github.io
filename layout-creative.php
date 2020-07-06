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
				
				<?php
					if ( isset( $_GET['first_full'] ) )
					{
						if ( $_GET['first_full'] == 'yes' )
						{
							$impose_creative_layout_1st_full = 'Yes';
						}
						else
						{
							$impose_creative_layout_1st_full = 'No';
						}
					}
					else
					{
						if ( is_category() )
						{
							$layout = get_option( 'impose_category_archive_type', 'Regular' );
						}
						elseif ( is_tag() )
						{
							$layout = get_option( 'impose_tag_archive_type', 'Regular' );
						}
						elseif ( is_author() )
						{
							$layout = get_option( 'impose_author_archive_type', 'Regular' );
						}
						elseif ( is_date() )
						{
							$layout = get_option( 'impose_date_archive_type', 'Regular' );
						}
						elseif ( is_search() )
						{
							$layout = get_option( 'impose_search_result_type', 'Regular' );
						}
						else
						{
							$layout = get_option( 'impose_blog_type', 'Regular' );
						}
						
						if ( $layout == '1st Full + Creative' )
						{
							$impose_creative_layout_1st_full = 'Yes';
						}
						else
						{
							$impose_creative_layout_1st_full = 'No';
						}
					}
				?>
				
				<div class="blog-creative blog-stream <?php if ( $impose_creative_layout_1st_full == 'Yes' ) { echo 'first-full'; } ?>">
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
							
								if ( $impose_creative_layout_1st_full == 'Yes' )
								{
									?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<?php
												if ( $impose_sidebar != 'with-sidebar' )
												{
													$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_1' );
												}
												else
												{
													$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_2' );
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
													</div>
													
													<p>
														<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Post', 'impose' ); ?></a>
													</p>
												</header>
											</div>
										</article>
									<?php
									
									$impose_creative_layout_1st_full = 'No';
								}
								else
								{
									?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<?php
												$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'impose_image_size_4' );
												$featured_image_url = $featured_image[0];
											?>
											<div class="post-thumbnail post-img" style="background-image: url( <?php echo esc_url( $featured_image_url ); ?> );">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												
												<header class="entry-header">
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
													</div>
												</header>
											</div>
											
											<div class="post-thumbnail post-desc">
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
													
													<p>
														<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Post', 'impose' ); ?></a>
													</p>
												</header>
											</div>
										</article>
									<?php
								}
							
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