<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
<meta charset="<?php echo Yii::app()->charset; ?>"/>
<meta name="keywords" content="<?php echo $this->keywords; ?>"/>
<meta name="description" content="<?php echo $this->description; ?>"/>
<meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>"/>
<meta property="og:description" content="<?php echo $this->description; ?>"/>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
$mainAssets = Yii::app()->assetManager->publish(
    Yii::getPathOfAlias('application.modules.yupe.views.assets')
);
$webrootAssets = Yii::app()->assetManager->publish(
    Yii::getPathOfAlias('webroot.web')
);

Yii::app()->clientScript->registerCssFile($webrootAssets . '/css/yupe.css');
Yii::app()->clientScript->registerCssFile($webrootAssets . '/css/site.css');
Yii::app()->clientScript->registerCssFile($webrootAssets . '/css/selectric.css');
Yii::app()->clientScript->registerCssFile($mainAssets . '/css/styles.css');
Yii::app()->clientScript->registerScriptFile($mainAssets . '/js/main.js');
Yii::app()->clientScript->registerScriptFile($webrootAssets . '/js/jquery.raty.js');
Yii::app()->clientScript->registerScriptFile($webrootAssets . '/js/jquery.expander.min.js');
Yii::app()->clientScript->registerScriptFile($webrootAssets . '/js/jquery.selectric.min.js');
Yii::app()->clientScript->registerScriptFile($webrootAssets . '/js/edu.js');
?>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
    var baseUrl = '<?php echo Yii::app()->getBaseUrl(); ?>';
</script>
</head>

<body>
<?php $this->widget('application.modules.menu.widgets.MenuWidget', array('name' => 'top-menu')); ?>
<!-- container -->
<div class='container'>
    <!-- breadcrumbs -->
    <?php $this->widget(
        'bootstrap.widgets.TbBreadcrumbs',
        array(
            'links' => $this->breadcrumbs,
        )
    );?>
    <div class="row">
        <!-- content -->
        <section class="span12 content">
            <!-- flashMessages -->
            <?php $this->widget('yupe\widgets\YFlashMessages'); ?>
            <?php echo $content; ?>
        </section>
        <!-- content end-->
    </div>
</div>
<!-- container end -->
</body>
</html>