<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<style>
    .footer-sec{
        bottom:auto !important;
    }
</style>
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
                <p>
                    You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a>
                    <a href="<?= Yii::app()->createUrl('users/cadmin',
                        array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i']))?>"><?php echo ucfirst($course->name); ?></a> /
                    <b>Edit Staff</b>
                </p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Edit Staff</p>
    </div>
    <div class="container">
        <div class="form">
            <?php
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'usersstaff-form',
                'enableClientValidation'=>true,
                'enableAjaxValidation'=>false,
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
                    <?php echo $form->textField($model,'email',
                        array('size'=>60,
                            'maxlength'=>255,'placeholder'=>'Email')); ?>
                    <?php echo $form->error($model,'email'); ?>
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
                                {
                                    $facarray[]=$feachValue->faculty_id;
                                    $fselectedOptions[$feachValue->faculty_id] = array('selected'=>'selected');
                                }
                            }
                            $coursemodel = UserCourses::model()->findAll('user_id='.$_GET['id']);
                            $facid=implode(',',$facarray);

                            if(count($coursemodel)>0) {
                                foreach ($coursemodel as $ceachValue)
                                {
                                    $cselectedOptions[$ceachValue->course_id] = array('selected'=>'selected');
                                }
                            }

                        }
                        ?>
                        <?php echo $form->dropDownList($model, 'fac_id', CHtml::listData(Faculties::model()->findAll("id in({$facid})"), 'id', 'name'),
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
                        <?php
                        echo $form->dropDownList($model, 'course_id', CHtml::listData(Courses::model()->findAll("faculty in ( {$facid}) "), 'id',
                            function($data){ return $data->course_type."-".$data->name." Level: ".$data->course_level." (".$data->faculty0->name.")";}), array('empty'=>'Select Course','multiple'=>'multiple','options'=>$cselectedOptions)); ?>
                        <?php echo $form->error($model,'course_id'); ?>
                    </div>
                </div>
            </div>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
            <?php $this->endWidget(); ?>
        </div>
        <!-- form -->
    </div>
</section>
<script>
    $(function() {
        $('.faccourse').show();
        $('#Users_username,#Users_password,#Users_first_name').on('Users_first_name', function(e) {
            alert('dfdfd')
            if (e.which == 32)
                return false;
        });
    });
</script>