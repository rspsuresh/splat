<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jqueryui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/jqueryui/jquery-ui.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/datetimepicker/datetimepicker.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/datetimepicker/datetimepicker.css">
<style>
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
    .fa
    {
        font-size:25px !important;
    }
    .m-projects-user
    {
        color: #00B9CF;
        font-size: 30px;
        text-align: left;
        margin-top: 0px;

    }
    table th{
        color:white;
    }
    table thead{
        background-color: #00B9D1 !important;
    }

</style>
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> / <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>"><?php echo ucfirst($faculty->name);?></a> / <b><?php echo ucfirst($course->name); ?></b></p>
            <?php }
            else { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> / <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>"><?php echo ucfirst($faculty->name);?></a> / <b><?php echo ucfirst($course->name); ?></b></p>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Course Items</p>
    </div>
    <!-- <div class="admin-manage col-lg-12 col-xs-12 col-sm-12 padzero">-->
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <div  class="mydiv">
            <h1 class="center m-projects">Manage users</h1>
            <div class="col-lg-12 col-xs-12 col-sm-12 m-t-10 padzero">
                <div class="col-lg-12 col-xs-12 col-sm-6 padzero">
                    <p class="row-inactive">
                        <span class="glyphicon glyphicon-info-sign" style="color:#337ab7 !important;"></span>
                        <span style="color:red">First thing first,add students to the course.</span>
                       </p>
                    <h4><b>Recently added Users</b></h4>
                    <!--<hr style="border:1px solid #9F9F9F !important">-->
                    <?php
                    $UserCourses = UserCourses::model()->with('user')->findAll(array('condition'=>'t.course_id='.base64_decode($_GET['c']).' 
                and user.role="5" and user.status="active"','limit'=>5,'order'=>'t.ID DESC'));
                    $i=0;
                    if(count($UserCourses)>0):

                        echo ' <table class="table">
                                <thead>
                                <tr>
                                    <th>Firstname /LastName</th>
                                    <th>UserName</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>';
                        foreach($UserCourses as $imodels):
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo ucwords($imodels->user->first_name.' '.$imodels->user->last_name); ?></td>
                                <td><?php echo $imodels->user->username; ?></td>
                                <td><i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $imodels->user->id  ?>',3,'<?php echo $imodels->course_id;?>')"></i></td>
                            </tr>

                            <!-- <div class="col-lg-12 col-xs-12 col-sm-12 padzero script-text" style="border-bottom:1px solid #eee !important; " id="urow_<?php /*echo $imodels->user->id  */?>">
                                <div class="col-lg-5 col-xs-5 col-sm-5 current-status padzero">
                                    <p><?php /*echo ucwords($imodels->user->first_name.' '.$imodels->user->last_name); */?></p>
                                </div>
                                <div class="col-lg-5 col-xs-5 col-sm-5 current-status padzero">
                                    <p><?php /*echo $imodels->user->username; */?></p>
                                </div>

                                <div class="col-lg-2 col-xs-2 col-sm-2 padzero current-fa text-right">
                                    <p><i class="fa fa-trash" onclick="ConfirmDelete('<?php /*echo $imodels->user->id  */?>',3,'<?php /*echo $imodels->course_id;*/?>')"></i></p>
                                </div>

                            </div>-->
                        <?php
                        endforeach;
                        echo '</tbody></table>';
                        ?>
                    <?php else: ?>
                        <div class="script-text">
                            <h1>No Users assigned to course.</h1>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php  //$this->endWidget();?>
                    <a href="<?php echo Yii::app()->createUrl('users/cadmin',array('c'=>$_GET['c'],
                        'i'=>$_GET['i'],'f'=>$_GET['f'])); ?>" class="add-course" style="margin-right:10px;">Manage Course Users</a>
                    <?php //} ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="admin-manage col-lg-12 col-xs-12 col-sm-12 padzero">-->
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <div  class="mydiv">
            <h1 class="center m-projects">Manage Projects</h1>
            <p class="row-inactive">
                <span class="glyphicon glyphicon-info-sign" style="color:#337ab7 !important;"></span>
                <span style="color:red">Projects can be created here and students can be grouped inside the project.A project can have multiple assessments points set while creation.</span>
            </p>
            <?php
            $i=0;
            if(count($model)>0):
                echo ' <table class="table">
                                <thead>
                                <tr>
                                    <th>Assessments</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>';
                foreach($model as $models):
                    $i++;
                    ?>
                    <tr>
                        <td><a href="javascript:void(0);" style="color:#000000;"><?php echo ucfirst($models->name);?></a></td>
                        <td><?php echo ucfirst($models->status);?></td>
                        <td>
                            <p>
                                <a href="<?php echo Yii::app()->createUrl('groupusers/projectgroups',
                                    array('id'=>$models->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$models->id));?>"
                                   title="Groups & Assessment"><i class="fa fa-users"></i>
                                </a>&nbsp;
                                <a href="javascript:void(0)">
                                    <i class="fa fa-cog" title="edit settings" data-toggle="modal" data-target="#courseModal_<?php echo $models->id; ?>"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-trash" title="delete" onclick="ConfirmDelete('<?php echo $models->id?>',1,'')"></i>
                                </a>
                            </p>
                        </td>
                    </tr>

                    <div class="modal fade" id="courseModal_<?php echo $models->id;?>" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                <div class="modal-header col-lg-12">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Projects</h4>
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
                                            <?php echo $form->radioButtonList($models,'status', array('current'=>'Current','archieved'=>'Archived'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                            <?php echo $form->error($models,'status'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-offset-8 col-lg-4 text-right">
                                        <span onclick="appenddateupdate()" class="badge badge-primary">Add</span>
                                    </div>
                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero appenddate apdedit">

                                        <?php
                                        $assmnt=Multipleassesment::model()->findAll("prj_id=".$models->id);?>
                                        <?php  if(count($assmnt)>0) {
                                            foreach($assmnt as $key =>$val){ ?>
                                                <div class="col-lg-4 padzero countclass">
                                                    <b>Assessment <?=$key+1?> due date</b>
                                                </div>

                                                <div class="col-lg-8 padzero">
                                                    <input class="edit"  name="multipleassesment_<?=$val->id?>"
                                                           value="<?=date('d-m-Y H:i',strtotime($val->due_date))?>" type="text">
                                                </div>
                                            <?php } } ?>
                                        <div class="col-lg-4 padzero countclass">
                                            <b>Assessment <?=count($assmnt)+1?> due date</b>
                                        </div>
                                        <div class="col-lg-8 padzero">
                                            <input class="edit" name="multipleassesment[]" type="text">
                                        </div>
                                        <input type="hidden" id="numberofrows" value="<?=count($assmnt)+1?>" name="nameofrows">
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
                    <h1>No projects created yet.</h1>
                </div>
            <?php endif; ?>
            <input type="button" value="Add a Project" class="add-course" data-toggle="modal" data-target="#projectModal">
        </div>
    </div>
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <div class="mydiv">
            <h1 class="center m-projects">Manage Questionnaire</h1>
            <p><span style="color:red;"><a href="#">
          <span class="glyphicon glyphicon-info-sign"></span>
        </a>Please select or create questions to be peer assessed by students.</a></span></p>
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
                    <i class="fa fa-cog" data-toggle="modal" data-target="#questionModal_<?php echo $iquestion->id; ?>"></i>
                    </span>
                        </td>
                    </tr>

                    <!-- <div class="script-text" id="qrow_<?php /*echo $iquestion->id; */?>">
                        <h1><a href="javascript:void(0);" class="item_link"><?php /*echo $i; */?>. <?php /*echo ucfirst($iquestion->question); */?></a>

                            <span class="pull-right">
			<i class="fa fa-trash" onclick="ConfirmDelete('<?php /*echo $iquestion->id */?>',2,'')"></i>
			<i class="fa fa-cog" data-toggle="modal" data-target="#questionModal_<?php /*echo $iquestion->id; */?>"></i>
			</span>
                    </div>-->
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
                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                        <div class="col-lg-4 padzero">
                                            <?php echo $form->labelEx($iquestion,'type'); ?>
                                        </div>
                                        <div class="col-lg-8 padzero formradio">
                                            <?php echo $form->radioButtonList($iquestion,'type', array('default'=>'Default','custom'=>'Custom'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                            <?php echo $form->error($iquestion,'type'); ?>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                    <div class="col-lg-4 padzero">
                                        <?php echo $form->labelEx($iquestion,'status'); ?>
                                    </div>
                                    <div class="col-lg-8 padzero formradio">
                                        <?php echo $form->radioButtonList($iquestion,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                        <?php echo $form->error($iquestion,'status'); ?>
                                    </div>
                                </div>-->
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
                <div class="script-text">
                    <h1>No questions selected for display.</h1>
                </div>
            <?php endif; ?>
            <?php  //if(Yii::app()->user->getState('role')=='Superuser'){ ?>
            &nbsp;&nbsp;<input type="button" value="Create a custom question" class="add-course" data-toggle="modal" data-target="#questionModal">
            <input type="button" value="Select default Question" class="add-course" data-toggle="modal" data-target="#dquestionModal" style="margin-right:10px;">
            <?php //}?>
        </div>
    </div>
</section>
<!-- model -->
<div class="modal fade" id="projectModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Project</h4>
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
                <div class="col-lg-offset-8 col-lg-4 text-right">
                    <span onclick="appenddate()" class="badge badge-primary">Add</span>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero appenddate appendinsert ">
                    <div class="col-lg-4 padzero countclass">
                        <b>Assessment 1 due date</b>
                    </div>
                    <div class="col-lg-8 padzero">
                        <input class="datepicker"   name="multipleassesment[]"  required type="text">
                    </div>
                </div>
                <input type="hidden" id="inshidden" value="1" name="inshidden">
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
                <h4 class="modal-title text-center">Questions  &rarr;  Create a custom question</h4>
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
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($questions,'type'); ?>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php echo $form->radioButtonList($questions,'type', array('default'=>'Default','custom'=>'Custom'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                        <?php echo $form->error($questions,'type'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($questions,'q_type'); ?>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php echo $form->radioButtonList($questions,'q_type', array('R'=>'Rating Scale','S'=>'Text'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                        <?php echo $form->error($questions,'q_type'); ?>
                    </div>
                </div>
                <!--<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($questions,'status'); ?>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php echo $form->radioButtonList($questions,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                        <?php echo $form->error($questions,'status'); ?>
                    </div>
                </div>-->
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
                <h4 class="modal-title text-center">Default Questions</h4>
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
                    $defaultQue=Questions::model()->findAll("type='default' and status='active'");

                    if(count($defaultQue) > 0) { ?>

                        <div class="col-lg-12 padzero">
                            <h3 class="text-center">Select from default</h3>
                        </div>
                        <div class="col-lg-12 padzero">

                            <?php echo CHtml::checkBoxList(
                                'defaultQuestions',
                                '',
                                CHtml::listData($defaultQue,'id','question'));
                            ?>
                        </div>
                    <?php }
                    else { ?>
                        <h1>No Default Question found</h1>
                    <?php } ?>
                </div>
                <?php echo CHtml::submitButton('Add',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<!-- model -->
<div class="modal fade" id="groupModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add Group to Projects</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'project-form1',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($pmodel,'project_id'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->dropDownList($pmodel, 'project_id', CHtml::listData(Projects::model()->findAll('faculty='.base64_decode($_GET['c'])), 'id', 'name'), array('empty'=>'Select Group')); ?>
                        <?php echo $form->error($pmodel,'project_id'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($pmodel,'group_id'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->dropDownList($pmodel, 'group_id', CHtml::listData(Groups::model()->findAll('status!="inactive"'), 'id', 'name'), array('empty'=>'Select Group')); ?>
                        <?php echo $form->error($pmodel,'group_id'); ?>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
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
    function alternate(id)
    {
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('site/assesmentchange') ?>",
            type: "post",
            data:{asses:id},
            success: function (result) {
                var data=JSON.parse(result);
                if(data.status=='A' || data.status=='I')
                {
                    $.fn.yiiGridView.update('multipleassesment-grid');
                    $.notify("Status changed succesfully", "success");
                }
                else if(data.status=='E') {
                    $.fn.yiiGridView.update('multipleassesment-grid');
                    $.notify("Already assessment is progess.please try after some time", "warning");                }
            }
        });

    }
    $(document).ready(function(){
        $('input').attr('autocomplete','off');
        $("td:empty").remove();
        /*$(".datepicker").inputmask("datetime",{
            mask: "y-2-1 h:s",
            placeholder: "yyyy-mm-dd hh:mm",
            leapday: "-02-29",
            separator: "-",
            alias: "yyyy-mm-dd"
        });
        $(".edit,.edit1").inputmask("datetime",{
            mask: "y-2-1 h:s",
            placeholder: "yyyy-mm-dd hh:mm",
            leapday: "-02-29",
            separator: "-",
            alias: "yyyy-mm-dd"
        });*/

        $('.appenddate > input,.edit').datetimepicker({
            inline:false,
            format: 'd-m-Y H:i',

        });

    });
    $('body').on('focus',".datepicker", function(){
        $('.appenddate input,.edit').datetimepicker({
            inline:false,
            format: 'd-m-Y H:i',
            orientation: "top" // add this

        });
    });
    function ConfirmDelete(id,type,course)

    {

        if(type==1)
        {
            var x = confirm("Are you sure you want to delete project?");
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
                        $("#row_"+id).remove();
                        $.notify("Project deleted succesfully", "success");
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
    function appenddate()
    {
        var rwcnt=parseInt($("#inshidden").val())+1;
        $(".appendinsert").append('<div class="col-lg-4 padzero">\n' +
            '            <b>Assessment '+rwcnt+' due date</b></div>\n' +
            '    <div class="col-lg-8 padzero">\n' +
            '        <input type="text"  name="multipleassesment[]" autocomplete="off" class="datepicker edit"  >\n' +
            '        </div>');

        $("#inshidden").val(rwcnt)
    }

    function appenddateupdate()
    {
        var rowcnt=parseInt($("#numberofrows").val())+1;

        $(".apdedit").append('<div class="col-lg-4 padzero">\n' +
            '            <b>Assessment '+rowcnt+' due date</b></div>\n' +
            '    <div class="col-lg-8 padzero">\n' +
            '        <input type="text"  name="multipleassesment[]" autocomplete="off" class="datepicker edit"  >\n' +
            '        </div>');
        $("#numberofrows").val(rowcnt);
    }
</script>