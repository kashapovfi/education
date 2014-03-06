<?php
/**
 * Отображение для postBackend/_search:
 * 
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => array('class' => 'well'),
    )
);

?>

    <fieldset class="inline">
        <div class="wide row-fluid control-group">
            <div class="span3">
                <div class="popover-help" data-original-title='<?php echo $model->getAttributeLabel('publish_date'); ?>' data-content='<?php echo $model->getAttributeDescription('publish_date'); ?>'>
                    <?php echo $form->labelEx($model, 'publish_date'); ?>
                    <?php
                    $this->widget(
                        'zii.widgets.jui.CJuiDatePicker', array(
                            'model'     => $model,
                            'attribute' => 'publish_date',
                            'options'   => array('dateFormat' => 'yy-mm-dd'),
                        )
                    ); ?>
                </div>
            </div>        
        </div>
    </fieldset>

    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'type'        => 'primary',
            'encodeLabel' => false,
            'buttonType'  => 'submit',
            'label'       => '<i class="icon-search icon-white">&nbsp;</i> ' . Yii::t('BlogModule.blog', 'Find a post'),
        )
    ); ?>

<?php $this->endWidget(); ?>