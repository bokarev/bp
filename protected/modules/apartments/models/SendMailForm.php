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

class SendMailForm extends CFormModel {
	public $senderName;
	public $senderEmail;
	public $senderPhone;
	public $body;
	public $verifyCode;

	public $ownerId;
	public $ownerEmail;
	public $ownerName;

	public $apartmentUrl;

	public function rules()	{
		return array(
			array('senderName, senderEmail, body', 'required'),
			array('senderEmail', 'email'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!Yii::app()->user->isGuest),
			array('senderPhone', 'safe'),
			array('senderName, senderEmail', 'length', 'max' => 128),
			array('senderPhone', 'length', 'max' => 16, 'min' => 5),
			array('body', 'length', 'max' => 1024),
		);
	}

	public function attributeLabels() {
		return array(
			'senderName' => tt('user_request_name', 'apartments'),
			'senderEmail' => tt('user_request_email', 'apartments'),
			'senderPhone' => tt('user_request_phone', 'apartments'),
			'body' => tt('user_request_message', 'apartments'),
			'verifyCode' => tt('user_request_ver_code', 'apartments'),
		);
	}
}