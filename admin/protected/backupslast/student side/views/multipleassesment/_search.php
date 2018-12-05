
<?php

/* @var $this MultipleassesmentController */
/* @var $model Multipleassesment */
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
		<?php echo $form->label($model,'prj_id'); ?>

		<?php echo $form->textField($model,'prj_id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'due_date'); ?>

		<?php echo $form->textField($model,'due_date'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>

		<?php echo $form->textField($model,'created_date'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->