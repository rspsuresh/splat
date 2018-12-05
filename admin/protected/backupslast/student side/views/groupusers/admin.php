<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#group-users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Manage Group Users</b></p>
		</div>
	</div>
	<div class="container-fluid user-assessment row">
		<p>Manage Group Users</p>
	</div>
	<div class="container">
		<?php echo CHtml::link('Back', Yii::app()->createUrl('site/courseitems',array('c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])),array('class'=>'admin-btn btn btn-info')); ?>
		<?php echo CHtml::link('Add a Group User', Yii::app()->createUrl('groupusers/create',array('id'=>$_GET['id'],'c'=>$_GET['c'],'f'=>$_GET['f'],'i'=>$_GET['i'])),array('class'=>'admin-btn btn btn-info')); ?>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'group-users-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'id',
				array(
					'header'=>'User',	
					'value'=>'$data->user->first_name'
				),
				array(
					'class'=>'CButtonColumn',
                    'template'=>'{viewanswers}',
					'buttons'=>array
					(
						'viewanswers' => array
						(
							'label'=>'View Feedback',
							'url'=>'Yii::app()->createUrl("site/projectquestions",array("id"=>$data->group_id,"g"=>$data->group_id,"u"=>$data->user_id,"c"=>$_GET["c"]))',
						),
					),
				),
				array(
					'class'=>'CButtonColumn',
                    'template'=>'{delete}'
				),
			),
		)); ?>	</div>
</section>