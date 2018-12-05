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
</style>
<section id="wrapper" style="height:auto !important">
    <div class="container">
        <div class="admin-home user-ass">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index');?>">Projects</a> /
                <a href="<?php echo Yii::app()->createUrl('site/projects',array('id'=>$projects->id));?>"><?php echo $projects->name;?></a> / <a href="javascritp:void(0);">Assessment</a></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p><?=$projects->name?>  (Assessment  <?=$_GET['id']?>)</p>
    </div>
    <?php $assement=Multipleassesment::model()->find("prj_id=".$projects->id." and status='A'");?>
    <div class="container">
        <form method="POST" id="assesmentsubmit">
            <input type="hidden" value="<?=$assement->id?>" name="assesmentid">
            <?php
            $groupusers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
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
                                 and to_user=:t',array(':q'=>$question->id,':p'=>$projects->id,':f'=>Yii::app()->user->id,':t'=>$groupuser->user_id));
                                ?>
                                <p class="selp-pad">
                                    <label>
                                        <?php if(Yii::app()->user->id == $groupuser->user_id)
                                            echo 'Self';
                                        else
                                            echo ucfirst($groupuser->user->first_name);
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
            <input type="submit" class="add-course" value="Save"> <div style="clear:both;"></div><br/>
            <!--<div class="comments">
                <label>Comments</label>
                <br/>
                <?php
                if(count($groupusers)>0):
                    foreach($groupusers as $groupuser):
                        $comments = AssessComments::model()->find('project=:p and from_user=:f and to_user=:t',array(':p'=>$projects->id,':f'=>Yii::app()->user->id,':t'=>$groupuser->user_id));
                        ?>
                        <label class="text-label">About
                            <?php if(Yii::app()->user->id == $groupuser->user_id)
                                echo 'me';
                            else
                                echo ucfirst($groupuser->user->first_name);
                            ?>
                        </label>
                        <textarea class="text-field" name="comments[<?php echo $groupuser->user_id; ?>]"><?php if(count($comments)>0) echo trim($comments->comments);?></textarea>
                    <?php endforeach;
                else:
                    ?>
                    <label class="text-label">No users assigned to project.</label>
                <?php endif;?>
                <input type="submit" class="add-course" value="Save"> <div style="clear:both;"></div><br/>
            </div>-->
        </form>
    </div>
</section>
<script>
    $( document ).ready(function() {
        $("#assesmentsubmit").submit(function(e){
            //e.preventDefault();
            if(confirm("Once response is submitted it should not be edited again.Are you sure you want to mark this as completed? Once saved, the responses cannot be edited."))
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    });
</script>