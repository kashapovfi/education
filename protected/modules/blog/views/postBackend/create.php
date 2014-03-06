<?php
/**
 * Отображение для postBackend/create:
 * 
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = array(   
    Yii::t('BlogModule.blog', 'Plans') => array('/blog/postBackend/index'),
    Yii::t('BlogModule.blog', 'Add'),
);

$this->pageTitle = Yii::t('BlogModule.blog', 'Plans - add');

$this->menu = array(
    array('label' => Yii::t('BlogModule.blog', 'Plans'), 'items' => array(
        array('icon' => 'list-alt', 'label' => Yii::t('BlogModule.blog', 'Manage plans'), 'url' => array('/blog/postBackend/index')),
        array('icon' => 'plus-sign', 'label' => Yii::t('BlogModule.blog', 'Add a plan'), 'url' => array('/blog/postBackend/create')),
    )),
);
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('BlogModule.blog', 'Plans'); ?>
        <small><?php echo Yii::t('BlogModule.blog', 'add'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>