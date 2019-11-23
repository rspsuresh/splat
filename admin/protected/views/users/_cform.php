<style>
    .mydiv{
        float: left;
        width: 100%;
        border-radius: 10px;
        border: 1px solid #1CBBB4;
        padding: 10px;
        margin-bottom: 15px;
    }
    .table thead {
        background-color: #03c6e3 !important;
        color: white;
    }
</style>
<div class="form">
    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        //'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'placeholder'=>'Email')); ?>
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
    <?php if(isset($_GET['c']) && $model->isNewRecord && Yii::app()->controller->action->id !="staffusers") { ?>
        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
            <div class="col-lg-4 padzero">
                <?php echo $form->labelEx($model,'grp'); ?>
            </div>
            <div class="col-lg-8 padzero">
                <?php
                echo $form->dropDownList($model, 'grp', CHtml::listData(Groups::model()->findAll('course_id='.base64_decode($_GET['c'])), 'id', 'name'), array('empty' => 'Select Group'));
                ?>
                <?php echo $form->error($model,'grp'); ?>
            </div>
        </div>
    <?php } ?>
    <?php $model->institution_id = '1'; ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<?php
  $course=base64_decode($_GET['c']);
  $session_userid=Yii::app()->session['id'];
  $staffuserssql="SELECT * FROM `user_courses` left join users on user_courses.user_id=users.id where users.role=3 and user_courses.course_id={$course} and users.id!={$session_userid}  GROUP BY users.id";
  $resultofstaff=Yii::app()->db->createCommand($staffuserssql)->queryAll();
?>
<div class="row mydiv">
    <h3 class="text-center">Course Staffs</h3>
    <table class="table" id="stafftbl">
        <thead>
        <tr>
            <th>S.No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(empty($resultofstaff)) {
        foreach ($resultofstaff as$key=>$val) { ?>
            <tr>
                <td><?=$key+1?></td>
                <td><?=$val['first_name']?></td>
                <td><?=$val['last_name']?></td>
                <td><?=$val['email']?></td>
            </tr>
        <?php } } else{  ?>
        <tr>
            <td colspan="4" class="text-center"><b>No Staff in this Course</b></td>
        </tr>
        <?php } ?>
        </tbody></table>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>./../js/jquery.easy-autocomplete.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>./../css/easy-autocomplete.min.css" rel="stylesheet" type="text/css"/>
<script>
    $(function() {
        $('#Users_username,#Users_password').on('keypress', function(e) {
            if (e.which == 32)
                return false;
        });
        $('#Users_password').bind("cut copy paste",function(e) {
            e.preventDefault();
        });
    });
</script>
<script>
    $( document ).ready(function() {
        var course='<?=base64_decode($_GET['c'])?>'
        var options = {
            url: function(phrase) {
                return "getdetails?phrase=" + phrase + "&format=json&course="+course;
            },
            getValue: "Label",
            list: {
                onSelectItemEvent: function() {
                    var fname = $("#Users_email").getSelectedItemData().firstname;
                    var lname = $("#Users_email").getSelectedItemData().lastname;
                    var exists = $("#Users_email").getSelectedItemData().exists;
                    if(!exists)
                    {
                        $("#Users_first_name").val(fname).trigger('change');
                        $("#Users_last_name").val(lname).trigger('change');
                    }
                }
            }
        };
        $("#Users_email").easyAutocomplete(options);
    });
</script>