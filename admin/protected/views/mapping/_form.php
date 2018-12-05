<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.jquery.js"></script>
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
        'id'=>'mapping-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'user_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
		    <?php //$type_list=CHtml::listData(Users::model()->findAll(),'id','username');
            //echo CHtml::activeCheckBoxList($model,'user_id',$type_list); ?>

            <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(Users::model()->findAll(), 'id', 'username'),array('multiple'=>true)); ?>
			<?php echo $form->error($model,'user_id'); ?>
        </div>
    </div>
	<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'institution'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'institution', CHtml::listData(Institutions::model()->findAll(), 'id', 'name'), array('empty'=>'Select Institution')); ?>

            <?php echo $form->error($model,'institution'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'faculty'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'faculty', CHtml::listData(Faculties::model()->findAll(), 'id', 'name'), array('empty'=>'Select faculty type')); ?>

            <?php echo $form->error($model,'faculty'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'course'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'course', CHtml::listData(Courses::model()->findAll(), 'id', 'name'), array('empty'=>'Select course')); ?>

            <?php echo $form->error($model,'course'); ?>
        </div>
    </div>
	<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'g_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'g_id', CHtml::listData(GroupMaster::model()->findAll(), 'id', 'g_name'), array('empty'=>'Select Group')); ?>

            <?php echo $form->error($model,'g_id'); ?>
        </div>
    </div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   //$("#Mapping_user_id").chosen();
</script>