<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<style>
    .container-fluid.bg-color {
        background-color: #00B9D1 !important;
        padding:40px 0px;
        margin-bottom:22px;
    }
    .head-bg{margin-bottom:0px;}
    .bg-text{
        color: #ffffff;
        font-size: 37px;
        font-weight: bold;
        text-align: center;
    }
    .oppo-color{
        color:#5FFC7B;
    }
    .production{
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        padding: 20px 0 0;
    }
    .recent {

        margin-top: 60px;
        padding: 0;
    }
    .font-normal{
        font-family:"Conv_helveticaneuecyr-roman" !important;
        font-weight:bold !important;
        color:#337AB7 !important;
        font-size:22px !important;
    }
    .user-assessment
    {
        font-size:19px !important;
    }
    h4.panel-title
    {
        color:#333 !important;
    }
</style>
<?php
/* echo "<pre>";print_r(Users::model()->findAll());die;
 $users=Users::model()->findByPk(40);
 $users->role=1;
 $users->save(false);*/
?>
<section id="wrapper" >
    <div class="container-fluid user-bg-padding">
        <div class="container-fluid bg-color">
            <div class="container">
                <p class="text-center bg-text">Welcome<span class="oppo-color">  <?php echo ucwords(Yii::app()->session['user']->first_name ." ".Yii::app()->session['user']->last_name) ?></span></p>
                <p class="text-center production">SPLAT is a Self & Peer Learning Assessment Tool. Here you can assess your group and provide feedback. </p>
            </div>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Projects / Units</p>
    </div>
    <div class="script-section col-lg-12 col-xs-12 col-sm-12">
        <div class="">
            <ul class="nav nav-tabs script-tab text-center">
                <li class="active"><a data-toggle="tab" href="#home">Current (<span id="activespan"></span>)</a></li>
                <li class="blue-clr"><a data-toggle="tab" href="#menu1">Archived (<span id="inactivespan"></span>)</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="bs-example">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <?php
                                $sqlg="SELECT * FROM `group_users` WHERE user_id=".Yii::app()->user->id;
                                $groupusers=Yii::app()->db->CreateCommand($sqlg)->QueryAll();
                                $mysare=array_column($groupusers,'group_id');
                                if(!empty($mysare))
                                {
                                    $string=implode(',',$mysare);
                                }
                                if(strlen($string)>0)
                                {
                                    $projectgroups = ProjectGroups::model()->findAll('group_id in ('.$string.')');

                                }
                                if(count($projectgroups)>0){
                                    foreach($projectgroups as $projectgroup){
                                        $courses[$projectgroup->course_id] = $projectgroup->course_id;
                                        $userprojects[$projectgroup->course_id] = $projectgroup->course_id;
                                    }
                                    // die;
                                }
                                //echo "<pre>";print_r($courses);die;
                                if(count($courses)>0):
                                    foreach($courses as $course):
                                        $coursesdetails = Courses::model()->find("id=".$course." and status='active'");
                                        ?>
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $coursesdetails->id; ?>"> <?php echo ucfirst($coursesdetails->name); ?> <i class="fa fa-angle-down pull-right blue-clr" aria-hidden="true"></i></a>
                                            </h4>
                                        </div>
                                        <div id="collapse_<?php echo $coursesdetails->id; ?>" class="panel-collapse collapse in">
                                            <div class="panel-body" id="activecount">
                                                <?php
                                                $projects = Projects::model()->findAll('course='.$course.' and status="current"');
                                                $activecount=count($projects);

                                                if(count($projects)>0){
                                                    $activecount = 0;
                                                    foreach($projects as $project) {
                                                        if (in_array($project->id, $userprojects)) {
                                                            $activecount += 1;
                                                            ?>
                                                            <div class="script-texts actclass" style="margin-left:30px;"
                                                                 id="<?= $activecount ?>"
                                                                 data-count="<?= $activecount ?>">
                                                                <a href="<?php echo Yii::app()->createUrl('site/projects', array('id' => $project->id)); ?>">
                                                                    <h1 class="blue-clr"><i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"
                                                                                style="color:#333 !important;"></i> <?php echo $project->name; ?>
                                                                    </h1></a>
                                                                <!--<p>Assessment due date : <?php echo date('d-M-Y', strtotime($project->assess_date)); ?></p>-->
                                                            </div>
                                                            <?php
                                                        }}
                                                }else{
                                                    ?>
                                                    <!--<div class="script-texts">
                                                        <h3 class="black-clr">No projects to show</h3>
                                                    </div>-->
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                else: ?>
                                    <h4 class="panel-title">No courses assigned.</h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <?php
                    $groupusers = GroupUsers::model()->find('user_id='.Yii::app()->user->id);
                    $projectgroups = array();
                    if(count($groupusers)>0)
                        $projectgroups = ProjectGroups::model()->findAll('group_id='.$groupusers->group_id);

                    if(count($projectgroups)>0){
                        foreach($projectgroups as $projectgroup){
                            $courses[$projectgroup->course_id] = $projectgroup->course_id;
                            $userprojects[$projectgroup->course_id] = $projectgroup->course_id;
                        }
                    }

                    if(count($courses)>0):
                        foreach($courses as $course):
                            $coursesdetails = Courses::model()->findByPk($course);
                            ?>
                            <?php $projects = Projects::model()->findAll('course='.$course.' and status="archieved"');
                            if(count($projects) >0) { ?>
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $coursesdetails->id; ?>"> <?php echo ucfirst($coursesdetails->name); ?> <i class="fa fa-angle-down pull-right blue-clr" aria-hidden="true"></i></a>
                                    </h4>
                                </div>

                                <div id="collapse_<?php echo $coursesdetails->id; ?>" class="panel-collapse collapse in">
                                    <div class="panel-body" id="inactivecount">
                                        <?php
                                        if(count($projects)>0) {
                                            $inactivecount=0;
                                            foreach($projects as $project){
                                                if(in_array($project->id, $userprojects)) {
                                                    $inactivecount += 1;
                                                    ?>
                                                    <div class="script-texts inactclass" style="margin-left:30px;"
                                                         id="<?= $inactivecount ?>" data-count="<?= $inactivecount ?>">
                                                        <a href="<?php echo Yii::app()->createUrl('site/projects', array('id' => $project->id)); ?>">
                                                            <h1 class="blue-clr"><?php echo $project->name; ?></h1>
                                                        </a>
                                                        <!--<p>Assessment due date : <?php echo date('d-M-Y', strtotime($project->assess_date)); ?></p>-->
                                                    </div>
                                                    <?php
                                                }
                                            } }
                                        else {
                                            ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } else  { ?>
                            <div class="script-texts">
                                <h3 class="black-clr">No projects to show</h3>
                            </div>
                        <?php } ?>
                        <?php  endforeach; else: ?>
                        <h4 class="panel-title">No courses assigned.</h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(window).bind("load", function() {

        var act=$('#activecount').children().last().attr('data-count');
        var inact= $('#inactivecount').children().last().attr('data-count');
        var finalact=(typeof act =='undefined')?'0':act;
        var finalinact=(typeof inact =='undefined')?'0':inact;
        $("#activespan").text(finalact);
        $("#inactivespan").text(finalinact);


    });
</script>