<?php
/* @var $this MappingController */
/* @var $model Mapping */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'institution'); ?>
		<?php echo $form->textField($model,'institution'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'faculty'); ?>
		<?php echo $form->textField($model,'faculty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'course'); ?>
		<?php echo $form->textField($model,'course'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'g_id'); ?>
		<?php echo $form->textField($model,'g_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->