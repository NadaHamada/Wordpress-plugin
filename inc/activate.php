<?php
/**
* @package owndesignPlugin
*/

class OwndesignPluginActivate
{
	public static function activate(){
		flush_rewrite_rules();
	}
}