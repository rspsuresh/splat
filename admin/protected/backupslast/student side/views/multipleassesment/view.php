
<?php

/* @var $this MultipleassesmentController */
/* @var $model Multipleassesment */

$this->breadcrumbs=array(
	'Multipleassesments'=>array('index'),
	$model->id,
);


$this->menu=array(
	array('label'=>'List Multipleassesment', 'url'=>array('index')),
	array('label'=>'Create Multipleassesment', 'url'=>array('create')),
	array('label'=>'Update Multipleassesment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Multipleassesment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Multipleassesment', 'url'=>array('admin')),
);
?>

<h1>View Multipleassesment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'prj_id',
		'due_date',
		'created_date',

	),
)); ?>
