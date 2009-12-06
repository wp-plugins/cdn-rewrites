<?php
global $wpdb;
global $cdn_rewrites_config;
$cdn_rewrites_config = array(
	'profiles_table_name' => "{$wpdb->prefix}cdn_rewrites_profiles",
	'plugin_name' => 'cdn-rewrites',
    'plugin_path' => '/' . PLUGINDIR . '/cdn-rewrites/',
	'plugin_version' => '1.0.1',
	'plugin_url' => 'http://www.phoenixheart.net/wp-plugins/cdn-rewrites',
	'default_options' => array(
		'powered'   => true,
		'debug'     => false,
	),
);