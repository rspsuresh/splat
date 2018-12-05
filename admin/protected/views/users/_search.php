<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form" style="display:none;">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
    <div class="row">
        <!--<div class="col-lg-2"><?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>'Search user name')); ?></div>
        <div class="col-lg-2"><?php echo $form->textField($model,'first_name',array('class'=>'form-control','placeholder'=>'Search first name')); ?></div>
        <div class="col-lg-2"><?php echo $form->textField($model,'last_name',array('class'=>'form-control','placeholder'=>'Search lastname ')); ?></div>-->
        <div class="col-lg-2">
            <?php echo $form->dropDownList($model, 'role', CHtml::listData(Userrole::model()->findAll(), 'id', 's_name'), array('class'=>'form-control','empty'=>'Select User type')); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->dropDownList($model, 'course_id', CHtml::listData(Courses::model()->findAll(), 'id', 'name'),
                array('class'=>'form-control','empty'=>'Select Course')); ?>
        </div>
        <div class="col-lg-1"><?php echo CHtml::submitButton('Search',array('class'=>'btn btn-success')); ?></div>
        <div class="col-lg-1"><?php echo CHtml::resetButton('Reset',array('class'=>'btn btn-warning','id'=>'reset')); ?></div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->