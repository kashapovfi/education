<script type='text/javascript'>
    $(document).ready(function () {
        $('#raty').raty({
            <!--            click: function (score, evt) {-->
            <!--                $.ajax({-->
            <!--                    type: 'POST',-->
            <!--                    cache: false,-->
            <!--                    data: {score: score},-->
            <!--                    dataType: 'json'-->
            <!--                    url: '--><?php //echo Yii::app()->createAbsoluteUrl('post/rating'); ?><!--'-->
            <!--                });-->
            <!---->
            <!--            },-->

            hints: ['Not Done!', 'Poor Done!', 'Regular Done!', 'Almost Done!', 'Done!'],

            target: '#hint',
            scoreName: 'Post[progress]',
            targetKeep: true,
            score: <?php echo $model->progress; ?>,
            targetText: '--Select--',
            path: '<?php echo Yii::app()->createAbsoluteUrl('web/images'); ?>'
        });
    });
</script>

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

<div class="row-fluid control-group <?php echo $model->hasErrors('content') ? 'error' : ''; ?>">
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

<?php if ($model->isNewRecord): ?>
<div class="row-fluid control-group">
        <?php
        echo $form->datetimepickerRow(
            $model, 'publish_date', array(
                'options' => array(
                    'format' => 'dd-mm-yyyy hh:ii',
                    'weekStart' => 1,
                    'autoclose' => true,
                ),
            )
        ); ?>
</div>
<?php endif; ?>

<?php if (!$model->isNewRecord): ?>
    <div class="row-fluid control-group">
        <div class="panel panel-default">
            <div class="panel-body" style="text-align: center;">
                <b>Plan progress <span id="hint" class="badge">42</span></b>
            </div>
        </div>
        <div id="raty"></div>
    </div>
<?php endif; ?>

<div class="row-fluid control-group">
    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'success',
            'htmlOptions' => array('name' => 'submit-type', 'value' => 'index', 'class' => 'span12'),
            'label' => $model->isNewRecord ? Yii::t('BlogModule.blog', 'Create') : Yii::t('BlogModule.blog', 'Save'),
        )
    ); ?>

    <?php $this->endWidget(); ?>
</div>