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

class MainController extends ModuleAdminController{
	public $modelName = 'Article';

	public function actionIndex(){
		//$this->layout='//layouts/inner';

		$criteria=new CDbCriteria;
		$criteria->order = 'sorter';
		$criteria->condition = 'active=1';

		$pages = new CPagination(Article::model()->count($criteria));
		$pages->pageSize = param('module_articles_itemsPerPage', 10);
		$pages->applyLimit($criteria);

		$articles = Article::model()->findAll($criteria);

		$this->render('index',array(
			'articles' => $articles, 'pages' => $pages
		));
	}

	public function actionView($id){
		//$this->layout='//layouts/inner';

		$criteria=new CDbCriteria;
		$criteria->order = 'sorter';
		$criteria->condition = 'active=1';
		$articles = Article::model()->findAll($criteria);

		$this->render('view',array(
			'model'=>$this->loadModel($id), 'articles' => $articles
		));
	}

	public function actionAdmin(){
		$this->getMaxSorter();
		parent::actionAdmin();
	}
}