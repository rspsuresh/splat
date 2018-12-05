<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
			<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Mapping</b></p>
		</div>
	</div>
	<div class="container-fluid user-assessment">
		<p>Mapping</p>
	</div>
	<div class="container">
		<br/><?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</section>
<script>
$(function()
{
   $("#Mapping_user_id").chosen();
});
</script>