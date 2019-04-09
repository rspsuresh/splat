<?php //echo "fgnfng";die; ?>
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
        font-size: 18px !important;
    }
    .align{
        margin-top:5px;
        margin-right:12px;
        float:right;
    }
</style>
<br><br>
<?php $sum=array();
$meanscore='';
$avg=0;
?>
<section>
    <div class="container ">
        <button class="btn btn-primary align" onclick="goBack()">Back</button>
        <?php $cmpsql="SELECT CAST(A.submitted_at AS DATE) as subdate,B.assess_date from assess as A left join projects as B on A.project=B.id where from_user={$_GET['u']}";
               $cmpsqlresult=Yii::app()->db->createCommand($cmpsql)->queryRow();
               if(!empty($cmpsqlresult)) {
                   $date2=date_create($cmpsqlresult['subdate']);
                   $date1=date_create($cmpsqlresult['assess_date']);
                   $diff=date_diff($date1,$date2);
                   $resultgign=$diff->format("%R%a");
                   if($resultgign >=1)
                   {
                       echo "<button class=\"btn btn-danger align\">Late Submission</button>";
                   }
               }?>

        <button class="btn btn-success align">Mean Score : <span id="score">
                <?php echo $meanscore?></span></button>
        <div class="user-assessment">
            <?php
            $indarray=array();
            $user=Users::model()->findByPk($_GET['u']);
            $projectsname=Projects::model()->findByPk($_GET['p']);?>
            <p><?=ucfirst($projectsname->name) .'  '. $user->first_name ." ".$user->last_name?></p>
        </div>
        <div class="panel-group" id="faqAccordion">
            <?php $groupusers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
            if(count($questions)>0){
                $i=0;
                foreach($questions as $question){
                    if($question->q_type=="R")
                    {
                        $avg=$avg+1;
                    }
                    $i++;
                    ?>
                    <div class="panel panel-default ">
                        <div class="panel-heading accordion-toggle question-toggle collapsed"
                             data-toggle="collapse"  data-target="#question<?=$i?>">
                            <h4 class="panel-title">
                                <a href="#" class="ing">
                                    <?= $i ." . " . $question->question ?>
                                    <?php if($question->q_type=="R")  { ?>
                                        : <b style="color:black !important"  data-qtype="<?=$question->q_type?>"
                                             class="que" id="question_<?=$i?>"></b>
                                    <?php } ?>
                                    <i class="fa fa-angle-right pull-right blue-clr" aria-hidden="true"></i>
                                </a>
                            </h4>
                        </div>
                        <input type="hidden" class="usercount" value="<?= count($groupusers)?>">
                        <div id="question<?=$i?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php if(count($groupusers)>0){
                                    //print_r(count($groupusers));die;
                                    foreach($groupusers as $groupuser){
                                        $assess = Assess::model()->find('question=:q and project=:p and 
                                        from_user=:f and to_user=:t and grp_id=:grp',
                                            array(':q'=>$question->id,':p'=>$projects->id,':t'=>$_GET['u'],
                                                ':f'=>$groupuser->user_id,':grp'=>$_GET['g']));
                                        ?>
                                        <div class="row">
                                            <?php $stcheck=Users::model()->findByPk($groupuser->user_id);?>
                                            <?php
                                            if($stcheck->status=='active') { ?>
                                                <div class="col-lg-3"><b>
                                                        <?php if($_GET['u'] == $groupuser->user_id)
                                                            echo 'Self';
                                                        else
                                                            echo 'By '.ucwords($groupuser->user->first_name ." ".$groupuser->user->last_name);
                                                        ?>
                                                    </b>
                                                </div>
                                                <div class="col-lg-7">
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
        // echo $meanscore=array_sum(array_filter($sum));
        //echo $avg;
        // die;
        $meanscore=array_sum(array_filter($sum))/$avg;
        $meanscore=number_format((float)$meanscore,1,'.','');
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
    //$("#score").text(<?php //echo $meanscore ?>);
    var sumarr=0;
    $(window).on('load', function() {
        quelength=$(".que").length;
        for(i=1;i<=quelength;i++)
        {
            var queans=[];
            var sum=0;
            var testarr=[];
            $(".answser_"+i).each(function(index, element) {
                if($(this).attr('data-type')=="R" && $(this).attr('data-val') !="#" ) {
                    testarr.push($(this).attr('data-val'));
                    sum=sum+parseInt($(this).attr('data-val'));
                    queans.push($(this).attr('data-val'));
                }
            });
            console.log(sum);
            if(sum !=0)
            {
                var usercount=parseInt($(".usercount").val())-1;
                var cal=(sum/queans.length).toFixed(1);
                $("#question_"+i).text(cal);
                sumarr=sumarr+parseFloat(cal);
            }
            else {
                if($("#question_"+i).attr('data-qtype') !="S")
                {
                    $("#question_"+i).text('No response yet');
                }
            }
        }
        var avg=<?php echo $avg?>;
        console.log(avg);
        var avgtotal=(sumarr/avg).toFixed(1);
        $("#score").text(avgtotal);
    });
</script>