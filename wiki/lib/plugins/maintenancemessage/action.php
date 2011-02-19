<?php
/**
 * Example Action Plugin:   Example Component.
 * 
 * @author     Samuele Tognini <samuele@cli.di.unipi.it>
 */
 
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');
 
class action_plugin_maintenancemessage extends DokuWiki_Action_Plugin {
 
	/**
	 * return some info
	 */
	function getInfo(){
		return confToHash(dirname(__FILE__).'/INFO.txt');
	}
	
	/**
	 * Register its handlers with the DokuWiki's event controller
	 */
	function register(&$controller) {
		$controller->register_hook('TPL_CONTENT_DISPLAY', 'BEFORE',  $this, '_printmaintenance');
		$controller->register_hook('AUTH_LOGIN_CHECK', 'BEFORE',  $this, '_denylogin');
		$controller->register_hook('TPL_ACT_RENDER', 'BEFORE',  $this, '_denyediting');
	}
	 
	/**
	 * Print Maintenance Message.
	 *
	 * @author Thomas Hawkins <thawkins@mun.ca>
	 */
	function _printmaintenance(&$event, $param){
		$html = &$event->data;
		if($this->getConf('maintenance_message_on') == true){
			$message = $this->getConf('maintenance_message_text');
			$html = '<div class="maintenancemessage">' . $message . '</div>' . $html;
		}
	}
	/**
	 * Denies login for all users.
	 *
	 * @author Thomas Hawkins <thawkins@mun.ca>
	 */
	function _denylogin(&$event, $param){
		$html = &$event->data;
		if($this->getConf('deny_all_logins') == true){
			$event->preventDefault();
			$message = $this->getConf('deny_login_message');
			$html = '<div class="maintenancemessage">' . $message . '</div>';
		}
	}
	/**
	 * Denies a user from editing any pages.
	 *
	 * @author Thomas Hawkins <thawkins@mun.ca>
	 */
	function _denyediting(&$event, $param){
		if($event->data != 'edit') return;
		if($this->getConf('deny_editing') == true){
			$message = $this->getConf('deny_editing_message');
			echo '<div class="denyeditmessage">' . $message . '</div>';
			$event->preventDefault();
		}
	}
}