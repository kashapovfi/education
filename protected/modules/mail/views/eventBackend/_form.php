<!--<script type='text/javascript'>-->
<!--    $(document).ready(function () {-->
<!--        $('#mail-event-form').liTranslit({-->
<!--            elName: '#MailEvent_name',-->
<!--            elAlias: '#MailEvent_code'-->
<!--        });-->
<!--    })-->
<!--</script>-->


<?php
/**
 * Отображение для _form:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id' => 'mail-event-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well'),
        'inlineErrors' => true,
    )
); ?>

<div class="alert alert-info">
    <?php echo Yii::t('MailModule.mail', 'Fields, with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('MailModule.mail', 'are required.'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class='control-group <?php echo $model->hasErrors("name") ? "error" : ""; ?>'>
    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span7', 'maxlength' => 300)); ?>
</div>

<div class="row-fluid control-group <?php echo $model->hasErrors('date') ? 'error' : ''; ?>">
    <?php echo $form->labelEx($model, 'date'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'date',
        'options' => array('dateFormat' => 'yy-mm-dd'),
        'htmlOptions' => array('class' => 'span7')
    )); ?>
</div>

<div class='control-group <?php echo $model->hasErrors("every_month") ? "error" : ""; ?>'>
    <?php echo $form->labelEx($model, 'every_month'); ?>
    <?php echo $form->checkBox($model, 'every_month', array('value'=>1, 'uncheckValue'=>0)); ?>
</div>



<?php
$this->widget(
    'bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('MailModule.mail', 'Create event and continue') : Yii::t('MailModule.mail', 'Save event and continue'),
    )
); ?>
<?php
$this->widget(
    'bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
        'label' => $model->isNewRecord ? Yii::t('MailModule.mail', 'Create event and close') : Yii::t('MailModule.mail', 'Save event and close'),
    )
); ?>

<?php $this->endWidget(); ?>