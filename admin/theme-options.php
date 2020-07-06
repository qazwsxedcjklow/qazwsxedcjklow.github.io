<?php

	function impose_create_tabs( $current = 'general' )
	{
		$tabs = array(  'general'     => 'General',
						'style'       => 'Style',
						'blog'        => 'Blog',
						'main-slider' => 'Main Slider',
						'sidebar'     => 'Sidebar',
						'homepage'    => 'Homepage' );
		
		?>
			<h1>Theme Options</h1>
			
			<h2 class="nav-tab-wrapper">
				<?php
					foreach ( $tabs as $tab => $name )
					{
						$class = ( $tab == $current ) ? ' nav-tab-active' : "";
						
						echo "<a class='nav-tab$class' href='?page=impose-theme-options&tab=$tab'>$name</a>";
					}
				?>
			</h2>
		<?php
	}


/* ============================================================================================================================================ */


	function impose_theme_options_page()
	{
		global $pagenow;
		
		?>
			<div class="wrap wrap2">
				<div class="status">
					<img alt="..." src="<?php echo get_template_directory_uri(); ?>/admin/ajax-loader.gif">
					
					<strong></strong>
				</div>
				
				<script>
					jQuery(document).ready(function($)
					{
					// -------------------------------------------------------------------------
					
						var uploadID = '',
							uploadImg = '';

						jQuery( '.upload-button' ).click(function()
						{
							uploadID = jQuery(this).prev( 'input' );
							uploadImg = jQuery(this).next( 'img' );
							formfield = jQuery( '.upload' ).attr( 'name' );
							tb_show( "", 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true' );
							return false;
						});
						
						window.send_to_editor = function( html )
						{
							imgurl = jQuery( 'img', html ).attr( 'src' );
							uploadID.val( imgurl );
							uploadImg.attr('src', imgurl);
							tb_remove();
						}
					
					
					// -------------------------------------------------------------------------
					
					
						$( ".alert-success p" ).click(function()
						{
							$(this).fadeOut( "slow", function()
							{
								$( ".alert-success" ).slideUp( "slow" );
							});
						});
					
					
					// -------------------------------------------------------------------------
					
					
						$( '.color' ).change( function()
						{
							var myColor = $( this ).val();
							
							$( this ).prev( 'div' ).find( 'div' ).css( 'backgroundColor', '#' + myColor );
						});
						
						
						$( '.color' ).keypress( function()
						{
							var myColor = $( this ).val();
							
							$( this ).prev( 'div' ).find( 'div' ).css( 'backgroundColor', '#' + myColor );
						});
					
					
					// -------------------------------------------------------------------------
					
					
						$( 'form.ajax-form' ).submit(function()
						{
							$.ajax(
							{
								data: $( this ).serialize(),
								type: "POST",
								beforeSend: function()
								{
									$( '.status' ).removeClass( 'status-done' );
									$( '.status img' ).show();
									$( '.status strong' ).html( 'Saving...' );
									$( '.status' ).fadeIn();
								},
								success: function(data)
								{
									$( '.status img' ).hide();
									$( '.status' ).addClass( 'status-done' );
									$( '.status strong' ).html( 'Done.' );
									$( '.status' ).delay( 1000 ).fadeOut();
								}
							});
							
							return false;
						});
					
					
					// -------------------------------------------------------------------------
					});
				</script>
				
				<?php
					if ( isset( $_GET['tab'] ) )
					{
						impose_create_tabs( $_GET['tab'] );
					}	
					else
					{
						impose_create_tabs( 'general' );
					}
				?>
				
				<div id="poststuff">
					<?php
						// theme options page
						if ( $pagenow == 'themes.php' && $_GET['page'] == 'impose-theme-options' )
						{
							// tab from url
							if ( isset( $_GET['tab'] ) )
							{
								$tab = $_GET['tab'];
							}
							else
							{
								$tab = 'general'; 
							}
							
							switch ( $tab )
							{
								case 'general' :
									
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="alert-success" title="Click to close"><p><strong>Saved.</strong></p></div>';
									}
									
									?>
										<div class="postbox">
											<div class="inside">
												<?php
													$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options' );
												?>
												<form method="post" class="ajax-form" action="<?php echo esc_url( $impose_admin_url ); ?>">
													<?php
														wp_nonce_field( "settings-page" );
													?>
													
													<table>
														<tr>
															<td class="option-left">
																<h4>Image Logo</h4>
																<?php
																	$impose_logo_image = get_option( 'impose_logo_image', "" );
																?>
																<input type="text" name="impose_logo_image" class="upload code2" value="<?php echo esc_url( $impose_logo_image ); ?>">
																
																<input type="button" class="button upload-button" style="margin-top: 10px;" value="Browse">
																
																<img style="margin-top: 10px; max-height: 50px;" align="right" alt="" src="<?php echo esc_url( $impose_logo_image ); ?>">
															</td>
															<td class="option-right">
																Upload a logo or specify an image address of your online logo.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Text Logo</h4>
																<?php
																	$impose_theme_site_title = stripcslashes( get_option( 'impose_theme_site_title', "" ) );
																?>
																<input type="text" name="impose_theme_site_title" value="<?php echo esc_attr( $impose_theme_site_title ); ?>">
															</td>
															<td class="option-right">
																Site title.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Tagline</h4>
																<?php
																	$impose_theme_tagline = stripcslashes(get_option('impose_theme_tagline', ""));
																?>
																<input type="text" name="impose_theme_tagline" value="<?php echo esc_attr($impose_theme_tagline); ?>">
															</td>
															<td class="option-right">
																In a few words, explain what this site is about.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Login Logo</h4>
																<?php
																	$impose_logo_login = get_option( 'impose_logo_login', "" );
																?>
																<input type="text" name="impose_logo_login" class="upload code2" style="width: 100%;" value="<?php echo esc_url( $impose_logo_login ); ?>">
																
																<input type="button" class="button upload-button" style="margin-top: 10px;" value="Browse">
																
																<img style="margin-top: 10px; max-height: 50px;" align="right" alt="" src="<?php echo esc_url( $impose_logo_login ); ?>">
																
																<br>
																<?php
																	$impose_logo_login_hide = get_option( 'impose_logo_login_hide', false );
																?>
																<label><input type="checkbox" name="impose_logo_login_hide" <?php if ( $impose_logo_login_hide ) { echo 'checked="checked"'; } ?>> Hide login logo module</label>
															</td>
															<td class="option-right">
																A PNG image.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<input type="submit" name="submit" class="button button-primary button-large" value="Save Changes">
																
																<input type="hidden" name="settings-submit" value="Y">
															</td>
															<td class="option-right">
																
															</td>
														</tr>
													</table>
												</form>
											</div>
										</div>
									<?php
								break;
								
								case 'style' :
									
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="alert-success" title="Click to close"><p><strong>Saved.</strong></p></div>';
									}
									
									?>
										<div class="postbox">
											<div class="inside">
												<?php
													$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options' );
												?>
												<form class="ajax-form" method="post" action="<?php echo esc_url( $impose_admin_url ); ?>">
													<?php
														wp_nonce_field( "settings-page" );
													?>
													
													<table>
														<tr>
															<td class="option-left">
																<h4>General Style</h4>
																<?php
																	$impose_general_style = get_option( 'impose_general_style', 'minimal-style' );
																?>
																<select name="impose_general_style">
																	<option <?php if ( $impose_general_style == 'minimal-style' ) { echo 'selected="selected"'; } ?> value="minimal-style">Minimal</option>
																	<option <?php if ( $impose_general_style == 'plain-style' ) { echo 'selected="selected"'; } ?> value="plain-style">Plain</option>
																	<option <?php if ( $impose_general_style == 'flat-style' ) { echo 'selected="selected"'; } ?> value="flat-style">Flat</option>
																</select>
															</td>
															<td class="option-right">
																Select design style.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Header</h4>
																<?php
																	$impose_header_type = get_option( 'impose_header_type', 'header-small' );
																?>
																<label>Type</label>
																<select name="impose_header_type">
																	<option <?php if ( $impose_header_type == 'header-small' ) { echo 'selected="selected"'; } ?> value="header-small">Default</option>
																	<option <?php if ( $impose_header_type == 'header-big' ) { echo 'selected="selected"'; } ?> value="header-big">Classic</option>
																</select>
																<?php
																	$impose_header_style = get_option( 'impose_header_style', 'header-light' );
																?>
																<label>Style</label>
																<select name="impose_header_style">
																	<option <?php if ( $impose_header_style == 'header-light' ) { echo 'selected="selected"'; } ?> value="header-light">Light</option>
																	<option <?php if ( $impose_header_style == 'header-dark' ) { echo 'selected="selected"'; } ?> value="header-dark">Dark</option>
																</select>
																<?php
																	$impose_header_menu = get_option( 'impose_header_menu', 'Smart Fixed' );
																?>
																<label>Menu</label>
																<select name="impose_header_menu">
																	<option <?php if ( $impose_header_menu == 'Smart Fixed' ) { echo 'selected="selected"'; } ?>>Smart Fixed</option>
																	<option <?php if ( $impose_header_menu == 'Fixed' ) { echo 'selected="selected"'; } ?>>Fixed</option>
																	<option <?php if ( $impose_header_menu == 'Static' ) { echo 'selected="selected"'; } ?>>Static</option>
																</select>
																<?php
																	$impose_header_search = get_option( 'impose_header_search', 'Yes' );
																?>
																<label>Search</label>
																<select name="impose_header_search">
																	<option <?php if ( $impose_header_search == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_header_search == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Select header layout type.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Fonts and Colors</h4>
																<?php
																	echo '<a href="' . esc_url( admin_url( 'customize.php' ) ) . '">Customize</a>';
																?>
															</td>
															<td class="option-right">
																Select from theme customizer.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Font Character Sets</h4>
																<label>
																	<input type="checkbox" name="impose_char_set_latin" checked="checked" disabled="disabled"> Latin
																</label>
																<br>
																<label>
																	<input type="checkbox" name="impose_char_set_latin_ext" <?php if ( get_option( 'impose_char_set_latin_ext' ) ) { echo 'checked="checked"'; } ?>> Latin Extended
																</label>
																<br>
																<label>
																	<input type="checkbox" name="impose_char_set_cyrillic" <?php if ( get_option( 'impose_char_set_cyrillic' ) ) { echo 'checked="checked"'; } ?>> Cyrillic
																</label>
																<br>
																<label>
																	<input type="checkbox" name="impose_char_set_cyrillic_ext" <?php if ( get_option( 'impose_char_set_cyrillic_ext' ) ) { echo 'checked="checked"'; } ?>> Cyrillic Extended
																</label>
																<br>
																<label>
																	<input type="checkbox" name="impose_char_set_greek" <?php if ( get_option( 'impose_char_set_greek' ) ) { echo 'checked="checked"'; } ?>> Greek
																</label>
																<br>
																<label>
																	<input type="checkbox" name="impose_char_set_greek_ext" <?php if ( get_option( 'impose_char_set_greek_ext' ) ) { echo 'checked="checked"'; } ?>> Greek Extended
																</label>
																<br>
																<label>
																	<input type="checkbox" name="impose_char_set_vietnamese" <?php if ( get_option( 'impose_char_set_vietnamese' ) ) { echo 'checked="checked"'; } ?>> Vietnamese
																</label>
															</td>
															<td class="option-right">
																Select any of them to include to the Google Fonts if the selected fonts have ones of them in their family.
																<br>
																<br>
																To see the supported character sets visit Google Fonts online.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Font Styles</h4>
																<?php
																	$impose_extra_font_styles = get_option( 'impose_extra_font_styles', 'No' );
																?>
																<select name="impose_extra_font_styles">
																	<option <?php if ( $impose_extra_font_styles == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																	<option <?php if ( $impose_extra_font_styles == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																</select>
															</td>
															<td class="option-right">
																Bold and italic styles.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Mobile Zoom</h4>
																<?php
																	$impose_mobile_zoom = get_option( 'impose_mobile_zoom', 'Yes' );
																?>
																<select name="impose_mobile_zoom">
																	<option <?php if ( $impose_mobile_zoom == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_mobile_zoom == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Enable/disable.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<input type="submit" name="submit" class="button button-primary button-large" value="Save Changes">
																
																<input type="hidden" name="settings-submit" value="Y">
															</td>
															<td class="option-right">
																
															</td>
														</tr>
													</table>
												</form>
											</div>
										</div>
									<?php
								break;
								
								case 'blog' :
									
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="alert-success" title="Click to close"><p><strong>Saved.</strong></p></div>';
									}
									
									?>
										<div class="postbox">
											<div class="inside">
												<?php
													$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options' );
												?>
												<form class="ajax-form" method="post" action="<?php echo esc_url( $impose_admin_url ); ?>">
													<?php
														wp_nonce_field( 'settings-page' );
													?>
													
													<table>
														<tr>
															<td class="option-left">
																<h4>Layout</h4>
																
																<?php
																	$impose_blog_type = get_option( 'impose_blog_type', 'Regular' );
																?>
																<label>Blog</label>
																<select name="impose_blog_type">
																	<option <?php if ( $impose_blog_type == 'Regular' ) { echo 'selected="selected"'; } ?>>Regular</option>
																	<option <?php if ( $impose_blog_type == 'Irregular' ) { echo 'selected="selected"'; } ?>>Irregular</option>
																	<option <?php if ( $impose_blog_type == 'Grid' ) { echo 'selected="selected"'; } ?>>Grid</option>
																	<option <?php if ( $impose_blog_type == 'List' ) { echo 'selected="selected"'; } ?>>List</option>
																	<option <?php if ( $impose_blog_type == 'Creative' ) { echo 'selected="selected"'; } ?>>Creative</option>
																	<option <?php if ( $impose_blog_type == 'Bold' ) { echo 'selected="selected"'; } ?>>Bold</option>
																	<option <?php if ( $impose_blog_type == 'Waterfall' ) { echo 'selected="selected"'; } ?>>Waterfall</option>
																	<option <?php if ( $impose_blog_type == '1st Full + Creative' ) { echo 'selected="selected"'; } ?>>1st Full + Creative</option>
																	<option <?php if ( $impose_blog_type == '1st Full + Irregular' ) { echo 'selected="selected"'; } ?>>1st Full + Irregular</option>
																	<option <?php if ( $impose_blog_type == '1st Full + Grid' ) { echo 'selected="selected"'; } ?>>1st Full + Grid</option>
																	<option <?php if ( $impose_blog_type == '1st Full + List' ) { echo 'selected="selected"'; } ?>>1st Full + List</option>
																</select>
																
																<?php
																	$impose_category_archive_type = get_option( 'impose_category_archive_type', 'Regular' );
																?>
																<label>Category Archive</label>
																<select name="impose_category_archive_type">
																	<option <?php if ( $impose_category_archive_type == 'Regular' ) { echo 'selected="selected"'; } ?>>Regular</option>
																	<option <?php if ( $impose_category_archive_type == 'Irregular' ) { echo 'selected="selected"'; } ?>>Irregular</option>
																	<option <?php if ( $impose_category_archive_type == 'Grid' ) { echo 'selected="selected"'; } ?>>Grid</option>
																	<option <?php if ( $impose_category_archive_type == 'List' ) { echo 'selected="selected"'; } ?>>List</option>
																	<option <?php if ( $impose_category_archive_type == 'Creative' ) { echo 'selected="selected"'; } ?>>Creative</option>
																	<option <?php if ( $impose_category_archive_type == 'Bold' ) { echo 'selected="selected"'; } ?>>Bold</option>
																	<option <?php if ( $impose_category_archive_type == 'Waterfall' ) { echo 'selected="selected"'; } ?>>Waterfall</option>
																	<option <?php if ( $impose_category_archive_type == '1st Full + Creative' ) { echo 'selected="selected"'; } ?>>1st Full + Creative</option>
																	<option <?php if ( $impose_category_archive_type == '1st Full + Irregular' ) { echo 'selected="selected"'; } ?>>1st Full + Irregular</option>
																	<option <?php if ( $impose_category_archive_type == '1st Full + Grid' ) { echo 'selected="selected"'; } ?>>1st Full + Grid</option>
																	<option <?php if ( $impose_category_archive_type == '1st Full + List' ) { echo 'selected="selected"'; } ?>>1st Full + List</option>
																</select>
																
																<?php
																	$impose_tag_archive_type = get_option( 'impose_tag_archive_type', 'Regular' );
																?>
																<label>Tag Archive</label>
																<select name="impose_tag_archive_type">
																	<option <?php if ( $impose_tag_archive_type == 'Regular' ) { echo 'selected="selected"'; } ?>>Regular</option>
																	<option <?php if ( $impose_tag_archive_type == 'Irregular' ) { echo 'selected="selected"'; } ?>>Irregular</option>
																	<option <?php if ( $impose_tag_archive_type == 'Grid' ) { echo 'selected="selected"'; } ?>>Grid</option>
																	<option <?php if ( $impose_tag_archive_type == 'List' ) { echo 'selected="selected"'; } ?>>List</option>
																	<option <?php if ( $impose_tag_archive_type == 'Creative' ) { echo 'selected="selected"'; } ?>>Creative</option>
																	<option <?php if ( $impose_tag_archive_type == 'Bold' ) { echo 'selected="selected"'; } ?>>Bold</option>
																	<option <?php if ( $impose_tag_archive_type == 'Waterfall' ) { echo 'selected="selected"'; } ?>>Waterfall</option>
																	<option <?php if ( $impose_tag_archive_type == '1st Full + Creative' ) { echo 'selected="selected"'; } ?>>1st Full + Creative</option>
																	<option <?php if ( $impose_tag_archive_type == '1st Full + Irregular' ) { echo 'selected="selected"'; } ?>>1st Full + Irregular</option>
																	<option <?php if ( $impose_tag_archive_type == '1st Full + Grid' ) { echo 'selected="selected"'; } ?>>1st Full + Grid</option>
																	<option <?php if ( $impose_tag_archive_type == '1st Full + List' ) { echo 'selected="selected"'; } ?>>1st Full + List</option>
																</select>
																
																<?php
																	$impose_author_archive_type = get_option( 'impose_author_archive_type', 'Regular' );
																?>
																<label>Author Archive</label>
																<select name="impose_author_archive_type">
																	<option <?php if ( $impose_author_archive_type == 'Regular' ) { echo 'selected="selected"'; } ?>>Regular</option>
																	<option <?php if ( $impose_author_archive_type == 'Irregular' ) { echo 'selected="selected"'; } ?>>Irregular</option>
																	<option <?php if ( $impose_author_archive_type == 'Grid' ) { echo 'selected="selected"'; } ?>>Grid</option>
																	<option <?php if ( $impose_author_archive_type == 'List' ) { echo 'selected="selected"'; } ?>>List</option>
																	<option <?php if ( $impose_author_archive_type == 'Creative' ) { echo 'selected="selected"'; } ?>>Creative</option>
																	<option <?php if ( $impose_author_archive_type == 'Bold' ) { echo 'selected="selected"'; } ?>>Bold</option>
																	<option <?php if ( $impose_author_archive_type == 'Waterfall' ) { echo 'selected="selected"'; } ?>>Waterfall</option>
																	<option <?php if ( $impose_author_archive_type == '1st Full + Creative' ) { echo 'selected="selected"'; } ?>>1st Full + Creative</option>
																	<option <?php if ( $impose_author_archive_type == '1st Full + Irregular' ) { echo 'selected="selected"'; } ?>>1st Full + Irregular</option>
																	<option <?php if ( $impose_author_archive_type == '1st Full + Grid' ) { echo 'selected="selected"'; } ?>>1st Full + Grid</option>
																	<option <?php if ( $impose_author_archive_type == '1st Full + List' ) { echo 'selected="selected"'; } ?>>1st Full + List</option>
																</select>
																
																<?php
																	$impose_date_archive_type = get_option( 'impose_date_archive_type', 'Regular' );
																?>
																<label>Date Archive</label>
																<select name="impose_date_archive_type">
																	<option <?php if ( $impose_date_archive_type == 'Regular' ) { echo 'selected="selected"'; } ?>>Regular</option>
																	<option <?php if ( $impose_date_archive_type == 'Irregular' ) { echo 'selected="selected"'; } ?>>Irregular</option>
																	<option <?php if ( $impose_date_archive_type == 'Grid' ) { echo 'selected="selected"'; } ?>>Grid</option>
																	<option <?php if ( $impose_date_archive_type == 'List' ) { echo 'selected="selected"'; } ?>>List</option>
																	<option <?php if ( $impose_date_archive_type == 'Creative' ) { echo 'selected="selected"'; } ?>>Creative</option>
																	<option <?php if ( $impose_date_archive_type == 'Bold' ) { echo 'selected="selected"'; } ?>>Bold</option>
																	<option <?php if ( $impose_date_archive_type == 'Waterfall' ) { echo 'selected="selected"'; } ?>>Waterfall</option>
																	<option <?php if ( $impose_date_archive_type == '1st Full + Creative' ) { echo 'selected="selected"'; } ?>>1st Full + Creative</option>
																	<option <?php if ( $impose_date_archive_type == '1st Full + Irregular' ) { echo 'selected="selected"'; } ?>>1st Full + Irregular</option>
																	<option <?php if ( $impose_date_archive_type == '1st Full + Grid' ) { echo 'selected="selected"'; } ?>>1st Full + Grid</option>
																	<option <?php if ( $impose_date_archive_type == '1st Full + List' ) { echo 'selected="selected"'; } ?>>1st Full + List</option>
																</select>
																
																<?php
																	$impose_search_result_type = get_option( 'impose_search_result_type', 'Regular' );
																?>
																<label>Search Result</label>
																<select name="impose_search_result_type">
																	<option <?php if ( $impose_search_result_type == 'Regular' ) { echo 'selected="selected"'; } ?>>Regular</option>
																	<option <?php if ( $impose_search_result_type == 'Irregular' ) { echo 'selected="selected"'; } ?>>Irregular</option>
																	<option <?php if ( $impose_search_result_type == 'Grid' ) { echo 'selected="selected"'; } ?>>Grid</option>
																	<option <?php if ( $impose_search_result_type == 'List' ) { echo 'selected="selected"'; } ?>>List</option>
																	<option <?php if ( $impose_search_result_type == 'Creative' ) { echo 'selected="selected"'; } ?>>Creative</option>
																	<option <?php if ( $impose_search_result_type == 'Bold' ) { echo 'selected="selected"'; } ?>>Bold</option>
																	<option <?php if ( $impose_search_result_type == 'Waterfall' ) { echo 'selected="selected"'; } ?>>Waterfall</option>
																	<option <?php if ( $impose_search_result_type == '1st Full + Creative' ) { echo 'selected="selected"'; } ?>>1st Full + Creative</option>
																	<option <?php if ( $impose_search_result_type == '1st Full + Irregular' ) { echo 'selected="selected"'; } ?>>1st Full + Irregular</option>
																	<option <?php if ( $impose_search_result_type == '1st Full + Grid' ) { echo 'selected="selected"'; } ?>>1st Full + Grid</option>
																	<option <?php if ( $impose_search_result_type == '1st Full + List' ) { echo 'selected="selected"'; } ?>>1st Full + List</option>
																</select>
															</td>
															<td class="option-right">
																Select layout type.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Grid Layout Options</h4>
																<?php
																	$impose_grid_layout_type = get_option( 'impose_grid_layout_type', 'fitRows' );
																?>
																<label>Type</label>
																<select name="impose_grid_layout_type">
																	<option <?php if ( $impose_grid_layout_type == 'fitRows' ) { echo 'selected="selected"'; } ?>>fitRows</option>
																	<option <?php if ( $impose_grid_layout_type == 'masonry' ) { echo 'selected="selected"'; } ?>>masonry</option>
																</select>
																<?php
																	$impose_grid_layout_post_width = get_option( 'impose_grid_layout_post_width', '420' );
																?>
																<label style="display: block;">Post Width</label>
																<input type="number" min="100" max="1920" step="10" name="impose_grid_layout_post_width" value="<?php echo esc_attr( $impose_grid_layout_post_width ); ?>">
																<span style="font-size: 11px; color: #666;">Default: 420 px</span>
															</td>
															<td class="option-right">
																Select grid layout type.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Irregular Layout Options</h4>
																<?php
																	$impose_irregular_layout_post_width = get_option( 'impose_irregular_layout_post_width', '420' );
																?>
																<label style="display: block;">Post Width</label>
																<input type="number" min="100" max="1920" step="10" name="impose_irregular_layout_post_width" value="<?php echo esc_attr( $impose_irregular_layout_post_width ); ?>">
																<span style="font-size: 11px; color: #666;">Default: 420 px</span>
															</td>
															<td class="option-right">
																Set item width.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Single Post Layout</h4>
																<?php
																	$impose_single_post_layout = get_option( 'impose_single_post_layout', 'Default' );
																?>
																<select name="impose_single_post_layout">
																	<option <?php if ( $impose_single_post_layout == 'Default' ) { echo 'selected="selected"'; } ?>>Default</option>
																	<option <?php if ( $impose_single_post_layout == 'Classic' ) { echo 'selected="selected"'; } ?>>Classic</option>
																</select>
															</td>
															<td class="option-right">
																Select featured image style. This setting may be overridden for individual articles.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Sidebar</h4>
																<?php
																	$impose_blog_sidebar = get_option( 'impose_blog_sidebar', 'Yes' );
																?>
																<label>Blog Sidebar</label>
																<select name="impose_blog_sidebar">
																	<option <?php if ( $impose_blog_sidebar == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_blog_sidebar == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
																<?php
																	$impose_post_sidebar = get_option( 'impose_post_sidebar', 'Yes' );
																?>
																<label>Post Sidebar</label>
																<select name="impose_post_sidebar">
																	<option <?php if ( $impose_post_sidebar == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_post_sidebar == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Enable/disable.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Automatic Excerpt</h4>
																<?php
																	$impose_theme_excerpt = get_option( 'impose_theme_excerpt', 'No' );
																?>
																<label>Activate</label>
																<select name="impose_theme_excerpt">
																	<option <?php if ( $impose_theme_excerpt == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																	<option <?php if ( $impose_theme_excerpt == 'standard' ) { echo 'selected="selected"'; } ?> value="standard">Yes - Only for standard format</option>
																	<option <?php if ( $impose_theme_excerpt == 'Yes' ) { echo 'selected="selected"'; } ?> value="Yes">Yes - For all post formats</option>
																</select>
																<label style="display: block;">Length</label>
																<?php
																	$impose_excerpt_length = get_option( 'impose_excerpt_length', '90' );
																?>
																<input type="number" min="5" max="100" step="5" name="impose_excerpt_length" value="<?php echo esc_attr( $impose_excerpt_length ); ?>">
																
																<span style="font-size: 11px; color: #666;">Default: 90 words</span>
															</td>
															<td class="option-right">
																Generates an excerpt from the post content.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Share Links</h4>
																<?php
																	$impose_share_links = get_option( 'impose_share_links', 'Yes' );
																?>
																<select name="impose_share_links">
																	<option>Yes</option>
																	<option <?php if ( $impose_share_links == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Select for post and attachment pages.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Selection Shareable</h4>
																<?php
																	$impose_selection_shareable = get_option( 'impose_selection_shareable', 'Yes' );
																?>
																<select name="impose_selection_shareable">
																	<option>Yes</option>
																	<option <?php if ( $impose_selection_shareable == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Select for individual post pages.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Author Info Box</h4>
																<?php
																	$impose_about_the_author_module = get_option( 'impose_about_the_author_module', 'Yes' );
																?>
																<select name="impose_about_the_author_module">
																	<option <?php if ( $impose_about_the_author_module == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_about_the_author_module == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Enable/disable.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Related Posts</h4>
																<?php
																	$impose_related_posts = get_option( 'impose_related_posts', 'Yes' );
																?>
																<select id="impose_related_posts" name="impose_related_posts">
																	<option <?php if ( $impose_related_posts == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_related_posts == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Enable/disable.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Numbered Pagination</h4>
																<?php
																	$impose_pagination = get_option( 'impose_pagination', 'No' );
																?>
																<select name="impose_pagination">
																	<option <?php if ( $impose_pagination == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_pagination == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
															</td>
															<td class="option-right">
																Use numbered pagination instead of Older-Newer links.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Blog Scroll Animation</h4>
																<?php
																	$impose_blog_scroll_animations = get_option( 'impose_blog_scroll_animations', 'Yes' );
																?>
																<label>Activate</label>
																<select name="impose_blog_scroll_animations">
																	<option <?php if ( $impose_blog_scroll_animations == 'Yes' ) { echo 'selected="selected"'; } ?>>Yes</option>
																	<option <?php if ( $impose_blog_scroll_animations == 'No' ) { echo 'selected="selected"'; } ?>>No</option>
																</select>
																<label>Type</label>
																<?php
																	$impose_blog_scroll_animations_type = get_option( 'impose_blog_scroll_animations_type', 'fadeIn' );
																?>
																<select name="impose_blog_scroll_animations_type">
																	<option <?php if ( $impose_blog_scroll_animations_type == 'fadeIn' ) { echo 'selected="selected"'; } ?>>fadeIn</option>
																	<option <?php if ( $impose_blog_scroll_animations_type == 'slideUp' ) { echo 'selected="selected"'; } ?>>slideUp</option>
																	<option <?php if ( $impose_blog_scroll_animations_type == 'zoomIn' ) { echo 'selected="selected"'; } ?>>zoomIn</option>
																</select>
															</td>
															<td class="option-right">
																Select animation type.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<input type="submit" name="submit" class="button button-primary button-large" value="Save Changes">
																
																<input type="hidden" name="settings-submit" value="Y">
															</td>
															
															<td class="option-right">
																
															</td>
														</tr>
													</table>
												</form>
											</div>
										</div>
									<?php
								break;
								
								case 'main-slider' :
									
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="alert-success" title="Click to close"><p><strong>Saved.</strong></p></div>';
									}
									
									?>
										<div class="postbox">
											<div class="inside">
												<?php
													$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options' );
												?>
												<form class="ajax-form" method="post" action="<?php echo esc_url( $impose_admin_url ); ?>">
													<?php
														wp_nonce_field( "settings-page" );
													?>
													
													<table>
														<tr>
															<td class="option-left">
																<h4>Activate</h4>
																<?php
																	$impose_main_slider_activate = get_option( 'impose_main_slider_activate', 'no' );
																?>
																<select name="impose_main_slider_activate">
																	<option <?php if ( $impose_main_slider_activate == 'no' ) { echo 'selected="selected"'; } ?> value="no">No</option>
																	<option <?php if ( $impose_main_slider_activate == 'only_for_blog' ) { echo 'selected="selected"'; } ?> value="only_for_blog">Yes - Only for blog page</option>
																	<option <?php if ( $impose_main_slider_activate == 'for_all_archives' ) { echo 'selected="selected"'; } ?> value="for_all_archives">Yes - For blog and archive pages</option>
																</select>
															</td>
															<td class="option-right">
																Select for blog page or all archive pages.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Slides</h4>
																<?php
																	$impose_main_slider_slides = get_option( 'impose_main_slider_slides', 'sticky' );
																?>
																<select name="impose_main_slider_slides">
																	<option <?php if ( $impose_main_slider_slides == 'sticky' ) { echo 'selected="selected"'; } ?> value="sticky">Sticky posts</option>
																	<option <?php if ( $impose_main_slider_slides == 'latest' ) { echo 'selected="selected"'; } ?> value="latest">Latest posts</option>
																</select>
																
																<h4>Slides Count</h4>
																<?php
																	$impose_main_slider_latest_posts_count = get_option( 'impose_main_slider_latest_posts_count', '5' );
																?>
																<input type="number" min="1" max="20" step="1" name="impose_main_slider_latest_posts_count" value="<?php echo esc_attr( $impose_main_slider_latest_posts_count ); ?>">
															</td>
															<td class="option-right">
																Create sticky posts or show latest posts.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Sticky Posts</h4>
																<?php
																	$impose_main_slider_sticky_posts = get_option( 'impose_main_slider_sticky_posts', 'exclude' );
																?>
																<select name="impose_main_slider_sticky_posts">
																	<option <?php if ( $impose_main_slider_sticky_posts == 'exclude' ) { echo 'selected="selected"'; } ?> value="exclude">Exclude from blog</option>
																	<option <?php if ( $impose_main_slider_sticky_posts == 'include' ) { echo 'selected="selected"'; } ?> value="include">Include to blog</option>
																</select>
															</td>
															<td class="option-right">
																Blog page behaviour for sticky posts.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Options</h4>
																
																<?php
																	$impose_homepage_owl_carousel_items = get_option( 'impose_homepage_owl_carousel_items', '3' );
																?>
																<label>Show Items</label>
																<select name="impose_homepage_owl_carousel_items">
																	<option <?php if ( $impose_homepage_owl_carousel_items == '1' ) { echo 'selected="selected"'; } ?>>1</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '2' ) { echo 'selected="selected"'; } ?>>2</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '3' ) { echo 'selected="selected"'; } ?>>3</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '4' ) { echo 'selected="selected"'; } ?>>4</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '5' ) { echo 'selected="selected"'; } ?>>5</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '6' ) { echo 'selected="selected"'; } ?>>6</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '7' ) { echo 'selected="selected"'; } ?>>7</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '8' ) { echo 'selected="selected"'; } ?>>8</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '9' ) { echo 'selected="selected"'; } ?>>9</option>
																	<option <?php if ( $impose_homepage_owl_carousel_items == '10' ) { echo 'selected="selected"'; } ?>>10</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_loop = get_option( 'impose_homepage_owl_carousel_loop', 'true' );
																?>
																<label>Loop</label>
																<select name="impose_homepage_owl_carousel_loop">
																	<option <?php if ( $impose_homepage_owl_carousel_loop == 'true' ) { echo 'selected="selected"'; } ?> value="true">Yes</option>
																	<option <?php if ( $impose_homepage_owl_carousel_loop == 'false' ) { echo 'selected="selected"'; } ?> value="false">No</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_center = get_option( 'impose_homepage_owl_carousel_center', 'false' );
																?>
																<label>Center</label>
																<select name="impose_homepage_owl_carousel_center">
																	<option <?php if ( $impose_homepage_owl_carousel_center == 'false' ) { echo 'selected="selected"'; } ?> value="false">No</option>
																	<option <?php if ( $impose_homepage_owl_carousel_center == 'true' ) { echo 'selected="selected"'; } ?> value="true">Yes</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_mouse_drag = get_option( 'impose_homepage_owl_carousel_mouse_drag', 'true' );
																?>
																<label>Mouse Drag</label>
																<select name="impose_homepage_owl_carousel_mouse_drag">
																	<option <?php if ( $impose_homepage_owl_carousel_mouse_drag == 'true' ) { echo 'selected="selected"'; } ?> value="true">Yes</option>
																	<option <?php if ( $impose_homepage_owl_carousel_mouse_drag == 'false' ) { echo 'selected="selected"'; } ?> value="false">No</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_nav_links = get_option( 'impose_homepage_owl_carousel_nav_links', 'true' );
																?>
																<label>Prev/Next Buttons</label>
																<select name="impose_homepage_owl_carousel_nav_links">
																	<option <?php if ( $impose_homepage_owl_carousel_nav_links == 'true' ) { echo 'selected="selected"'; } ?> value="true">Yes</option>
																	<option <?php if ( $impose_homepage_owl_carousel_nav_links == 'false' ) { echo 'selected="selected"'; } ?> value="false">No</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_nav_dots = get_option( 'impose_homepage_owl_carousel_nav_dots', 'false' );
																?>
																<label>Nav Dots</label>
																<select name="impose_homepage_owl_carousel_nav_dots">
																	<option <?php if ( $impose_homepage_owl_carousel_nav_dots == 'false' ) { echo 'selected="selected"'; } ?> value="false">No</option>
																	<option <?php if ( $impose_homepage_owl_carousel_nav_dots == 'true' ) { echo 'selected="selected"'; } ?> value="true">Yes</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_autoplay = get_option( 'impose_homepage_owl_carousel_autoplay', 'false' );
																?>
																<label>Autoplay</label>
																<select name="impose_homepage_owl_carousel_autoplay">
																	<option <?php if ( $impose_homepage_owl_carousel_autoplay == 'false' ) { echo 'selected="selected"'; } ?> value="false">No</option>
																	<option <?php if ( $impose_homepage_owl_carousel_autoplay == 'true' ) { echo 'selected="selected"'; } ?> value="true">Yes</option>
																</select>
																
																<?php
																	$impose_homepage_owl_carousel_autoplay_speed = get_option( 'impose_homepage_owl_carousel_autoplay_speed', '600' );
																?>
																<label style="display: block;">Slide Transiton Speed</label>
																<input type="number" min="100" max="1000" step="100" name="impose_homepage_owl_carousel_autoplay_speed" value="<?php echo esc_attr( $impose_homepage_owl_carousel_autoplay_speed ); ?>">
																
																<span style="font-size: 11px; color: #666;">Default: 600 milliseconds</span>
																
																<?php
																	$impose_homepage_owl_carousel_autoplay_timeout = get_option( 'impose_homepage_owl_carousel_autoplay_timeout', '2000' );
																?>
																<label style="display: block;">Slide Interval Time</label>
																<input type="number" min="500" max="10000" step="250" name="impose_homepage_owl_carousel_autoplay_timeout" value="<?php echo esc_attr( $impose_homepage_owl_carousel_autoplay_timeout ); ?>">
																
																<span style="font-size: 11px; color: #666;">Default: 2000 milliseconds</span>
															</td>
															<td class="option-right">
																Slider properties.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<input type="submit" name="submit" class="button button-primary button-large" value="Save Changes">
																
																<input type="hidden" name="settings-submit" value="Y">
															</td>
															<td class="option-right">
																
															</td>
														</tr>
													</table>
												</form>
											</div>
										</div>
									<?php
								break;
								
								case 'sidebar' :
								
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										$impose_no_sidebar_name = get_option( 'impose_no_sidebar_name' );
										
										if ( $impose_no_sidebar_name == "" )
										{
											echo '<div class="alert-success" title="Click to close"><p><strong>Enter a text for new sidebar name.</strong></p></div>';
										}
										else
										{
											echo '<div class="alert-success" title="Click to close"><p><strong>Created.</strong></p></div>';
										}
									}
									elseif ( esc_attr( @$_GET['deleted'] ) == 'true' )
									{
										delete_option( 'impose_sidebars_with_commas' );
										
										echo '<div class="alert-success" title="Click to close"><p><strong>Deleted.</strong></p></div>';
									}
									
									?>
										<div class="postbox">
											<div class="inside">
												<?php
													$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options&tab=sidebar' );
												?>
												<form method="post" action="<?php echo esc_url( $impose_admin_url ); ?>">
													<?php
														wp_nonce_field( "settings-page" );
													?>
													
													<table>
														<tr>
															<td class="option-left">
																<h4>New Sidebar</h4>
																<input type="text" name="impose_new_sidebar_name" required="required" style="width: 100%;" value="">
															</td>
															<td class="option-right">
																Enter a text for a new sidebar name.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<input type="submit" name="submit" class="button button-primary button-large" value="Create">
																
																<input type="hidden" name="settings-submit" value="Y">
															</td>
															<td class="option-right">
																Create new sidebar.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Sidebars</h4>
																<select name="sidebars" style="width: 100%;" size="10" disabled="disabled">
																	<?php
																		$impose_sidebars_with_commas = get_option( 'impose_sidebars_with_commas' );
																		
																		if ( $impose_sidebars_with_commas != "" )
																		{
																			$sidebars = preg_split("/[\s]*[,][\s]*/", $impose_sidebars_with_commas);

																			foreach ( $sidebars as $sidebar_name )
																			{
																				echo '<option>' . $sidebar_name . '</option>';
																			}
																		}
																	?>
																</select>
															</td>
															<td class="option-right">
																New sidebar name must be different from created sidebar names.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<?php
																	$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options&tab=sidebar&deleted=true' );
																?>
																<a class="button button-primary button-large" style="margin-top: 20px;" href="<?php echo esc_url( $impose_admin_url ); ?>">Delete</a>
															</td>
															<td class="option-right">
																Remove.
															</td>
														</tr>
													</table>
												</form>
											</div>
										</div>
									<?php
								break;
								
								case 'homepage' :
									
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="alert-success" title="Click to close"><p><strong>Saved.</strong></p></div>';
									}
									
									?>
										<div class="postbox">
											<div class="inside">
												<?php
													$impose_admin_url = admin_url( 'themes.php?page=impose-theme-options' );
												?>
												<form class="ajax-form" method="post" action="<?php echo esc_url( $impose_admin_url ); ?>">
													<?php
														wp_nonce_field( "settings-page" );
													?>
													
													<table>
														<tr>
															<td class="option-left">
																<h4>Rotate Words Animation</h4>
																<?php
																	$impose_homepage_rotate_words_animation = get_option( 'impose_homepage_rotate_words_animation', 'rotate-1' );
																?>
																<select name="impose_homepage_rotate_words_animation">
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'rotate-1' ) { echo 'selected="selected"'; } ?> value="rotate-1">Rotate</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'zoom' ) { echo 'selected="selected"'; } ?> value="zoom">Zoom</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'letters rotate-2' ) { echo 'selected="selected"'; } ?> value="letters rotate-2">Rotate Letters Vertically</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'letters rotate-3' ) { echo 'selected="selected"'; } ?> value="letters rotate-3">Rotate Letters Horizontally</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'letters scale' ) { echo 'selected="selected"'; } ?> value="letters scale">Scale</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'slide' ) { echo 'selected="selected"'; } ?> value="slide">Slide</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'push' ) { echo 'selected="selected"'; } ?> value="push">Push</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'letters type' ) { echo 'selected="selected"'; } ?> value="letters type">Type Letters</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'loading-bar' ) { echo 'selected="selected"'; } ?> value="loading-bar">Loading Bar</option>
																	<option <?php if ( $impose_homepage_rotate_words_animation == 'clip is-full-width' ) { echo 'selected="selected"'; } ?> value="clip is-full-width">Clip</option>
																</select>
															</td>
															<td class="option-right">
																Select animation type.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<h4>Latest Posts Count</h4>
																<?php
																	$impose_homepage_latest_posts_count = get_option( 'impose_homepage_latest_posts_count', '7' );
																?>
																<input type="number" min="1" max="50" step="1" name="impose_homepage_latest_posts_count" value="<?php echo esc_attr( $impose_homepage_latest_posts_count ); ?>">
															</td>
															<td class="option-right">
																Number of posts to show.
															</td>
														</tr>
														
														<tr>
															<td class="option-left">
																<input type="submit" name="submit" class="button button-primary button-large" value="Save Changes">
																
																<input type="hidden" name="settings-submit" value="Y">
															</td>
															<td class="option-right">
																
															</td>
														</tr>
													</table>
												</form>
											</div>
										</div>
									<?php
								break;
							}
						}
					?>
				</div>
			</div>
		<?php
	}


