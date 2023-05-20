<?php

/**
 *  2Moons
 *   by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package 2Moons
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @licence MIT
 * @version 1.8.x Koray Karakuş <koraykarakus@yahoo.com>
 * @link https://github.com/jkroepke/2Moons
 */

/**
 *
 */
class ShowFacebookPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){
		global $LNG;

		$config = Config::get(Universe::getEmulated());

		$this->assign(array(
			'fb_on'					=> $config->fb_on,
			'fb_apikey'				=> $config->fb_apikey,
			'fb_skey'				=> $config->fb_skey,
			'fb_curl'				=> function_exists('curl_init') ? 1 : 0,
			'fb_curl_info'			=> function_exists('curl_init') ? $LNG['fb_curl_yes'] : $LNG['fb_curl_no'],
		));

		$this->display('page.facebook.default.tpl');

	}

	function saveSettings(){

		// TODO: buggy
		global $LNG;

		$config = Config::get(Universe::getEmulated());


		$fb_on = HTTP::_GP('fb_on', '') === "on" ? 1 : 0;
		$fb_apikey	= HTTP::_GP('fb_apikey', '');
		$fb_skey 	= HTTP::_GP('fb_skey', '');


		foreach(array(
					'fb_on'		=> $fb_on,
					'fb_apikey'	=> $fb_apikey,
					'fb_skey'	=> $fb_skey
		) as $key => $value) {
			$config->$key	= $value;
		}

		$config->save();

		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=facebook&mode=show',
			'label' => $LNG['uvs_back']
		);

		$this->printMessage($LNG['settings_successful'],$redirectButton);

	}

}
