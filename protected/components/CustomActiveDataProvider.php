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

class CustomActiveDataProvider extends CActiveDataProvider {
	private $_pagination;

    // override to create instance of CustomPagination
    public function getPagination() {
        if ($this->_pagination === null) {

            $this->_pagination = new CustomPagination;
            if (($id = $this->getId()) != '')
                $this->_pagination->pageVar = $id . '_page';
        }
        return $this->_pagination;
    }
}