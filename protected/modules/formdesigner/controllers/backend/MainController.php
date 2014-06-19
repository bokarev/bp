<?php
/**********************************************************************************************
*                            CMS bp.4pr
*                              -----------------
*	version				:	1.8.2
*	copyright			:	(c) 2012 4pr
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
	public $modelName = 'FormDesigner';

    public function actionAdmin() {
        $model = new $this->modelName('search');
        $model->resetScope();

        if($this->scenario){
            $model->scenario = $this->scenario;
        }

        if($this->with){
            $model = $model->with($this->with);
        }

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->modelName])){
            $model->attributes=$_GET[$this->modelName];
        }
        $this->render('admin',
            array_merge(array('model'=>$model), $this->params)
        );
    }

    public function actionVisible() {
        $id = Yii::app()->request->getParam('id', null);

        $model = $this->loadModel($id);

        $model->visible = $model->visible ? 0 : 1;
        $model->update('visible');

        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function actionUpdate($id){
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if(isset($_POST[$this->modelName])){
            $model->attributes=$_POST[$this->modelName];

            $model->scenario = 'save_types';

            if($model->save()){
                $this->redirect(array('admin'));
            }
        }

        $this->render('_setup_form',
            array('model'=>$model)
        );
    }

}
