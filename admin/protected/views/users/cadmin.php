<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    .fa-input { font-family: FontAwesome, ‘Helvetica Neue’, Helvetica, Arial, sans-serif; }
    .redclr{
        color:red;
    }
    .ifanchor{
        border-bottom:2px solid #00B9CF;
        color:#00B9CF !important;
    }
    /*.footer-sec{*/
    /*    bottom:auto !important;*/
    /*}*/
    i.fa.fa-youtube-play {
        color: #e52d27 !important;
        font-size:16px !important;
    }
    .view
    {
        display:none;
    }
    .btn-bs-file{
        position:relative;
    }
    .btn-bs-file input[type="file"]{
        position: absolute;
        filter: alpha(opacity=0);
        opacity: 0;
        width:0;
        height:0;
        outline: none;
        cursor: inherit;
    }
    .admin-manage{border-bottom:none !important; }
    .mydiv
    {    float: left;
        width: 100%;
        border-radius: 10px;
        border: 1px solid #1CBBB4;
        padding: 10px;}
    .user-assessment p,.m-projects
    {
        font-size:20px !important;
        font-weight:bold;
    }
    .script-text .current-status > p {
        font-size: 16px;
    }
    .current-fa p > li {
        font-size: 16px;
    }
    .current-fa .fa-trash {
        font-size: 22px !important;
        margin-top: 10px;
    }
    .add-course{
        font-size:17px !important;
        font-weight:bold;
    }
    .script-text >h1 >a {
        font-size: 16px;
    }
    .common
    {
        font-size: 20px !important;
        font-weight: bold;
    }
    .m-projects-user
    {
        color: #00B9CF;
        font-size: 30px;
        text-align: left;
        margin-top: 0px;

    }
    .table th{
        color:white;
    }
    .table thead{
        background-color:#03c6e3 !important;
    }
    .info-student{
        background-color:#03c6e3 !important;
        color:#f0ffff;
        padding: 8px;
        border:none;
        border-radius:3px;
        margin-bottom: 3px;
    }
    .grayclass{
        background-color: grey !important;
    }
    .info-gray {
        background-color:grey !important;
        color: #f0ffff;
        padding: 8px;
        border: none;
        border-radius: 3px;
    }
    #loading {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        display: block;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
        text-align: center;
    }

    #loading-image {
        position: absolute;
        top: 100px;
        left: 691px;
        z-index: 100;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
    {
        vertical-align:unset !important;
    }
    .questioners
    {
        width: 100%;
        float: left;
        color: snow;padding:15px!important;
    }
    .released
    {
        background-color: gray !important;
    }
    .irlsd
    {
        font-size:19px !important;
        color:darkgreen !important;
    }
    .irls
    {
        font-size:19px !important;
        color:white !important;
    }
    .ipend
    {
        font-size:19px !important;
        color:red !important;
    }
    .table th
    {
        border: 1px white solid;
        padding: 0.3em;
    }
    td
    {

    }
    .crnone
    {
        cursor: auto !important;
    }
</style>
<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
?>
<div id="loading" style="display:none">
    <img id="loading-image"  src="<?=Yii::app()->request->baseUrl?>/../images/loading.gif" alt="Loading..." />
