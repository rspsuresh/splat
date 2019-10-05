<style>
    .fullbg{
        background-image: url(<?=Yii::app()->request->baseUrl?>/images/Asses.jpg);
        display:block;
        width:100%;
        height:500px;
    }
    .mbr-white {
        color: #ffffff;
    }
    .align-left {
        text-align: left;
    }
    .container-fluid.bg-color1 {
        background-color: rgb(242, 242, 242);
        opacity:0.8;
        margin-top: 85px;
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
    .f-20
    {
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
    .asses {
        text-align: center;
        color: #ffff;
    }
    .margin-top {
        background: #00CFE8;
        margin-top: 29px;
    }
    .course {
        color:black !important;
    }
    .black-clr {
        color: red;
        margin-left: 20px;
    }
    .containers >p {
        opacity:0.8;
    }

</style>
<div class="container fullbg">
    <div class="container-fluid bg-color1">
        <div class="containers">
            <h4 class="welcome"> Welcome <?php echo ucwords(Yii::app()->session['user']->first_name ." ".Yii::app()->session['user']->last_name) ?></h4>
        </div>
    </div>
    <div class="container-fluid bg-color2">
        <div class="containers">
            <p class="welcomeforp"> Splat is a Self and Peer Learning Assesment Tool</p>
            <p class="text-center production f-20">Here you can assess your group and provide feedback. </p>
        </div>
    </div>
</div>

<div class="container-fluid user-assessment">
    <p>Assessments</p>
</div>
<div class="script-section col-lg-12 col-xs-12 col-sm-12">
    <div class="">
        <ul class="nav nav-tabs script-tab text-center">
            <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true">Live (<span id="activespan">1</span>)</a></li>
            <li class="blue-clr"><a data-toggle="tab" href="#menu1" aria-expanded="false">Completed (<span id="inactivespan">0</span>)</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="bs-example">
                    <div class="panel-group" id="accordion">
                        <?php
                        $userid=Yii::app()->user->id;
                        $coursessql="SELECT * FROM `user_courses` as A left join courses as B on A.course_id=B.id and B.status=\"active\" WHERE A.`user_id` ={$userid}";
                        $courseresult=Yii::app()->db->CreateCommand($coursessql)->QueryAll();
                        if(count($courseresult)>0) {
                            foreach($courseresult as $course)    {
                                $groupfind="SELECT *  FROM `group_users` as A left join groups as B  on A.`group_id`=B.`id`  WHERE A.`user_id` ={$userid}
  and B.`course_id`={$course['id']}";
                                $groupfindresult=Yii::app()->db->CreateCommand($groupfind)->queryAll();
                                ?>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a  class="course" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $course['id']; ?>"> <?php echo ucfirst($course['course_type']." ".$course['name']. " | Level : ".$course['type']." | Year : ".date('Y-m',strtotime($course['year']))); ?> <i class="fa fa-angle-down pull-right blue-clr" aria-hidden="true"></i></a>
                                        </h4>
                                    </div>
                                    <div id="collapse_<?php echo $course['id']; ?>" class="panel-collapse collapse in">
                                        <div class="panel-body" id="activecount">
                                            <?php
                                            $assesmentsql="SELECT *  FROM `projects` WHERE `institution` ={$course['institution']} 
                                                                AND `faculty` ={$course['faculty']} AND `course` ={$course['id']} and `status`='live'";
                                            $aseesresult=Yii::app()->db->CreateCommand($assesmentsql)->QueryAll();
                                            if(!empty($aseesresult)) {
                                                foreach ($aseesresult as $asees)  {
                                                    foreach ($groupfindresult as $grpresult): ?>
                                                    <div class="script-texts actclass" style="margin-left:30px;border-bottom:1px solid rgb(242, 242, 242)">
                                                        <a href="<?php echo Yii::app()->createUrl('site/assessment', array('id' => $asees['id'],'course'=>$course['id'],'g'=>$grpresult['id'])); ?>">
                                                            <h1 class="blue-clr">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#333 !important;"></i>
                                                                <?=$asees['name']."( ".$grpresult['name'].")"?>
                                                            </h1>
                                                            <p>Due By : <?=date('d-m-Y',strtotime($asees['assess_date']))?></p>
                                                        </a>
                                                    </div>

                                                <?php endforeach;} } else { ?>
                                                echo '<div class="script-texts">
                                            <h3 class="black-clr">No Assesments Created Yet</h3>
                                        </div>';
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            <?php } }  ?>

                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="bs-example">
                    <div class="panel-group" id="accordion1">
                        <?php
                        if(count($courseresult)>0) {
                            foreach($courseresult as $course)    {
                                $groupfind="SELECT *  FROM `group_users` as A left join groups as B  on A.`group_id`=B.`id`  WHERE A.`user_id` ={$userid}  and B.course_id={$course['id']}";
                                $groupfindresult=Yii::app()->db->CreateCommand($groupfind)->queryAll();
                                ?>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a  class="course" data-toggle="collapse" data-parent="#accordion1" href="#incollapse_<?php echo $course['id']; ?>">
                                                <?php //echo ucfirst($course['course_type']." ".$course['name']. "Type-".$course['type']); ?>
                                                <?php echo ucfirst($course['course_type']." ".$course['name']); ?>
                                                <i class="fa fa-angle-down pull-right blue-clr" aria-hidden="true"></i></a>
                                        </h4>
                                    </div>
                                    <div id="incollapse_<?php echo $course['id']; ?>" class="panel-collapse collapse in">
                                        <div class="panel-body" id="inactivecount">
                                            <?php
                                            $assesmentsql="SELECT *  FROM `projects` WHERE `institution` ={$course['institution']} 
                                                  AND `faculty` ={$course['faculty']} AND `course` ={$course['id']} and `status`='completed'";
                                            $aseesresultcom=Yii::app()->db->CreateCommand($assesmentsql)->QueryAll();
                                            if(!empty($aseesresultcom)) {
                                                foreach ($aseesresultcom as $asees)  {
                                                    foreach($groupfindresult as $grpresult):
                                                    ?>
                                                    <div class="script-texts actclass" style="margin-left:30px;"
                                                         id="ssd"
                                                         data-count="dsd">
                                                        <a href="<?php echo Yii::app()->createUrl('site/projects', array('id' => $asees['id'],
                                                            'c'=>$course['id'],'g'=>$grpresult['id'])); ?>">
                                                            <h1 class="blue-clr"><i
                                                                        class="fa fa-pencil-square-o"
                                                                        aria-hidden="true"
                                                                        style="color:#333 !important;"></i> <?=$asees['name']."( ".$grpresult['name'].")"?>
                                                            </h1>
                                                            <p>Due By : <?=date('d-m-Y',strtotime($asees['assess_date']))?></p>
                                                        </a>
                                                    </div>
                                                <?php endforeach; }} else { ?>
                                                echo '<div class="script-texts">
                                                    <h3 class="black-clr">No Assesments Created Yet</h3>
                                                </div>';
                                                ?>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            <?php } }  ?>

                    </div>
                </div>
            </div>
        </div>
    </div></div>
<script>
    $(window).bind("load", function() {

        var act=$('#accordion>.panel').length;
        var inact= $('#accordion1>.panel').length;
        var finalact=(typeof act =='undefined')?'0':act;
        var finalinact=(typeof inact =='undefined')?'0':inact;
        var empdivactive=$("#accordion .script-texts >h3").parent().parent().parent().parent().length;
        var empdivinactive=$("#accordion1 .script-texts >h3").parent().parent().parent().parent().length;
        $("#activespan").text(finalact-empdivactive);
        $("#inactivespan").text(finalinact - empdivinactive);
        var checkcount=finalinact - empdivinactive;
        console.log(checkcount);
        if(checkcount ==0)
        {
            $("#accordion1").html('<h3> No complete assessment yet</h3>');

        }
        $("#accordion .script-texts >h3").parent().parent().parent().parent().hide();
        $("#accordion1 .script-texts >h3").parent().parent().parent().parent().hide();
    });
</script>
