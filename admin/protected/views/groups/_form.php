<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?><style>
    #wrapper{height:0px !important}
    /*.footer-sec {*/
    /*    position: absolute;*/
    /*    right: 0;*/
    /*    bottom: 0 !important;*/
    /*    left: 0;*/
    /*}*/
    .save-btn
    {
        color: white;
        font-size: 20px;
    }
</style>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'groups-form',
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
	)); ?>
	<br/><br/>
	<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
			<?php echo $form->labelEx($model,'name'); ?>
		</div>
	
		<div class="col-lg-8 padzero">
			<?php
				if($model->name=='') {
					$criteria = new CDbCriteria;
					$criteria->order = 'id DESC';
					$criteria->condition='course_id='.base64_decode($_GET['c']);
					$row = Groups::model()->findAll($criteria);
					$maxgroupid = $row->id;
					$model->name = 'Group '.(count($row)+1);
				}
			?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
	</div>
	<!--<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'status'); ?>
        </div>

        <div class="col-lg-8 padzero formradio">
            <?php echo $form->radioButtonList($model,'status', array('active'=>'Active','inactive'=>'Inactive','locked'=>'Locked'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
    </div>-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'save-btn')); ?>
		<a href="#"  onclick="window.history.back()" class="save-btn" style="margin-top:0.5%;margin-right:10px;color:white !important;">Back</a>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
