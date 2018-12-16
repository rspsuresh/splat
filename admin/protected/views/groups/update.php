<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a>
                / <a href="<?php echo Yii::app()->createUrl('groups/admin'); ?>">Manage Groups</a></p>
        </div>	</div>	<div class="container-fluid user-assessment row">
        <p>Update <span id="groupidname"></span><?php //echo $model->id; ?></p>
    </div>	<div class="container">

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div></section>
<script>
    $(document).ready(function () {
       $("#groupidname").text($("#Groups_name").val());
    });
</script>