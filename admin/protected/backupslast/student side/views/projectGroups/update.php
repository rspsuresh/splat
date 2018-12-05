<?php
/* @var $this ProjectGroupsController */
/* @var $model ProjectGroups */

$this->breadcrumbs=array(
	'Project Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectGroups', 'url'=>array('index')),
	array('label'=>'Create ProjectGroups', 'url'=>array('create')),
	array('label'=>'View ProjectGroups', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProjectGroups', 'url'=>array('admin')),
);
?>

<h1>Update ProjectGroups <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>