<?php
/* @var $this GroupmasterController */
/* @var $model Groupmaster */

$this->breadcrumbs=array(
	'Groupmasters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Groupmaster', 'url'=>array('index')),
	array('label'=>'Create Groupmaster', 'url'=>array('create')),
	array('label'=>'Update Groupmaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Groupmaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Groupmaster', 'url'=>array('admin')),
);
?>

<h1>View Groupmaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'g_name',
		'created_by',
		'status',
	),
)); ?>
