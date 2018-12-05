
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
        'id'=>'sadmin-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'username'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255,'placeholder'=>'Username')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'password'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255,'placeholder'=>'Password')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'role'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'role', CHtml::listData(Userrole::model()->findAll(), 'id', 's_name'), array('empty'=>'Select User type')); ?>

            <?php echo $form->error($model,'role'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'ins_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'ins_id', CHtml::listData(Institutions::model()->findAll(), 'id', 'name'), array('empty'=>'Select Institution')); ?>

            <?php echo $form->error($model,'ins_id'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'fac_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'fac_id', CHtml::listData(Faculties::model()->findAll(), 'id', 'name'), array('empty'=>'Select faculty type')); ?>

            <?php echo $form->error($model,'fac_id'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'course_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'course_id', CHtml::listData(Courses::model()->findAll(), 'id', 'name'), array('empty'=>'Select faculty type')); ?>

            <?php echo $form->error($model,'course_id'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'placeholder'=>'First Name')); ?>
            <?php echo $form->error($model,'name'); ?>
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