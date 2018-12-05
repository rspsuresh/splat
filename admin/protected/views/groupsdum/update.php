
<?php

/* @var $this GroupsdumController */
/* @var $model Groupsdum */

$this->breadcrumbs=array(
	'Groupsdums'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);


$this->menu=array(
	array('label'=>'List Groupsdum', 'url'=>array('index')),
	array('label'=>'Create Groupsdum', 'url'=>array('create')),
	array('label'=>'View Groupsdum', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Groupsdum', 'url'=>array('admin')),
);
?>

<h1>Update Groupsdum <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>