<div class="bootstrap-widget-header">
    <i class="icon-star"></i>
    <h3><?php echo CHtml::encode($plan[0]->title); ?></h3>
</div>

<div class="bootstrap-widget-content">
    <div class="row-fluid">
        <div class="span12">
          <?php echo $plan[0]->content; ?>
        </div>
    </div>
</div>
<br>
<div class="pull-left">
    <?php echo CHtml::link('<i class="icon-pencil"></i> Edit Active Plan', array('post/update', 'id' => $plan[0]->id), array('class' => 'btn btn-warning btn-large'));?>
</div>

<div class="pull-right">
    <?php echo CHtml::link('<i class="icon-check"></i> New Plan', array('post/create'), array('class' => 'btn btn-success btn-large'));?>
</div>
<br>
<br>
<br>