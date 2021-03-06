<style>
    input,
    input::-webkit-input-placeholder {
        font-size:0.9em;
    }
    select option
    {
        font-size: 14px !important;
    }
    .view>img{width:16px;height: 16px}
    /*.footer-sec{*/
    /*    bottom:auto !important;*/
    /*}*/
</style>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage All Staffs</b></p>
            <?php }
            else { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage All Users</b></p>
            <?php } ?>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage All Staffs</p>
    </div>
    <div class="container">
        <a class="admin-btn btn btn-success"  onclick="searchdiv()" id="searchbutton" href="#">Advanced Search</a>
        <a class="admin-btn btn btn-danger" style="visibility: hidden" onclick="deleteuser()" id="deletebutton" href="#">Delete users</a>
        <?php //echo CHtml::link('Bulk Import Users',Yii::app()->createUrl('users/create'),array('class'=>'admin-btn btn btn-warning')); ?>
        <div class="search-form" >
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div><!-- search-form -->

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'users-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                array(
                    'name' => 'check',
                    'id' => 'selectedIds',
                    'value' => '$data["id"]',
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => '100',
                    'headerHtmlOptions' => array("class" => "", 'onchange' => "fn_onclick();"),
                    'htmlOptions' => array("class" => "", 'onchange' => "fn_onclick();"),
                ),
                /*'first_name',
                'last_name',
                'username',*/
                array(
                    'header' => 'First Name',
                    'filter' => CHtml::textField('Users[first_name]', $model->first_name,array('placeholder'=>'Enter first name','class'=>'form-control')),
                    'value'=>function($data)
                    {
                        return $data->first_name;
                    },
                ),
                array(
                    'header' => 'Last Name',
                    'filter' => CHtml::textField('Users[last_name]', $model->last_name,array('placeholder'=>'Enter last name','class'=>'form-control')),
                    //'value'=>'$data->courses->name',
                    'value'=>function($data)
                    {
                        return $data->last_name;
                    },
                ),
                array(
                    'header' => 'Email',
                    'filter' => CHtml::textField('Users[email]', $model->username,array('placeholder'=>'Enter  email','class'=>'form-control')),
                    //'value'=>'$data->courses->name',
                    'value'=>function($data)
                    {
                        return $data->email;
                    },
                ),
                array(
                    'header' => 'Course',
                    'filter' => CHtml::dropDownlist('Users[course_id]', $model->course_id, CHtml::listData(Courses::model()->findAll(), "id", "name"),
                        array('empty' => 'Select','style'=>'display:none;','class'=>'form-control')),
                    //'value'=>'$data->courses->name',
                    'value'=>function($data)
                    {
                        //echo "<pre>";print_r($data);die;
                        return Users::courses($data->course_id);
                    },
                ),
                array(
                    'header'=>'Role',
                    'filter' => CHtml::dropDownlist('Users[role]', $model->role, CHtml::listData(Userrole::model()->findAll("s_name!='Student'"), "id", "s_name"), array('empty'=>'select','class'=>'form-control')),
                    'value'=>'$data->roles->s_name'
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}',
                    'buttons'=>array
                    (

                        'update' => array
                        (
                            'visible'=> '$data->role !=1',
                            'url'=>'$this->grid->controller->createUrl("/users/updatestaff", array("type"=>"staff","id"=>$data->id,"i"=>base64_encode($data->institution_id)))',
                        ),
                        'view'=>array(
                            'label'=>'View staff/admin',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/eye.png',
                            'class'=>'eyeicon'
                        )
                    ),
                ),
            ),
        )); ?>
    </div>
</section>
<script>
    $(document).on('click','#users-grid_c0_all',function(){
        //var items = $('#users-grid').yiiGridView('getChecked', '#users-grid_c0')
        var items = $('#users-grid').yiiGridView('getSelection');
        console.log(items);
    });
    $(document).on('click','#reset',function(){
        $('.form-control').val('');
        var id='users-grid';
        var inputSelector='#'+id+' .filters input, '+'#'+id+' .filters select';
        $(inputSelector).each( function(i,o) {
            $(o).val('');
        });
        var data=$.param($(inputSelector));
        $.fn.yiiGridView.update(id, {data: data});
        return false;
    });
    function searchdiv()
    {
        $('.wide').toggle();
    }
    function fn_onclick() {
        var cid = $.fn.yiiGridView.getChecked("users-grid", "selectedIds").toString();
        if (cid != '') {
            $("#deletebutton").css('visibility', 'visible');
        }
        else {
            $("#deletebutton").css('visibility', 'hidden');
        }
    }
    function deleteuser() {
        var $id = $.fn.yiiGridView.getChecked("users-grid", "selectedIds").toString();
        if (confirm("Are you want to delete the selected users?")) {
            $.ajax({
                url: "<?php echo Yii::app()->createUrl('users/deletemultiple') ?>",
                type: "post",
                data: {id: $id},
                success: function (result) {
                    var result=JSON.parse(result);
                    if(result.flag="S")
                    {
                        $.notify("Deleted Successfully","success");
                        $.fn.yiiGridView.update('users-grid');
                        $("#deletebutton").css('visibility', 'hidden');
                    }
                    else
                    {
                        $.notify("Something went wrong .please try again after some time","danger");
                    }
                }
            });
        }
        else {
            alert("Please minimum one row");
        }
    }
</script>