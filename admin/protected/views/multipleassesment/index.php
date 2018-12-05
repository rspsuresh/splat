
<?php

/* @var $this MultipleassesmentController */

/* @var $dataProvider CActiveDataProvider */



$this->breadcrumbs=array(

	'Multipleassesments',

);



$this->menu=array(

	array('label'=>'Create Multipleassesment', 'url'=>array('create')),

	array('label'=>'Manage Multipleassesment', 'url'=>array('admin')),

);

?>



<h1>Multipleassessments</h1>



<?php $this->widget('zii.widgets.CListView', array(

	'dataProvider'=>$dataProvider,

	'itemView'=>'_view',

)); ?>

