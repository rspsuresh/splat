<?php
/* @var $this ProjectGroupsController */
/* @var $model ProjectGroups */

$this->breadcrumbs=array(
	'Project Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectGroups', 'url'=>array('index')),
	array('label'=>'Manage ProjectGroups', 'url'=>array('admin')),
);
?>

<h1>Create ProjectGroups</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>