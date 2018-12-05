<?php
/* @var $this GroupUsersController */
/* @var $model GroupUsers */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-users-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<br/><br/>	<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
			<?php echo $form->labelEx($model,'user_id'); ?>
		</div>
		<div class="col-lg-8 padzero">
			<?php echo $form->dropDownList($model, 'user_id',
                CHtml::listData(UserCourses::model()->with('user')->findAll('user.role="5" and
                 t.course_id='.base64_decode($_GET['c'])), 'user_id',
                    'user.first_name'), array('class'=>'chosen-select','multiple' => 'multiple','empty'=>'Select User')); ?>

			<?php echo $form->error($model,'user_id'); ?>
		</div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'save-btn')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<script>
    $(function(){
        $('.chosen-select').chosen({}).change( function(obj, result) {
            console.debug("changed: %o", arguments);

            console.log("selected: " + result.selected);
        });

    });

</script>