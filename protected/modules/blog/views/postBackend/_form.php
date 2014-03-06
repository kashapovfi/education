<?php
/**
 * Отображение для postBackend/_form:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id' => 'post-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        'inlineErrors' => true,
    )
);

?>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid control-group">

    <div class="span2  pull-left popover-help" data-original-title='<?php echo $model->getAttributeLabel('publish_date'); ?>'
         data-content='<?php echo $model->getAttributeDescription('publish_date'); ?>'>
        <?php
        echo $form->datetimepickerRow(
            $model, 'publish_date', array(
                'options' => array(
                    'format' => 'dd-mm-yyyy hh:ii',
                    'weekStart' => 1,
                    'autoclose' => true
                ),
            )
        ); ?>
    </div>

</div>

<div class="row-fluid control-group <?php echo $model->hasErrors('content') ? 'error' : ''; ?>">
    <div class="popover-help" data-original-title='<?php echo $model->getAttributeLabel('content'); ?>'
         data-content='<?php echo $model->getAttributeDescription('content'); ?>'>
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php
        $this->widget(
            $this->module->editor, array(
                'model' => $model,
                'attribute' => 'content',
                'options' => $this->module->editorOptions,
            )
        ); ?>
    </div>
</div>

    <div class="row-fluid control-group <?php echo ($model->hasErrors('progress') || $model->hasErrors('progress')) ? 'error' : ''; ?>">
        <?php echo $form->dropDownListRow($model, 'progress',$model->getProgressAsString(null, true)); ?>
    </div>

<br/>

<?php
$this->widget(
    'bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
        'label' => $model->isNewRecord ? Yii::t('BlogModule.blog', 'Create plan and close') : Yii::t('BlogModule.blog', 'Save'),
    )
); ?>

<?php $this->endWidget(); ?>