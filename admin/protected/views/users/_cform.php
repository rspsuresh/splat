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
    .table thead {
        background-color: #03c6e3 !important;
        color: white;
    }

    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
        border: 1px solid #000 !important;
        padding: 6px 10px !important;
        border-radius: 5px !important;

    }
    .table thead {
        background-color: #03c6e3 !important;
    }
    .table th {
        border: 1px white solid;
        padding: 0.3em;
        color: white;
    }
    .table.dataTable thead th, table.dataTable thead td,table.dataTable.no-footer{
        border-bottom: none !important;
    }
</style>
<div class="form">
    <?php
    $action_boolean=Yii::app()->controller->action->id =='staffusers'?true:false;
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableAjaxValidation' => $action_boolean,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
            'validateOnType' => false,
            'afterValidate' => 'js:function(form, data, hasError) { saveUserForm(form, data, hasError);}',
        ),
    ));

    ?>
    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
        <div class="col-lg-4 padzero">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
        <div class="col-lg-8 padzero">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'placeholder'=>'Email')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    </div>
    <input type="hidden" name="course" value="<?=$_GET['c']?>">
    <input type="hidden" name="institution" value="<?=$_GET['i']?>">
    <input type="hidden" name="faculty" value="<?=$_GET['f']?>">
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
        <style>
            .save-btn{
                margin-bottom: 10px;
                margin-top:0px !important;
            }
        </style>
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
    <?php } else { ?>
        <style>
            .save-btn{
                margin-top: 5px !important;
            }
        </style>
   <?php } ?>
    <?php $model->institution_id = '1'; ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array('class'=>'save-btn')); ?>
    <?php $this->endWidget(); ?>
</div>
<!-- form -->
<?php if(Yii::app()->controller->action->id =='staffusers') {
    $course=base64_decode($_GET['c']);
    $staffuserssql="SELECT * FROM `user_courses` left join users on user_courses.user_id=users.id where users.role=3 and user_courses.course_id={$course} GROUP BY users.id";
    $resultofstaff=Yii::app()->db->createCommand($staffuserssql)->queryAll();
    ?>
    <div class="row mydiv">
        <h3 class="text-center">Course Staffs</h3>
        <table class="table" id="stafftbl">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Staff Name</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($resultofstaff)) {
                foreach (array_reverse($resultofstaff) as $key=>$val) { ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$val['first_name']." ".$val['last_name']?></td>
                        <td><?=$val['email']?></td>
                    </tr>
                <?php } } else{  ?>
            <?php } ?>
            </tbody></table>
    </div>
<?php } ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>./../js/jquery.easy-autocomplete.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>./../css/easy-autocomplete.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>./../css/jquery.dataTables.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>./../css/jquery.dataTables.min.js"></script>
<script>
    function saveUserForm(form, data, hasError) {
        if (!hasError) {
            var formData = new FormData($('#users-form')[0]);
            var course='<?=$_GET['c']?>';
            var inst='<?=$_GET['i']?>';
            var faculty='<?=$_GET['f']?>';
            <?php if(Yii::app()->controller->action->id =='staffusers') { ?>
            var url = `staffusers?c=${course}&i=${inst}&f=${faculty}`;
            <?php } else { ?>
            var url = `ccreate?c=${course}&i=${inst}&f=${faculty}`;
            <?php } ?>
            $.ajax({
                url: url,
                type: "post",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                     var obj = JSON.parse(result);
                     if(obj.flag =='S')
                     {
                         $.notify("Staff added successfully", "success");
                         setTimeout(function(){
                             window.location.reload();
                             }, 3000);
                     }
                     else if(obj.flag =='E')
                     {
                         $.notify("Staff is already present in this course!", "error");
                     }
                     else if(obj.flag =='S200')
                     {
                         $.notify("New Student added successfully", "success");
                         setTimeout(function(){
                             window.location.assign('<?=Yii::app()->createUrl('users/cadmin',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f']))?>');
                         }, 3000);

                     }
                     else if(obj.flag =='E200')
                     {
                         $.notify("Student is already present in this course!", "error");
                     }
                }
            });
        }
    }
    $(function() {
        $('#Users_username,#Users_password').on('keypress', function(e) {
            if (e.which == 32)
                return false;
        });
        $('#Users_password').bind("cut copy paste",function(e) {
            e.preventDefault();
        });
        $("#stafftbl").dataTable({
            "bPaginate" : $('#stafftbl tbody tr').length>10,
            "iDisplayLength": 10,
            "searching":$('#stafftbl tbody tr').length>=10?true:false,
            language: {
                emptyTable: "No Staffs found.",
                "info": "Showing _START_ to _END_ of _TOTAL_ Staffs.",
            },
        });
        $('.dataTables_filter input').addClass('course-field');
    });
</script>
<script>
    <?php if(Yii::app()->controller->action->id =='staffusers') { ?>
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
<?php } ?>
</script>
