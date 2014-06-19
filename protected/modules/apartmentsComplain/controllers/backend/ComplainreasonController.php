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

class ComplainreasonController extends ModuleAdminController{
	public $modelName = 'ApartmentsComplainReason';
	public $redirectTo = array('admin');

	public function getViewPath($checkTheme=false){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->getModule($this->id)->getName().DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'reason';
		}
		return Yii::getPathOfAlias('application.modules.'.$this->getModule($this->id)->getName().'.views.backend.reason');
	}

	public function actionAdmin() {
		$this->getMaxSorter();
		$this->getMinSorter();

		parent::actionAdmin();
	}

	public function actionView($id) {
		$this->redirect($this->redirectTo);
	}
}
