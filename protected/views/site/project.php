<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.twbsPagination.js"></script>
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
    [data-toggle="collapse"]:after {
        display: inline-block;
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        content: "\f105";
        transform: rotate(90deg) ;
        transition: all linear 0.25s;
        float: right;
        margin-right: 20px;
        margin-top: -17px;
    }
    [data-toggle="collapse"].collapsed:after {
        transform: rotate(0deg) ;
        margin-right: 20px;
        margin-top: -17px;
    }
    .page {
        display: none;
    }
    .page-active {
        display: block;
    }
</style>
<section id="wrapper" >
    <div class="container-fluid user-assessment">
        <p><?php echo ucfirst($projects->name); ?></p>
    </div>
    <div class="script-section col-lg-12 col-xs-12 col-sm-12">
        <?php
        $coursest_id=$_GET['c'];
        $sqldcque="SELECT GROUP_CONCAT(question_id) as question 
         FROM `delete_custom_question` WHERE `course_id` =$coursest_id";
        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';

        //$prj= Userdetails::model()->find("course=".$_GET['c']." and user_id=".Yii::app()->user->id);
        // if(count($prj)>0)
        $groupusers = Userdetails::model()->with('user')->findAll('grp_id='.$_GET['g'].' and user.status="active" and course='.$_GET['c']);


        $sqldcque="SELECT GROUP_CONCAT(question_id) as question FROM `delete_custom_question` WHERE `course_id` =$projects->course";
        $resdcq=Yii::app()->db->createCommand($sqldcque)->queryAll();
        $ids=($resdcq[0]['question'])?$resdcq[0]['question']:'0';

        $questions=Questions::model()->findAll('course='.$_GET['c'].' and status="active" and id NOT IN ('.$ids.')');
        ?>
        <div class="">
            <ul class="nav nav-tabs script-tab text-center">
                <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true">Received</a></li>
                <li class="blue-clr"><a data-toggle="tab" href="#menu1" aria-expanded="false">Sent</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="bs-example" id="mycontent">
                        <div class="panel-group" id="faqAccordion">
                            <?php
                            if(count($groupusers)>0):
                                $u = 0;
                                $chunkarray=array_chunk($groupusers,5);
                                foreach($chunkarray as $ckey =>$cval) :
                                    foreach($cval  as $key=>$groupuser):
                                        $u++;
                                        $myclass=($groupuser->user_id==Yii::app()->user->id)?'mine':'others';
                                        ?>

                                        <div class="panel panel-default <?=$myclass?> page page_<?=$ckey+1?> " style="margin-bottom:5px !important;">
                                            <div class="panel-heading accordion-toggle question-toggle"
                                                 data-toggle="collapse" data-parent="#faqAccordion"
                                                 data-target="#question_<?php echo $groupuser->id;?>" >
                                                <h4 class="panel-title">
                                                    <a href="#" class="ing">
                                                        <?php
                                                        if($groupuser->user_id==Yii::app()->user->id)
                                                        {
                                                            echo 'Self Assessment';
                                                        }
                                                        else
                                                        {
                                                            if($projects->course0->anonymous ==1)
                                                            {
                                                                echo "From anonymous user";
                                                            }
                                                            else{
                                                                echo "From ".$groupuser->user->first_name." ".$groupuser->user->last_name;
                                                            }
                                                        }
                                                        ?>

                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="question_<?php echo $groupuser->id;?>" class="panel-collapse collapse"
                                                 style="height: 0px;">
                                                <div class="panel-body">
                                                    <div class="script-texts">
                                                        <?php
                                                        $i=0;
                                                        foreach($questions as $iquestion):
                                                            $i++;
                                                            $iassess = Assess::model()->find('project='.$projects->id.' 
                                                and from_user='.$groupuser->user_id.' 
                                                and to_user='.Yii::app()->user->id.' and question='.$iquestion->id.' and grp_id='.$_GET['g']);
                                                            ?>
                                                            <p class="m-t-10"><?php echo $i;?>. <?php echo $iquestion->question;?> : <b><?php if(count($iassess)>0) echo $iassess->value; else echo '-'; ?></b></p>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endforeach;
                            else: ?>
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
                <div id="menu1" class="tab-pane fade">
                    <div class="bs-example" id="mycontentsent">
                        <div class="panel-group" id="faqAccordionsent">
                            <?php
                            if(count($groupusers)>0):
                                $u = 0;
                                $chunkarray=array_chunk($groupusers,5);
                                foreach($chunkarray as $ckey =>$cval) :
                                    foreach($cval  as $key=>$groupuser):
                                        $u++;
                                        $myclass=($groupuser->user_id==Yii::app()->user->id)?'mine1':'others1 ';
                                        ?>

                                        <div class="panel panel-default <?=$myclass?> page page_<?=$ckey+1?> " style="margin-bottom:5px !important;">
                                            <div class="panel-heading accordion-toggle question-toggle"
                                                 data-toggle="collapse" data-parent="#faqAccordionsent"
                                                 data-target="#sentquestion_<?php echo $groupuser->id;?>" >
                                                <h4 class="panel-title">
                                                    <a href="#" class="ing">
                                                        <?php
                                                        if($groupuser->user_id==Yii::app()->user->id)
                                                        {
                                                            echo 'Self Assessment';
                                                        }

                                                        else
                                                        {
                                                            if($projects->course0->anonymous ==1)
                                                            {
                                                                echo "From anonymous user";
                                                            }
                                                            else{
                                                                echo $groupuser->user->first_name." ".$groupuser->user->last_name;
                                                            }
                                                        }
                                                        ?>

                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="sentquestion_<?php echo $groupuser->id;?>" class="panel-collapse collapse"
                                                 style="height: 0px;">
                                                <div class="panel-body">
                                                    <div class="script-texts">
                                                        <?php
                                                        //$questions=Questions::model()->findAll('faculty='.base64_decode($_GET['f']).' and course='.base64_decode($_GET['c']).' and status="active" or type="default" and id NOT IN ('.$ids.')');
                                                        $iquestions=Questions::model()->findAll('course='.$projects->course.' and status="active" and id NOT IN ('.$ids.')');
                                                        $i=0;
                                                        foreach($questions as $iquestion):
                                                            $i++;
                                                            $iassess = Assess::model()->find('project='.$projects->id.'
                                                and from_user='.Yii::app()->user->id.' 
                                                and to_user='.$groupuser->user_id.' and question='.$iquestion->id.' and grp_id='.$_GET['g']);
                                                            ?>
                                                            <p class="m-t-10">
                                                                <?php echo $i;?>.<?php echo $iquestion->question;?>
                                                                :
                                                                <b><?php if(count($iassess)>0) echo $iassess->value; else echo '-'; ?></b>
                                                            </p>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endforeach;
                            else: ?>
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
        </div>
    </div>
</section>
<?php
$totalcount=count($chunkarray);?>
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
        var prjname=$("#projectname").text();
        var assm=$(".btn-primary").text().trim();
        var cms="View feedback from Peer "+prjname+"("+assm+")";
        $("#rmd").text(cms);
    });

    var container = $('#mycontent').clone();
    $('#mycontent').html('');
    container.find('.others').each(function() {
        $('#mycontent').append($(this)[0].outerHTML);
    })
    container.find('.mine').each(function() {
        $('#mycontent').append($(this)[0].outerHTML);
    })


    $('#mycontent').twbsPagination({
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
    $('#mycontentsent').twbsPagination({
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