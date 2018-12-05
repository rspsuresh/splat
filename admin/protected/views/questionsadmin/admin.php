
<section id="wrapper12" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Default Questions</b></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Manage Questions</p>
    </div>
    <div class="container">
        <?php echo CHtml::link('Add a Question', Yii::app()->createUrl('questionsadmin/create'),array('class'=>'admin-btn btn btn-info')); ?>
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
      <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'questionsadmin-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'question',
		/*'type',*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
    </div>
</section>