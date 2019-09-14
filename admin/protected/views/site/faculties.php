<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/summernote-master/dist/summernote-bs4.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/summernote-master/dist/summernote-bs4.js"></script>
<style>
    .note-editable card-block{width:410px;}
    .container-fluid.bg-color {
        background-color: #00B9D1 !important;
        padding:40px 0px;
        margin-bottom:22px;opacity:0.9;
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
    .user-assessment>p
    {font-size:20px !important;}
    .script-text h1 {
        color: #000;
        font-size: 16px !important;
    }
    .add-course
    {
        font-size: 15px !important;
        font-weight:bold;
    }
    .fullbg{
        background-image: url(/images/Asses.jpg);
        display:block;
        width:100%;
        height:500px;
    }
    .container-fluid.bg-color1 {
        background-color: rgb(242, 242, 242);

        margin-top: 150px;
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
    .containers >p
    {
        margin:0px !important;
    }
    .container-fluid.bg-color2>.containers
    {
        padding:5px;
    }
    /*.footer-sec{*/
    /*    bottom:auto !important;*/
    /*}*/
</style>
<section id="wrapper" >
    <?php  if(Yii::app()->user->getState('role')=='Staff') { ?>
        <div class="container fullbg">
            <div class="container-fluid bg-color1">
                <div class="containers">
                    <h4 class="welcome"> Welcome <span class="oppo-color">
                                             <?php echo ucwords(Yii::app()->session['user']->first_name." ".Yii::app()->session['user']->last_name)?></span></h4>
                </div>
            </div>
            <div class="container-fluid bg-color2">
                <div class="containers">
                    <p class="welcomeforp">You have Staff permissions. SPLAT is a Self Learning and Peer Assessment Tool where you can create courses, add users to the course, setup projects, create groups & view peer assessment feedback.</p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php  if(Yii::app()->user->getState('role')=='Superuser') { ?>
        <div class="container">
            <div class="user-institute">
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <a href="javascript:void(0);">Manage Faculties</a></p>
            </div>	</div>
    <?php } else { ?>
        <div class="container">		<div class="user-institute"><p>You are here: <a href="javascript:void(0);">Manage Faculties</a></p>		</div>	</div>
    <?php } ?>
    <div class="container-fluid user-assessment">
        <p>Manage Faculties</p>
    </div>
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <?php
        $i=0;
        if(count($model)>0):
            foreach($model as $models):
                $i++;
                ?>
                <div class="script-text" id="row_<?php echo $models->id ?>">
                    <h1><a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>$_GET['i'],
                            'f'=>base64_encode($models->id))); ?>" class="item_link">
                            <?php echo $i; ?>. <?php echo ucfirst($models->name); ?></a>
                        <span class="pull-right">
                <?php  if(Yii::app()->user->getState('role')=='Superuser'){ ?>
                    <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>',1)"></i>
                <?php } ?>
                            <i class="fa fa-cog" data-toggle="modal" data-target="#facultyModal_<?php echo $models->id; ?>"></i>
			</span>
                        <?php //} ?>
                    </h1>
                    <?php if(Yii::app()->user->getState('role')=='Superuser') { ?>
                        <p>
                            <span>Total Courses: <?php echo Courses::model()->count('faculty='.$models->id .' and status="active"' ); ?></span>
                        </p>
                    <?php }
                    else {
                        $result=Yii::app()->db->createCommand('select group_concat(course_id) as course  from user_courses where user_id="'.Yii::app()->session['id'].'"')->queryAll();
                        $course=($result>0)?$result[0]['course']:"0";
                        //$stfmodel = Courses::model()->count('faculty=' . base64_decode($models->id) . ' and status="active"  and  id in('.$course.')');?>
                        <p>
                            <span>Available Courses: <?php echo Courses::model()->count('faculty=' .$models->id . ' and status="active"  and  id in('.$course.')'); ?></span>
                        </p>
                    <?php } ?>



                </div>
                <div class="modal fade" id="facultyModal_<?php echo $models->id;?>" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                            <div class="modal-header col-lg-12">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Faculties</h4>
                            </div>
                            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'faculty-form'.$models->id,
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
                                        <?php echo $form->labelEx($models,'description'); ?>
                                    </div>
                                    <div class="col-lg-8 padzero">
                                        <?php echo $form->textarea($models,'description', array('placeholder'=>'Description')); ?>
                                        <?php echo $form->error($models,'description'); ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero" style="display:none;">
                                    <div class="col-lg-4 padzero">
                                        <?php echo $form->labelEx($models,'status'); ?>
                                    </div>
                                    <div class="col-lg-8 padzero formradio" >
                                        <?php echo $form->radioButtonList($models,'status', array('active'=>'Active','inactive'=>'Inactive'),
                                            array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
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
                <h1>No Faculties found.</h1>
            </div>
        <?php endif; ?>
		
        <?php if(Yii::app()->user->getState('role')=='Superuser'){ ?>
            <input type="button" value="Add a Faculty" class="add-course" data-toggle="modal" data-target="#facultyModal">
        <?php } ?>
    </div>
</section>

<!--<div class="modal fade" id="emailModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Email Template</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php /*$form=$this->beginWidget('CActiveForm', array(
                    'id'=>'email-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); */?>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php /*echo $form->labelEx($makemodel,'name'); */?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php /*echo $form->textField($makemodel,'name', array('placeholder'=>'Name')); */?>
                        <?php /*echo $form->error($makemodel,'name'); */?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php /*echo $form->labelEx($makemodel,'description'); */?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php /*echo $form->textarea($makemodel,'description', array('placeholder'=>'Description','class'=>'summernote')); */?>
                        <?php /*echo $form->error($makemodel,'description'); */?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                    <div class="col-lg-4 padzero">
                        <?php /*echo $form->labelEx($makemodel,'status'); */?>
                    </div>
                    <div class="col-lg-8 padzero formradio">
                        <?php /*echo $form->radioButtonList($makemodel,'status', array('active'=>'Active','inactive'=>'Inactive'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); */?>
                        <?php /*echo $form->error($makemodel,'status'); */?>
                    </div>
                </div>
                <?php /*echo CHtml::submitButton('Save',array('class'=>'save-btn')); */?>
                <?php /*$this->endWidget(); */?>
            </div>
        </div>
    </div>
</div>-->
<script>
    $(function() {
        $('.summernote').summernote({
            height: 200
        });
    });
    function ConfirmDelete(id,type)
    {
        if(type==1)
        {
            var url = '<?php echo Yii::app()->createUrl('site/deletefacilites') ?>';
            var x=confirm("Are you sure you want to delete faculty?");
        }
        else
        {
            var url = '<?php echo Yii::app()->createUrl('site/deletetemplate') ?>';
            var x=confirm("Are you sure you want to delete Template?");
        }

        if (x)
        {

            $.ajax({
                url: url,
                type: 'post',
                data: {'id': id},
                dataType: "json",
                success: function (data) {
                    if(type==1)
                    {
                        $("#row_"+id).remove();
                        $.notify("Facility deleted succesfully", "success");
                    }
                    else
                    {
                        $("#temprow_"+id).remove();
                        $.notify("Template deleted succesfully", "success");
                    }
                }
            });
        }
        else
        {
            return false;
        }
    }
</script><!-- model -->
<div class="modal fade" id="facultyModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Faculty</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm',
                    array('id'=>'faculty-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array('validateOnSubmit'=>true))); ?>
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
                        <?php echo $form->labelEx($formModel,'description'); ?>
                    </div>
                    <div class="col-lg-8 padzero">
                        <?php echo $form->textarea($formModel,'description', array('placeholder'=>'Description')); ?>
                        <?php echo $form->error($formModel,'description'); ?>
                    </div>
                </div>
                <!--<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                      <div class="col-lg-4 padzero">
                          echo $form->labelEx($formModel,'status'); ?>
                      </div>
                      <div class="col-lg-8 padzero formradio">
                          <?php echo $form->radioButtonList($formModel,'status', array('active'=>'Active','inactive'=>'Inactive'),
                    array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'  ')); ?>
                          <?php echo $form->error($formModel,'status'); ?>
                      </div>
                  </div>-->
                <?php echo CHtml::submitButton('Save',array('class'=>'save-btn')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div></div>