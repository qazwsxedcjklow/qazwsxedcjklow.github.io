<?php
	get_header();
?>


<?php
	$impose_sidebar = "";
	$impose_select_page_sidebar = get_option( 'impose_select_page_sidebar' . '__' . get_the_ID(), 'No Sidebar' );
	
	if ( $impose_select_page_sidebar != 'No Sidebar' )
	{
		$impose_sidebar = 'with-sidebar';
	}
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
	
	<div class="layout-medium">
		<div id="primary" class="content-area <?php echo esc_attr( $impose_sidebar ); ?>">
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
								comments_template( "", true );
							?>
						<?php
					endwhile;
				?>
			</div>
		</div>
		
		<?php
			if ( $impose_select_page_sidebar != 'No Sidebar' )
			{
				impose_sidebar();
			}
		?>
	</div>
</div>


<?php
	get_footer();
?>