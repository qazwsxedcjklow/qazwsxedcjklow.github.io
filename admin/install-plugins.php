<?php

	require_once get_template_directory() . '/admin/class-tgm-plugin-activation.php';
	
	function impose_plugins()
	{
		$config = array(
			'id'           => 'impose_tgmpa',
			'default_path' => "",
			'menu'         => 'impose-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => esc_html__('Install Plugins', 'impose'),
			'is_automatic' => true,
			'message'      => "",
			'strings'      => array('nag_type' => 'updated')
		);
		
		$plugins = array(
			array(
				'name'               => esc_html__('Impose Shortcodes', 'impose'),
				'slug'               => 'impose-shortcodes',
				'source'             => get_template_directory() . '/admin/plugins/impose-shortcodes.zip',
				'version'            => '1.0.2',
				'required'           => false,
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => "",
				'is_callable'        => ""
			),
			array(
				'name'     => esc_html__('One Click Demo Import', 'impose'),
				'slug'     => 'one-click-demo-import',
				'required' => false
			),
			array(
				'name'     => esc_html__('Regenerate Thumbnails', 'impose'),
				'slug'     => 'regenerate-thumbnails',
				'required' => false
			),
			array(
				'name'     => esc_html__('Loco Translate', 'impose'),
				'slug'     => 'loco-translate',
				'required' => false
			),
			array(
				'name'     => esc_html__('Instagram Feed Gallery', 'impose'),
				'slug'     => 'insta-gallery',
				'required' => false
			),
			array(
				'name'     => esc_html__('Top 10 - Popular Posts', 'impose'),
				'slug'     => 'top-10',
				'required' => false
			),
			array(
				'name'     => esc_html__('MailChimp for WordPress', 'impose'),
				'slug'     => 'mailchimp-for-wp',
				'required' => false
			)
		);
		
		tgmpa($plugins, $config);
	}
	
	add_action('tgmpa_register', 'impose_plugins');

?>