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
    Yii::app()->clientScript->registerCssFile($mainAssets . '/css/styles.css');
    Yii::app()->clientScript->registerScriptFile($mainAssets . '/js/main.js');
    Yii::app()->clientScript->registerScriptFile($mainAssets . '/js/jquery.li-translit.js');
    if (($langs = $this->yupe->languageSelectorArray) != array())
        Yii::app()->clientScript->registerCssFile($mainAssets. '/css/flags.css');
    ?>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<?php $this->widget('application.modules.menu.widgets.MenuWidget', array('name' => 'top-menu')); ?>
<!-- container -->
<div class='container'>
    <!-- flashMessages -->
    <?php $this->widget('YFlashMessages'); ?>
    <!-- breadcrumbs -->
    <?php $this->widget(
        'bootstrap.widgets.TbBreadcrumbs',
        array(
            'links' => $this->breadcrumbs,
        )
    );?>
    <div class="row">
        <!-- content -->
        <section class="span9 content">
            <?php echo $content; ?>
        </section>
        <!-- content end-->

        <!-- sidebar -->
        <aside class="span3 sidebar">
            <?php if (Yii::app()->user->isAuthenticated()): ?>
                <div class="widget last-login-users-widget">
                    <?php $this->widget('application.modules.user.widgets.ProfileWidget'); ?>
                </div>
                <?php endif; ?>

            <div class="widget last-login-users-widget">
                <?php $this->widget(
                    'application.modules.user.widgets.LastLoginUsersWidget',
                    array(
                        'cacheTime' => $this->yupe->coreCacheTime,
                    )
                ); ?>
            </div>

        </aside>
        <!-- sidebar end -->
    </div>
</div>
<!-- container end -->
</body>
</html>