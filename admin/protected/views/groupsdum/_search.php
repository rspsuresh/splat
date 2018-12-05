
<?php

/* @var $this GroupsdumController */
/* @var $model Groupsdum */
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
		<?php echo $form->label($model,'name'); ?>

		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'course_id'); ?>

		<?php echo $form->textField($model,'course_id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'status'); ?>

		<?php echo $form->textField($model,'status',array('size'=>8,'maxlength'=>8)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>

		<?php echo $form->textField($model,'created_date'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'updated_date'); ?>

		<?php echo $form->textField($model,'updated_date'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->