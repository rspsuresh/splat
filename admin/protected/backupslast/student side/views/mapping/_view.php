<?php
/* @var $this MappingController */
/* @var $data Mapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('institution')); ?>:</b>
	<?php echo CHtml::encode($data->institution); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('faculty')); ?>:</b>
	<?php echo CHtml::encode($data->faculty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course')); ?>:</b>
	<?php echo CHtml::encode($data->course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('g_id')); ?>:</b>
	<?php echo CHtml::encode($data->g_id); ?>
	<br />


</div>