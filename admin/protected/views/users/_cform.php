<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        //'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'placeholder'=>'Email')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    </div>
    <?php if(!$model->getIsNewRecord()) { ?>
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($model,'password'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255,'placeholder'=>'Password')); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>
        </div>
    <?php } ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'first_name'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255,'placeholder'=>'First Name')); ?>
            <?php echo $form->error($model,'first_name'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'last_name'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255,'placeholder'=>'Last Name')); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>
    </div>
    <?php if(isset($_GET['c']) && $model->isNewRecord) { ?>
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($model,'grp'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php
                echo $form->dropDownList($model, 'grp', CHtml::listData(Groups::model()->findAll('course_id='.base64_decode($_GET['c'])), 'id', 'name'), array('empty' => '(Select a category'));
                ?>
                <?php echo $form->error($model,'grp'); ?>
            </div>
        </div>
    <?php } ?>
    <?php $model->institution_id = '1'; ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function() {
        $('#Users_username,#Users_password').on('keypress', function(e) {
            if (e.which == 32)
                return false;
        });
        $('#Users_password').bind("cut copy paste",function(e) {
            e.preventDefault();
        });
    });
</script>