
<?php

/* @var $this MultipleassesmentController */
/* @var $model Multipleassesment */

$this->breadcrumbs=array(
	'Multipleassesments'=>array('index'),
	'Create',
);


$this->menu=array(
	array('label'=>'List Multipleassesment', 'url'=>array('index')),
	array('label'=>'Manage Multipleassesment', 'url'=>array('admin')),
);
?>

<h1>Create Multipleassesment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
