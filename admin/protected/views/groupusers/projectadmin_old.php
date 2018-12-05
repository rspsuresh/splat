<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#group-users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>

input[type="radio"] {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 30px;
  border-radius: 100%;
  outline: none !important;
  -webkit-appearance: none;
}
input[type="radio"]::before {
  position: relative;
 top: -8px;
    left: -12px;
  display: block;
  content: '';
  background: white;
  border: 1px solid rgba(128, 128, 128, 0.4);
  border-radius: 100%;
  -webkit-box-shadow: inset 0 0.1em 1px -0.1em rgba(0, 0, 0, 0.3);
          box-shadow: inset 0 0.1em 1px -0.1em rgba(0, 0, 0, 0.3);
  width: 32px;
  height: 32px;
}
input[type="radio"]:active::before {
  -webkit-box-shadow: inset 0 0.1em 1px -0.1em rgba(0, 0, 0, 0.3), inset 0 0 2px 3px rgba(0, 0, 0, 0.1);
          box-shadow: inset 0 0.1em 1px -0.1em rgba(0, 0, 0, 0.3), inset 0 0 2px 3px rgba(0, 0, 0, 0.1);
}
input[type="radio"]:focus::before {
  -webkit-box-shadow: inset 0 0.1em 1px -0.1em rgba(0, 0, 0, 0.3), 0 0 0 2px rgba(30, 144, 255, 0.5);
          box-shadow: inset 0 0.1em 1px -0.1em rgba(0, 0, 0, 0.3), 0 0 0 2px rgba(30, 144, 255, 0.5);
}
input[type="radio"]:checked::before {
  background: #a5d3ff;
  border-color: dodgerblue;
}
input[type="radio"]:disabled::before {
  cursor: not-allowed;
  background-color: #eaeaea;
  border-color: rgba(128, 128, 128, 0.2);
}
input[type="radio"]::after {
  position: relative;
  top: -17px;
  left: 15px;
  display: block;
  content: '';
  background: dodgerblue;
  border-radius: 100%;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  width: 0;
  height: 0;
}
input[type="radio"]:checked::after {
  -webkit-transition: all ease-in-out 100ms 0;
  transition: all ease-in-out 100ms 0;
    top: -33px;
    left: -5px;
    width: 18px;
    height: 18px;
}
input[type="radio"]:disabled::after {
  background: #cccccc;
}
label {
  font-size: 2.5em;
  display: block;
}

input + input {
  margin-left: .5em;
}
div.form label {
    font-weight: bold;
    font-size: 12px;
    display: block;
}
.radio-text{
    margin-left: -7px;
}
</style>

<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Project Groups</b></p>
		</div>
	</div>
	<div class="container-fluid user-assessment row">
		<p>Manage Project Groups</p>
	</div>
	<div class="container">
		<?php echo CHtml::link('Back', Yii::app()->createUrl('site/courseitems',array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])),array('class'=>'admin-btn btn btn-info')); ?>
		<?php echo CHtml::link('Add group to Project', Yii::app()->createUrl('groups/create',array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'],'p'=>base64_encode($_GET['id']))),array('class'=>'admin-btn btn btn-info')); ?>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'project-groups-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				//'id',
				array(
					'header'=>'Group',	
					'value'=>'$data->groups->name'
				),
				array(
					'header'=>'Action',
					'class'=>'CButtonColumn',
                    'template'=>'{viewuser}',
					'buttons'=>array
					(
						'viewuser' => array
						(
							'label'=>'View Users',
							'url'=>'Yii::app()->createUrl("groupusers/admin",array("id"=>$data->group_id,"c"=>$_GET["c"],"i"=>$_GET["i"],"f"=>$_GET["f"]))',
						),
					),
				),
			),
		)); ?>	</div>
