<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<style>
    .row-inactive
    {
        color:red;
    }
    /*.footer-sec{*/
    /*    bottom:auto !important;*/
    /*}*/
</style>
<p class="row-inactive">
    <a href="#">
        <span class="glyphicon glyphicon-info-sign"></span>
    </a> Select a faculty and course for staff & student users. Admin users will see all the faculties and courses by default.</p>
<div class="form">
    <?php

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php //echo "<pre>";print_r($model);die;?>
            <?php echo $form->textField($model,'email',
                array('size'=>60,
                    'maxlength'=>255,'placeholder'=>'Email')); ?>
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
            <?php echo $form->labelEx($model,'role'); ?>
        </div>

        <div class="col-lg-8 padzero">
            <?php
            if(Yii::app()->controller->action->id =='create') {  ?>
                <?php echo $form->dropDownList($model, 'role',
                    CHtml::listData(Userrole::model()->findAll("id !=5"), 'id', 's_name'), array('empty'=>'Select User type')); ?>

            <?php } else { ?>
                <?php echo $form->dropDownList($model, 'role', CHtml::listData(Userrole::model()->findAll(), 'id', 's_name'), array('empty'=>'Select User type')); ?>
            <?php } ?>
            <?php echo $form->error($model,'role'); ?>
        </div>
    </div>
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
    <?php $model->institution_id = '1'; ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'institution_id'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->dropDownList($model, 'institution_id', CHtml::listData(Institutions::model()->findAll(), 'id', 'name'), array('empty'=>'Select Institution')); ?>
            <?php echo $form->error($model,'institution_id'); ?>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#Users_institution_id').trigger('change');
        });
    </script>
    <div class="faccourse">
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($model,'fac_id'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php
                if(isset($_GET['id'])) {
                    $facultymodel = UserFaculties::model()->findAll('user_id='.$_GET['id']);
                    if(count($facultymodel)>0) {
                        foreach ($facultymodel as $feachValue)
                            $fselectedOptions[$feachValue->faculty_id] = array('selected'=>'selected');
                    }
                    $coursedecode=base64_decode($_GET['c']);
                    $coursemodel = UserCourses::model()->findAll('user_id='.$_GET['id']." and course_id=".$coursedecode);
                    if(count($coursemodel)>0) {
                        foreach ($coursemodel as $ceachValue)
                            $cselectedOptions[$ceachValue->course_id] = array('selected'=>'selected');
                    }
                    if (Yii::app()->controller->action->id != "create") {
                        $userGrps=GroupUsers::model()->with('group')->findAll("user_id=".$_GET['id']." and group.course_id=".base64_decode($_GET['c']));
                        if(count($userGrps)>0) {
                            foreach ($userGrps as $geachValue)
                                $grpselectedOptions[$geachValue->group_id] = array('selected'=>'selected');
                        }
                    }
                }
                ?>
                <?php echo $form->dropDownList($model, 'fac_id', CHtml::listData(Faculties::model()->findAll(), 'id', 'name'),
                    array('empty'=>'Select faculty type','multiple'=>'multiple','options'=>$fselectedOptions,
                        'ajax' => array(
                            'type'=>'POST', //request type
                            'url'=>CController::createUrl('Users/dynamiccourses'), //url to call.
                            'update'=>'#Users_course_id', //selector to update
                        )
                    )); ?>
                <?php echo $form->error($model,'fac_id'); ?>
            </div>
        </div>
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($model,'course_id'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php echo $form->dropDownList($model, 'course_id', CHtml::listData(Courses::model()->findAll(), 'id', 'name'), array('empty'=>'Select Course','multiple'=>'multiple','options'=>$cselectedOptions)); ?>
                <?php echo $form->error($model,'course_id'); ?>
            </div>
        </div>
        <?php if(Yii::app()->controller->action->id  !="create") { ?>
            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                <div class="col-lg-4 padzero">
                    <label for="Users_grp">Group</label>
                </div>
                <div class="col-lg-8 padzero">
                    <?php echo $form->dropDownList($model, 'grp', CHtml::listData(Groups::model()->findAll(), 'id', 'name'),
                        array('empty'=>'Select Group','multiple'=>'multiple',
                            'options'=>$grpselectedOptions)); ?>
                    <?php echo $form->error($model,'grp'); ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function() {
        <?php if(Yii::app()->user->getState('role')=="Superuser") { ?>
         $("#Users_grp,#Users_course_id,#Users_fac_id").prop('disabled',true);
        <?php } ?>
        $('.faccourse').show();
        $("#Users_role").change(function() {
            if($('option:selected', this).val() ==1)
            {
                $('.faccourse').hide();
            }
            else
            {
                $('.faccourse').show();
            }
        });

        $('#Users_username,#Users_password').on('keypress', function(e) {
            if (e.which == 32)
                return false;
        });
    });
</script>