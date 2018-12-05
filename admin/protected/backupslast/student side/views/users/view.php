
<section id="wrapper" >
    <div class="container">
        <div class="user-institute">
            <p>You are here:
                <a href="<?=Yii::app()->session['homeurl']?>">Home</a> /
                <a href="#" onclick="return window.history.back()">View User</a></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>View Users #<?php echo $model->id; ?></p>
    </div>

    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'id',
            'username',
            'password',
            'first_name',
            'last_name',
            'status',
            'created_date',
            'updated_date',
        ),
    )); ?>
    </div>
</section>
<!--<script type="text/javascript">
    $(function(){
        alert("ffrf");
        function home()
        {
            alert("fdbghfg");
        }
        function  manageusers()
        {
            alert("users");
        }
    });
</script>-->