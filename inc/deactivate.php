<?php
/**
* @package owndesignPlugin
*/

class OwndesignPluginDeactivate
{
	public static function deactivate(){
		flush_rewrite_rules();
	}
}