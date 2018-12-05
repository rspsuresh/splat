<?php
/* @var $this UsersController */
/* @var $model Users */
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.jquery.js"></script>
<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Mapping</b></p>
		</div>
	</div>
	<div class="container-fluid user-assessment">
		<p>Add Mapping</p>
	</div>
	<div class="container">
		<br/>
	</div>
</section>
<style>
    #wrapper{height:0px !important}
	#mapp{margin-top:150px}
</style>
<div class="form" id="mapp">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'mapping-form',
        'enableClientValidation'=>true,
		 'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
        ),
     
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'user_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
		    <?php //$type_list=CHtml::listData(Users::model()->findAll(),'id','username');
            //echo CHtml::activeCheckBoxList($model,'user_id',$type_list); ?>

            <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(Users::model()->findAll('status="active"'), 'id', 'username'),array('multiple'=>true)); ?>
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
            <?php echo $form->dropDownList($model, 'g_id', CHtml::listData(GroupMaster::model()->findAll(), 'id', 'g_name'), array('empty'=>'Select group')); ?>

            <?php echo $form->error($model,'g_id'); ?>
        </div>
    </div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
   $(document).ready(function() {
    $('.chosen-select').chosen({
      placeholder_text_single: "Select Project/Initiative...",
      no_results_text: "Oops, nothing found!"
    });  
  });
</script>