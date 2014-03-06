<?php
/**
 * Отображение для _search:
 * 
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'htmlOptions' => array('class' => 'well search-form'),
    )
); ?>

<fieldset class="inline">

    <?php echo $form->textFieldRow($model, 'id', array('class' => 'span5', 'maxlength' => 10)); ?>
    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 300)); ?>

    <div class="form-actions">
    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(       
            'buttonType' => 'submit',
            'type' => 'primary',
            'encodeLabel' => false,
            'label' => '<i class="icon-search icon-white"></i> ' . Yii::t('MailModule.mail', 'Find')
        )
    ); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>