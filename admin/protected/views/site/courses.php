<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jqueryui/jquery-ui.min.css">
<link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/../css/course.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqueryui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/../css/jquery.dataTables.min.css">
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/../css/jquery.dataTables.min.js"></script>
<style>
    .dataTable tbody tr:hover {
        background: #ECFBD4 !important;
    }
</style>
<section id="wrapper" >
<div class="container">
<div class="user-institute">
<?php if (Yii::app()->user->getState('role') == 'Superuser') {?>
<p>You are here:
<a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home
</a> /
<a href="<?php echo Yii::app()->createUrl('site/faculties', array('i' => base64_encode($institution->id))); ?>">Faculties
</a> /
<b>
<?php echo ucfirst($faculty->name); ?>
</b>
</p>
<?php } else {?>
<p>You are here:
<a href="<?php echo Yii::app()->createUrl('site/faculties', array('i' => base64_encode($institution->id))); ?>">Faculties
</a> /
<b>
<?php echo ucfirst($faculty->name); ?>
</b>
</p>
<?php }?>
</div>
</div>
<div class="container-fluid user-assessment">
<p>Manage Courses
</p>
</div>
<div class="script-section col-xs-12 col-lg-12 col-sm-12">
<ul class="nav nav-tabs script-tab text-center" >
<li class="active">
<a data-toggle="tab" href="#home" aria-expanded="true">
<i class="fa fa-toggle-on" style="color:white" aria-hidden="true">
</i> Active (<?=count($model)?>)
</a>
</li>
<li class="blue-clr">
<a data-toggle="tab" href="#menu1" aria-expanded="false">
<i class="fa fa-toggle-off" style="color:white" aria-hidden="true">
</i> Inactive (<?=count($imodel)?>)
</a>
</li>
</ul>
<div class="tab-content" >
<div id="home" class="tab-pane fade in active">
<div class="bs-example">
<div class="panel-group" id="accordion">
<div class="panel">
<table id='course_tbl'>
<thead>
<tr>
<th class="coursenameclr">Course Name
</th>
<th>Level
</th>
<th>Year
</th>
<th>Students
</th>
<th class="coursenameclr_end">Action
</th>
</tr>
</thead>
<tbody>
<?php foreach ($model as $key => $models) {?>
<tr data-href="<?php echo Yii::app()->createUrl('users/cadmin',array('i'=>$_GET['i'],
'f'=>$_GET['f'], 'c'=>trim(base64_encode($models->id)))); ?>">
<td>
<?php echo ucwords($models->course_type . " " . $models->name); ?>
</td>
<td>
<?=($models->course_level != '') ? 'Level: ' . $models->course_level : ''?>
</td>
<td>
<?=($models->year != '') ? 'Year: ' . $models->year : ''?>
</td>
<td>
<?php
$sql = "SELECT user_id as user_id FROM `user_courses`
join users on user_courses.user_id=users.id and users.role=5
WHERE user_courses.`course_id` = " . $models->id . " and users.status='active'";
$result = Yii::app()->db->createCommand($sql)->queryAll();
$uniquesdata = array_unique(array_column($result, 'user_id'));
echo count($uniquesdata);?>
</td>
<td>
<span class="pull-right">
<i class="fa fa-cog" data-toggle="modal"
data-target="#courseModal_<?php echo $models->id; ?>">
</i>
</span>
</td>
</tr>
<div class="modal fade" id="courseModal_<?php echo $models->id; ?>" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content col-xs-12 col-lg-12 col-sm-12">
<div class="modal-header col-lg-12">
<button type="button" class="close" data-dismiss="modal">&times;
</button>
<h4 class="modal-title text-center">Courses
</h4>
</div>
<div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
<?php $form = $this->beginWidget('CActiveForm', array(
'id' => 'course-form' . $models->id,
'enableClientValidation' => true,
'clientOptions' => array(
'validateOnSubmit' => true,
),
));?>
<?php echo $form->hiddenField($models, 'id'); ?>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'name'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models, 'name', array('placeholder' => 'Name')); ?>
<?php echo $form->error($models, 'name'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'course_type'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models, 'course_type', array('placeholder' => 'MA(Hons),M.sc..')); ?>
<?php echo $form->error($models, 'course_type'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'course_level'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models, 'course_level', array('placeholder' => 'Ex:2')); ?>
<?php echo $form->error($models, 'course_level'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'year'); ?>
</div>
<div class="col-lg-8 padzero">
<?php $models->year = date('M-Y', strtotime($models->year));
echo $form->textField($models, 'year', array('placeholder' => 'year', 'maxlength' => 4, 'class' => 'datepicker', 'id' => 'Courses_year_' . $models->id));?>
<?php echo $form->error($models, 'year'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'description'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textarea($models, 'description', array('placeholder' => 'Description')); ?>
<?php echo $form->error($models, 'description'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models,'marks'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->dropDownList($models, 'marks',
array(5=>'1-5',10=>'1-10')
, array('empty'=>'Select Marks')); ?>
<?php echo $form->error($models,'marks'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'status'); ?>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($models, 'status', array('active' => 'Active', 'inactive' => 'Inactive'), array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')); ?>
<?php echo $form->error($models, 'status'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<label>Anonymous
</label>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($models, 'anonymous', array('1' => 'ON', '2' => 'OFF'), array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')); ?>
<?php echo $form->error($models, 'anonymous'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<label>Delete Course
</label>
</div>
<div class="col-lg-8 padzero formradio">
<i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')">
</i>
</div>
</div>
<?php echo CHtml::submitButton('Save', array('class' => 'save-btn')); ?>
<?php $this->endWidget();?>
</div>
</div>
</div>
</div>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div id="menu1" class="tab-pane fade">
<div class="bs-example">
<table id='course_tbl_incative'>
<thead>
<tr>
<th>Course Name
</th>
<th>Level
</th>
<th>Year
</th>
<th>Users
</th>
<th>Action
</th>
</tr>
</thead>
<tbody>
<?php foreach ($imodel as $key => $models) {?>
<tr>
<td>
<?php echo ucwords($models->course_type . " " . $models->name); ?>
</td>
<td>
<?=($models->course_level != '') ? 'Level: ' . $models->course_level : ''?>
</td>
<td>
<?=($models->year != '') ? 'Year: ' . $models->year : ''?>
</td>
<td>
<?php
$sql = "SELECT user_id as user_id FROM `user_courses`
join users on user_courses.user_id=users.id and users.role=5
WHERE user_courses.`course_id` = " . $models->id . " and users.status='active'";
$result = Yii::app()->db->createCommand($sql)->queryAll();
$uniquesdata = array_unique(array_column($result, 'user_id'));
echo count($uniquesdata);?>
</td>
<td>
<span class="pull-right">
<i class="fa fa-cog" data-toggle="modal"
data-target="#courseModal_<?php echo $models->id; ?>">
</i>
</span>
</td>
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content col-xs-12 col-lg-12 col-sm-12">
<div class="modal-header col-lg-12">
<button type="button" class="close" data-dismiss="modal">&times;
</button>
<h4 class="modal-title text-center">Courses
</h4>
</div>
<div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
<?php $form = $this->beginWidget('CActiveForm', array(
'id' => 'course-form' . $models->id,
'enableClientValidation' => true,
'clientOptions' => array(
'validateOnSubmit' => true,
),
));?>
<?php echo $form->hiddenField($models, 'id'); ?>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'name'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models, 'name', array('placeholder' => 'Name')); ?>
<?php echo $form->error($models, 'name'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'course_type'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models, 'course_type', array('placeholder' => 'MA(Hons),M.sc..')); ?>
<?php echo $form->error($models, 'course_type'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'course_level'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models, 'course_level', array('placeholder' => 'Ex:2')); ?>
<?php echo $form->error($models, 'course_level'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php
echo $form->labelEx($models, 'year'); ?>
</div>
<div class="col-lg-8 padzero">
<?php
echo $form->textField($models, 'year', array('placeholder' => 'year', 'maxlength' => 4, 'class' => 'datepicker', 'id' => 'Courses_year_' . $models->id)); ?>
<?php echo $form->error($models, 'year'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'description'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textarea($models, 'description', array('placeholder' => 'Description')); ?>
<?php echo $form->error($models, 'description'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models,'marks'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->dropDownList($models, 'marks',
array(5=>'1-5',10=>'1-10')
, array('empty'=>'Select Marks')); ?>
<?php echo $form->error($models,'marks'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models, 'status'); ?>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($models, 'status', array('active' => 'Active', 'inactive' => 'Inactive'), array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')); ?>
<?php echo $form->error($models, 'status'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<label>Anonymous Option
</label>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($models, 'anonymous', array('1' => 'ON', '2' => 'OFF'), array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')); ?>
<?php echo $form->error($models, 'anonymous'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<label>Delete Course
</label>
</div>
<div class="col-lg-8 padzero formradio">
<i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')">
</i>
</div>
</div>
<?php echo CHtml::submitButton('Save', array('class' => 'save-btn')); ?>
<?php $this->endWidget();?>
</div>
</div>
</div>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<input type="button" value="&#xf02d; Add a Course" class="add-course fa-input" data-toggle="modal" data-target="#courseModal">
</div>
</section>
<!-- model -->
<div class="modal fade" id="courseModal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content col-xs-12 col-lg-12 col-sm-12">
<div class="modal-header col-lg-12">
<button type="button" class="close" data-dismiss="modal">&times;
</button>
<h4 class="modal-title text-center">Courses
</h4>
</div>
<div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
<?php $form = $this->beginWidget('CActiveForm', array(
'id' => 'course-form',
'enableClientValidation' => false,
'clientOptions' => array(
'validateOnSubmit' => true,
),
));?>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel, 'name'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($formModel, 'name', array('placeholder' => 'Name')); ?>
<?php echo $form->error($formModel, 'name'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel, 'course_type'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($formModel, 'course_type', array('placeholder' => 'MA(Hons),M.Sc..')); ?>
<?php echo $form->error($formModel, 'course_type'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel, 'course_level'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($formModel, 'course_level', array('placeholder' => 'Ex:2')); ?>
<?php echo $form->error($formModel, 'course_level'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel, 'year'); ?>
</div>
<div class="col-lg-8 padzero">
<?php
echo $form->textField($formModel, 'year', array('placeholder' => 'year', 'maxlength' => 4, 'class' => 'datepicker')); ?>
<?php echo $form->error($formModel, 'year'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel, 'description'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textarea($formModel, 'description', array('placeholder' => 'Description')); ?>
<?php echo $form->error($formModel, 'description'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel,'marks'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->dropDownList($formModel, 'marks',
array(5=>'1-5',10=>'1-10')
, array('empty'=>'Select Marks')); ?>
<?php echo $form->error($formModel,'marks'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel, 'status'); ?>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($formModel, 'status', array('active' => 'Active', 'inactive' => 'Inactive'), array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')); ?>
<?php echo $form->error($formModel, 'status'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<label>Anonymous Option
</label>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($formModel, 'anonymous', array('1' => 'ON', '2' => 'OFF'), array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')); ?>
<?php echo $form->error($formModel, 'anonymous'); ?>
</div>
</div>
<?php
echo CHtml::tag('button', [
'id' => 'btsubmit', 'class' => 'save-btn fa-input', 'name' => 'yt3', 'type' => 'submit',
], '<i class="fa fa-floppy-o" aria-hidden="true"></i> Save'); ?>
<?php $this->endWidget();?>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function ConfirmDelete(id)
{
var x = confirm("Are you sure you want to delete this course? The action cannot be undone and all the responses in here will be deleted.");
if (x)
{
$.ajax({
url: '<?php echo Yii::app()->createUrl('site/deletecourse') ?>',
type: 'post',
data: {'id': id}  ,
dataType: "json",
success: function (data) {
$("#row_"+id).remove();
$.notify("Course deleted succesfully", "success");
window.location.reload();
}
}
);
}
else
{
return false;
}
}
$(function() {
$("#course_tbl").dataTable({
"bPaginate" : $('#course_tbl tbody tr').length>10,
"iDisplayLength": 10,
"searching":$('#course_tbl tbody tr').length>=10?true:false,
language: {
infoEmpty: "No Courses found.",
emptyTable: "No Courses found.",
zeroRecords: "No Courses found.",
"info": "Showing _START_ to _END_ of _TOTAL_ courses",
},
});
$("#course_tbl_incative").dataTable({
"bPaginate" : $('#course_tbl_incative tbody tr').length>10,
"iDisplayLength": 10,
"searching":$('#course_tbl_incative tbody tr').length>=10?true:false,
language: {
infoEmpty: "No Courses found.",
emptyTable: "No Courses found.",
zeroRecords: "No Courses found.",
"info": "Showing _START_ to _END_ of _TOTAL_ Inactive Courses",
},
});
$('.dataTables_filter input').addClass('course-field');
$('.datepicker').each(function(){
$(this).datepicker({
dateFormat: 'M-yy' });
});
});
$(document).on('click','#course_tbl tbody tr td:not(":last-child")',function(){
var url=$(this).closest('tr').attr('data-href');
window.location.assign(url);
});
</script>