/* ============================================================================================================================================ */


	function impose_theme_save_settings()
	{
		global $pagenow;
		
		if ( $pagenow == 'themes.php' && $_GET['page'] == 'impose-theme-options' )
		{
			if ( isset ( $_GET['tab'] ) )
			{
				$tab = $_GET['tab'];
			}
			else
			{
				$tab = 'general';
			}
			
			
			switch ( $tab )
			{
				case 'general' :
				
					update_option( 'impose_logo_image', $_POST['impose_logo_image'] );
					update_option( 'impose_theme_site_title', $_POST['impose_theme_site_title'] );
					update_option( 'impose_theme_tagline', $_POST['impose_theme_tagline'] );
					update_option( 'impose_logo_login', $_POST['impose_logo_login'] );
					update_option( 'impose_logo_login_hide', $_POST['impose_logo_login_hide'] );
				
				break;
				
				case 'style' :
				
					update_option( 'impose_general_style', $_POST['impose_general_style'] );
					update_option( 'impose_header_type', $_POST['impose_header_type'] );
					update_option( 'impose_header_style', $_POST['impose_header_style'] );
					update_option( 'impose_header_menu', $_POST['impose_header_menu'] );
					update_option( 'impose_header_search', $_POST['impose_header_search'] );
					update_option( 'impose_char_set_latin', $_POST['impose_char_set_latin'] );
					update_option( 'impose_char_set_latin_ext', $_POST['impose_char_set_latin_ext'] );
					update_option( 'impose_char_set_cyrillic', $_POST['impose_char_set_cyrillic'] );
					update_option( 'impose_char_set_cyrillic_ext', $_POST['impose_char_set_cyrillic_ext'] );
					update_option( 'impose_char_set_greek', $_POST['impose_char_set_greek'] );
					update_option( 'impose_char_set_greek_ext', $_POST['impose_char_set_greek_ext'] );
					update_option( 'impose_char_set_vietnamese', $_POST['impose_char_set_vietnamese'] );
					update_option( 'impose_extra_font_styles', $_POST['impose_extra_font_styles'] );
					update_option( 'impose_mobile_zoom', $_POST['impose_mobile_zoom'] );
				
				break;
				
				case 'blog' :
				
					update_option( 'impose_blog_type', $_POST['impose_blog_type'] );
					update_option( 'impose_category_archive_type', $_POST['impose_category_archive_type'] );
					update_option( 'impose_tag_archive_type', $_POST['impose_tag_archive_type'] );
					update_option( 'impose_author_archive_type', $_POST['impose_author_archive_type'] );
					update_option( 'impose_date_archive_type', $_POST['impose_date_archive_type'] );
					update_option( 'impose_search_result_type', $_POST['impose_search_result_type'] );
					update_option( 'impose_grid_layout_type', $_POST['impose_grid_layout_type'] );
					update_option( 'impose_grid_layout_post_width', $_POST['impose_grid_layout_post_width'] );
					update_option( 'impose_irregular_layout_post_width', $_POST['impose_irregular_layout_post_width'] );
					update_option( 'impose_single_post_layout', $_POST['impose_single_post_layout'] );
					update_option( 'impose_blog_sidebar', $_POST['impose_blog_sidebar'] );
					update_option( 'impose_post_sidebar', $_POST['impose_post_sidebar'] );
					update_option( 'impose_theme_excerpt', $_POST['impose_theme_excerpt'] );
					update_option( 'impose_excerpt_length', $_POST['impose_excerpt_length'] );
					update_option( 'impose_share_links', $_POST['impose_share_links'] );
					update_option( 'impose_selection_shareable', $_POST['impose_selection_shareable'] );
					update_option( 'impose_about_the_author_module', $_POST['impose_about_the_author_module'] );
					update_option( 'impose_related_posts', $_POST['impose_related_posts'] );
					update_option( 'impose_pagination', $_POST['impose_pagination'] );
					update_option( 'impose_blog_scroll_animations', $_POST['impose_blog_scroll_animations'] );
					update_option( 'impose_blog_scroll_animations_type', $_POST['impose_blog_scroll_animations_type'] );
				
				break;
				
				case 'main-slider' :
				
					update_option( 'impose_main_slider_activate', $_POST['impose_main_slider_activate'] );
					update_option( 'impose_main_slider_slides', $_POST['impose_main_slider_slides'] );
					update_option( 'impose_main_slider_sticky_posts', $_POST['impose_main_slider_sticky_posts'] );
					update_option( 'impose_main_slider_latest_posts_count', $_POST['impose_main_slider_latest_posts_count'] );
					update_option( 'impose_homepage_owl_carousel_items', $_POST['impose_homepage_owl_carousel_items'] );
					update_option( 'impose_homepage_owl_carousel_loop', $_POST['impose_homepage_owl_carousel_loop'] );
					update_option( 'impose_homepage_owl_carousel_center', $_POST['impose_homepage_owl_carousel_center'] );
					update_option( 'impose_homepage_owl_carousel_mouse_drag', $_POST['impose_homepage_owl_carousel_mouse_drag'] );
					update_option( 'impose_homepage_owl_carousel_nav_links', $_POST['impose_homepage_owl_carousel_nav_links'] );
					update_option( 'impose_homepage_owl_carousel_nav_dots', $_POST['impose_homepage_owl_carousel_nav_dots'] );
					update_option( 'impose_homepage_owl_carousel_autoplay', $_POST['impose_homepage_owl_carousel_autoplay'] );
					update_option( 'impose_homepage_owl_carousel_autoplay_speed', $_POST['impose_homepage_owl_carousel_autoplay_speed'] );
					update_option( 'impose_homepage_owl_carousel_autoplay_timeout', $_POST['impose_homepage_owl_carousel_autoplay_timeout'] );
				
				break;
				
				case 'sidebar' :
				
					update_option( 'impose_no_sidebar_name', esc_attr( $_POST['impose_new_sidebar_name'] ) );
					
					if ( esc_attr( $_POST['impose_new_sidebar_name'] ) != "" )
					{
						$impose_sidebars_with_commas = get_option( 'impose_sidebars_with_commas', "" );
						
						if ( $impose_sidebars_with_commas == "" )
						{
							update_option( 'impose_sidebars_with_commas', esc_attr( $_POST['impose_new_sidebar_name'] ) );
						}
						else
						{
							update_option( 'impose_sidebars_with_commas', get_option( 'impose_sidebars_with_commas' ) . ',' . esc_attr( $_POST['impose_new_sidebar_name'] ) );
						}
					}
				
				break;
				
				case 'homepage' :
				
					update_option( 'impose_homepage_rotate_words_animation', $_POST['impose_homepage_rotate_words_animation'] );
					update_option( 'impose_homepage_latest_posts_count', $_POST['impose_homepage_latest_posts_count'] );
				
				break;
			}
		}
	}


/* ============================================================================================================================================ */


	function impose_load_settings_page()
	{
		if ( isset( $_POST["settings-submit"] ) == 'Y' )
		{
			check_admin_referer( "settings-page" );
			impose_theme_save_settings();
			$url_parameters = isset( $_GET['tab'] ) ? 'tab=' . $_GET['tab'] . '&saved=true' : 'saved=true';
			wp_redirect( admin_url( 'themes.php?page=impose-theme-options&' . $url_parameters ) );
			exit;
		}
	}


/* ============================================================================================================================================ */


	function impose_theme_menu()
	{
		$settings_page = add_theme_page('Theme Options',
										'Theme Options',
										'edit_theme_options',
										'impose-theme-options',
										'impose_theme_options_page' );
		
		add_action( "load-{$settings_page}", 'impose_load_settings_page' );
	}
	
	add_action( 'admin_menu', 'impose_theme_menu' );

?>