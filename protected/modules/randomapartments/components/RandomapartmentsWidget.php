<?php
/**********************************************************************************************
*                            CMS bp.4pr
*                              -----------------
*	version				:	1.2.0
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

class RandomapartmentsWidget extends CWidget {
	public $usePagination = 1;
	public $criteria = null;
	public $count = null;
	public $widgetTitle = null;

	public function getViewPath($checkTheme=false){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'apartments';
		}
		return Yii::getPathOfAlias('application.modules.apartments.views');
	}

	public function run() {
		Yii::import('application.modules.apartments.helpers.apartmentsHelper');

		$dependency = new CDbCacheDependency('SELECT MAX(date_updated) FROM {{apartment}}');
		$sql = 'SELECT id FROM {{apartment}} WHERE active="'.Apartment::STATUS_ACTIVE.'" ';

		if (param('useUserads'))
			$sql .= ' AND owner_active = '.Apartment::STATUS_ACTIVE;

		$results = Yii::app()->db->cache(param('cachingTime', 1209600), $dependency)->createCommand($sql)->queryColumn();
		shuffle($results);

		$this->criteria = new CDbCriteria;
		$this->criteria->addInCondition('t.id', array_slice($results, 0, param('countListitng'.User::getModeListShow(), 6)));

		$result = apartmentsHelper::getApartments(param('countListitng'.User::getModeListShow(), 6), $this->usePagination, 0, $this->criteria);

		if($this->count){
			$result['count'] = $this->count;
		}

		$this->render('widgetApartments_list', $result);
	}
}