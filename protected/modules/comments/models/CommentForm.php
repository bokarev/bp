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

class CommentForm extends CFormModel {
	public $body;
	public $url;
	public $verifyCode;

	public $enableRating = false;

	public $rating;
	public $user_name;
	public $user_email;

	public $rel;

	public $modelName;
	public $modelId;

	public function attributeLabels(){
		return array(
			'body' => Yii::t('module_comments', 'Comment'),
			'rating' => Yii::t('module_comments', 'Rate'),
			'user_name' => Yii::t('module_comments', 'Name'),
			'user_email' => Yii::t('module_comments', 'Email'),
			'verifyCode' => tt('Verification Code', 'contactform'),
		);
	}

	public function rules()	{
		$return = array(
			array('body', 'required'),

			array('verifyCode', (Yii::app()->user->isGuest || param('useCaptchaCommentsForRegistered', 1)) ? 'required' : 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=> !(Yii::app()->user->isGuest || param('useCaptchaCommentsForRegistered', 1))),

			array('user_name, user_email', 'length', 'max' => 64),
			array('user_email', 'email'),
			array('rating, url, modelName, modelId, rel', 'safe'),
		);

		if(Yii::app()->user->isGuest){
			$return[] = array('user_name, user_email', 'required');
		}

		return $return;
	}

	public function defineShowRating(){
		if($this->modelName == 'Apartment'){
			$this->enableRating = true;
		}
	}

}
