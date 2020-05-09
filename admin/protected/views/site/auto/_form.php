<style>
    .mydiv{
    float: left;
    width: 100%;
    border-radius: 10px;
        border: 1px solid #1CBBB4;
        padding: 10px;
        margin-bottom: 15px;
        margin-top:20px;
    }
    .footer-sec{
        bottom:auto !important;
    }
</style>
<section id="wrapper" >
    <div class="container-fluid user-assessment">
        <p>Staff Auto Registration</p>
    </div>
<div class="container">
<div class="form" style="margin-top:20px">
    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true
        ),
    ));
    ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($models,'email'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($models,'email',array('size'=>60,'maxlength'=>255,'placeholder'=>'Email')); ?>
            <?php echo $form->error($models,'email'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($models,'first_name'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($models,'first_name',array('size'=>60,'maxlength'=>255,'placeholder'=>'First name')); ?>
            <?php echo $form->error($models,'first_name'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($models,'last_name'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($models,'last_name',array('size'=>60,'maxlength'=>255,'placeholder'=>'Last Name')); ?>
            <?php echo $form->error($models,'last_name'); ?>
        </div>
    </div>
    <div class="faccourse">
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($models,'fac_id'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php
                    $facultymodel = Faculties::model()->findAll();
                    if(count($facultymodel)>0) {
                        foreach ($facultymodel as $feachValue)
                        {
                            $facarray[]=$feachValue->id;
                            $fselectedOptions[$feachValue->id] = array('selected'=>'selected');
                        }
                    }
                    $coursemodel = Courses::model()->findAll();
                    if(count($coursemodel)>0) {
                        foreach ($coursemodel as $ceachValue)
                        {
                            $cselectedOptions[$ceachValue->id] = array('selected'=>'selected');
                        }
                    }
                ?>
                <?php echo $form->dropDownList($models, 'fac_id', CHtml::listData(Faculties::model()->findAll(), 'id', 'name'),
                    array('empty'=>'Select faculty type','multiple'=>'multiple','options'=>'',
                        'ajax' => array(
                            'type'=>'POST', //request type
                            'url'=>CController::createUrl('Users/dynamiccourses'), //url to call.
                            'update'=>'#Users_course_id', //selector to update
                        )
                    )); ?>
                <?php echo $form->error($models,'fac_id'); ?>
            </div>
        </div>
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($models,'course_id'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php
                echo $form->dropDownList($models, 'course_id', CHtml::listData(Courses::model()->findAll(), 'id',
                    function($data){ return $data->course_type."-".$data->name." Level: ".$data->course_level." (".$data->faculty0->name.")";}), array('empty'=>'Select Course','multiple'=>'multiple','options'=>'')); ?>
                <?php echo $form->error($models,'course_id'); ?>
            </div>
        </div>
    </div>
    <?php echo CHtml::submitButton($models->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div>
</div>
</section>