</div>
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            {
                ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/faculties',
                        array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),
                        'f'=>base64_encode($faculty->id)));?>"><?php echo ucfirst($faculty->name);?></a> /
                    <b><?php echo ucfirst($course->name); ?></b></p>
            <?php }
            else { ?>
                <p>
                    <a>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',
                            array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                        <a href="<?php echo Yii::app()->createUrl('site/courses',
                            array('i'=>base64_encode($institution->id),
                                'f'=>base64_encode($faculty->id)));?>">
                            <?php echo ucfirst($faculty->name);?></a> /
                        <a href="<?=Yii::app()->createUrl('site/courseitems',array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i']))?>"><?php echo ucfirst($course->name); ?></a>
                </p>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Course Users</p>
    </div>
    <div class="container-fluid">
        <div class="script-section col-xs-12 col-lg-12 col-sm-12">
            <div class="mydiv">
                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'users-grid',
                    'dataProvider'=>$modeluser->search(),
                    'emptyText'=>"No users imported yet.",
                    'filter'=>$modeluser,
                    'columns'=>array(
                        'email',
                        'first_name',
                        'last_name',
                        array
                        (
                            "header" => "Actions",
                            'class'=>'CButtonColumn',
                            'template'=>'{view}{update}{delete}',
                            'buttons'=>array
                            (
                                'update' => array
                                (
                                    'url'=>'$this->grid->controller->createUrl("/users/update", array("id"=>$data->id,"c"=>$_GET["c"],"i"=>$_GET["i"],"f"=>$_GET["f"]))',
                                ),
                                'delete'=>array(
                                    'url'=>'$this->grid->controller->createUrl("/users/delete", array("id"=>$data->id,"c"=>$_GET["c"],"i"=>$_GET["i"],"f"=>$_GET["f"],"ajax"=>"users-grid"))',
                                )
                            ),
                        ),
                    ),
                )); ?>
                <div class="row">
                    <div class="col-sm-12" style="margin-top:30px;">
                        <?php $grpmodel=Groups::model()->find('course_id='.base64_decode($_GET['c'])) ?>

                        <?php if($grpmodel) {
                            echo CHtml::link('<i class="fa fa-user" style="color:white" aria-hidden="true"></i>&nbsp;Add a student to this course ', Yii::app()->createUrl('users/ccreate',
                                array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'])),
                                array('class'=>'admin-btn btn btn-info '));
                        }
                        ?>

                        <label class="admin-btn btn-bs-file btn btn-info" title="Browse user">
                   <i class="fa fa-users" style="color:white" aria-hidden="true"></i> Bulk import students
                    <?php
                    $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'bulk_import_group_users',
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <input type="file"  onchange="filechange()" value="Bulk Import"  id="bulk_import_group_users" name="csv_file" accept=".csv" />
                    <?php  $this->endWidget();?>
                </label>
                        <a href="<?= Yii::app()->CreateUrl('users/staffusers',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f']))?>">
                            <button class="admin-btn btn-bs-file btn btn-info" title="Create Staff">
                                <i class="fa fa-user" style="color:white" aria-hidden="true"></i>&nbsp;Add a Staff to this Course
                            </button></a>
                    </div>
                    <div class="col-lg-12" style="padding-top: 10px">
                        <p><span style="color:red;"><a href="JavaScript:Void(0);">
          <span class="glyphicon glyphicon-info-sign crnone" ></span>
        </a>Watch the video tutorial on bulk importing the users from Brightspace:<a class="ifanchor">
		<i data-toggle="modal" data-target="#myModalprv" class="fa fa-youtube-play"> <strong style="color:#00B9CF !important">Video</strong></i> </a><br>
                               &nbsp;&nbsp;&nbsp;&nbsp;Alternatively, you can download and refer to the attached File: <a class="ifanchor"  onclick='download1()'><strong>
							   Splat_Bulk_user_import_template.csv</strong></a><br>
                            &nbsp;&nbsp;
&nbsp;Note: The import file must be in .csv format
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Assesments</p>
    </div>
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <div  class="mydiv">
            <p class="row-inactive">
                <span class="glyphicon glyphicon-info-sign crnone" style="color:#337ab7 !important;"></span>
                <!--<span style="color:red">
                    Projects can be created here and students can be grouped inside the project.A project can have multiple assessments points set while creation.
                </span>-->
                <span style="color:red">
                    Add an assessment to view the users and groups. Users are grouped automatically based on the import file.
                </span>
            </p>
            <?php
            $i=0;
            if(count($model)>0):
                echo ' <table class="table">
                                <thead>
                                <tr>
                                    <th>Assessment  Name</th>
                                    <th>Status</th>
                                    <th>Due By</th>
                                    <th>Email Actions</th>
                                    <th>Result Action</th>
                                </tr>
                                </thead>
                                <tbody>';
                foreach($model as $models):
                    $i++;
                    ?>
                    <tr >
                        <td><a href="javascript:void(0)">

                                <i class="fa fa-cog" title="edit settings" data-toggle="modal" data-target="#courseModal_<?php echo $models->id;?>"></i>
                            </a>  <a href="javascript:void(0);" style="color:#000000;"><?php echo ucfirst($models->name);?></a></td>
                        <td><?php echo ucfirst($models->status);?></td>
                        <td>
                            <?=date('d-m-Y H:i',strtotime($models->assess_date))?>
                        </td>
                        <?php
                        $countcourseuser=Userdetails::model()->count('course='.base64_decode($_GET['c']));
                        $mailsendtowardscourseandassessment=MailSend::model()->count(array(
                            'condition'=>'c_id='.base64_decode($_GET['c']).' and as_id='.$models->id,
                            'group'=>'as_id,u_id'));

                        $countdata=count(Userdetails::model()->findAll('course='.base64_decode($_GET['c'])))
                            -
                            count(MailSend::model()->findAll("c_id=".base64_decode($_GET['c'])." and as_id=".$models->id));
                        $countdatafinal=($countdata  >1)?$countdata:0;
                        ?>
                        <td>
                            <?php if($mailsendtowardscourseandassessment==0) {?>
                                <button class="info-student release" onclick="mailprocess(<?=base64_decode($_GET['c'])?>,<?=base64_decode($_GET['i'])?>,<?=base64_decode($_GET['f'])?>,<?=$models->id?>)"><i class="fa fa-envelope-o irls" aria-hidden="true"></i> Release to students  <span>(<?=$countcourseuser?>)</span>
                                </button>
                            <?php } else if($mailsendtowardscourseandassessment ==$countcourseuser ||  $mailsendtowardscourseandassessment > $countcourseuser) { ?>
                                <button class="info-student released"><i class="fa fa-check irlsd" aria-hidden="true"></i> Released to students<span></span>
                                </button>
                            <?php } else { ?>
                            <?php if($models->status !='completed'){ ?>
                                <button class="info-student pendingrelease" onclick="mailprocess(<?=base64_decode($_GET['c'])?>,<?=base64_decode($_GET['i'])?>,<?=base64_decode($_GET['f'])?>,<?=$models->id?>)"><i class="fa fa-clock-o ipend" aria-hidden="true"></i> Pending to students<span>(<?=$countcourseuser-$mailsendtowardscourseandassessment?>)</span>
                                </button>
                                <?php } else {  ?>
                                -
                                <?php } ?>
                            <?php } ?>

                            <?php if($models->status =='current'){ ?>
                                <button onclick="sendremainder(<?=base64_decode($_GET['c'])?>,<?=base64_decode($_GET['i'])?>,<?=base64_decode($_GET['f'])?>,<?=$models->id?>)"
                                        class="info-student"><i class="fa fa-paper-plane"  style="color:white" aria-hidden="true"></i>
                                    Send remainder
                                </button>
                            <?php } ?>
                        </td>
                        <td>
                            <a  href="<?php echo Yii::app()->createUrl('groupusers/groupasses',
                                array('id'=>$models->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$models->id));?>">
                                <button class="info-student"><i class="fa fa-eye" style="color:white" aria-hidden="true"></i> View</button></a>
                            <a  class="download" title="Download responses"
                                data-status="<?=$models->status?>"
                                data-projectname="<?=$models->name?>"
                                data-project='<?=$models->id?>'>
                                <button  class="info-student"><i class="fa fa-download" style="color:white" aria-hidden="true"></i> Download</button>
                            </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="courseModal_<?php echo $models->id;?>" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                <div class="modal-header col-lg-12">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Assesments</h4>
                                </div>
                                <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                        'id'=>'course-form'.$models->id,
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
                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                        <div class="col-lg-4 padzero">
                                            <?php echo $form->labelEx($models,'status'); ?>
                                        </div>
                                        <div class="col-lg-8 padzero formradio">
                                            <?php echo $form->radioButtonList($models,'status',
                                                array('inactive'=>'Draft','completed'=>'Completed','current'=>'Live'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                            <?php echo $form->error($models,'status'); ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                        <div class="col-lg-4 padzero">
                                            <label for="Projects_assess_date" class="required">Assessment Due date <span class="required">*</span></label>
                                        </div>
                                        <div class="col-lg-8 padzero">
                                            <?php
                                            $models->assess_date=date('d-m-Y H:i:s',strtotime($models->assess_date));
                                            echo $form->textField($models,'assess_date', array('placeholder'=>'yyyy-mm-dd','class'=>'datepickerp')); ?>
                                            <?php echo $form->error($models,'assess_date'); ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                        <div class="col-lg-4 padzero">
                                            <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>',1,'')"></i><strong>
                                                Delete Assessment</strong>
                                        </div>
                                    </div>
                                    <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                                    <?php $this->endWidget(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                echo '</tbody></table>';
            else:
                ?>
                <div class="script-text">
                    <h1>Create an Assessment project.</h1>
                </div>
            <?php endif; ?>
            <input type="button" value="&#xf0f6; Create an Assessment" class="add-course fa-input" data-toggle="modal" data-target="#projectModal">
        </div>
    </div>
    <h1 class="center m-projects user-assessment questioners">Manage Questionnaire</h1>
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <div class="mydiv">
            <p><span style="color:red;"><a href="JavaScript:Void(0);">
          <span class="glyphicon glyphicon-info-sign crnone"></span>
        </a>Please select or create questions for peers to be assessed on.You can either select the questions from the default question set or create custom questions of your own.</a></span></p>
            <?php
            $i=0;
            if(count($question)>0):
            echo ' <table class="table">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Question Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>';
            foreach($question as $iquestion):
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo ucfirst($iquestion->question); ?></td>
                <td>
                    <span class="pull-left">
                    <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $iquestion->id ?>',2,'')"></i>
                        <?php if($iquestion->type !="default") { ?>
                            <i class="fa fa-pencil" data-toggle="modal" data-target="#questionModal_<?php echo $iquestion->id; ?>"></i>
                        <?php } ?>

                    </span>
                </td>
            </tr>
            </span>
        </div>
        <div class="modal fade" id="questionModal_<?php echo $iquestion->id;?>" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                    <div class="modal-header col-lg-12">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Questions</h4>
                    </div>
                    <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'question-form'.$iquestion->id,
                            'enableClientValidation'=>true,
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                            ),
                        )); ?>
                        <?php echo $form->hiddenField($iquestion,'id'); ?>
                        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                            <div class="col-lg-4 padzero">
                                <?php echo $form->labelEx($iquestion,'question'); ?>
                            </div>
                            <div class="col-lg-8 padzero">
                                <?php echo $form->textArea($iquestion,'question', array('placeholder'=>'Question')); ?>
                                <?php echo $form->error($iquestion,'question'); ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none">
                            <div class="col-lg-4 padzero">
                                <?php echo $form->labelEx($iquestion,'type'); ?>
                            </div>
                            <div class="col-lg-8 padzero formradio">
                                <?php echo $form->radioButtonList($iquestion,'type', array('default'=>'Default','custom'=>'Custom'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                <?php echo $form->error($iquestion,'type'); ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
                            <div class="col-lg-4 padzero">
                                <?php echo $form->labelEx($iquestion,'q_type'); ?>
                            </div>
                            <div class="col-lg-8 padzero formradio">
                                <?php echo $form->radioButtonList($iquestion,'q_type', array('R'=>'Rating','S'=>'Text'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                <?php echo $form->error($iquestion,'q_type'); ?>
                            </div>
                        </div>
                        <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endforeach;
        echo "</tbody></table>";
        else:
            ?>
            <div class="script-text" style="border:none !important">
                <h1>No questions for display.</h1>
            </div>
        <?php endif; ?>
        <?php  //if(Yii::app()->user->getState('role')=='Superuser'){ ?>
        &nbsp;&nbsp;<input type="button" value="&#xf059; Create a custom question" class="add-course fa-input" data-toggle="modal" data-target="#questionModal">
        <input type="button" value="&#xf059; Select from default Question" class="add-course fa-input" data-toggle="modal" data-target="#dquestionModal" style="margin-right:10px;">
        <?php //}?>
    </div>
</section>
<!-- model -->
<div class="modal fade" id="projectModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Assessment</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'project-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'name'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textField($formModel,'name', array('placeholder'=>'Name')); ?>
                        <span style="color:gray;">Eg.. Unit -I Project name(2018-2019)</span>
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
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <label for="Projects_assess_date" class="required">Assessment Due date <span class="required">*</span></label>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php
                        echo $form->textField($formModel,'assess_date', array('placeholder'=>'dd-mm-yyyy','class'=>'datepickerp')); ?>
                        <?php echo $form->error($formModel,'assess_date'); ?>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">User</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'user-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>

                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($institutionUser,'user_id'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php
                        if(count($existing_users)>0)
                            echo $form->dropDownList($institutionUser, 'user_id', CHtml::listData(Users::model()->findAll('id  in('.implode(',',$existing_users).') and status="active"'), 'id', 'first_name'), array('empty'=>'Select User'));
                        else
                            echo $form->dropDownList($institutionUser, 'user_id', CHtml::listData(Users::model()->findAll('status="active"'), 'id', 'first_name'), array('empty'=>'Select User'));
                        ?>
                        <?php echo $form->error($institutionUser,'user_id'); ?>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<!-- model -->
<div class="modal fade" id="questionModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Create a custom question</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'question-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($questions,'question'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textArea($questions,'question', array('placeholder'=>'Question')); ?>
                        <?php echo $form->error($questions,'question'); ?>
                    </div>
                </div>
                <!--                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">-->
                <!--                    <div class="col-lg-4 padzero">-->
                <!--                        --><?php //echo $form->labelEx($questions,'type'); ?>
                <!--                    </div>-->
                <!--                    <div class="col-lg-8 padzero formradio">-->
                <!--                        --><?php //echo $form->radioButtonList($questions,'type', array('default'=>'Default','custom'=>'Custom'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                <!--                        --><?php //echo $form->error($questions,'type'); ?>
                <!--                    </div>-->
                <!--                </div>-->
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($questions,'q_type'); ?>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php echo $form->radioButtonList($questions,'q_type', array('R'=>'Rating Scale (1-10)','S'=>'Text'), array('labelOptions'=>array('style'=>'display:inline','class'=>'typeques'),'separator'=>'  ')); ?>
                        <?php echo $form->error($questions,'q_type'); ?>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<!-- model -->
<div class="modal fade" id="dquestionModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Select From Default Questions</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'dquestion-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <?php
                    $questioncheck=Yii::app()->db->CreateCommand('select GROUP_CONCAT(question_id) as questionid from delete_custom_question')->QueryAll();
                    $question=(!empty($questioncheck[0]['questionid']))?$questioncheck[0]['questionid']:0;
                    //$defaultQue=Questions::model()->findAll("type='default' and status='active' and id not in (".$question.")");
                    $defaultQuerating=Questions::model()->findAll("type='default' and status='active' and q_type='R'");
                    $defaultQuetxt=Questions::model()->findAll("type='default' and status='active' and q_type='S'");

                    if(count($defaultQuerating) > 0  || count($defaultQuetxt) > 0  ) { ?>
                        <div class="col-lg-12 padzero">
                            <?php if(count($defaultQuerating) > 0 ) { ?>
                                <p class="redclr"><strong>Rating Scale (1-10)</strong></p>
                                <?php echo CHtml::checkBoxList(
                                    'defaultQuestions',
                                    '',
                                    CHtml::listData($defaultQuerating,'id','question'));
                                ?>
                            <?php } ?>
                            <?php if(count($defaultQuetxt) > 0) { ?>
                                <p class="redclr"><strong>Text Box</strong></p>
                                <?php echo CHtml::checkBoxList(
                                    'defaultQuestions',
                                    '',
                                    CHtml::listData($defaultQuetxt,'id','question'));
                                ?>
                            <?php } ?>
                        </div>
                        <?php echo CHtml::submitButton('Add questions to your course ',array('class'=>'save-btn')); ?>
                    <?php }
                    else { ?>
                        <h1>No Default Question found</h1>
                    <?php } ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/css/bootstrap-datetimepicker.css">
<script src="<?=Yii::app()->request->baseUrl?>/js/moment.min.js"></script>
<script src="<?=Yii::app()->request->baseUrl?>/js/bootstrap-datetimepicker.js"></script>
<style>
    #defaultQuestions input{
        width:auto;
        float:left;
        margin-right:5px;
    }
    .summary
    {
        text-align:left !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="text"]').attr('autocomplete','off');
        $('.datepickerp').datetimepicker({format: 'DD-MM-YYYY HH:mm'});

    });
    function ConfirmDelete(id,type,course)

    {

        if(type==1)
        {
            var x = confirm("Are you sure you want to delete assessment?");
            var url='<?php echo Yii::app()->createUrl('site/deletecourseitems') ?>';
        }
        else if(type==2)
        {
            var x = confirm("Are you sure you want to delete the question?");
            var url='<?php echo Yii::app()->createUrl('site/deleteque',array('c'=>$_GET['c'])) ?>';
        }
        else if(type==3)
        {
            var x = confirm("Are you sure you want to delete user?");
            var url='<?php echo Yii::app()->createUrl('site/deleteuser') ?>';
        }
        else if(type==4)
        {
            var x = confirm("Are you sure you want to delete this group?");
            var url='<?php echo Yii::app()->createUrl('site/deletegroup') ?>';
        }

        if (x)
        {
            $.ajax({
                url:url,
                type: 'post',
                data: {'id': id,'course': course},
                success: function (data) {
                    if(type==1)
                    {
                        window.location.reload();
                        $.notify("Assesment deleted succesfully", "success");
                    }
                    else if(type==2)
                    {
                        $("#qrow_"+id).remove();
                        $.notify("Question deleted succesfully", "success");
                        window.location.reload();
                    }
                    else if(type==3)
                    {
                        $("#urow_"+id).remove();
                        $.notify("User deleted succesfully", "success");
                    }
                    else if(type==4)
                    {
                        $("#groups_"+id).remove();
                        $.notify("Group deleted succesfully", "success");
                    }
                }
            });
        }
        else
        {
            return false;
        }
    }

    function mailprocess(c,i,f,p)
    {
        $("#loading").show();
        var data={course:c,inst:i,fac:f,asses:p};
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('users/mailprocess') ?>",
            type: "post",
            data:data,
            success: function (result) {
                if(result.trim() =='Y')
                {
                    $("#loading").hide();
                    window.location.reload();
                }
            }
        });
    }
    function sendremainder(c,i,f,p)
    {
        $("#loading").show();
        var data={course:c,inst:i,fac:f,asses:p};
        if(confirm('Are you sure want to send remainder mail?'))
        {
            $.ajax({
                url: "<?php echo Yii::app()->createUrl('groupusers/sendremainder?c=') ?>"+c,
                type: "post",
                data:data,
                success: function (result) {
                    if(result.trim() =='Y')
                    {
                        $("#loading").hide();
                        window.location.reload();
                    }
                }
            });
        }
    }
    var labelID;
    $('.test').click(function() {
        labelID = $(this).attr('for');
        $('#'+labelID).trigger('click');
    });
