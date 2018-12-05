<?php
/* @var $this ProjectGroupsController */
/* @var $model ProjectGroups */

$this->breadcrumbs=array(
	'Project Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProjectGroups', 'url'=>array('index')),
	array('label'=>'Create ProjectGroups', 'url'=>array('create')),
	array('label'=>'Update ProjectGroups', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProjectGroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectGroups', 'url'=>array('admin')),
);
?>

<h1>View ProjectGroups #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'group_id',
	),
)); ?>
