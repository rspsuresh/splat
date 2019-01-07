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
                                                //echo "<pre>";print_r($result);die;
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
                                                            <?php echo $form->labelEx($models,'type'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->dropDownList($models, 'type', CHtml::listData(CourseTypes::model()->findAll(), 'id', 'name'), array('empty'=>'Select Type')); ?>
                                                            <?php echo $form->error($models,'type'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'year'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'year', array('placeholder'=>'year','maxlength'=>4, 'class'=>'datepicker','id'=>'Courses_year_'.$models->id)); ?>
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
                                                            <?php echo $form->labelEx($models,'type'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->dropDownList($models, 'type', CHtml::listData(CourseTypes::model()->findAll(), 'id', 'name'), array('empty'=>'Select Type')); ?>
                                                            <?php echo $form->error($models,'type'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                        <div class="col-lg-4 padzero">
                                                            <?php echo $form->labelEx($models,'year'); ?>
                                                        </div>
                                                        <div class="col-lg-8 padzero">
                                                            <?php echo $form->textField($models,'year', array('placeholder'=>'year','maxlength'=>4, 'class'=>'datepicker','id'=>'Courses_year_'.$models->id)); ?>
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
        <?php  if(Yii::app()->user->getState('role')=='Superuser'){ ?>
            <input type="button" value="Add a Course" class="add-course" data-toggle="modal" data-target="#courseModal">
        <?php } ?>
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
                        <?php echo $form->labelEx($formModel,'type'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->dropDownList($formModel, 'type', CHtml::listData(CourseTypes::model()->findAll(), 'id', 'name'), array('empty'=>'Select Level')); ?>
                        <?php echo $form->error($formModel,'type'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php echo $form->labelEx($formModel,'year'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textField($formModel,'year', array('placeholder'=>'year','maxlength'=>4,'class'=>'datepicker')); ?>
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
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
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
