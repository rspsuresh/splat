
<?php

/* @var $this MultipleassesmentController */

/* @var $model Multipleassesment */



$this->breadcrumbs=array(

	'Multipleassesments'=>array('index'),

	$model->id=>array('view','id'=>$model->id),

	'Update',

);



$this->menu=array(

	array('label'=>'List Multipleassessment', 'url'=>array('index')),

	array('label'=>'Create Multipleassesment', 'url'=>array('create')),

	array('label'=>'View Multipleassesment', 'url'=>array('view', 'id'=>$model->id)),

	array('label'=>'Manage Multipleassesment', 'url'=>array('admin')),

);

?>



<h1>Update Multipleassessment <?php echo $model->id; ?></h1>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>