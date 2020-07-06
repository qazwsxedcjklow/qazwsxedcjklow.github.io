(function($) {


// ====================================================================================================================
// ====================================================================================================================


	wp.customize( 'blogname', function( value )
	{
		value.bind( function( to )
		{
			$( 'header h1.site-title a' ).html( to );
		});
	});
	
	
	wp.customize( 'blogdescription', function( value )
	{
		value.bind( function( to )
		{
			$( 'header  p.site-description' ).html( to );
		});
	});


// ====================================================================================================================
// ====================================================================================================================
	
	
 	wp.customize( 'impose_setting_font_1', function( value )
	{
		value.bind( function( to )
		{
			$( 'body' ).append( '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' + to + ':300,400,500,600,700,800,900,300italic,400italic,500italic,600italic,700italic,800italic,900italic">' );
			
			
			var styleCss = '<style type="text/css">' + 
							
								'.site-title { font-family: "' + to + '"; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});
	
	
 	wp.customize( 'impose_setting_font_2', function( value )
	{
		value.bind( function( to )
		{
			$( 'body' ).append( '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' + to + ':300,400,500,600,700,800,900,300italic,400italic,500italic,600italic,700italic,800italic,900italic">' );
			
			
			var styleCss = '<style type="text/css">' + 
							
								'.nav-menu, .widget-title, .nav-single h4, .about-author h3, .share-links h3, .related-posts h3, .comments-area h3, .entry-title i { font-family: "' + to + '"; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});
	
	
 	wp.customize( 'impose_setting_font_3', function( value )
	{
		value.bind( function( to )
		{
			$( 'body' ).append( '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' + to + ':300,400,500,600,700,800,900,300italic,400italic,500italic,600italic,700italic,800italic,900italic">' );
			
			
			var styleCss = '<style type="text/css">' + 
							
								'h1, h2, h3, h4, h5, h6, #search-field, .nav-single, .comment-meta .fn, .yarpp-thumbnail-title, .widget_categories ul li,.widget_recent_entries ul li, .tptn_title, .blog-simple .day, .intro .wp-caption-text { font-family: "' + to + '"; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});
	
	
 	wp.customize( 'impose_setting_font_4', function( value )
	{
		value.bind( function( to )
		{
			$( 'body' ).append( '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' + to + ':300,400,500,600,700,800,900,300italic,400italic,500italic,600italic,700italic,800italic,900italic">' );
			
			
			var styleCss = '<style type="text/css">' + 
							
								'body, input, textarea, select, button, .event h5, .event h6 { font-family: "' + to + '"; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});


// ====================================================================================================================
// ====================================================================================================================


	wp.customize( 'impose_setting_color_1', function( value )
	{
		value.bind( function( to )
		{
			var styleCss = '<style type="text/css">' + 
							
								'a { color: ' + to + '; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});
	
	
	wp.customize( 'impose_setting_color_2', function( value )
	{
		value.bind( function( to )
		{
			var styleCss = '<style type="text/css">' + 
							
								'a:hover { color: ' + to + '; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});
	
	
	wp.customize( 'impose_setting_color_3', function( value )
	{
		value.bind( function( to )
		{
			var styleCss = '<style type="text/css">' + 
							
								'.site-navigation { background: ' + to + '; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});
	
	
	wp.customize( 'impose_setting_color_4', function( value )
	{
		value.bind( function( to )
		{
			var styleCss = '<style type="text/css">' + 
							
								'.flat-style .entry-meta .cat-links a, .flay-style .owl-theme .owl-dots .owl-dot.active span, .flat-style input[type=submit], .flat-style input[type=button], .flat-style button, .flat-style a.button, .flat-style .button, .flat-style .skill-unit .bar .progress span, .flat-style .event [class*="pw-icon-"], .flat-style .owl-theme .owl-dots .owl-dot.active span { background: ' + to + '; }' +
								
								'.flat-style .format-link .entry-content > p:first-child a:first-child, .flat-style .event.current:after, .flat-style input:not([type=submit]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]):focus, .flat-style textarea:focus, .flat-style select:focus { border-color: ' + to + '; }' +
							
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});


// ====================================================================================================================
// ====================================================================================================================


 	wp.customize( 'impose_setting_content_width', function( value )
	{
		value.bind( function( to )
		{
			var styleCss = '<style type="text/css">' + 
								
								'.layout-medium { max-width: ' + to + '; }' +
								
							'</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});


// ====================================================================================================================
// ====================================================================================================================


 	wp.customize( 'impose_setting_custom_css', function( value )
	{
		value.bind( function( to )
		{
			var styleCss = '<style type="text/css">' + to + '</style>';
			
			
			$( 'body' ).append( styleCss );
		});
	});


// ====================================================================================================================
// ====================================================================================================================


})(jQuery);