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

class CustomPagination extends CPagination {
	public function createPageUrl($controller,$page)         {
			$params=$this->params===null ? $_GET : $this->params;
	//      if($page>0) // page 0 is the default
					$params[$this->pageVar]=$page+1;
	//      else
	//              unset($params[$this->pageVar]);
			return $controller->createUrl($this->route,$params);
	}
}