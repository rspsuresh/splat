
<?php

/* @var $this GroupsdumController */
/* @var $model Groupsdum */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupsdum-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>

		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>

		<?php echo $form->error($model,'name'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'course_id'); ?>

		<?php echo $form->textField($model,'course_id'); ?>

		<?php echo $form->error($model,'course_id'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>

		<?php echo $form->textField($model,'status',array('size'=>8,'maxlength'=>8)); ?>

		<?php echo $form->error($model,'status'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>

		<?php echo $form->textField($model,'created_date'); ?>

		<?php echo $form->error($model,'created_date'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'updated_date'); ?>

		<?php echo $form->textField($model,'updated_date'); ?>

		<?php echo $form->error($model,'updated_date'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->