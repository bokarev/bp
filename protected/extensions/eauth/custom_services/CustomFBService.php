<?php
/**********************************************************************************************
*                            CMS bp.4pr
*                              -----------------
*	version				:	1.8.2
*	copyright			:	(c) 2014 4pr
*	website				:	http://www.4pr.ru/
*	contact us			:	http://www.4pr.ru/contact
*
* This file is part of CMS bp.4pr
*
* bp.4pr is free software. This work is licensed under a GNU GPL.
* http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
* bp.4pr is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
***********************************************************************************************/

require_once dirname(dirname(__FILE__)).'/services/FacebookOAuthService.php';

class CustomFBService extends FacebookOAuthService {
	protected $jsArguments = array('popup' => array('width' => 750, 'height' => 450));
	protected $scope = 'email';
	protected $client_id = '';
	protected $client_secret = '';
	protected $providerOptions = array(
		'authorize' => 'https://www.facebook.com/dialog/oauth',
		'access_token' => 'https://graph.facebook.com/oauth/access_token',
	);

	public function __construct() {

		$this->title = tt('facebook_label', 'socialauth');
	}

	protected function fetchAttributes() {
		$info = (object) $this->makeSignedRequest('https://graph.facebook.com/me');

		$this->attributes['id'] = $info->id;
		$this->attributes['firstName'] = $info->first_name;
		$this->attributes['email'] = (isset($info->email) && $info->email) ? $info->email : '';
		$this->attributes['mobilePhone'] = '';
		$this->attributes['homePhone'] = '';
		$this->attributes['url'] = $info->link;
	}
}
