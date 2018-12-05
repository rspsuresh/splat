<?php
/* @var $this UsersController */
/* @var $model Users */
?>
<style>
    .save-btn
    {
        color: white !important;
        font-size: 18px !important;
    }
</style>
<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
?>
<section id="wrapper" >
	<div class="container">
		<div class="user-institute">
            <?php  if(Yii::app()->user->getState('role')=='Superuser')
            { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a> /
                    <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> / <b><?php echo ucfirst($course->name); ?></b></p>
            <?php }
            else { ?>
                <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/faculties',array('i'=>base64_encode($institution->id)));?>">Faculties</a>
                    / <a href="<?php echo Yii::app()->createUrl('site/courses',array('i'=>base64_encode($institution->id),'f'=>base64_encode($faculty->id)));?>">
                        <?php echo ucfirst($faculty->name);?></a> / <b><?php echo ucfirst($course->name); ?></b></p>
            <?php } ?>
			<!--<p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Home</a> / <b>Add Users to course</b></p>-->
		</div>
	</div>
	<div class="container-fluid user-assessment">
		<p>Add a User to course</p>
	</div>
	<div class="container">
		<br/><?php $this->renderPartial('_cform', array('model'=>$model)); ?>
	</div>
</section>
<script>
    $('#Users_username').on('blur', function() {
        console.log(this.value)
        if(this.value !='')
        {
            $.ajax({
                url: "<?php echo Yii::app()->createUrl('groupusers/usercheck') ?>",
                type: "post",
                data: {emailid:this.value.trim()},
                success: function (result) {
                    var result=JSON.parse(result);
                    if (result.status=="Y") {
                       $("#Users_first_name").val(result.firstname);
                       $("#Users_last_name").val(result.lastname);
                       $("#Users_password").val(result.password);
                    }
                    else
                    {

                    }

                }
            });
        }

    });
</script>