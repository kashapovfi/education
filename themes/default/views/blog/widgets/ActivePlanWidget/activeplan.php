<?php if (isset($plan[0]->content)):
    $status = $plan[0]->progress == 5
        ? array('class' => 'btn-success', 'text' => 'COMPLETED',
            'state' => array('disabled' => 'disabled', 'class' => 'btn btn-warning btn-large'))
        : array('class' => 'btn-danger', 'text' => 'IN PROGRESS',
            'state' => array('class' => 'btn btn-warning btn-large'));

    $statusCreate = true;
    $statusCreate = $statusCreate === !Yii::app()->user->isSuperUser()
        ? array('class' => 'btn btn-success btn-large')
        : array('disabled' => 'disabled', 'class' => 'btn btn-success btn-large');

    if (Yii::app()->user->isSuperUser() AND isset($status['state']['disabled']))
        unset($status['state']['disabled']);
    if (Yii::app()->user->isSuperUser() AND isset($statusCreate['disabled']))
        unset($statusCreate['disabled']);

    ?>
    <div class="yupe-widget-header">
        <i class="icon-star"></i>

        <h3>My active plan <b>[<?=date('F');?>]</b></h3>

        <div class="pull-right">
            <h3><span class="label <?php echo $status['class']; ?>"><?php echo $model->getProgressAsString($plan[0]->progress); ?></span></h3>
        </div>
    </div>

    <div class="yupe-widget-content">
        <div class="row-fluid">
            <div class="span12">
                <?php echo $plan[0]->getQuote(); ?>
            </div>
        </div>
    </div>
    <br>
    <div class="pull-left">
        <?php echo CHtml::link('<i class="icon-pencil icon-white"></i> Edit Active Plan', array('post/update', 'id' => $plan[0]->id), $status['state']); ?>
    </div>
<?php endif; ?>
<div class="pull-right">
    <?php echo CHtml::link('<i class="icon-check icon-white"></i> New Plan', array('post/create'), isset($statusCreate) ? $statusCreate : array('class' => 'btn btn-success btn-large')); ?>
</div>


<br/>
<br/>
<br/>
