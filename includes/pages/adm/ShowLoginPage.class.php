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
class ShowLoginPage extends AbstractAdminPage
{

	function __construct()
	{
		global $USER;

		if ($USER['authlevel'] == AUTH_USR)
		{
		  throw new PagePermissionException("Permission error!");
		}

		parent::__construct();
		$this->setWindow('login');
	}

	function show(){
		global $USER;

		$session	= Session::create();
		if($session->adminAccess == 1)
		{
			$this->redirectTo('admin.php?page=overview');
		}


		$this->assign(array(
			'bodyclass'	=> 'standalone',
			'username'	=> $USER['username'],
		));

		$this->display('page.login.default.tpl');

	}


	function validate(){
		global $USER, $LNG;

		$error = array();

		$enteredPassword = HTTP::_GP('password', '', true);

		if (!password_verify($enteredPassword, $USER['password'])) {
			$error[] = $LNG['adm_bad_password'];
		}

		if (empty($error)) {

			$session	= Session::create();
			$session->adminAccess	= 1;

			$data = array();
			$data['status'] = "redirect";
			$this->sendJSON($data);
		}else {
			$error['status'] = "fail";
			$this->sendJSON($error);
		}


	}

}
