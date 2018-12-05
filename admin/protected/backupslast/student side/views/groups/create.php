<section id="wrapper" >

    <div class="container">

        <div class="user-institute">

            <!--<p>You are here: <a href="<?=Yii::app()->session['homeurl']?>">Home</a> /
                <a href="#">Create Group</a></p>-->

        </div>

    </div>

    <div class="container-fluid user-assessment row">

        <p>Create Groups</p>

    </div>

    <div class="container">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</section>