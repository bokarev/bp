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
class SimpleformModel extends CFormModel {
	public $username;
	public $comment;
	public $useremail;
	public $phone;
	public $date_start;
	public $date_end;
	public $time_in;
	public $time_out;
	public $user_id;
	public $password;
	public $email;
	public $type;

	public $time_inVal;
	public $time_outVal;

	public $activatekey;
	public $activateLink;

	public $verifyCode;

	public function rules() {
		return array(
			array('date_start, date_end, time_in, time_out, type, ' . (Yii::app()->user->isGuest ? 'useremail, username' : ''), 'required', 'on' => 'forrent'),
			array('type, ' . (Yii::app()->user->isGuest ? 'useremail, username' : ''), 'required', 'on' => 'forbuy'),
			array('time_in, time_out', 'numerical', 'integerOnly' => true, 'on' => 'forrent'),
			array('useremail', 'email'),
			array('date_start, date_end', 'date', 'format' => Booking::getYiiDateFormat(), 'on' => 'forrent'),
			array('date_start, date_end', 'myDateValidator', 'on' => 'forrent'),
			array('useremail', 'myUserEmailValidator'),
			array('useremail, username, phone', 'length', 'max' => 128),
			array('phone', 'required'),
			array('comment, type', 'safe'),

			array('verifyCode', (Yii::app()->user->isGuest) ? 'required' : 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=> !(Yii::app()->user->isGuest)),
		);
	}

	public function myUserEmailValidator() {
		if (Yii::app()->user->isGuest) {
			$model = User::model()->findByAttributes(array('email' => $this->useremail));
			if ($model) {
				$this->addError('useremail',
					Yii::t('module_booking', 'User with such e-mail already registered. Please <a title="Login" href="{n}">login</a> and try again.',
						Yii::app()->createUrl('/site/login')));
			}
		}
	}

	public function myDateValidator($param) {
		$dateStart = CDateTimeParser::parse($this->date_start, Booking::getYiiDateFormat()); // format to unix timestamp
		$dateEnd = CDateTimeParser::parse($this->date_end, Booking::getYiiDateFormat()); // format to unix timestamp

		if ($param == 'date_start' && $dateStart < CDateTimeParser::parse(date('Y-m-d'), 'yyyy-MM-dd')) {
			$this->addError('date_start', tt('Wrong check-in date', 'booking'));
		}
		if ($param == 'date_end' && $dateEnd <= $dateStart) {
			$this->addError('date_end', tt('Wrong check-out date', 'booking'));
		}
	}

	public function attributeLabels() {
		return array(
			'date_start' => tt('Check-in date', 'booking'),
			'date_end' => tt('Check-out date', 'booking'),
			'email' => Yii::t('common', 'E-mail'),
			'time_in' => tt('Check-in time', 'booking'),
			'time_out' => tt('Check-out time', 'booking'),
			'comment' => tt('Comment', 'booking'),
			'username' => tt('Your name', 'booking'),
			'useremail' => tt('Email', 'booking'),
			'phone' => Yii::t('common', 'Your phone number'),
			'rooms' => Yii::t('common', 'Number of rooms'),
			'type' => Yii::t('common', 'I want'),
			'verifyCode' => tc('Verify Code'),
		);
	}

    public function getTypeName(){
        return $this->type;
        //$types = Apartment::getTypesWantArray();
        //return isset($types[$this->type]) ? $types[$this->type] : '';
    }
}