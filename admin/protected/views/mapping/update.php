<?php
/* @var $this MappingController */
/* @var $model Mapping */

$this->breadcrumbs=array(
	'Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mapping', 'url'=>array('index')),
	array('label'=>'Create Mapping', 'url'=>array('create')),
	array('label'=>'View Mapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mapping', 'url'=>array('admin')),
);
?>

<h1>Update Mapping <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>