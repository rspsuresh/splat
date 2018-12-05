
<?php

/* @var $this GroupsdumController */
/* @var $model Groupsdum */

$this->breadcrumbs=array(
	'Groupsdums'=>array('index'),
	'Create',
);


$this->menu=array(
	array('label'=>'List Groupsdum', 'url'=>array('index')),
	array('label'=>'Manage Groupsdum', 'url'=>array('admin')),
);
?>

<h1>Create Groupsdum</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
