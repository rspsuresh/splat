<style>
    .fa-input { font-family: FontAwesome, ‘Helvetica Neue’, Helvetica, Arial, sans-serif; }
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
    .grey
    {
        color:grey;
    }
    .panel-group .panel
    {
        padding:4px;
        border-radius: 2px solid grey;
    }

    div[class~='.script-text']:last-of-type{
        border-bottom: none !important;
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
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <ul class="nav nav-tabs script-tab text-center" >
            <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true"> <i class="fa fa-toggle-on" style="color:white" aria-hidden="true"></i> Active (<?= count($model)?>)</a></li>
            <li class="blue-clr"><a data-toggle="tab" href="#menu1" aria-expanded="false"><i class="fa fa-toggle-off" style="color:white" aria-hidden="true"></i> Inactive (<?= count($imodel)?>)</a></li>
        </ul>
        <div class="tab-content" >
            <div id="home" class="tab-pane fade in active">
                <div class="bs-example">
                    <div class="panel-group" id="accordion">
                        <div class="panel">
                            <?php
                            $i=0;
                            if(count($model)>0):
                                foreach($model as $key=>$models):
                                    $i++;
                                    ?>
                                    <div class="script-text courseofclass" style="<?=(count($model) ==($key+1))?"border-bottom:none !important":""?>" id="row_<?php echo $models->id ?>">
                                        <h1>
                                            <a data-course="<?=$models->id?>" href="<?php echo Yii::app()->createUrl('users/cadmin',array('i'=>$_GET['i'],
                                                'f'=>$_GET['f'], 'c'=>trim(base64_encode($models->id)))); ?>"
                                               class="item_link"><?php echo $i; ?>.
                                                <?php echo ucwords ($models->course_type." ".$models->name); ?>  <span class="grey"><?=($models->course_level !='')?' | Level: '.$models->course_level:''?> <?=($models->year !='')?' | Year: '.$models->year:''?></span></a>

                                            <span class="pull-right">
                                                <i class="fa fa-cog" data-toggle="modal"
                                                   data-target="#courseModal_<?php echo $models->id; ?>"></i>
								  </span>
                                            <?php //} ?></h1>
                                        <p><span>Users:
                                                <?php
                                                $sql="SELECT count(*) as count FROM `user_courses` 
                                                       join users on user_courses.user_id=users.id and users.role=5 and users.status='active'
                                                        WHERE user_courses.`course_id` = $models->id";

                                                $sql="SELECT user_id as user_id FROM `user_courses` 
                                                      join users on user_courses.user_id=users.id and users.role=5
                                                      WHERE user_courses.`course_id` = ".$models->id." and users.status='active'";
                                                $result=Yii::app()->db->createCommand($sql)->queryAll();
                                                $uniquesdata=array_unique(array_column($result,'user_id'));

                                                echo count($uniquesdata); ?>
                                            </span></p>
                                    </div>
                                    <div class="modal fade" id="courseModal_<?php echo $models->id;?>" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                                <div class="modal-header col-lg-12">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title text-center">Courses</h4>
                                                </div>
                                                <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'course-form'.$models->id,
                                                        'enableClientValidation'=>true,
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                        ),
                                                    )); ?>
                                                    <?php echo $form->hiddenField($models,'id'); ?>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'name'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'name', array('placeholder'=>'Name')); ?>
                                                            <?php echo $form->error($models,'name'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'course_type'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'course_type', array('placeholder'=>'MA(Hons),M.sc..')); ?>
                                                            <?php echo $form->error($models,'course_type'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'course_level'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'course_level', array('placeholder'=>'Ex:2')); ?>
                                                            <?php echo $form->error($models,'course_level'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'year'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php $models->year=date('M-Y',strtotime($models->year));
                                                            echo $form->textField($models,'year', array('placeholder'=>'year','maxlength'=>4, 'class'=>'datepicker','id'=>'Courses_year_'.$models->id)); ?>
                                                            <?php echo $form->error($models,'year'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'description'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textarea($models,'description', array('placeholder'=>'Description')); ?>
                                                            <?php echo $form->error($models,'description'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'status'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero formradio">
                                                            <?php echo $form->radioButtonList($models,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                                            <?php echo $form->error($models,'status'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <label>Anonymous</label>
                                                        </div>
                                                        <div class="col-lg-8 padzero formradio">
                                                            <?php echo $form->radioButtonList($models,'anonymous', array('1'=>'ON','2'=>'OFF'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                                            <?php echo $form->error($models,'anonymous'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <label>Delete Course</label>
                                                        </div>
                                                        <div class="col-lg-8 padzero formradio">
                                                            <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')"></i></div>
                                                    </div>
                                                    <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                                                    <?php $this->endWidget(); ?>
                                                </div>
                                            </div>
                                        </div>
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
                                    <div class="script-text" style="<?=(count($imodel) ==($key+1) && !empty($imodel))?"border-bottom:none !important":"border-bottom:none !important"?>" id="row_<?php echo $models->id ?>">
                                        <h1><a href="<?php echo Yii::app()->createUrl('site/courseItems',array('i'=>$_GET['i'],'f'=>$_GET['f'], 'c'=>base64_encode($models->id))); ?>" class="item_link"><?php echo $i; ?>.<?php echo ucwords ($models->course_type." ".$models->name); ?></a>
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
                                    <div class="modal fade" id="courseModal_<?php echo $models->id;?>" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                                <div class="modal-header col-lg-12">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title text-center">Courses</h4>
                                                </div>
                                                <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                                        'id'=>'course-form'.$models->id,
                                                        'enableClientValidation'=>true,
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                        ),
                                                    )); ?>
                                                    <?php echo $form->hiddenField($models,'id'); ?>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'name'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'name', array('placeholder'=>'Name')); ?>
                                                            <?php echo $form->error($models,'name'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'course_type'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'course_type', array('placeholder'=>'MA(Hons),M.sc..')); ?>
                                                            <?php echo $form->error($models,'course_type'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'course_level'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'course_level', array('placeholder'=>'Ex:2')); ?>
                                                            <?php echo $form->error($models,'course_level'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php
                                                            echo $form->labelEx($models,'year'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">

                                                            <?php 
                                                            echo $form->textField($models,'year', array('placeholder'=>'year','maxlength'=>4, 'class'=>'datepicker','id'=>'Courses_year_'.$models->id)); ?>
                                                            <?php echo $form->error($models,'year'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'description'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textarea($models,'description', array('placeholder'=>'Description')); ?>
                                                            <?php echo $form->error($models,'description'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'status'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero formradio">
                                                            <?php echo $form->radioButtonList($models,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                                            <?php echo $form->error($models,'status'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <label>Anonymous Option</label>
                                                        </div>
                                                        <div class="col-lg-8 padzero formradio">
                                                            <?php echo $form->radioButtonList($models,'anonymous', array('1'=>'ON','2'=>'OFF'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                                                            <?php echo $form->error($models,'anonymous'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <label>Delete Course</label>
                                                        </div>
                                                        <div class="col-lg-8 padzero formradio">
                                                            <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')"></i></div>
                                                    </div>
                                                    <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                                                    <?php $this->endWidget(); ?>
                                                </div>
                                            </div>
                                        </div>
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


            <input type="button" value="&#xf02d; Add a Course" class="add-course fa-input" data-toggle="modal" data-target="#courseModal">

    </div>
</section>
<!-- model -->
<div class="modal fade" id="courseModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Courses</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'course-form',
                    'enableClientValidation'=>false,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'name'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textField($formModel,'name', array('placeholder'=>'Name')); ?>
                        <?php echo $form->error($formModel,'name'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'course_type'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textField($formModel,'course_type', array('placeholder'=>'MA(Hons),M.Sc..')); ?>
                        <?php echo $form->error($formModel,'course_type'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'course_level'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textField($formModel,'course_level', array('placeholder'=>'Ex:2')); ?>
                        <?php echo $form->error($formModel,'course_level'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'year'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php
                        echo $form->textField($formModel,'year', array('placeholder'=>'year','maxlength'=>4,'class'=>'datepicker')); ?>
                        <?php echo $form->error($formModel,'year'); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'description'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textarea($formModel,'description', array('placeholder'=>'Description')); ?>
                        <?php echo $form->error($formModel,'description'); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'status'); ?>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php echo $form->radioButtonList($formModel,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                        <?php echo $form->error($formModel,'status'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <label>Anonymous Option</label>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php echo $form->radioButtonList($formModel,'anonymous', array('1'=>'ON','2'=>'OFF'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                        <?php echo $form->error($formModel,'anonymous'); ?>
                    </div>
                </div>
                <?php
                echo CHtml::tag('button',[
                    'id'=>'btsubmit','class'=>'save-btn fa-input','name'=>'yt3','type'=>'submit'
                ],'<i class="fa fa-floppy-o" aria-hidden="true"></i> Save'); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>

    </div>
</div>
<!--<script type="text/javascript" src="/splat/admin/js/jqueryui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/splat/admin/js/jqueryui/jquery-ui.min.css">-->
<script type="text/javascript">
    function ConfirmDelete(id)
    {
        var x = confirm("Are you sure you want to delete this course? The action cannot be undone and all the responses in here will be deleted.");
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
                    window.location.reload();
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
            $(this).datepicker({ dateFormat: 'M-yy' });
        });
    });
</script>
