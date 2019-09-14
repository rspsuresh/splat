<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
?>
<?php $grp=Groups::model()->findAll('course_id='.base64_decode($_GET['c']).' order by right(name,3)');
$project=Projects::model()->findByPk($_GET['id']);
?>
<style>
    #accordion .panel-heading { padding: 0;}
    #accordion .panel-title > a {
        display: block;
        padding: 0.4em 0.6em;
        outline: none;
        font-weight:bold;
        text-decoration: none;
    }

    #accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
        content:"\e113";
        float: left;
        font-family: 'Glyphicons Halflings';
        margin-right :1em;
    }
    #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
        content:"\e114";
    }
    .quick-btn {
        position: relative;
        display: inline-block;
        width: auto;
        height: 80px;
        padding-top: 16px;
        margin: 10px;
        color: #444444;
        text-align: center;
        text-decoration: none;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.6);
        -webkit-box-shadow: 0 0 0 1px #F8F8F8 inset, 0 0 0 1px #CCCCCC;
        box-shadow: 0 0 0 1px #F8F8F8 inset, 0 0 0 1px #CCCCCC;
        margin:4px;
        padding:10px;
    }
    .quick-btn .label {
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .btn-metis-4 {
        color: #ffffff;
        background-color: #a264e7;
        border-color: #62309a;
    }
    .save-btn
    {
        color: white;
        font-size: 20px;
    }
    .align{
        margin-top:13px;
        float:right;
    }
    .page {
        display: none;
    }
    .page-active {
        display: block;
    }
    .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color:#03c6e3 !important;
        border-color:#03c6e3 !important;
    }
