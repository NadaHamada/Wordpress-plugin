<?php
/**
* @package owndesignPlugin
*/
/**
Plugin Name: Owndesign 
Description: يمكنك إضافة موديﻻت لفساتين جديدة و عرضها علي المستخدم ليصنع تصميمه بنفسه .
Version: 1.0.0
Author: imCan
Author URI: http://flyimcan.com/shop/wordpress
Text Domain: create your own design
*/
defined('ABSPATH') or die('Hey, dead end');
if ( file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
	require_once dirname(__FILE__).'/vendor/autoload.php';
}
if ( !class_exists('OwndesignPlugin')) {

class OwndesignPlugin
{	
	
	//activated based on developer desire
	function register(){
		//replace admin with wp if you want style in frontend
		add_action('admin_enqueue_scripts',array($this, 'enqueue'));
		add_action('admin_menu',array($this, 'add_pages'));
		// adds links
		add_filter('plugin_action_links_' . plugin_basename( __FILE__ ),array($this,'plugin_pages'));
	}
	public function plugin_pages($links){
		//add pages to plugin
		$admin = '<a href="admin.php?page=owndesign_plugin">إضافة تصميم</a>';
		array_push($links, $admin);
		return $links;
	}

	public function plugin_subpages($links){
		$orders = '<a href="orders.php?page=owndesign_plugin">Check Orders</a>';
		array_push($links, $orders);
		return $links;
	}

	public function add_pages(){
		add_menu_page('add template','عرض القوالب','manage_options','owndesign_plugin',array($this,'admin_index'),'dashicons-admin-customizer',20);
		add_submenu_page( 'owndesign_plugin', 'orders', 'عرض الطلبات', 'manage_options','orders', array($this,'check_order'));
	}

	public function admin_index(){
		//activate templates
		require_once plugin_dir_path(__FILE__).'templates/admin.php';
	}
	public function check_order(){
		//activate templates
		require_once plugin_dir_path(__FILE__).'templates/orders.php';
	}
	protected function create_post_type(){
		add_action('init',array($this, 'custom_post_type'));
	}

	function custom_post_type(){
		register_post_type('design',['public'=> true, 'label'=>'Design']);
	}
	//enqueue css & js
	function enqueue(){
		wp_enqueue_style('owndesignstyle',plugins_url('/assets/sample.css',__FILE__),array(),false,'all');
		wp_enqueue_script('owndesignscript',plugins_url('/assets/sample.js',__FILE__),array(),false,'all');
	}
}

	$owndesignPlugin = new OwndesignPlugin();
	$owndesignPlugin->register();
}

// activation
require_once plugin_dir_path(__FILE__).'inc/activate.php';
register_activation_hook(__FILE__, array('OwndesignPluginActivate', 'activate'));

//deactivation
require_once plugin_dir_path(__FILE__).'inc/deactivate.php';
register_deactivation_hook(__FILE__, array('OwndesignPluginDeactivate', 'deactivate'));