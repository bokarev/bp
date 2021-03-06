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
	public $modelName = 'ApartmentCity';

	public function actionView($id){
		$this->redirect(array('admin'));
	}
	public function actionIndex(){
		$this->redirect(array('admin'));
	}

	public function actionAdmin(){
		$this->getMaxSorter();
		parent::actionAdmin();
	}

    public function actionDelete($id){

        // Не дадим удалить последний город
        if(ApartmentCity::model()->count() <= 1){
            if(!isset($_GET['ajax'])){
                Yii::app()->user->setFlash('error', tt('You can not delete the last city'));
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }else{
                echo "<div class='flash-error'>".tt('You can not delete the last city')."</div>";
            }
            Yii::app()->end();
        }

        parent::actionDelete($id);
    }
}
