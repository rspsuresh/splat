<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jqueryui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/jqueryui/jquery-ui.min.css">
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="#"><?php echo ucfirst($projects->name); ?></a></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p><?php echo ucfirst($projects->name); ?></p>
    </div>
    <div class="container">
        <div class="user-description col-lg-12 padzero">
            <h6>Description</h6>
            <p><?php echo $projects->description?></p></div>
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero user-staff">
            <div class="col-lg-6 col-xs-12 col-sm-6 padzero">
                <div class="staff">
                    <h6>Staff</h6>
                    <p><input type="text" id="staff" value="<?php echo ucfirst($projects->faculty0->name)?>" size="40" readonly style="border:none;">
                        <input type="hidden" id="staffhidden" value="<?php echo $projects->faculty?>" size="40" readonly style="border:none;">
                        <span style="float:right;margin-right:50px;"><i class="fa fa-check" aria-hidden="true" id="staffcheck"
                                                                        onclick="check('staff')"
                                                                        style="display:none;"></i>
											<i class="fa fa-pencil staffp" aria-hidden="true" onclick="pencil('staff')" ></i>
                            <i class="fa fa-times" aria-hidden="true" id="stafftimes" onclick="times('staff')" style="display:none;"></i></span></p>
                </div>
                <div class="staff">
                    <h6>Assessment Settings</h6>
                    <p><?php echo ucfirst($projects->faculty0->name); ?></p>
                </div>
                <div class="staff">
                    <h6>Assessment Due date:</h6>
                    <p><input type="text" id="due" class="datepicker" value="<?php echo date('d-M-Y',strtotime($projects->assess_date)); ?>" size="40" readonly style="border:none">
                        <input type="hidden" id="duehidden" value="<?php echo $projects->id ?>">
                        <span style="float:right;margin-right:50px;"><i class="fa fa-check" aria-hidden="true"
                                                                        id="duecheck" onclick="check('due')"
                                                                        style="display:none"></i>
											<i class="fa fa-pencil due" aria-hidden="true" onclick="pencil('due')" ></i>
                            <i class="fa fa-times" aria-hidden="true" id="duetimes" onclick="times('due')" style="display:none;"></i></span></p>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6 staff-due">
                <h6>My Group</h6>
                <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                    <?php
                    if(count($groupUsers)>0):
                        foreach($groupUsers as $groupUser):
                            $iquestions = Questions::model()->count('course='.$projects->course);
                            $iassess = Assess::model()->count('project='.$projects->id.' and from_user='.$groupUser->user_id);
                            $icomments = AssessComments::model()->count('project='.$projects->id.' and from_user='.$groupUser->user_id);
                            $class = 'exclamation';
                            if($iassess>=$iquestions && $icomments>0)
                                $class = 'check';
                            ?>
                            <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                                <div class="col-lg-6 col-xs-6 col-sm-6 padzero">
                                    <p><?php echo ucfirst($groupUser->user->first_name); ?>
                                </div>
                                <div class="col-lg-6 col-xs-6 col-sm-6 padzero">
                                    <p><i class="fa fa-<?php echo $class;?>" aria-hidden="true"></i></p>
                                </div>
                            </div>
                        <?php endforeach; else: ?>
                        <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
                            <div class="col-lg-6 col-xs-6 col-sm-6 padzero">
                                <p>No users assigned.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--<a href="<?php echo Yii::app()->createUrl('site/assessment',array('id'=>$projects->id)); ?>" class="add-course pull-left">Assess</a>-->
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
            <h1 class="text-center response">Responses</h1>
            <div class="bs-example">
                <div class="panel-group" id="accordion">
                    <?php
                    if(count($groupUsers)>0):
                        $u = 0;
                        foreach($groupUsers as $groupUser):
                            $u++;
                            ?>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?php echo $groupUser->id;?>">
                                            <?php

                                            echo 'By '.$groupUser->user->first_name;
                                            ?>
                                            <i class="fa fa-angle-down pull-right blue-clr" aria-hidden="true"></i></a>
                                    </h4>
                                </div>
                                <div id="collapseOne_<?php echo $groupUser->id;?>" class="panel-collapse collapse <?php if($u==1) echo 'in'; ?>">
                                    <div class="panel-body">
                                        <div class="script-texts">
                                            <?php
                                            $iquestions = Questions::model()->findAll('course='.$projects->course);
                                            $icomments = AssessComments::model()->find('project='.$projects->id.' and from_user='.$groupUser->user_id);

                                            $i=0;
                                            foreach($iquestions as $iquestion):
                                                $i++;
                                                $iassess = Assess::model()->find('project='.$projects->id.' and from_user='.$groupUser->user_id.' and question='.$iquestion->id);
                                                ?>
                                                <p class="m-t-10"><?php echo $i;?>. <?php echo $iquestion->question;?> : <?php if(count($iassess)>0) echo $iassess->value; else echo '-'; ?></p>
                                                <?php
                                            endforeach;
                                            ?>
                                            <div class="m-t-10">
                                                <p>Comments:</p>
                                                <p class="cmt-color"><?php if(count($icomments)>0) echo $icomments->comments; else echo '-';?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; else: ?>
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
</section>
<script>
    $( document ).ready(function() {
        $('.datepicker').each(function(){
            $(this).datepicker({
                dateFormat : 'yy-mm-dd'
            });
        });
    });
    function pencil(id)
    {
        if(id=='staff')
        {
            $('.staffp').hide();
            $("#staff").attr("readonly", false).css("border","1px solid gray");
            $("#stafftimes,#staffcheck").show();
        }
        else if(id=='due')
        {
            $("#due").val('');
            $('.due').hide();
            $("#due").attr("readonly", false).css("border","1px solid gray");
            $("#duetimes,#duecheck").show();
        }
    }
    function check(id)
    {
        var url='<?php echo Yii::app()->createUrl('site/assespage') ?>';
        if($("#"+id).val())
        {
            $.ajax({
                url:url,
                type: 'post',
                data: {name: $("#"+id).val(),type:id,hidden:$("#"+id+"hidden").val()},
                dataType:'json',
                success: function (data) {
                    if(id=='staff')
                    {
                        $('#staff').val(data).css("border","none");
                        $("#staffcheck,#stafftimes").hide();
                        $(".staffp").show();
                        $.notify("Faculty name changed succesfully", "success");
                    }
                    else if(id=='due')
                    {
                        $('#due').val(data).css("border","none");
                        $("#duecheck,#duetimes").hide();
                        $(".due").show();
                        $.notify("Assessment date changed succesfully", "success");

                    }
                }
            });
        }

    }
    function times(id)
    {       $('#'+id).css("border","none");
        if(id=='staff')
        {

            $("#staffcheck,#stafftimes").hide();
            $(".staff").show();
        }
        else if(id=='ln')
        {
            $("#lncheck,#lntimes").hide();
            $(".lnpencil").show();
        }

    }

</script>