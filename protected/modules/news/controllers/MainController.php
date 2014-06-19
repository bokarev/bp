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

class MainController extends ModuleUserController{
	public $modelName = 'News';

	public function init() {
		parent::init();

		$newsPage = Menu::model()->findByPk(Menu::NEWS_ID);
		if ($newsPage) {
			if ($newsPage->active == 0) {
				throw404();
			}
		}
	}

	public function actionIndex(){
		$model = new $this->modelName;
		$result = $model->getAllWithPagination();

		$this->render('index', array(
			'items' => $result['items'],
			'pages' => $result['pages'],
		));
	}
}