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

/* draw gallery with control buttons, inputs for comments */
class AdminViewImagesWidget extends CWidget {

	public $objectId;
	public $images;
	public $withMain = true;

	public function getViewPath($checkTheme=false){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'images';
		}
		return Yii::getPathOfAlias('application.modules.images.views');
	}

	public function run() {
		if(!$this->images){
			$sql = 'SELECT id, file_name, comment, id_object, file_name_modified, is_main FROM {{images}} WHERE id_object=:id ORDER BY sorter';
			$this->images = Images::model()->findAllBySql($sql, array(':id' => $this->objectId));
		}

		$this->render('widgetAdminViewImages', array(
			'images' => $this->images,
		));
	}
}