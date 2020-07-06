<?php
	if ( post_password_required() )
	{
		return;
	}
?>


<?php
	if ( comments_open() || get_comments_number() )
	{
		?>
			<div id="comments" class="comments-area">
				<?php
					if ( have_comments() )
					{
						?>
							<h3>
								<?php
									printf( _n( '1 Comment %2$s', '%1$s Comments %2$s', get_comments_number(), 'impose' ),
											number_format_i18n( get_comments_number() ), "" );
								?>
							</h3>
							
							<ol class="commentlist">
								<?php
									wp_list_comments( array('callback' => 'impose_theme_comments',
															'style'    => 'ol' ) );
								?>
							</ol>
							
							<?php
								if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) )
								{
									?>
										<nav class="nav-single row">
											<div class="nav-previous col-xs-6">
												<?php
													previous_comments_link( esc_html__( 'Older Comments', 'impose' ) );
												?>
											</div>
											
											<div class="nav-next col-xs-6">
												<?php
													next_comments_link( esc_html__( 'Newer Comments', 'impose' ) );
												?>
											</div>
										</nav>
									<?php
								}
					}
				?>
				
				<?php
					$args = array( 'title_reply' => esc_html__( 'Leave A Comment', 'impose' ) );
					
					comment_form( $args );
				?>
			</div>
		<?php
	}
?>