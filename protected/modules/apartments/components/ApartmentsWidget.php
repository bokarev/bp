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

class ApartmentsWidget extends CWidget {
	public $usePagination = 1;
	public $criteria = null;
	public $count = null;
	public $widgetTitle = null;
	public $breadcrumbs = null;

	public function getViewPath($checkTheme=false){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'apartments';
		}
		return Yii::getPathOfAlias('application.modules.apartments.views');
	}

	public function run() {
		Yii::import('application.modules.apartments.helpers.apartmentsHelper');
		$result = apartmentsHelper::getApartments(param('countListitng'.User::getModeListShow(), 10), $this->usePagination, 0, $this->criteria);

		if (!$this->breadcrumbs) {
			$this->breadcrumbs=array(
				Yii::t('common', 'Apartment search'),
			);
		}

		if($this->count){
			$result['count'] = $this->count;
		}
		else {
			$result['count'] = $result['apCount'];
		}

		$this->render('widgetApartments_list', $result);
	}
}