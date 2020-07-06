<?php
/*
Template Name: Homepage
*/

get_header();
?>

<div id="main" class="site-main">
	<div class="layout-medium">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php
					while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php
									$rotate_words_animation = get_option( 'impose_homepage_rotate_words_animation', 'rotate-1' );
								?>
								<div class="entry-content intro" data-animation="<?php echo esc_attr( $rotate_words_animation ); ?>">
									<?php
										if ( has_post_thumbnail() )
										{
											?>
												<div class="profile-image">
													<?php
														the_post_thumbnail( 'impose_image_size_3' );
													?>
												</div>
											<?php
										}
									?>
									
									<?php
										impose_content();
									?>
								</div>
							</article>
						<?php
					endwhile;
				?>
				
				<?php
					$latest_posts_count = get_option( 'impose_homepage_latest_posts_count', '7' );
					
					$args = array(  'post_type'           => 'post',
									'ignore_sticky_posts' => true,
									'posts_per_page'      => $latest_posts_count );
					
					$query = new WP_Query( $args );
					
					if ( $query->have_posts() ) :
						?>
							<h3 class="widget-title home-title"><?php esc_html_e( 'Latest From The Blog', 'impose' ); ?></h3>
							
							<div class="blog-simple">
								<?php
									while ( $query->have_posts() ) : $query->the_post();
										?>
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
												<div class="hentry-left">
													<div class="entry-date">
														<span class="day">
															<?php
																echo get_the_date( 'd' );
															?>
														</span>
														<span class="month">
															<?php
																echo get_the_date( 'M' );
															?>
														</span>
														<span class="year">
															<?php
																echo get_the_date( 'Y' );
															?>
														</span>
													</div>
													<?php
														if ( has_post_thumbnail() )
														{
															$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
															$featured_image_url = $featured_image[0];
															?>
																<div class="featured-image" style="background-image: url( <?php echo esc_url( $featured_image_url ); ?> );"></div>
															<?php
														}
													?>
												</div>
												<div class="hentry-middle">
													<h2 class="entry-title">
														<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													</h2>
												</div>
												<a class="post-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</article>
										<?php
									endwhile;
								?>
							</div>
						<?php
					endif;
					wp_reset_postdata();
				?>
				
				<?php
					$front_page_displays = get_option( 'show_on_front' );
					
					if ( $front_page_displays == 'posts' )
					{
						?>
							<div class="home-launch">
								<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php
										esc_html_e( 'See All Posts', 'impose' );
									?>
								</a>
							</div>
						<?php
					}
					else
					{
						$blog_page_id = get_option( 'page_for_posts' );
						
						if ( $blog_page_id )
						{
							$blog_page_url = get_page_link( $blog_page_id );
							
							?>
								<div class="home-launch">
									<a class="button" href="<?php echo esc_url( $blog_page_url ); ?>">
										<?php
											esc_html_e( 'See All Posts', 'impose' );
										?>
									</a>
								</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php
	get_footer();
?>