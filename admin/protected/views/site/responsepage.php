<style>
    .panel-body
    {
        margin:10px;
    }
    .panel-title
    {
        margin-left:5px;
    }
    .user-assessment p
    {
        font-size: 19px !important;
    }
    .ing
    {
        font-size: 17px !important;
    }
    .align{
        margin-top:5px;
        margin-right:12px;
        float:right;
    }
    .fa.pull-right
    {
        margin-right:10px !important;
    }
    .footer-sec
    {
        position: static !important;
    }
</style>

<?php
$sum=array();
$rating=[];
$meanscore='';
$avg=0;
?>
<section>
    <?php
    $facultymdel=Faculties::model()->findByPk(base64_decode($_GET['f']));
    $couesemodels=Courses::model()->findByPk(base64_decode($_GET['c']));
    $assessmodel=Projects::model()->findByPk($_GET['p']);
    $project_pk=$_GET['p'];
    $groupmodel=Groups::model()->findByPk($_GET['g']);
    ?>
    <div class="container ">
        <div class="user-institute">
            <p>You are here: <a href="/splat/admin/site/index">Home</a> /
                <a href="<?=Yii::app()->createUrl('site/faculties',array('i'=>$_GET['i']));?>">Faculties</a> /
                <a href="<?=Yii::app()->createUrl('site/faculties',array('i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id)));?>"><?=$facultymdel->name?></a> /
                <a href="<?=Yii::app()->createUrl('site/courses',array('i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id),'c'=>base64_encode($couesemodels->id)));?>"><?=$couesemodels->name?></a> /
                <a href="<?=Yii::app()->createUrl('users/cadmin',array('i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id),'c'=>base64_encode($couesemodels->id)));?>"><?=$assessmodel->name?></a> /
                <a href="<?=Yii::app()->createUrl('groupusers/groupasses',array('id'=>$_GET['id'],'i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id),'c'=>base64_encode($couesemodels->id),'p'=>$_GET['id']));?>"><?=$groupmodel->name?></a> /
                <b>Responses</b></p>
        </div>

        <button class="btn btn-primary align" onclick="goBack()">Back</button>
        <?php $cmpsql="SELECT datediff(cast(B.assess_date as DATE),CAST(A.submitted_at AS DATE)) as diff from assess as A left join projects as B on A.project=B.id and B.status !='inactive' where A.from_user={$_GET['u']} and B.id={$_GET['p']}";
        $cmpsqlresult=Yii::app()->db->createCommand($cmpsql)->queryRow();
        if(!empty($cmpsqlresult)) {
            if($cmpsqlresult['diff'] < 0)
            {
                echo "<button class=\"btn btn-danger align\">Late Submission</button>";
            }
        }?>
        <?php  if(count($questions)>0) { ?>
            <button class="btn btn-success align">Mean Score : <span id="score">
                <?php echo $meanscore?></span>
            </button>
        <?php } ?>
        <div class="user-assessment">
            <?php
            $indarray=array();
            $user=Users::model()->findByPk($_GET['u']);
            $projectsname=Projects::model()->findByPk($_GET['p']);?>
            <p><?=ucfirst($projectsname->name) .'  '. $user->first_name ." ".$user->last_name?></p>
        </div>
        <div class="panel-group" id="faqAccordion">
            <?php
            // $groupusers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
            $groupusers=Userdetails::model()->with('user')->findAll('grp_id='.$_GET['g'].' and user.status="active"');
            if(count($questions)>0){
                $i=0;
                foreach($questions as $question){
                    $i++;
                    if($question->q_type=="R")
                    {
                        $rating[]=$i;
                        $avg=$avg+1;
                    }

                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading accordion-toggle question-toggle collapsed"
                             data-toggle="collapse"  data-target="#question<?=$i?>">
                            <div class="row">
                                <div class="col-lg-1 text-right">
                                    <?=$i?>.
                                </div>
                                <div class="col-lg-8">
                                    <a href="#" class="ing">
                                        <?=  $question->question ?>
                                    </a>
                                </div>
                                <div class="col-lg-2">
                                    <?php if($question->q_type=="R")  { ?>
                                        <b style="color:red !important"  data-qtype="<?=$question->q_type?>" data-queid="<?=$i?>" class="que" id="question_<?=$i?>"></b>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-1">
                                    <i class="fa fa-angle-right pull-right blue-clr" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="usercount" value="<?= count($groupusers)?>">
                        <div id="question<?=$i?>" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <?php if(count($groupusers)>0){
                                    foreach($groupusers as $groupuser){
                                        $assess = Assess::model()->find('question=:q and project=:p and 
                                        from_user=:f and to_user=:t and grp_id=:grp',
                                            array(':q'=>$question->id,':p'=>$project_pk,':t'=>$_GET['u'],
                                                ':f'=>$groupuser->user_id,':grp'=>$_GET['g']));
                                        ?>
                                        <div class="row">
                                            <?php $stcheck=Users::model()->findByPk($groupuser->user_id);?>
                                            <?php
                                            if($stcheck->status=='active') { ?>
                                                <div class="col-lg-offset-1 col-md-offset-3 col-sm-offset-3 col-lg-3 col-md-3 col-xs-3 col-sm-3"><b>
                                                        <?php if($_GET['u'] == $groupuser->user_id)
                                                            echo 'Self';
                                                        else
                                                            echo 'By '.ucwords($groupuser->user->first_name ." ".$groupuser->user->last_name);
                                                        ?>
                                                    </b>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-xs-7 col-sm-7">
                                                    <p>:
                                                        <?php if($_GET['u'] == $groupuser->user_id) {?>
                                                            <b style="color:red;" class="answser_<?=$i?>"
                                                               data-val="<?=($assess->value)?$assess->value:'#';?>"
                                                               data-type="<?=$question->q_type?>">
                                                                <?php
                                                                if(is_numeric($assess->value) && $question->q_type=="R" )
                                                                {
                                                                    array_push($sum,$assess->value);
                                                                }
                                                                echo ($assess->value!="")?$assess->value : ' -';
                                                                ?>
                                                            </b>
                                                        <?php } else { ?>
                                                            <b class="answser_<?=$i?>"
                                                               data-val="<?=($assess->value)?$assess->value:'#';?>"
                                                               data-type="<?=$question->q_type?>"
                                                               style="color:red;">
                                                                <?php
                                                                if(is_numeric($assess->value) && $question->q_type=="R" )
                                                                {
                                                                    array_push($sum,$assess->value);
                                                                }
                                                                echo ($assess->value)?$assess->value : '-';
                                                                ?>
                                                            </b>
                                                        <?php } ?>

                                                    </p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } }
                                else { ?>
                                    <p class="selp-pad">
                                        <label>No users assigned to project.</label>
                                    </p>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php } }
            else { ?>
                <div class="user-form">
                    <p>No questions assigned yet.</p>
                </div>
                <?php
            } ?>
        </div>

        <?php
        $explode_asstring=implode(',',$rating);
        echo '<input  type="hidden" id="rating" value='.$explode_asstring.'>';
        if(count($questions)>0) {
            $meanscore = array_sum(array_filter($sum)) / $avg;
            $meanscore = number_format((float)$meanscore, 1, '.', '');
        }
        ?>
</section>
<style>
    footer
    {
        position:absolute;
        bottom:0;
        width:100%;
        height:100px;
    }
</style>
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    var sumarr=0;
    $(window).on('load', function() {
        quelength=$(".que").length;
        var array_list=document.querySelectorAll('.que');
        var rating_arr=$('#rating').val().split(',');
        for(i=0;i<=quelength;i++)
        {
            var queans=[];
            var sum=0;
            var testarr=[];
            var ques_id=rating_arr[i];
            $(".answser_"+ques_id).each(function(index, element) {
                if($(this).attr('data-val') !="#" ) {
                    testarr.push($(this).attr('data-val'));
                    sum=sum+parseInt($(this).attr('data-val'));
                    queans.push($(this).attr('data-val'));
                }
            });
            if(sum !=0)
            {
                var usercount=parseInt($(".usercount").val())-1;
                var cal=(sum/queans.length).toFixed(1);
                console.log(cal)
                $("#question_"+ques_id).text(cal);
                sumarr=sumarr+parseFloat(cal);
            }
            else
            {
                if($("#question_"+ques_id).attr('data-qtype') !="S")
                {
                    $("#question_"+ques_id).text('No response yet');
                }
            }
        }
        var avg=<?php echo $avg?>;
        var avgtotal=(sumarr/avg).toFixed(1);
        $("#score").text(avgtotal);
    });
</script>