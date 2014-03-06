<div class="view">

	<b><?php echo  CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo  CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo  CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo  CHtml::encode($data->event_id); ?>
	<br />

	<b><?php echo  CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo  CHtml::encode($data->name); ?>
	<br />

	<b><?php echo  CHtml::encode($data->getAttributeLabel('to')); ?>:</b>
	<?php echo  CHtml::encode($data->to); ?>
	<br />
	
	<b><?php echo  CHtml::encode($data->getAttributeLabel('theme')); ?>:</b>
	<?php echo  CHtml::encode($data->theme); ?>
	<br />

	<b><?php echo  CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo  CHtml::encode($data->status); ?>
	<br />
</div>