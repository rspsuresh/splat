<style>
    .text-label
    {
        margin:0px !important;
    }
    .add-course
    {
        font-size: 18px !important;
    }
    .user-assessment
    {
        font-size:20px !important;
    }
    .user-form p {
        font-size: 17px !important;
    }
    .comments label
    {
        font-size: 17px !important;
    }
    .footer-menu li a
    {
        font-size: 17px !important;
    }
    .btn-infomy {
        color: #fff;
        background-color:#212323;
    }
    .btn-infomy:hover
    {
        text-decoration:none;
    }
</style>
<section id="wrapper" style="height:auto !important;margin-top:5px;">
    <?php $course=Courses::model()->findByPk($_GET['course']);
    $assesmentdetails=Projects::model()->findByPk($_GET['id'])?>
    <div class="container-fluid user-assessment">
        <div class="col-lg-4" style="text-align: left">
            <a href="#"  onclick="window.history.back()" class="btn btn-infomy btn-lg">
                <span class="glyphicon glyphicon-arrow-left"></span>
            </a>
        </div>
        <div class="col-lg-4">
            <p>Course - <?=$course->name?></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 style="color:#00BACF">Description</h3>
            </div>
            <div class="col-lg-12">
                <h4><?=$assesmentdetails->description?></h4>
            </div>
        </div>
        <div class="row">
            <h2 style="color:#00BACF;text-align: center;">Assessment - <?=$assesmentdetails->name?></h2>
        </div>
        <form method="POST" id="assesmentsubmit">
            <input type="hidden" value="<?=$_GET['id']?>" name="assesmentid">
            <h3>Please provide feedback for the below questions.</h3>
            <?php
            $groupusers = Userdetails::model()->with('user')->findAll('grp_id='.$_GET['g'].' and user.status="active"');
            // echo "<pre>";print_r(array_column($groupusers,'user_id'));die;
            $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
                                              FROM `delete_custom_question` WHERE `course_id` =$projects->course";
            $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
            $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';

            $questions=Questions::model()->findAll('course='.$projects->course.' and status="active" or type="default" and id NOT IN ('.$ids.')');
            // $questions=Questions::model()->findAll('institution='.$projects->institution.'
            //                                                and faculty='.$projects->faculty.'
            //                                                and course='.$projects->course.' and status="active" and id NOT IN ('.$ids.')');
            if(count($questions)>0):
                $i=0;
                foreach($questions as $question):
                    $i++;
                    ?>
                    <div class="user-form">
                        <p style="font-weight:bold; ">
                            <?php echo $i;?>.<?php echo $question->question; ?>
                        </p>
                        <?php
                        if(count($groupusers)>0):
                            foreach($groupusers as $groupuser):
                                $assess = Assess::model()->find('question=:q and project=:p and from_user=:f
                                 and to_user=:t and  grp_id=:grp',array(':q'=>$question->id,
                                    ':p'=>$projects->id,
                                    ':f'=>Yii::app()->user->id,
                                    ':t'=>$groupuser->user_id,':grp'=>$_GET['g']));
                                ?>
                                <?php if($groupuser->user->status =="active") { ?>
                                <p class="selp-pad">
                                    <label>
                                        <?php if(Yii::app()->user->id == $groupuser->user_id)
                                            echo 'Self';
                                        else
                                            echo ucfirst($groupuser->user->first_name." ".$groupuser->user->last_name);
                                        ?>
                                    </label>
                                    <?php  if($question->q_type =="R") { ?>
                                        <select  style="width:70px !important;" name="assess[<?php echo $question->id;?>][<?php echo $groupuser->user_id; ?>]">
                                            <?php for($j=1;$j<=10;$j++) {
                                                $selected = "";
                                                if(count($assess)>0){
                                                    if($j==$assess->value)
                                                        $selected = "selected";
                                                }
                                                ?>
                                                <option value="<?php echo $j;?>" <?php echo $selected; ?>>
                                                    <?php echo $j;?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>

                                        <textarea name="assess[<?php echo $question->id;?>][<?php echo $groupuser->user_id; ?>]"><?=$assess->value ?></textarea>

                                    <?php } ?>
                                </p>

                            <?php } ?>
                            <?php endforeach; else: ?>
                            <p class="selp-pad">
                                <label>No users assigned to project.</label>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; else:?>
                <div class="user-form">
                    <p>No questions assigned yet.</p>
                </div>
            <?php endif;?>
            <?php
            $prjid=$_GET['id'];
            $assess = Assess::model()->find('project=:p and from_user=:f and to_user=:t and grp_id=:grp',
                array(':p'=>$prjid,':f'=>Yii::app()->user->id,':t'=>Yii::app()->user->id,':grp'=>$_GET['g']));?>
            <?php if(count($assess) ==0) { ?>
                <input type="submit" class="add-course" value="Submit"> <div style="clear:both;"></div><br/>
            <?php } ?>
        </form>
    </div>
</section>
<script>
    $(document).ready(function() {
        $("#assesmentsubmit").submit(function(e){
            if(confirm("The responses submitted are permanent are cannot be edited and submitted again. Are you sure want to submit your response ?"))
            {
                return true;
            }
            else
            {
                return false;
            }
            $('input[type="submit"]').hide();
        });
    });
</script>