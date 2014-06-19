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
?>

<div class="language-select">
    <?php
    switch ($type) {
        case 'flags':
            foreach ($languages as $lang) {
                if ($lang['name_iso'] != $currentLang) {
                    echo CHtml::link(
                        '<img src="'  . Yii::app()->getBaseUrl() . Lang::FLAG_DIR . $lang['flag_img'] . '" title="' . $lang['name'] . '">',
                        $this->getOwner()->createLangUrl($lang['name_iso'])
                    );
                }
                ;
            }
            break;

        case 'links':
            $lastElement = end($languages);

            foreach ($languages as $lang) {
                $imgFlag = '<img src="'  . Yii::app()->getBaseUrl() . Lang::FLAG_DIR . $lang['flag_img'] . '" title="' . $lang['name'] . '" class="flag_img">';
                if ($lang['name_iso'] != $currentLang) {
                    echo CHtml::link(
                        $imgFlag . $lang['name'],
                        $this->getOwner()->createLangUrl($lang['name_iso']),
                        array('class' => 'language-select-link')
                    );
                } else {
                    echo '<b>' . $imgFlag . $lang['name'] . '</b>';
                }
                if ($lang != $lastElement) echo ' | ';
            }
            break;

        case 'dropdown':
            echo CHtml::form();
            $dropDownLangs = array();
            foreach ($languages as $lang) {
                echo CHtml::hiddenField(
                    $lang['name_iso'],
                    $this->getOwner()->createLangUrl($lang['name_iso'])
                    , array('id' => 'langurl_' . $lang['name_iso'])
                );
                $dropDownLangs[$lang['name_iso']] = $lang['name'];
            }
            echo CHtml::dropDownList('lang', $currentLang, $dropDownLangs,
                array(
                    'onclick' => ' this.form.action=$("#langurl_"+this.value).val(); this.form.submit(); return false; ',
                )
            );
            echo CHtml::endForm();

            break;
    }

    ?>
</div>