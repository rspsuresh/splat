<style>
    .user-assessment >p
    {
        font-size:20px !important;
    }
    .script-text > h1
    {
        font-size:16px;
    }
    .add-course
    {
        font-weight:bold;
        font-size:16px !important;
    }
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqueryui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jqueryui/jquery-ui.min.css">
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser'){ ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> / <b><?php echo ucfirst($faculty->name);?></b></p>
            <?php }
            else { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> / <b><?php echo ucfirst($faculty->name);?></b></p>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Courses</p>
    </div>
    <?php
    /*
    $sql="select group_concat(course_id) as course  from user_courses where user_id=".Yii::app()->session["id"];
    $result=Yii::app()->db->createCommand($sql)->queryAll();
    $course=($result>0)?$result[0]['course']:"0";
    print_r($course);die;
    $model = Courses::model()->findAll('faculty=' . base64_decode($_GET['f']) . ' and status="active"  and  id in('.$course.')');*/
    // $model = Courses::model()->findAll('faculty=' . base64_decode($_GET['f']) . ' and status="active");
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_course'
    ));
    ?>
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <ul class="nav nav-tabs script-tab text-center" >
            <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true">Active (<?= count($model)?>)</a></li>
            <li class="blue-clr"><a data-toggle="tab" href="#menu1" aria-expanded="false">Inactive (<?= count($imodel)?>)</a></li>
        </ul>
        <div class="tab-content" >
            <div id="home" class="tab-pane fade in active">
                <div class="bs-example">
                    <div class="panel-group" id="accordion">
                        <div class="panel">
                            <?php
                            $i=0;
                            if(count($model)>0):
                                foreach($model as $models):
                                    $i++;
                                    ?>
                                    <div class="script-text" id="row_<?php echo $models->id ?>">
                                        <h1><a href="<?php echo Yii::app()->createUrl('site/courseItems',array('i'=>$_GET['i'],
                                                'f'=>$_GET['f'], 'c'=>base64_encode($models->id))); ?>"
                                               class="item_link"><?php echo $i; ?>.
                                                <?php echo ucwords ($models->type0->name." ".$models->name); ?></a>

                                            <span class="pull-right">
                                                <?php  if(Yii::app()->user->getState('role')=='Superuser') { ?>
                                                    <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')"></i>
                                                <?php } ?>
                                                <i class="fa fa-cog" data-toggle="modal"
                                                   data-target="#courseModal_<?php echo $models->id; ?>"></i>
								  </span>
                                            <?php //} ?></h1>
                                        <p>
                                            <span>Users:
                                                <?php
                                                $sql="SELECT count(*) as count FROM `user_courses` 
                                                       join users on user_courses.user_id=users.id and users.role=5 and users.status='active'
                                                        WHERE user_courses.`course_id` = $models->id";
                                                $result=Yii::app()->db->createCommand($sql)->queryAll();
                                                $count=($result[0]['count'])?$result[0]['count']:0;
                                                echo $count; ?>
                                            </span></p>
                                    </div>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <div class="script-text">
                                    <h1>No active courses found.</h1>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="bs-example">
                    <div class="panel-group" id="accordion">
                        <div class="panel">

                            <?php
                            $i=0;
                            if(count($imodel)>0):
                                foreach($imodel as $models):
                                    $i++;
                                    ?>
                                    <div class="script-text" id="row_<?php echo $models->id ?>">
                                        <h1><a href="<?php echo Yii::app()->createUrl('site/courseItems',array('i'=>$_GET['i'],'f'=>$_GET['f'], 'c'=>base64_encode($models->id))); ?>" class="item_link"><?php echo $i; ?>.<?php echo ucwords ($models->type0->name." ".$models->name); ?></a>
                                            <?php  //if(Yii::app()->user->getState('role')=='Superuser') { ?>
                                            <span class="pull-right">
                                                <?php if(Yii::app()->user->getState('role') !='Staff') { ?>
                                                    <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')"></i>
                                                <?php } ?>
                                                <i class="fa fa-cog" data-toggle="modal" data-target="#courseModal_<?php echo $models->id; ?>"></i>
								                 </span>
                                            <?php //} ?></h1>
                                        <p><span>Users: <?php echo InstitutionUser::model()->count('course='.$models->id); ?></span></p>
                                    </div>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <div class="script-text">
                                    <h1>No inactive courses found.</h1>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  if(Yii::app()->user->getState('role')=='Superuser'){ ?>
            <input type="button" value="Add a Course" class="add-course" data-toggle="modal" data-target="#courseModal">
        <?php } ?>
    </div>
</section>
<script type="text/javascript">
    function ConfirmDelete(id)
    {
        var x = confirm("Are you sure you want to delete course?");
        if (x)
        {

            $.ajax({
                url: '<?php echo Yii::app()->createUrl('site/deletecourse') ?>',
                type: 'post',
                data: {'id': id},
                dataType: "json",
                success: function (data) {
                    $("#row_"+id).remove();
                    $.notify("Course deleted succesfully", "success");
                }
            });
        }
        else
        {
            return false;
        }
    }
    $(function() {
        $('.datepicker').each(function(){
            $(this).datepicker();
        });
    });
</script>
