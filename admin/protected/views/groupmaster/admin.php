<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#groupmaster-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Groups</b></p>
		</div>
	</div>
	<div class="container-fluid user-assessment">
		<p>Manage Groups</p>
	</div>
	<div class="container">
		<?php echo CHtml::link('Add a Group', Yii::app()->createUrl('groupmaster/create'),array('class'=>'admin-btn btn btn-info')); ?>
		<?php echo CHtml::link('Create Mapping', Yii::app()->createUrl('groupmaster/mapping'),array('class'=>'admin-btn btn btn-info')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'groupmaster-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'g_name',
		   array(
                    'header' => 'created_by',
                    'filter' => CHtml::dropDownlist('GroupMaster[created_by]', $model->created_by, CHtml::listData(Users::model()->findAll(), "id", "first_name"), array('empty' => 'Select')),
                    'value'=>'$data->create->name',
                ),
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</section>
