
<style>
    footer
    {
        position:absolute;
        bottom:0;
        width:100%;
        height:100px;
    }
    .script-texts p {
        font-size:16px
    }
    .panel-title
    {
        margin-left:13px;
        font-size:17px !important;
    }
    #wrapper
    {
        height:auto !important;
    }
    .fa.pull-right
    {
        margin-right:.3em !important ;
    }
    .footer-menu li a
    {
        font-size: 17px !important;
    }
</style>
<?php
$usergroup = GroupUsers::model()->find('user_id='.Yii::app()->user->id);
$groupusers = array();
if(count($usergroup)>0)
    $groupusers = GroupUsers::model()->findAll('group_id='.$usergroup->group_id);
?>
<section id="wrapper" >
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero" style="display:<?=$showresponse?>">
            <h1 class="text-center response">Responses</h1>
            <div class="bs-example">
                <div class="panel-group" id="accordion">
                    <?php
                    if(count($groupusers)>0):
                        $u = 0;
                        foreach($groupusers as $groupuser):
                            $u++;
                            ?>

                            <div class="panel" >
                                <div class="panel-heading" style="background-color: #f5f5f5 !important;">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?php echo $groupuser->id;?>">
                                            <?php
                                            if($groupuser->user_id==Yii::app()->user->id)
                                                echo 'Self Assessment';
                                            else
                                                echo 'To '.$groupuser->user->first_name;
                                            ?>
                                            <i class="fa fa-angle-down pull-right blue-clr" aria-hidden="true"></i></a>
                                    </h4>
                                </div>
                                <div id="collapseOne_<?php echo $groupuser->id;?>" class="panel-collapse collapse <?php if($u==1) echo 'in'; ?>">
                                    <div class="panel-body">
                                        <div class="script-texts">
                                            <?php
                                            $iquestions = Questions::model()->findAll('course='.$projects->course);
                                            $icomments = AssessComments::model()->find('project='.$projects->id.'
                                             and to_user='.$groupuser->user_id.' and from_user='.Yii::app()->user->id.' and asses_id='.$_GET['as']);

                                            $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
                                              FROM `delete_custom_question` WHERE `course_id` =$projects->course";
                                            $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
                                            $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';
                                            $questions=Questions::model()->findAll('institution='.$projects->institution.'
                                                           and faculty='.$projects->faculty.'
                                                           and course='.$projects->course.' and status="active" and id NOT IN ('.$ids.') 
                                                        or ( type="default" and id NOT IN ('.$ids.'))');
                                            $i=0;
                                            foreach($questions as $iquestion):
                                                //echo $iquestion->id.''.$institutionUser->user_id.''.Yii::app()->user->id.''.$projects->id ;
                                                $i++;
                                                $iassess = Assess::model()->find('project='.$projects->id.'
                                                 and to_user='.$groupuser->user_id.' and from_user='.Yii::app()->user->id.' and question='.$iquestion->id.' and asses_id='.$_GET['as']);
                                                //print_r($iassess);
                                                ?>
                                                <p class="m-t-10"><?php echo $i;?>. <?php echo $iquestion->question;?> :<b><?php if(count($iassess)>0) echo $iassess->value; else echo '-'; ?></b></p>
                                                <?php
                                            endforeach;
                                            ?>
                                            <div class="m-t-10">
                                                <p>Comments:</p>
                                                <p class="cmt-color"><?php if(count($icomments)>0) echo $icomments->comments; else echo '-';?></p>
                                            </div>
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
    </div>
</section>