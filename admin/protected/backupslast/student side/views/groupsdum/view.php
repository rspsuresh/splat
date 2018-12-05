
<?php

/* @var $this GroupsdumController */
/* @var $model Groupsdum */

$this->breadcrumbs=array(
	'Groupsdums'=>array('index'),
	$model->name,
);


$this->menu=array(
	array('label'=>'List Groupsdum', 'url'=>array('index')),
	array('label'=>'Create Groupsdum', 'url'=>array('create')),
	array('label'=>'Update Groupsdum', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Groupsdum', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Groupsdum', 'url'=>array('admin')),
);
?>

<h1>View Groupsdum #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'course_id',
		'status',
		'created_date',
		'updated_date',

	),
)); ?>
