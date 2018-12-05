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
        <button class="btn btn-success align">Mean Score : <span id="score">
                <?php echo $meanscore?></span></button>
        <div class="user-assessment">
            <?php
            $indarray=array();
            $user=Users::model()->findByPk($_GET['u']); ?>
            <p>Assessment for <?= $user->first_name ." ".$user->last_name?></p>
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
                             data-toggle="collapse" data-parent="#faqAccordion" data-target="#question<?=$i?>">
                            <h4 class="panel-title">
                                <a href="#" class="ing"><?= $i .".". $question->question ?>  : <b style="color:black !important" class="que" id="question_<?=$i?>"></b></a>
                            </h4>
                        </div>
                        <div id="question<?=$i?>" class="panel-collapse collapse" >
                            <div class="panel-body">
                                <?php if(count($groupusers)>0){
                                    foreach($groupusers as $groupuser){
                                        $assess = Assess::model()->find('question=:q and project=:p and 
                                        from_user=:f and to_user=:t and asses_id=:as and grp_id=:grp',
                                            array(':q'=>$question->id,':p'=>$projects->id,':t'=>$_GET['u'],
                                                ':f'=>$groupuser->user_id,':as'=>$_GET['as'],':grp'=>$_GET['g']));
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
                                                    </b></div>
                                                <div class="col-lg-7"><p>:
                                                        <b class="answser_<?=$i?>"
                                                           data-val="<?=($assess->value)?$assess->value:0;?>"
                                                           data-type="<?=$question->q_type?>"
                                                           style="color:red;">
                                                            <?php
                                                            if(is_numeric($assess->value) && $question->q_type=="R" )
                                                            {
                                                                array_push($sum,$assess->value);
                                                            }
                                                            echo ($assess->value!="")?$assess->value : '-';
                                                            ?>
                                                        </b>
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
        $meanscore=number_format((float)$meanscore,2,'.','');
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
    $("#score").text(<?php echo $meanscore ?>);
    $(window).on('load', function() {
        quelength=$(".que").length;
        for(i=1;i<=quelength;i++)
        {
            var queans=[];
            var sum=0;
            $(".answser_"+i).each(function(index, element) {
                if($(this).attr('data-type')=="R") {
                    sum=sum+parseInt($(this).attr('data-val'));
                    queans.push($(this).attr('data-val'));
                }
            });
            $("#question_"+i).text(sum);
        }
    });
</script>