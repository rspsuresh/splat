
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'multipleassesment-editasses-form',
	'enableAjaxValidation'=>false,

)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
        <div class="col-lg-4">
            <?php echo $form->labelEx($model,'prj_id'); ?>
            <?php echo $form->textField($model,'prj_id',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'prj_id'); ?>
        </div>
        <div class="col-lg-4">
            <?php echo $form->labelEx($model,'due_date'); ?>
            <?php echo $form->textField($model,'due_date',array('class'=>'form-control datepicker')); ?>
            <?php echo $form->error($model,'due_date'); ?>
        </div>
        <div class="col-lg-4 buttons">
            <?php echo CHtml::submitButton('Submit',array('class'=>'save-btn')); ?>
        </div>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->