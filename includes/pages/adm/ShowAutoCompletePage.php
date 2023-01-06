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
 * @version 1.8.0
 * @link https://github.com/jkroepke/2Moons
 */

if ($USER['authlevel'] == AUTH_USR)
{
	throw new Exception("Permission error!");
}

function ShowAutoCompletePage()
{
	$searchText	= HTTP::_GP('term', '', UTF8_SUPPORT);
	$searchList	= array();

	if(empty($searchText) || $searchText === '#') {
		echo json_encode(array());
		exit;
	}

	if(substr($searchText, 0, 1) === '#')
	{
		$where = 'id = '.((int) substr($searchText, 1));
		$orderBy = ' ORDER BY id ASC';
	}
	else
	{
		$where = "username LIKE '%". $searchText ."%'";
		$orderBy = " ORDER BY (IF(username = '". $searchText ."', 1, 0) + IF(username LIKE '" . $searchText ."%', 1, 0)) DESC, username";
	}

	$sql = "SELECT id, username FROM %%USERS%% WHERE universe = :universe AND " . $where . $orderBy . " LIMIT 20";

	$userRaw = Database::get()->select($sql,array(
		':universe' => Universe::getEmulated()
	));

	foreach($userRaw as $userRow)
	{
		$searchList[]	= array(
			'label' => $userRow['username'].' (ID:'.$userRow['id'].')',
			'value' => $userRow['username']
		);
	}

	echo json_encode($searchList);
	exit;
}
