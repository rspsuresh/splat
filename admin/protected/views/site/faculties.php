<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>./../css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>./../css/faculty.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>./../css/jquery.dataTables.min.js"></script>
<style>
    table#tblfaculty.dataTable tbody tr:hover {
        background: #ECFBD4 !important;
    }
</style>
<section id="wrapper" >
<?php  if(Yii::app()->user->getState('role')=='Staff') { ?>
<div class="container fullbg">
<div class="container-fluid bg-color1">
<div class="containers">
<h4 class="welcome"> Welcome <span class="oppo-color">
<?php echo ucwords(Yii::app()->session['user']->first_name." ".Yii::app()->session['user']->last_name)?></span></h4>
</div>
</div>
<div class="container-fluid bg-color2">
<div class="containers">
<p class="welcomeforp">You have Staff permissions. SPLAT is a Self Learning and Peer Assessment Tool where you can create courses, add users to the course, setup projects, create groups & view peer assessment feedback.</p>
</div>
</div>
</div>
<?php } ?>
<?php  if(Yii::app()->user->getState('role')=='Superuser') { ?>
<div class="container">
<div class="user-institute">
<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="javascript:void(0);">Manage Faculties</a></p>
</div>	</div>
<?php } else { ?>
<div class="container">		<div class="user-institute"><p>You are here: <a href="javascript:void(0);">Manage Faculties</a></p>		</div>	</div>
<?php } ?>
<div class="container-fluid user-assessment">
<p>Manage Faculties</p>
</div>
<div class="script-section col-xs-12 col-lg-12 col-sm-12">
<table id='tblfaculty' class="table table-striped">
<thead>
<tr data-href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>$_GET['i'],
'f'=>base64_encode($models->id))); ?>">
<th class="facname">Facultly Name</th>
<th>Total Courses</th>
<th class="facnameend">Actions</th>
</tr>
</thead>
<tbody>
<?php $i=0;
foreach($model as $models) { ?>
<tr data-href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>$_GET['i'],
'f'=>base64_encode($models->id))); ?>">
<td><?php echo ucfirst($models->name); ?></td>
<td>
<?php if(Yii::app()->user->getState('role')=='Superuser') { ?>
<?php echo Courses::model()->count('faculty='.$models->id .' and status="active"' ); ?>
<?php } else {
$result=Yii::app()->db->createCommand('select group_concat(course_id) as course  from user_courses where user_id="'.Yii::app()->session['id'].'"')->queryAll();
$course=($result>0)?$result[0]['course']:"0";
echo Courses::model()->count('faculty=' .$models->id . ' and status="active"  and  id in('.$course.')'); ?>
<?php }  ?>
</td>
<td><?php if(Yii::app()->user->getState('role')=='Superuser') { ?>
    <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>',1)"></i>
    <?php  } ?>
<i class="fa fa-cog" data-toggle="modal" data-target="#facultyModal_<?php echo $models->id; ?>"></i>
</td>
<div class="modal fade" id="facultyModal_<?php echo $models->id;?>" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content col-xs-12 col-lg-12 col-sm-12">
<div class="modal-header col-lg-12">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title text-center">Faculties</h4>
</div>
<div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'faculty-form'.$models->id,
'enableClientValidation'=>true,
'clientOptions'=>array(
'validateOnSubmit'=>true,
),
)); ?>
<?php echo $form->hiddenField($models,'id'); ?>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models,'name'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($models,'name', array('placeholder'=>'Name')); ?>
<?php echo $form->error($models,'name'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models,'description'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textarea($models,'description', array('placeholder'=>'Description')); ?>
<?php echo $form->error($models,'description'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($models,'status'); ?>
</div>
<div class="col-lg-8 padzero formradio" >
                                   <?php echo $form->radioButtonList($models,'status', array('active'=>'Active','inactive'=>'Inactive'),
                                       array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                   <?php echo $form->error($models,'status'); ?>
                                   </div>
                                     </div>
                                       <?php echo CHtml::submitButton('Save',array('class'=>'save-btn fa-input')); ?>
                                       <?php $this->endWidget(); ?>
                                       </div>
                                         </div>
                                           </div>
                                             </div>
                                               <?php } ?>
                                               </tr>
                                                 </tbody>
                                                   </table>
                                                     <?php if(Yii::app()->user->getState('role')=='Superuser'){ ?>
                                                     <input type="button" value="&#xf02d; Add a Faculty" class="add-course fa-input" data-toggle="modal" data-target="#facultyModal">
                                                                                                                                                                                    <?php } ?>
                                                                                                                                                                                    </div>
                                                                                                                                                                                      </section>
<script type="text/javascript">
$(function() {
$("#tblfaculty").dataTable({
"bPaginate" : $('#tblfaculty tbody tr').length>10,
"iDisplayLength": 10,
"searching":$('#tblfaculty tbody tr').length>=10?true:false,
language: { infoEmpty: "No Faculties found.",
emptyTable: "No Faculties found.",
zeroRecords: "No Faculties found.",
"info": "Showing _START_ to _END_ of _TOTAL_ faculties",
},
});
$('.dataTables_filter input').addClass('course-field');
});
$(document).on('click','#tblfaculty tbody tr td:not(":last-child")',function(){
    var url=$(this).closest('tr').attr('data-href');
    window.location.assign(url);
});
function ConfirmDelete(id,type)
{
if(type==1)
{
var url = '<?php echo Yii::app()->createUrl('site/deletefacilites') ?>';
var x=confirm("Are you sure you want to delete faculty?");
}
else
{
var url = '<?php echo Yii::app()->createUrl('site/deletetemplate') ?>';
var x=confirm("Are you sure you want to delete Template?");
}

if (x)
{

$.ajax({
url: url,
type: 'post',
data: {'id': id},
dataType: "json",
success: function (data) {
if(type==1)
{
$("#row_"+id).remove();
$.notify("Facility deleted succesfully", "success");
}
else
{
$("#temprow_"+id).remove();
$.notify("Template deleted succesfully", "success");
}
}
});
}
else
{
return false;
}
}
</script>
<!-- model -->
<div class="modal fade" id="facultyModal" role="dialog">
<div class="modal-dialog">
<div class="modal-content col-xs-12 col-lg-12 col-sm-12">
<div class="modal-header col-lg-12">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title text-center">Faculty</h4>
</div>
<div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
<?php $form=$this->beginWidget('CActiveForm',
array('id'=>'faculty-form',
'enableClientValidation'=>true,
'clientOptions'=>array('validateOnSubmit'=>true))); ?>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel,'name'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textField($formModel,'name', array('placeholder'=>'Name')); ?>
<?php echo $form->error($formModel,'name'); ?>
</div>
</div>
<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
<?php echo $form->labelEx($formModel,'description'); ?>
</div>
<div class="col-lg-8 padzero">
<?php echo $form->textarea($formModel,'description', array('placeholder'=>'Description')); ?>
<?php echo $form->error($formModel,'description'); ?>
</div>
</div>
<!--<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
<div class="col-lg-4 padzero">
echo $form->labelEx($formModel,'status'); ?>
</div>
<div class="col-lg-8 padzero formradio">
<?php echo $form->radioButtonList($formModel,'status', array('active'=>'Active','inactive'=>'Inactive'),
array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
<?php echo $form->error($formModel,'status'); ?>
</div>
</div>-->
<?php
echo CHtml::tag('button',[
'id'=>'btsubmit','class'=>'save-btn fa-input','name'=>'files','type'=>'submit'
],'<i class="fa fa-floppy-o" aria-hidden="true"></i> Save'); ?>
<?php $this->endWidget(); ?>
</div>
</div>
</div></div>
