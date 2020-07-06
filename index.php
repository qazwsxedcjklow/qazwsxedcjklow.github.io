<?php
	if (isset($_GET['layout']))
	{
		if ( $_GET['layout'] == 'list' )
		{
			get_template_part( 'layout', 'list' );
		}
		elseif ( $_GET['layout'] == 'grid' )
		{
			get_template_part( 'layout', 'grid' );
		}
		elseif ( $_GET['layout'] == 'creative' )
		{
			get_template_part( 'layout', 'creative' );
		}
		elseif ( $_GET['layout'] == 'bold' )
		{
			get_template_part( 'layout', 'bold' );
		}
		elseif ( $_GET['layout'] == 'waterfall' )
		{
			get_template_part( 'layout', 'waterfall' );
		}
		elseif ( $_GET['layout'] == 'irregular' )
		{
			get_template_part( 'layout', 'irregular' );
		}
		else
		{
			get_template_part( 'layout', 'regular' );
		}
	}
	else
	{
		$layout = "";
		
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
		
		
		if (( $layout == 'List' ) || ( $layout == '1st Full + List' ))
		{
			get_template_part( 'layout', 'list' );
		}
		elseif (( $layout == 'Grid' ) || ( $layout == '1st Full + Grid' ))
		{
			get_template_part( 'layout', 'grid' );
		}
		elseif (( $layout == 'Creative' ) || ( $layout == '1st Full + Creative' ))
		{
			get_template_part( 'layout', 'creative' );
		}
		elseif (( $layout == 'Irregular' ) || ( $layout == '1st Full + Irregular' ))
		{
			get_template_part( 'layout', 'irregular' );
		}
		elseif ( $layout == 'Bold' )
		{
			get_template_part( 'layout', 'bold' );
		}
		elseif ( $layout == 'Waterfall' )
		{
			get_template_part( 'layout', 'waterfall' );
		}
		else
		{
			get_template_part( 'layout', 'regular' );
		}
	}
?>