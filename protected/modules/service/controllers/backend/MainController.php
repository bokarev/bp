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
	public $modelName = 'Service';

	public function actionUpdate($id) {
		$this->redirect('admin');
	}

	public function actionDelete($id) {
		$this->redirect('admin');
	}

	public function actionCreate() {
		$this->redirect('admin');
	}

    public function actionAdmin(){
		$model = $this->loadModel(Service::SERVICE_ID);
		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				Yii::app()->user->setFlash('success', tt('success_saved', 'service'));
			}
			else
				Yii::app()->user->setFlash('error', tt('failed_save_try_later', 'service'));
		}

		$this->render('update', array('model' => $model));
    }
}