</script>
</section>
<div id="htmltable" style="display:none;">
</div>
<!-- Modal -->
<div id="myModalprv" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bulk Import Demo</h4>
            </div>
            <div class="modal-body">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/H93XP_QG_kA" frameborder="0" allow="accelerometer; autoplay="0"; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tabletoCSV.js"></script>
<script type="text/javascript">
    $(function () {
        $('input[type="text"]').addClass('form-control');
        $('td > input').attr('placeholder','Search');
        function download()
        {
            window.location.href='<?php echo Yii::app()->CreateUrl('users/download')?>';
        }
    });
    function filechange()
    {
        $('#bulk_import_group_users').submit();
    }

    $(document).on('click','.download',function(){

        var p=$(this).attr('data-project');
        var projectname=$(this).attr('data-projectname');
        var stustus=($(this).attr('data-status') =='completed')?'Are you sure want to download report?':'Assessment is not fully complete. Awaiting feedback from some students. Proceed to download?';
        if(confirm(stustus))
        {
            var url="<?= Yii::app()->CreateUrl('groupusers/download',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>''))?>"+p;
            $.ajax({
                url: url,
                type: "get",
                success: function (result) {
                    $("#htmltable").html(result);
                    $("#resulttable").tableToCSV(projectname);
                    return false;
                }
            });
        }
    });
</script>
<script>
    function download1()
    {
        window.location.href='<?php echo Yii::app()->CreateUrl('users/download')?>';
    }
    $('#Users_username').on('focus', function() {});
</script>
