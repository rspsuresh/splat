<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/summernote-master/dist/summernote-bs4.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/summernote-master/dist/summernote-bs4.js"></script>
<style>
    .fa-input { font-family: FontAwesome, ‘Helvetica Neue’, Helvetica, Arial, sans-serif; }
    .note-editable card-block{width:410px;}
    .container-fluid.bg-color {
        background-color: #00B9D1 !important;
        padding:40px 0px;
        margin-bottom:22px;opacity:0.9;
    }
    .head-bg{margin-bottom:0px;}
    .bg-text{
        color: #ffffff;
        font-size: 37px;
        font-weight: bold;
        text-align: center;
    }
    .oppo-color{
        color:#5FFC7B;
    }
    .production{
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        padding: 20px 0 0;
    }
    .recent {

        margin-top: 60px;
        padding: 0;
    }
    .font-normal{
        font-family:"Conv_helveticaneuecyr-roman" !important;
        font-weight:bold !important;
        color:#337AB7 !important;
        font-size:22px !important;
    }
    .user-assessment>p
    {font-size:20px !important;}
    .script-text h1 {
        color: #000;
        font-size: 16px !important;
    }
    .add-course
    {
        font-size: 15px !important;
        font-weight:bold;
    }
    .fullbg{
        background-image: url(/images/Asses.jpg);
        display:block;
        width:100%;
        height:500px;
    }
    .container-fluid.bg-color1 {
        background-color: rgb(242, 242, 242);

        margin-top: 150px;
        width: 500px;
    }
    .container-fluid.bg-color2 {
        background-color: rgb(242, 242, 242);

        margin-top: 15px;
        width: 610px;
    }
    .welcome
    {
        font-size: 30px;
        text-align: center;
    }
    .welcomeforp
    {
        text-align: center;
        font-size:20px
    }
    .containers >p
    {
        margin:0px !important;
    }
    .container-fluid.bg-color2>.containers
    {
        padding:5px;
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
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
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
<th>Facultly Name</th>
<th>Total Courses</th>
<th>Actions</th>
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
  <td><i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>',1)"></i>
  <i class="fa fa-cog" data-toggle="modal" data-target="#facultyModal_<?php echo $models->id; ?>"></i></td>
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
<script>
    $(function() {
       $("#tblfaculty").dataTable({
    "bPaginate" : $('#tblfaculty tbody tr').length>5,
   "iDisplayLength": 5,
   "searching":$('#tblfaculty tbody tr').length>=3?true:false,
  language: { infoEmpty: "No Faculties found.",
                emptyTable: "No Faculties found.",
                zeroRecords: "No Faculties found.",
				"info": "Showing _START_ to _END_ of _TOTAL_ faculties",
    },
});
$('#tblfaculty').on( 'click', 'tbody tr', function () {
    window.location.href = $(this).data('href');
});
$('.dataTables_filter input').addClass('course-field');
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
</script><!-- model -->
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