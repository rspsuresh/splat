<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a></p>
            <?php }
            else { ?>
                <p>You are here: <a href="#">Home</a></p>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Institutions</p>
    </div>
    <div class="script-section col-xs-12 col-lg-12 col-sm-12">
        <?php
        $i=0;
        if(count($model)>0):
            foreach($model as $models):
                $i++;
                ?>
                <div class="script-text" id="row_<?php echo $models->id ?>">
                    <h1>
                        <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($models->id))); ?>" class="item_link"><?php echo $i; ?>. <?php echo ucfirst($models->name); ?></a>
                        <?php  //if(Yii::app()->user->getState('role')=='Superuser'){ ?>
                            <span class="pull-right">
			 <i class="fa fa-trash" onclick="ConfirmDelete('<?php echo $models->id ?>')"></i>
			 <i class="fa fa-cog" data-toggle="modal" data-target="#instituionsModal_<?php echo $models->id; ?>"></i>
			 </span>
                        <?php //}?>
                    </h1>
                    <p><span>Courses: <?php echo Courses::model()->count('institution='.$models->id); ?></span> <span>Members: <?php echo InstitutionUser::model()->count('institution='.$models->id); ?></span></p>
                </div>
                <div class="modal fade" id="instituionsModal_<?php echo $models->id;?>" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                            <div class="modal-header col-lg-12">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Institutions</h4>
                            </div>
                            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'institutions-form'.$models->id,
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
                <h1>No Institutions found.</h1>
            </div>
        <?php endif; ?>
        <?php  if(Yii::app()->user->getState('role')=='Superuser')
        { ?>
        <input type="button" value="Add an Institution" class="add-course" data-toggle="modal" data-target="#instituionsModal">
       <?php } ?>
    </div>
</section>
<!-- model -->
<div class="modal fade" id="instituionsModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
            <div class="modal-header col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Institutions</h4>
            </div>
            <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'institutions-form',
                    'enableClientValidation'=>true,
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
<script>
    function ConfirmDelete(id)
    {
        var x = confirm("Are you sure you want to delete Institutions?");
        if (x)
        {
            var institution="institution";
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('site/deleteins') ?>',
                type: 'post',
                data: {'id': id},
                dataType: "json",
                success: function (data) {
                    //console.log(obj);
                    $("#row_"+id).remove();
                    $.notify("Institution deleted succesfully", "success");
                }
            });
        }
        else
        {
            return false;
        }
    }
</script>