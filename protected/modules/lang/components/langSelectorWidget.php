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

class langSelectorWidget extends CWidget
{
    public $type = 'dropdown';
    public $languages;

	public function getViewPath($checkTheme=false){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'lang';
		}
		return Yii::getPathOfAlias('application.modules.lang.views');
	}

    public function run()
    {
        $this->render('langSelectorFormWidget', array(
                'currentLang' => Yii::app()->language,
                'languages' => ($this->languages) ? $this->languages : Lang::getActiveLangs(true),
                'type' => $this->type
            )
        );
    }
}
?>