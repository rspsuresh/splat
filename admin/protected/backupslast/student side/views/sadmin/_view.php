<?php
/* @var $this SadminController */
/* @var $data Sadmin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
    <?php echo CHtml::encode($data->courses->names); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('ins_id')); ?>:</b>
    <?php echo CHtml::encode($data->institution->names); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('faculties')); ?>:</b>
    <?php echo CHtml::encode($data->faculties->names); ?>
    <br />

</div>