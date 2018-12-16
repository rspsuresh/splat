<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<style>
    .staff
    {
        margin:0px !important;
    }
    .staff h6,.staff-due h6
    {
        font-size: 19px;
    }
    .staff p,.padzero p {
        font-size: 17px;

    }
    .script-texts
    {
        margin-left:10px;
    }
    .panel-heading {
        cursor: pointer;
    }
    #wrapper
    {
        height:auto !important;
    }
    .panel-heading
    {
        background-color: #f5f5f5 !important;
    }
    .panel-title
    {
        margin-left:13px;
    }
    .panel.panel-default,.panel-heading
    {
        border-radius: 15px;
    }
    .user-assessment
    {
        font-size:19px !important;
    }
    .add-course,.footer-menu li a
    {
        font-size: 17px !important;
    }
    .fa.pull-right
    {
        margin-right:.3em !important ;
    }
</style>
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="<?= Yii::app()->CreateUrl('site/index')?>">Home </a> <b>/</b>
                <a href="#"><?php echo ucfirst($projects->name); ?></a></p>
        </div>
    </div>
    <?php //print_r($projects);die;?>
    <div class="container-fluid user-assessment">
        <p><?php echo ucfirst($projects->name); ?></p>
    </div>
    <div class="container">
        <!--<div class="user-description col-lg-12 padzero">
			<h6>Description</h6>
			<p><?php echo $projects->description; ?></p>
		</div>-->
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero user-staff">
            <?php $columndecide=Multipleassesment::model()->findAll("prj_id=".$_GET['id']." and status='A'");
            $column=(count($columndecide)>0)?'4':'6';
            ?>
            <div class="col-lg-<?=$column?> col-xs-12 col-sm-4 padzero">
                <!--<div class="staff">
					<h6>Staff</h6>
					<p><?php echo ucfirst($projects->faculty0->name); ?></p>
				</div>-->
                <div class="staff">
                    <h6>Description</h6>
                    <p id="projectname"><?php echo $projects->description; ?></p>
                </div>
                <div class="staff">
                    <h6>Course</h6>
                    <p><?php echo ucfirst($projects->course0->name); ?></p>
                </div>
                <!--<div class="staff">
					<h6>Assessment Settings</h6>
					<p><?php echo ucfirst($projects->faculty0->name); ?></p>
				</div>-->
                <?php
                $assescheck=Multipleassesment::model()->findAll("prj_id=".$_GET['id']." and status='A'");
                $showresponse=(count($assescheck)==1)?"block":"none";
                if(count($assescheck)==1) { ?>
                    <div class="staff">
                        <h6>Assessment Due date:</h6>
                        <p><?php echo date('d-m-Y',strtotime($assescheck[0]['due_date'])) ?></p>
                    </div>
                <?php }
                else {?>
                    <div class="staff">
                        <p style="color:red">Assessment not created yet or More than one assessment is active</p>
                    </div>
                <?php  }?>
            </div>
            <?php
            $prj="SELECT group_concat(group_id) as grp  FROM `project_groups` WHERE `project_id` =".$_GET['id'];
            $prjresult=Yii::app()->db->CreateCommand($prj)->QueryAll();
            $grpstr=$prjresult[0]['grp'];
            $grpfind="SELECT A.`group_id`,B.`name` FROM `group_users` as A
            left join `groups` as B on A.`group_id`=B.`id`
            WHERE A.`group_id` IN ($grpstr) and A.`user_id`=".Yii::app()->user->id;
            $grpresult=Yii::app()->db->CreateCommand($grpfind)->QueryAll();
            $usergroup = GroupUsers::model()->find('user_id='.Yii::app()->user->id);
            $groupusers = array();
            if(count($grpresult)>0)
                $groupusers = GroupUsers::model()->with('user')->findAll('group_id='.$grpresult[0]['group_id'].' and user.status="active" ');
            ?>
            <?php
            $assescheck=Multipleassesment::model()->findAll("prj_id=".$_GET['id']." and status='A'");
            //echo "<pre>";print_r(count($assescheck));die;
            ?>
            <div class="col-lg-<?=$column?> col-xs-12 col-sm-4 staff-due well"  >
                <h6>Your Group : <?=$groupusers[0]->groups->name?></h6>
                <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                    <?php
                    if(count($groupusers)>0  && count($assescheck) >0 ) {
                        foreach($groupusers as $groupuser) {
                            $iquestions = Questions::model()->count('course='.$projects->course);
                            $iassess = Assess::model()->count('project='.$projects->id.' and
                             from_user='.Yii::app()->user->id.' and to_user='.$groupuser->user_id.' 
                             and grp_id='.$groupuser->group_id.' 
                              and asses_id='.$assescheck[0]['id'].' and to_user !='.Yii::app()->user->id);
                            // $icomments = AssessComments::model()->count('project='.$projects->id.' and from_user='.Yii::app()->user->id.' and to_user='.$groupuser->user_id);
                            //echo $iassess;
                            if($iassess >0)
                            {
                                $class = 'fa fa-check';
                                $style="font-size:20px;background:green;color:white;display:none;";
                            }
                            else
                            {
                                $class = 'fa-check-square';
                                $style="font-size:20px;color:red;display:none;";
                            }

                            ?>

                            <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                                <div class="col-lg-8 col-xs-10 col-sm-8 padzero">
                                    <?php if($groupuser->user_id != Yii::app()->user->id) { ?>
                                    <p><?php echo ucwords($groupuser->user->first_name." ".$groupuser->user->last_name); ?>
                                        <?php } else { ?>
                                    <p style="color:grey"><?php echo ucwords($groupuser->user->first_name." ".$groupuser->user->last_name); ?>
                                        <?php } ?>
                                </div>
                                <div class="col-lg-3 col-xs-2 col-sm-3 padzero">
                                    <p><i class="fas <?php echo $class;?>" style="<?=$style?>" aria-hidden="true"></i></p>
                                </div>
                            </div>
                        <?php } } else { ?>
                        <?php
                        if(count($groupusers) >0) {
                            foreach($groupusers as $groupuser) { ?>
                                <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                                    <div class="col-lg-8 col-xs-10 col-sm-8 padzero">
                                        <?php if($groupuser->user_id != Yii::app()->user->id) { ?>
                                        <p><?php echo ucwords($groupuser->user->first_name." ".$groupuser->user->last_name); ?>
                                            <?php } else { ?>
                                        <p style="color:grey"><?php echo ucwords($groupuser->user->first_name." ".$groupuser->user->last_name); ?>
                                            <?php } ?>
                                    </div>
                                    <div class="col-lg-3 col-xs-2 col-sm-3 padzero">
                                        <p><i class="fas <?php echo $class;?>" style="<?=$style?>" aria-hidden="true"></i></p>
                                    </div>
                                </div>
                            <?php } } else {  ?>
                            <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                                <div class="col-lg-6 col-xs-6 col-sm-6 padzero">
                                    <p>No users assigned.</p>
                                </div>
                            </div>
                        <?php } }?>
                    <?php
                    $grpidb=($grpresult[0]['group_id'])?$grpresult[0]['group_id']:0;
                    $checkiassess = Assess::model()->count('project='.$projects->id.' 
                             and grp_id='.$grpidb.' and from_user='.Yii::app()->user->id);
                    ?>
                    <?php
                    $activeass=$assescheck[0]['id'];
                    if(count($assescheck)==1 && $checkiassess==0 ) {
                        ?>
                        <a href="<?php echo Yii::app()->createUrl('site/assessment',
                            array('id'=>$projects->id,'g'=>$grpresult[0]['group_id'],'asm'=>$assescheck[0]['id'])); ?>"
                           class="add-course pull-left">Assess</a>
                    <?php  } ?>

                </div>
            </div>
            <?php if(count($assescheck)>0) { ?>
            <div class="col-lg-3 col-xs-12 col-sm-4 staff-due" style="display:<?=$showresponse?>">
                <h6>View your responses</h6>
                <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                    <?php $assesall=Multipleassesment::model()->findAll("prj_id=".$_GET['id']." and (status='A' or status='C')");?>
                    <?php foreach($assesall as $key=>$val){
                        $badge=($val->status=="A")?"primary":"danger";
                        $courseid=base64_encode($projects->course);
                        $facultyid=base64_encode($projects->faculty);
                        $insid=base64_encode($projects->institution);
                        $projectsid=base64_encode($projects->id);
                        $assmnt=$val->id;
                        $userid=Yii::app()->user->id;
                        $action=Yii::app()->CreateUrl('site/assesmentresponse',array('id'=>$projects->id,
                            'u'=>$userid,'c'=>$courseid,'g'=>$grpresult[0]['group_id'],'as'=>$val->id,'key'=>$key+1));

                        $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
                                   FROM `delete_custom_question` WHERE `course_id` =$projects->course";
                        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
                        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';
                        $questions=Questions::model()->findAll('institution='.$projects->institution.'
                        and faculty='.$projects->faculty.'
                         and course='.$projects->course.' and status="active" and id NOT IN ('.$ids.') 
                         or ( type="default" and id NOT IN ('.$ids.'))');
                        ?>
                        <div class="col-lg-12 col-xs-12 col-sm-12 padzero" style="margin:5px;">
                            <?php $assexists=Assess::model()->findByAttributes(array("asses_id"=>$val->id));
                            if($assexists) { ?>
                                <a href="<?php echo $action ?>"  style="color:white !important;">
                                    <button type="button" class="btn btn-<?=$badge?>">Assessment -<?= ($key+1)?></button>
                                </a>
                            <?php }
                            else { ?>
                                <a href="<?php echo $action ?>"  style="color:white !important;"><button type="button" class="btn btn-<?=$badge?>">
                                        Assessment -<?= ($key+1)?>
                                    </button>
                                </a>
                            <?php } ?>
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero" style="display:<?=$showresponse?>">
            <h1 class="text-center response"><span id="rmd"></span> </h1>
            <div class="bs-example">
                <div class="panel-group" id="faqAccordion">
                    <?php
                    if(count($groupusers)>0):
                        $u = 0;
                        foreach($groupusers as$key=>$groupuser):
                            $u++;
                            ?>
                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle question-toggle collapsed"
                                     data-toggle="collapse" data-parent="#faqAccordion"
                                     data-target="#question_<?php echo $groupuser->id;?>" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a href="#" class="ing">
                                            <?php
                                            if($groupuser->user_id==Yii::app()->user->id)
                                                echo 'Self Assessment';
                                            else
                                                // echo 'From anonymous user'.ucwords($groupuser->user->first_name." ".$groupuser->user->last_name);
                                                echo 'From anonymous user';
                                            ?>

                                        </a>
                                    </h4>
                                </div>
                                <div id="question_<?php echo $groupuser->id;?>" class="panel-collapse collapse"
                                     aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="script-texts">
                                            <?php
                                            $iquestions = Questions::model()->findAll('course='.$projects->course);
                                            /*$icomments = AssessComments::model()->find('project='.$projects->id.'
                                             and from_user='.$groupuser->user_id.' 
                                            and to_user='.Yii::app()->user->id.' and asses_id='.$activeass);*/

                                            $i=0;
                                            foreach($questions as $iquestion):
                                                $i++;
                                                $iassess = Assess::model()->find('project='.$projects->id.' 
                                                and from_user='.$groupuser->user_id.' 
                                                and to_user='.Yii::app()->user->id.' and question='.$iquestion->id.' 
                                                and asses_id='.$activeass);
                                                ?>
                                                <p class="m-t-10"><?php echo $i;?>. <?php echo $iquestion->question;?> : <b><?php if(count($iassess)>0) echo $iassess->value; else echo '-'; ?></b></p>
                                                <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; else: ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <p>No assessment yet.</p>
                                </h4>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    </div>
</section>
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
                    'id'=>'group-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                ));
                $gmodel->group_id = $grpresult[0]['group_id'];
                ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($gmodel,'user_id'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->dropDownList($gmodel, 'user_id', CHtml::listData(Users::model()->findAll('role="5" and status="active"'), 'id', 'first_name'), array('empty'=>'Select User')); ?>

                        <?php echo $form->error($gmodel,'user_id'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($gmodel,'group_id'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->dropDownList($gmodel, 'group_id', CHtml::listData(Groups::model()->findAll('status!="inactive"'), 'id', 'name'), array('empty'=>'Select Group')); ?>
                        <?php echo $form->error($gmodel,'group_id'); ?>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function assesment(id)
    {
        alert("Assessment not started yet.please try after some time");
    }
    function ConfirmDelete(id,group)
    {
        var x = confirm("Are you sure you want to leave from group?");
        var url='<?php echo Yii::app()->createUrl('site/leavegroup') ?>';
        if (x)
        {
            $.ajax({
                url:url,
                type: 'post',
                data: {'id': id, 'group': group},
                success: function (data) {
                    window.location.href='<?php echo Yii::app()->createUrl('site/index') ?>';
                }
            });
        }
        else
        {
            return false;
        }
    }
    $( document ).ready(function() {
        console.log( "ready!" );
        var prjname=$("#projectname").text();
        var assm=$(".btn-primary").text();
        //var cms="Assesment for "+prjname+"("+assm+")";
        var cms="View your responses for "+prjname+"("+assm+")";
        $("#rmd").text(cms);
    });
</script>