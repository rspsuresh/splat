

					
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
						'id'=>'question-form',
						'enableClientValidation'=>true,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
					)); ?>
						<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
							<div class="col-lg-4 padzero">
								<?php echo $form->labelEx($model,'question'); ?>
							</div>
							<div class="col-lg-8 padzero">
								<?php echo $form->textArea($model,'question', array('placeholder'=>'Question')); ?>
								<?php echo $form->error($model,'question'); ?>
							</div>
						</div>
						<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
							<div class="col-lg-4 padzero">
								<?php echo $form->labelEx($model,'type'); ?>
							</div>
							<div class="col-lg-8 padzero formradio">
								<?php $model->type='default'; echo $form->radioButtonList($model,'type', array('default'=>'Default','custom'=>'Custom'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
								<?php echo $form->error($model,'type'); ?>
							</div>
						</div>
                                                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
							<div class="col-lg-4 padzero">
								<?php echo $form->labelEx($model,'q_type'); ?>
							</div>
							<div class="col-lg-8 padzero formradio">
								<?php echo $form->radioButtonList($model,'q_type', array('R'=>'Rating Scale','S'=>'Text'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
								<?php echo $form->error($model,'q_type'); ?>
							</div>
						</div>
						<!--<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
							<div class="col-lg-4 padzero">
								<?php echo $form->labelEx($model,'status'); ?>
							</div>
							<div class="col-lg-8 padzero formradio">
								<?php echo $form->radioButtonList($model,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
								<?php echo $form->error($model,'status'); ?>
							</div>
						</div>-->
						<?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
					<?php $this->endWidget(); ?>
</div><!-- form -->