<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
$project = Projects::model()->findByPk($_GET['p']);
?>
<style>
    .row-inactive
    {
        color:orangered;
    }
    .row-active
    {
        color:#00b6e2;
    }
    .btn
    {
        background-color:#00B9D1;
        color:#fff;
    }
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
    .float-left
    {

        float:left !important;
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
    .mydiv
    {
        padding:10px;
    }
    .text-align
    {
        text-align:center;
    }
</style>
<section style="min-height:460px">
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> /
                    <a href="<?=Yii::app()->createUrl('site/courseitems',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f']))?>"><?php echo ucfirst($course->name); ?></a>
                    / <b><?=$project->name?></b>
                </p>
            <?php }
            else { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a>
                    / <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> / <b><?php echo ucfirst($course->name); ?></b></p>
            <?php } ?>
            <!--<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Project Groups</b></p>-->
        </div>
    </div>
    <div class="container-fluid user-assessment row">
        <?php $project=Projects::model()->findByPk($_GET['id']);
        ?>
        <p><?= $project->name?></p>
    </div>
    <div class="container">
        <?php
        Yii::app()->clientScript->registerScript('search', "
                            $('.search-button').click(function(){
                                $('.search-form').toggle();
                                return false;
                            });
                            $('.search-form form').submit(function(){
                                $('#groupsdum-grid').yiiGridView('update', {
                                    data: $(this).serialize()
                                });
                                return false;
                            });
                            ");
        ?>
        <div class="mydiv" style="border:1px solid #00B9D1;border-radius:5px;margin-top:10px">
            <h1 class="common user-assessment" style="margin-top:0px !important;">Manage Groups</h1>
            <a href="<?= Yii::app()->CreateUrl('site/courseItems',array('i'=>$_GET['i'],'f'=>$_GET['f'],'c'=>$_GET['c']))?>">
                <button class="admin-btn btn-bs-file btn btn-info" style="margin: 0px" title="Back"> Back
                </button>
            </a>
            <a href="<?php echo Yii::app()->CreateUrl('groups/create',array('c'=>$_GET['c'],
                'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p']));?>">
                <button class="admin-btn btn-bs-file btn btn-info" style="margin: 0px" title="Back"> Add a Group
                </button>
            </a>
            <!--<a  class="download" href="#">
                <button class="admin-btn btn-bs-file btn btn-success" style="margin: 0px" title="Download"> Download Assessment Scores
                </button>
            </a>
            <a class="save-btn" style="text-decoration:none;cursor:pointer;margin-top:0% !important;float:right"
               href='<?php /*echo Yii::app()->CreateUrl('groups/create',array('c'=>$_GET['c'],
                   'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p']));*/?>'>Add a Group
            </a>-->
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'groupsdum-grid',
                'dataProvider'=>$grpmodel->search(),
                'template'=>'{items}{summary}{pager}',
                'columns'=>array(
                    array(
                        'name'=>'name',
                        'sortable'=>false,
                        'htmlOptions' => array('width' => '50%'),
                        //'headerOptions' => array('class' => 'text-center'),
                        //'filterHtmlOptions' => array('style' => 'width: 8%;'),
                        'value'=>function($data)
                        {
                            echo $data->name;
                        }
                    ),
                    array(
                        'header'=>'Action',
                        'sortable'=>false,
                        'type'=>'raw',
                        'htmlOptions' => array('width' => '50%','class'=>'text-align'),
                        "value" => 'Groups::Actionbuttonsgroups($data)'
                    )
                ),
            ));
            ?>
        </div>
        <br>
        <br>
        <div class="mydiv" style="border:1px solid #00B9D1;border-radius:5px;margin-top:10px;float:left;width:100%;">
            <h3 class="user-assessment" style="font-size: 18px !important;margin-top:0px">Assign users to the Group</h3>
            <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'group-users-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <br/><br/>
                <div class="col-xs-12 col-lg-8 col-sm-12 course-field padzero">
                    <div class="col-lg-2 padzero">
                        <label for="GroupUsers_user_id" class="required">Select Group <span class="required">*</span></label>		</div>
                    <div class="col-lg-10 padzero">
                        <?php echo $form->dropDownList($model, 'group_id',
                            CHtml::listData(ProjectGroups::model()->with('groups')->findAll('project_id='.$_GET['id'].' 
                        and groups.status="active"'), 'groups.id',
                                'groups.name'), array('class'=>'form-control','style'=>'height:44px','empty'=>'Select Group')); ?>
                        <?php echo $form->error($model,'group_id'); ?>
                        <?php $grp=ProjectGroups::model()->with('groups')->
                        findAll('project_id='.$_GET['id'].' and groups.status="active"');
                        ?>
                    </div>
                    <div class="col-lg-2 padzero">
                        <?php echo $form->labelEx($model,'user_id'); ?>
                    </div>
                    <div class="col-lg-10 padzero">
                        <?php
                        $list= Yii::app()->db->createCommand('SELECT GROUP_CONCAT(user_id) as user FROM `group_users` where group_id=13')->queryAll();
                        $data=$list[0]['user'];
                        //echo "<pre>";print_r($data);die;
                        $cond=(isset($list[0]['user']))? "and A.user_id not in($data)":'';
                        $c=base64_decode($_GET['c']);
                        $sql='SELECT A.*,concat(first_name," ",last_name) as name FROM `user_courses` as A left join users as B on B.id=A.user_id
                             WHERE A.course_id='.$c.' and B.role=5 and B.status="active" '. $cond;
                        $result=Yii::app()->db->CreateCommand($sql)->QueryAll();
                        ?>
                        <?php echo $form->dropDownList($model, 'user_id',
                            CHtml::listData($result,'user_id','name'), array('class'=>'chosen-select form-control','multiple' => 'multiple'));?>
                        <?php echo $form->error($model,'user_id'); ?>
                    </div>
                </div>
                <div class="col-lg-8 buttons">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Assign users' : 'Save', array('class'=>'save-btn')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div><!-- form -->
        </div>
        <br><br>
        <?php
        Yii::app()->clientScript->registerScript('search', "
                $('.search-button').click(function(){
                    $('.search-form').toggle();
                    return false;
                });
                $('.search-form form').submit(function(){
                    $('#multipleassesment-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                });
                ");
        ?>
        <div class="mydiv" style="border:1px solid #00B9D1;border-radius:5px;margin-top:50px;float:left;width:100%;">
            <h3 class="common user-assessment" style="font-size: 18px !important;margin-top:0px"><p>Manage Assessment points</p></h3>
            <p class="row-inactive">        <a href="#">
                    <span class="glyphicon glyphicon-info-sign"></span>
                </a> Please activate a point of assessment. Only one assessment can be active at a time</p>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'multipleassesment-grid',
                'dataProvider'=>$assesmodel->search(),

                'rowCssClassExpression'=>'$data->status=="I"?"row-inactive":"row-active"',
                'template'=>'{items}{summary}{pager}',
                'columns'=>array(
                    array(
                        'name' => 'id',
                        'header'=>'Assessment Point',
                        'sortable'=>false,
                        'htmlOptions'=>array('width'=>'40px'),
                        'value' => function ($data,$row) {
                            return "Assessment-".($row+1);
                        }
                    ),
                    array(
                        'name' => 'due_date',
                        'header'=>'Due Date',
                        'sortable'=>false,
                        'htmlOptions'=>array('width'=>'20px'),
                        'value' => function ($data) {
                            return  date('d-m-Y h:i',strtotime($data->due_date));
                        }
                    ),
                    array(
                        'header'=>'Action',
                        'type'=>'raw',
                        'htmlOptions'=>array('width'=>'40px'),
                        "value" => 'Multipleassesment::ActionButtons($data->id,$row+1)'
                    ),
                ),
            )); ?>
            <p>
                <a  class="download" href="#">
                    <button class="admin-btn btn-bs-file btn btn-success" style="margin: 0px" title="Download"> Download Assessment Scores
                    </button>
                </a>
            </p>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
        <script>
            $(function(){
                $('.chosen-select').chosen({}).change( function(obj, result) {});
            });
        </script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <style>
            thead th
            {
                background-color: #00B9D1 !important;
            }
        </style>
</section>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container">
    <button type="button" id="clickbutton" style="display:none;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
<div id="htmltable" style="display:none;">

</div>
<?php //print_r($_SESSION);die;?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jqueryui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/jqueryui/jquery-ui.min.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tabletoCSV.js"></script>
<style>
    .datepicker {
        z-index: 100000;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Multipleassesment_due_date').datepicker({ format: "yyyy/mm/dd" });
        //$("table").tableToCSV();
    });
</script>
<script type="text/javascript">
    function alternate(id,a)
    {
        var typeofstatus=$(a).attr('data-status');
        console.log(typeofstatus);
        if(typeofstatus =='I')
        {
            if(confirm('Are you sure you want to set the status to Inactive for this assessment? Students cannot view and submit feedbacks unless it is active.'))
            {
                $.ajax({
                    url: "<?php echo Yii::app()->createUrl('site/assesmentchange') ?>",
                    type: "post",
                    data:{asses:id},
                    success: function (result) {
                        var data=JSON.parse(result);
                        if(data.status)
                        {
                            $.fn.yiiGridView.update('multipleassesment-grid');
                            $.notify("Status changed succesfully", "success");
                            location.reload();
                        }
                    }
                });
            }
        }
        else if(typeofstatus =="A")
        {
            if(confirm('Are you sure you want to set the status to active for this assessment? Students can view and provide feedback.' +
                    '\n' +
                    '\n'))
            {
                var mycheck =$(".present").is(":visible");
                if(!mycheck)
                {
                    $.ajax({
                        url: "<?php echo Yii::app()->createUrl('site/assesmentchange') ?>",
                        type: "post",
                        data:{asses:id},
                        success: function (result) {
                            var data=JSON.parse(result);
                            if(data.status)
                            {
                                $.fn.yiiGridView.update('multipleassesment-grid');
                                $.notify("Status changed succesfully", "success");
                                location.reload();
                            }
                        }
                    });
                }
                else {
                    alert('Another assessment is already ‘Active’, please disable it or ‘Mark as complete');
                    return false;
                }
            }

        }

    }
    function deletegroup(id)
    {
        if(confirm('Are you sure you want to delete the group? All entries in the group will also be deleted.'))
        {
            $.ajax({
                url: "<?php echo Yii::app()->createUrl('groups/deletegroup') ?>/"+id,
                type: "post",
                data:{id:id},
                success: function (result) {
                    if(result =="S")
                    {
                        $.fn.yiiGridView.update('groupsdum-grid');
                        $.notify("Group deleted succesfully", "success");
                        location.reload();
                    }
                }
            });
        }
    }
    $(document).on('click','.download',function(){
        var groupid=$(this).attr('data-group');
        var url="<?= Yii::app()->CreateUrl('groupusers/download',array('c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],'p'=>$_GET['p']))?>";
        $.ajax({
            url: url,
            type: "get",
            success: function (result) {
                $("#htmltable").html(result);
                $("#resulttable").tableToCSV();
                return false;
            }
        });
        //window.location.href=url;
    });
    function complete(id)
    {
        if(confirm('Are you sure want to mark this assessment as complete?'))
        {
            $.ajax({
                url: "<?php echo Yii::app()->createUrl('site/assesmentcomplete') ?>",
                type: "post",
                data:{asses:id},
                success: function (result) {
                    var data=JSON.parse(result);
                    if(data.status)
                    {
                        $.fn.yiiGridView.update('multipleassesment-grid');
                        $.notify("Assessment Completed succesfully", "success");
                        location.reload();
                    }
                }
            });
        }
        else
        {
            return false;
        }

    }
    $(function () {
        $('#classModal').modal('show')
        $("td:empty").remove();
    });
    function openmodel(id)
    {
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('groupusers/viewusers') ?>/"+id,
            type: "post",
            data:{grp:id},
            success: function (result) {
                //var data=JSON.parse(result);
                if(result)
                {
                    $('.modal-title').text($("#"+id).data('grp'));
                    $("#clickbutton").trigger('click');
                    $(".modal-body").html(result);
                }
            }
        });

    }
    function unlock(userid,group_id,prj)
    {
        if(confirm("Are you sure you want to remove the user from the group? All the responses given by the user will be deleted."))
        {

            $.ajax({
                url: "<?php echo Yii::app()->createUrl('groupusers/unlockusers') ?>",
                type: "post",
                data:{userid:userid,grpid:group_id,project:prj},
                success: function (result) {
                    alert("User has been removed from the group");
                    $(".remove_"+userid).remove();
                }
            });
        }

    }
    function deleteasses(id)
    {
        if(confirm('Are you sure want to remove all data?')) {
            $.ajax({
                url: "<?php echo Yii::app()->createUrl('groupusers/deleteasses') ?>/" + id,
                type: "post",
                data: {asses: id},
                success: function (result) {
                    var result=JSON.parse(result);
                    if (result.status=="Y") {
                        $.notify("Assessment deleted successfully", "success");
                        $.fn.yiiGridView.update('multipleassesment-grid');
                        location.reload();
                    }
                    else
                    {
                        alert("something went wrong");
                    }
                }
            });
        }

    }

</script>