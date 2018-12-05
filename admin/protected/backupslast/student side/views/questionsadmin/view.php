<?php
/* @var $this QuestionsadminController */
/* @var $model Questionsadmin */

$this->breadcrumbs=array(
	'Questionsadmins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Questionsadmin', 'url'=>array('index')),
	array('label'=>'Create Questionsadmin', 'url'=>array('create')),
	array('label'=>'Update Questionsadmin', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Questionsadmin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Questionsadmin', 'url'=>array('admin')),
);
?>

<h1>View Questionsadmin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'type',
		'course',
		'institution',
		'faculty',
		'status',
	),
)); ?>