</style>
<section id="wrapper">
    <div class="container">
        <?php
        $facultymdel=Faculties::model()->findByPk(base64_decode($_GET['f']));
        $couesemodels=Courses::model()->findByPk(base64_decode($_GET['c']));
        $assessmodel=Projects::model()->findByPk($_GET['p']);
        $groupmodel=Groups::model()->findByPk($_GET['g']);
        ?>
        <div class="user-institute">
            <p>You are here: <a href="/splat/admin/site/index">Home</a> /
                <a href="<?=Yii::app()->createUrl('site/faculties',array('i'=>$_GET['i']));?>">Faculties</a> /
                <a href="<?=Yii::app()->createUrl('site/faculties',array('i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id)));?>"><?=$facultymdel->name?></a> /
                <a href="<?=Yii::app()->createUrl('site/courses',array('i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id),'c'=>base64_encode($couesemodels->id)));?>"><?=$couesemodels->name?></a> /
                <a href="<?=Yii::app()->createUrl('users/cadmin',array('i'=>$_GET['i'],'f'=>base64_encode($facultymdel->id),'c'=>base64_encode($couesemodels->id)));?>"><?=$assessmodel->name?></a> / <b>Groups</b></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h3><?=$project->name?></h3>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-primary align" onclick="goBack()">Back</button>
            </div>
            <div class="col-lg-12" id="main">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
                    $usermodelsql="SELECT user_id,users.first_name,users.last_name,users.username as username FROM `user_courses` 
                  join users on user_courses.user_id=users.id and users.role=5 and users.status='active'
                  WHERE user_courses.`course_id` = ".base64_decode($_GET["c"]);

                    $usermodel=Yii::app()->db->createCommand($usermodelsql)->queryAll();
                    $courseid=base64_decode($_GET['c']);


                    $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
                                   FROM `delete_custom_question` WHERE `course_id` =$courseid";
                    $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
                    $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';
                    $questions=Questions::model()->findAll('faculty='.base64_decode($_GET['f']).' and q_type="R"
                         and course='.base64_decode($_GET['c']).' and status="active" or type="default" and id NOT IN ('.$ids.') ');
                    $dividedcount=count($questions);

                    $chunkarray=array_chunk($grp,10);
                    foreach($chunkarray as $ckey =>$cval) {
                        foreach($cval as $val) {

                            Yii::app()->db->createCommand('SET group_concat_max_len = 1000000')->execute();
                            $totalusertowardsgrp=count(Userdetails::model()->findAll('course='.base64_decode($_GET['c']).' and grp_id='.$val->id));
                            $meansql="SELECT (sum(value)/$dividedcount) as mean FROM `assess` join `projects` on projects.id=assess.`project` and projects.status !='inactive' WHERE assess.`project` ={$_GET['p']} AND `grp_id` ={$val->id}  ORDER BY assess.`id`  DESC";
                            $meansocre=Yii::app()->db->Createcommand($meansql)->QueryAll();
                            $scoremean=(!empty($meansocre[0]['mean']))?$meansocre[0]['mean']/$totalusertowardsgrp:"0";
                            ?>

                            <div class="panel panel-default page page_<?=$ckey+1?>">
                                <div class="panel-heading" role="tab" id="headingOne<?=$val->id?>" style="background-color:#03c6e3;color:#fff; ">
                                    <?php $grpuser=Userdetails::model()->with('user')->findAll('grp_id='.$val->id.' and user.status="active"');
                                    $finishedusermodel=Assess::model()->findAll(
                                        array(
                                            'condition'=>'grp_id='.$val->id,
                                            'group'=>'from_user'
                                        ));
                                    ?>
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseOne<?=$val->id?>"
                                           aria-expanded="false" aria-controls="collapseOne<?=$val->id?>">
                                            <?=$val->name?><span style="float:right">Completed Users : <?=count($finishedusermodel).'/'.count($grpuser)?></span>   <span style="float:right;margin-right: 30px;">Group mean : <?=round($scoremean,2)?></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne<?=$val->id?>" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingOne<?=$val->id?>">
                                    <div class="panel-body">
                                        <?php
                                        if($grpuser) {
                                            foreach ($grpuser as $gval) {
                                                $noofusersql="SELECT id FROM `assess` WHERE `to_user` ={$gval->user->id} GROUP BY from_user";

                                                $noofuser=Yii::app()->db->Createcommand($noofusersql)->QueryAll();
                                                //echo count($noofuser)."<br>";
                                                $meansqlind="SELECT (sum(value)/$dividedcount) as mean FROM assess inner join projects on projects.id=assess.project and projects.status !='inactive' WHERE assess.project ={$_GET['p']} AND assess.grp_id ={$val->id} and assess.to_user={$gval->user->id} group by assess.to_user ORDER BY assess.id  DESC";
                                                //echo $meansqlind."<br>";
                                                $meansocreind=Yii::app()->db->Createcommand($meansqlind)->QueryAll();
                                                $sqlusercountexact="SELECT count(distinct from_user) as noofuser
                                                FROM `assess` WHERE `to_user` ={$gval->user->id} and `project`={$_GET['p']}";
                                                $noofuserexact=Yii::app()->db->Createcommand($sqlusercountexact)->queryRow();
                                                //echo "<pre>";print_r($noofuserexact);
                                                $scoremeanind=(!empty($meansocreind[0]['mean']))?$meansocreind[0]['mean']/$noofuserexact['noofuser']:"0";
                                                ?>
                                                <?php $action=Yii::app()->CreateUrl('site/responsepage',
                                                    array('id'=>$project->id,
                                                        'u'=>$gval->user->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],
                                                        'g'=>$val->id, 'p'=>$_GET['p']));?>
                                                <a class="quick-btn"  href="<?php echo $action?>">
                                                    <br/>
                                                    <span> <?=$gval->user->first_name." ".$gval->user->last_name?>
                                            </span>
                                                    <p style="color:red;text-decoration:none;"><?=round($scoremeanind,2)?></p>
                                                </a>
                                            <?php }
                                        }
                                        else { ?>
                                            <a class="quick-btn" href="#">
                                                <br/>
                                                <span>No users</span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    <ul id="pagination-demo" class="pagination-lg pull-right"></ul>
                </div>
            </div>
        </div>
        <div>
</section>
<?php $totalcount=count($chunkarray);?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/../js/jquery.twbsPagination.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
    $('#pagination-demo').twbsPagination({
        totalPages:<?=$totalcount?>,
// the current page that show on start
        startPage: 1,

// maximum visible pages
        visiblePages: 10,

        initiateStartPageClick: true,

// template for pagination links
        href: false,

// variable name in href template for page number
        hrefVariable: '{{number}}',

// Text labels
        first: 'First',
        prev: 'Previous',
        next: 'Next',
        last: 'Last',

// carousel-style pagination
        loop: false,

// callback function
        onPageClick: function (event, page) {
            $('.page-active').removeClass('page-active');
            $('.page_'+page).addClass('page-active');
        },

// pagination Classes
        paginationClass: 'pagination',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first',
        pageClass: 'page',
        activeClass: 'active',
        disabledClass: 'disabled'

    });
</script>


