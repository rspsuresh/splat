
<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<style>
    #wrapper{height:0px !important}
</style>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'groupmaster-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'g_name'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'g_name',array('size'=>60,'maxlength'=>255,'placeholder'=>'Group name')); ?>
            <?php echo $form->error($model,'g_name'); ?>
        </div>
    </div>
	 <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'status'); ?>
        </div>
        <div class="col-lg-8 padzero formradio">
            <?php echo $form->radioButtonList($model,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
    </div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->