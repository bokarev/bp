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

class Module extends CWebModule {

	public $defaultController = 'main';

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
			'application.modules.'.$this->getName() . '.models.*',
			'application.modules.'.$this->getName() . '.components.*',
		));
		$this->setViewPath(Yii::app()->getBasePath() . '/modules/' . $this->getName(). '/views');
	}

	public static function t($str='',$params=array(),$dic=null) {
		if(Yii::app()->controller->module){
			if($dic === null){
				return Yii::t('module_'.Yii::app()->controller->module->id, $str, $params);
			}
			else{
				return Yii::t('module_'.Yii::app()->controller->module->id.'_'.$dic, $str, $params);
			}
		}
	}
}
