<?php

/**
* uninstall plugin
*
* @package owndesignPlugin
*/

if(! defined('WP_UNINSTALL_PLUGIN')){
	die;
}
//clear DB after uninstall
$designs = get_posts(array('post_type'=>'design','numberposts'=>-1));
foreach ($designs as $design) {
	wp_delete_post($design->ID,true);
}