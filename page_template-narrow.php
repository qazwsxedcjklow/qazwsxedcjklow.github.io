<?php
/*
Template Name: Narrow Page
*/

get_header();
?>


<div id="main" class="site-main">
	<?php
		if ( has_post_thumbnail() )
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
							<?php
								the_title( '<h1 class="entry-title">', '</h1>' );
							?>
						</header>
					</div>
				</div>
			<?php
		}
	?>
	
	<div class="layout-fixed">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php
					while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php
									if ( ! has_post_thumbnail() )
									{
										?>
											<header class="entry-header">
												<?php
													the_title( '<h1 class="entry-title">', '</h1>' );
												?>
											</header>
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
				?>
			</div>
		</div>
	</div>
</div>


<?php
	get_footer();
?>