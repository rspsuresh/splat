
<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<style>
    #wrapper{height:0px !important}
</style>
<div class="container form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableClientValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
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
            <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255,'placeholder'=>'First Name')); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>
    </div>
    <div class="col-xs-8 col-lg-8 col-sm-8 course-field padzero">
        <div class="col-lg-6 padzero">
            <?php echo $form->labelEx($model,'profile'); ?>
        </div>
        <div class="col-lg-6 padzero">
            <?php echo $form->fileField($model, 'profile');?>

            <?php echo $form->error($model,'profile'); ?>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="col-lg-8 padzero">
            <?php
            $modeluser=Users::model()->findByPk(Yii::app()->session['id']);
            $path=$modeluser->profile?"images/profile/".$modeluser->profile:"images/user.jpg";?>
            <img style="width:100px" src="<?php echo  Yii::app()->request->baseUrl."/".$path?>">
        </div>
    </div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->