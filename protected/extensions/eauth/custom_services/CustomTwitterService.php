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

require_once dirname(dirname(__FILE__)).'/services/TwitterOAuthService.php';

class CustomTwitterService extends TwitterOAuthService {
	protected $jsArguments = array('popup' => array('width' => 750, 'height' => 450));
	protected $key = '';
	protected $secret = '';
	protected $providerOptions = array(
		'request' => 'https://api.twitter.com/oauth/request_token',
		'authorize' => 'https://api.twitter.com/oauth/authorize',  //'https://api.twitter.com/oauth/authenticate',
		'access' => 'https://api.twitter.com/oauth/access_token',
	);

	public function __construct() {
		$this->title = tt('twitter_label', 'socialauth');
	}

	protected function fetchAttributes() {
		$info = $this->makeSignedRequest('https://api.twitter.com/1.1/account/verify_credentials.json');

		$this->attributes['id'] = $info->id;
		$this->attributes['firstName'] = $info->name; // $info->screen_name;
		$this->attributes['email'] = '';
		$this->attributes['mobilePhone'] = '';
		$this->attributes['homePhone'] = '';
		$this->attributes['url'] = 'http://twitter.com/account/redirect_by_id?id='.$info->id_str;
	}
}