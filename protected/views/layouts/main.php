<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
/*$nameRFC3066 = 'ru-ru';
$allLangs = Lang::getActiveLangs(true);
if ($allLangs) {
	$nameRFC3066 = (array_key_exists(Yii::app()->language, $allLangs) && array_key_exists('name_rfc3066', $allLangs[Yii::app()->language])) ? $allLangs[Yii::app()->language]['name_rfc3066'] : 'ru-ru';
}
$nameRFC3066 = utf8_strtolower($nameRFC3066);
*/
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language;?>" lang="<?php echo Yii::app()->language;?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php echo CHtml::encode($this->seoTitle ? $this->seoTitle : $this->pageTitle); ?></title>
	<meta name="description" content="<?php echo CHtml::encode($this->seoDescription ? $this->seoDescription : $this->pageDescription); ?>" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->seoKeywords ? $this->seoKeywords : $this->pageKeywords); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,500&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/print.css" media="print" />
	<!--<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/form.css" />-->
	<link media="screen, projection" type="text/css" href="<?php echo $baseUrl; ?>/css/styles.css" rel="stylesheet" />

	<!--[if IE]> <link href="<?php echo $baseUrl; ?>/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

	<link rel="icon" href="<?php echo $baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo $baseUrl; ?>/favicon.ico" type="image/x-icon" />

	<?php
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	$cs->registerCoreScript('rating');
	$cs->registerCssFile($cs->getCoreScriptUrl().'/rating/jquery.rating.css');
	$cs->registerCssFile($baseUrl . '/css/ui/jquery-ui.multiselect.css');
	$cs->registerCssFile($baseUrl . '/css/redmond/jquery-ui-1.7.1.custom.css');
	$cs->registerCssFile($baseUrl . '/css/ui.slider.extras.css');
	$cs->registerScriptFile($baseUrl . '/js/jquery.multiselect.min.js');
	$cs->registerCssFile($baseUrl . '/css/ui/jquery-ui.multiselect.css');
	$cs->registerScriptFile($baseUrl . '/js/jquery.dropdownPlain.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($baseUrl . '/js/common.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($baseUrl . '/js/habra_alert.js', CClientScript::POS_END);
	$cs->registerCssFile($baseUrl.'/css/form.css', 'screen, projection');

	// superfish menu
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/superfish/css/superfish.css', 'screen');
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/superfish/css/superfish-vertical.css', 'screen');
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/superfish/js/hoverIntent.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/superfish/js/superfish.js', CClientScript::POS_HEAD);

	$cs->registerScript('initizlize-superfish-menu', '
			$("#sf-menu-id").superfish( {delay: 100, autoArrows: false, dropShadows: false, pathClass: "overideThisToUse", speed: "fast" });
		', CClientScript::POS_READY);

	if(param('useYandexMap') == 1){
		$cs->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&coordorder=longlat&lang='.CustomYMap::getLangForMap(), CClientScript::POS_END);
	}
	elseif (param('useGoogleMap') == 1){
		//$cs->registerScriptFile('https://maps.google.com/maps/api/js??v=3.5&sensor=false&language='.Yii::app()->language.'', CClientScript::POS_END);
		//$cs->registerScriptFile('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js', CClientScript::POS_END);
	}
	elseif (param('useOSMMap') == 1){
		//$cs->registerScriptFile('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js', CClientScript::POS_END);
		//$cs->registerCssFile('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css');

		$cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/leaflet/leaflet-0.7.2/leaflet.js', CClientScript::POS_HEAD);
		$cs->registerCssFile(Yii::app()->request->baseUrl . '/js/leaflet/leaflet-0.7.2/leaflet.css');

		$cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/leaflet/leaflet-0.7.2/dist/leaflet.markercluster-src.js', CClientScript::POS_HEAD);
		$cs->registerCssFile(Yii::app()->request->baseUrl . '/js/leaflet/leaflet-0.7.2/dist/MarkerCluster.css');
		$cs->registerCssFile(Yii::app()->request->baseUrl . '/js/leaflet/leaflet-0.7.2/dist/MarkerCluster.Default.css');
	}

	if(Yii::app()->user->getState('isAdmin')){
		?><link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/tooltip/tipTip.css" /><?php
	}
	?>
</head>

<body>
	<?php if (demo()) :?>
		<?php $this->renderPartial('//site/ads-block', array()); ?>
	<?php endif; ?>

	<div id="container" <?php echo (demo()) ? 'style="padding-top: 40px;"' : '';?> >
		<noscript><div class="noscript"><?php echo Yii::t('common', 'Allow javascript in your browser for comfortable use site.'); ?></div></noscript>
		<div class="logo">
			<a title="<?php echo Yii::t('common', 'Go to main page'); ?>" href="<?php echo Yii::app()->controller->createAbsoluteUrl('/'); ?>">
				<img width="259" height="50" alt="<?php echo CHtml::encode($this->pageDescription); ?>" src="<?php echo $baseUrl; ?>/images/pages/logo-open-ore.png" id="logo" />
			</a>
		</div>
                

		<?php
		if(true){ //langs
			if(count(Lang::getActiveLangs()) > 1){
				$this->widget('application.modules.lang.components.langSelectorWidget', array( 'type' => 'links' ));
			}
//			if(count(Currency::getActiveCurrency()) >1){
//				$this->widget('application.modules.currency.components.currencySelectorWidget');
//			}
		}
		?>

		<div id="user-cpanel"  class="menu_item">
			<?php
			   if(!isset($adminView)){
					$this->widget('zii.widgets.CMenu',array(
						'id' => 'nav',
						'items'=>$this->aData['userCpanelItems'],
						'htmlOptions' => array('class' => 'dropDownNav'),
					));
				} else {
					$this->widget('zii.widgets.CMenu',array(
						'id' => 'dropDownNav',
						'items'=>CMap::mergeArray($this->aData['topMenuItems'], array(array('label' => Yii::t('common', 'Logout'), 'url'=>array('/site/logout')))),
						'htmlOptions' => array('class' => 'dropDownNav adminTopNav'),
					));
				}
			?>
		</div>

		<?php
		if(!isset($adminView)){
		?>
			<div id="search" class="menu_item">
				<?php
//				if (param('useYandexShare', 0))
//					$this->widget('application.extensions.YandexShareApi', array(
//						'services' => param('yaShareServices', 'yazakladki,moikrug,linkedin,vkontakte,facebook,twitter,odnoklassniki')
//					));
				if (param('useInternalShare', 1))
					$this->widget('ext.sharebox.EShareBox', array(
						'url' => Yii::app()->getRequest()->getHostInfo().Yii::app()->request->url,
						'title'=> CHtml::encode($this->seoTitle ? $this->seoTitle : $this->pageTitle),
						'iconSize' => 16,
						'include' => explode(',', param('intenalServices', 'facebook,vk,twitter,google-plus')),
					));

					/*$this->widget('zii.widgets.CMenu',array(
						'id' => 'dropDownNav',
						'items'=>$this->aData['topMenuItems'],
						'htmlOptions' => array('class' => 'dropDownNav'),
					));*/

					$this->widget('zii.widgets.CMenu',array(
						'id' => 'sf-menu-id',
						'items' => $this->aData['topMenuItems'],
						'htmlOptions' => array('class' => 'sf-menu'),
						'encodeLabel' => false,
					));
				?>
			</div>
		<?php
		} else {
			echo '<hr />';
			?>

			<div class="admin-top-menu">
				<?php
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->aData['adminMenuItems'],
					'encodeLabel' => false,
					'submenuHtmlOptions' => array('class' => 'admin-submenu'),
					'htmlOptions' => array('class' => 'adminMainNav')
				));
				?>
			</div>
		<?php
		}
		?>

		<div class="content">
			<?php echo $content; ?>
			<div class="clear"></div>
		</div>

		<?php
			if(issetModule('advertising')) {
				$this->renderPartial('//../modules/advertising/views/advert-bottom', array());
			}
		?>

		<div class="footer">
			<?php echo getGA(); 
                        //TODO_BP : copyrite!?>
			<?php echo getJivo(); ?>
			<p class="slogan">&copy;&nbsp;<?php echo CHtml::encode(Yii::app()->name).', '.date('Y'); ?></p>
			<!-- TODO_BP : copyrite! <?php echo param('version_name').' '.param('version'); ?> -->
		</div>
	</div>

	<div id="loading" style="display:none;"><?php echo Yii::t('common', 'Loading content...'); ?></div>
	<?php
    $cs->registerScript('main-vars', '
		var BASE_URL = '.CJavaScript::encode(Yii::app()->baseUrl).';
		var params = {
			change_search_ajax: '.param("change_search_ajax", 1).'
		}
	', CClientScript::POS_HEAD, array(), true);

    $this->renderPartial('//layouts/_common');

	$this->widget('application.modules.fancybox.EFancyBox', array(
		'target'=>'a.fancy',
		'config'=>array(
				'ajax' => array('data'=>"isFancy=true"),
				'titlePosition' => 'inside',
				'onClosed' => 'js:function(){
					var capClick = $("#yw0_button");
					if(typeof capClick !== "undefined")	capClick.click();
				}'
			),
		)
	);
//var capClick = $("#yw0_button");alert(capClick);
	if(Yii::app()->user->getState('isAdmin')){
		$cs->registerScriptFile($baseUrl.'/js/tooltip/jquery.tipTip.minified.js', CClientScript::POS_HEAD);
		$cs->registerScript('adminMenuToolTip', '
			$(function(){
				$(".adminMainNavItem").tipTip({maxWidth: "auto", edgeOffset: 10, delay: 200});
			});
		', CClientScript::POS_READY);
		?>

		<div class="admin-menu-small <?php echo demo() ? 'admin-menu-small-demo' : '';?> ">
			<a href="<?php echo $baseUrl; ?>/apartments/backend/main/admin">
				<img src="<?php echo $baseUrl; ?>/images/adminmenu/administrator.png" alt="<?php echo Yii::t('common','Administration'); ?>" title="<?php echo Yii::t('common','Administration'); ?>" class="adminMainNavItem" />
			</a>
		</div>
	<?php } ?>
</body>
</html>