</section>
<section style="min-height:460px"><div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Project Groups</b></p>
		</div>
	</div>
	<div class="container-fluid user-assessment row">
		<p>Manage Project Groups</p>
	</div>
    <style>
        .btn
        {
            background-color:#00B9D1;
            color:#fff;
        }
    </style>

    <div class="container">
        <!--<div  class="col-lg-12" data-toggle="buttons">
            <a  class="btn  active">
                <input type="radio" />Prices
            </a>
            <a  class="btn " >
                <input type="radio" />Features
            </a>
            <a  class="btn" >
                <input type="radio" />Requests
            </a>
            <a  class="btn">
                <input type="radio" />Contact
            </a>
            <a  class="btn">
                <input type="radio" />Prices
            </a>
            <a  class="btn" >
                <input type="radio" />Features
            </a>
            <a  class="btn" >
                <input type="radio" />Requests
            </a>
            <a  class="btn">
                <input type="radio" />Contact
            </a>
        </div>-->
        <div class="form">
            <form id="group-users-form" action="/splat/admin/groupusers/create/3?c=MQ%3D%3D&amp;f=MQ%3D%3D&amp;i=MQ%3D%3D" method="post">	<br><br>	<div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">

                    <div class="col-lg-2 padzero">
                        <label for="GroupUsers_user_id" class="required">User <span class="required">*</span></label>		</div>
                    <div class="col-lg-10 padzero">
                        <?php $grp=ProjectGroups::model()->with('groups')->findAll('project_id=1');
                         foreach($grp as $val)
                         {

echo '<div class="col-lg-1"><input name="radio" class="radio" type="radio" value="'.$val->group_id.'" id="LoginForm_attribute" name="LoginForm[attribute]" checked="checked"><label class="radio-text">'.$val->groups->name.'</label></div>';


                         }
                        ?>
                        <select class="chosen-select" multiple="multiple" name="GroupUsers[user_id][]" id="GroupUsers_user_id" style="display: none;">

                            <option value="">Select User</option>
                            <option value="1">Dhamuu</option>
                            <option value="2">Lokesh</option>
                            <option value="33">Import</option>
                            <option value="34">Import2</option>
                            <option value="27">Fynd</option>
                            <option value="36">Dhamu</option>
                            <option value="37">Dhamu</option>
                            <option value="38">Dhamu</option>
                            <option value="39">Userpage</option>
                        </select><div class="chosen-container chosen-container-multi" style="width: 760px;" title="" id="GroupUsers_user_id_chosen"><ul class="chosen-choices"><li class="search-field"><input value="Select Some Options" class="default" autocomplete="off" style="width: 149px;" type="text"></li></ul><div class="chosen-drop"><ul class="chosen-results"><li class="active-result" style="" data-option-array-index="0">Select User</li><li class="active-result" style="" data-option-array-index="1">Dhamuu</li><li class="active-result" style="" data-option-array-index="2">Lokesh</li><li class="active-result" style="" data-option-array-index="3">Import</li><li class="active-result" style="" data-option-array-index="4">Import2</li><li class="active-result" style="" data-option-array-index="5">Fynd</li><li class="active-result" style="" data-option-array-index="6">Dhamu</li><li class="active-result" style="" data-option-array-index="7">Dhamu</li><li class="active-result" style="" data-option-array-index="8">Dhamu</li><li class="active-result" style="" data-option-array-index="9">Userpage</li></ul></div></div>
                        <div class="errorMessage" id="GroupUsers_user_id_em_" style="display:none"></div>
                    </div>

                    <div class="col-lg-2">
                        <label for="GroupUsers_user_id" class="required">Users <span class="required">*</span></label></div>
                    </div>
                   <div class="col-lg-10">

                   </div>
                </div>
                <div class="row buttons">
                    <input class="save-btn" name="yt0" value="Create" type="submit">	</div>
            </form></div><!-- form -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
        <script>
            $(function(){
                $('.chosen-select').chosen({}).change( function(obj, result) {
                    console.debug("changed: %o", arguments);

                    console.log("selected: " + result.selected);
                });

            });

        </script>	</div>
</section>
