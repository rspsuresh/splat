<?php
$this->pageTitle=Yii::app()->name;
?>
<style>
    .container-fluid.bg-color {
        background-color: #00c4ff;
        padding:40px 0px;
        margin-bottom:22px;
        opacity:0.9;
    }
    .head-bg{margin-bottom:0px;}
    .bg-text{
        color: #ffffff;
        font-size: 37px;
        font-weight: bold;
        text-align: center;
    }
    .oppo-color{
        color:#5FFC7B;
    }
    .production{
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        padding: 20px 0 0;
    }
    .recent {

        margin-top: 60px;
        padding: 0;
    }
    .font-normal{
        font-family:"Conv_helveticaneuecyr-roman" !important;
        font-weight:bold !important;
        color:#337AB7 !important;
        font-size:22px !important;
    }
    .home-menu {
        margin-top: 20px;
        margin-right: 90px;
    }
    .footer-sec {
        bottom: auto !important;

    }
    .fa
    {
        color: #ffffff;
    }
    .home-menu
    {
        margin-right: 20px;
    }
    .mo{
        margin:0px;
    }
    @media screen and (max-width:768px)
    {
        .footer-sec
        {
            bottom: 0px !important;
            position: absolute;
        }
    }
</style>
<style>
    .fullbg{
        background-image: url(/images/Asses.jpg);
        display:block;
        width:100%;
        height:500px;
    }
    .container-fluid.bg-color1 {
        background-color: rgb(242, 242, 242);

        margin-top: 150px;
        width: 500px;
    }
    .container-fluid.bg-color2 {
        background-color: rgb(242, 242, 242);

        margin-top: 15px;
        width: 610px;
    }
    .welcome
    {
        font-size: 30px;
        text-align: center;
    }
    .welcomeforp
    {
        text-align: center;
        font-size:20px
    }
    .containers >p
    {
        margin:0px !important;
    }
    .container-fluid.bg-color2>.containers
    {
        padding:5px;
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
      integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<section id="wrapper" style="height:auto;">
<div class="container fullbg">
    <div class="container-fluid bg-color1">
        <div class="containers">
            <h4 class="welcome"> Welcome <span class="oppo-color">
                                             <?php echo ucwords(Yii::app()->session['user']->first_name." ".Yii::app()->session['user']->last_name)?></span></h4>
        </div>
    </div>
    <div class="container-fluid bg-color2">
        <div class="containers">
            <p class="welcomeforp">You have admin permissions. You can manage faculties, courses, projects, groups and all the users.</p>
        </div>
    </div>
</div>
    <!--<div class="container-fluid bg-color">
        <div class="container">
            <p class="text-center bg-text">Welcome  <span class="oppo-color">
                                             <?php echo ucwords(Yii::app()->session['user']->first_name." ".Yii::app()->session['user']->last_name)?></span></p>
            <p class="text-center production">You have admin permissions. You can manage faculties, courses, projects, groups and all the users. </p>
        </div>
    </div>-->
    <div class="container">
        <div class="admin-home">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Admin Home</a></p>
        </div>
        <div class="row padzero" style="margin-bottom: 5pc">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 padzero home-menu text-center">
                <?php
                $ins_user=Users::model()->findByPk(Yii::app()->session['id']);
                $insbs64=base64_encode($ins_user->institution_id);?>
                <a href="<?php echo Yii::app()->createUrl("site/faculties?i=$insbs64"); ?>">
                    <p class="mo"><i class="fas fa-book"></i></p>
                    Manage Faculty / Courses</a>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-4 padzero home-menu text-center ">
                <a href="<?php echo Yii::app()->createUrl('users/admin'); ?>" style="padding: 16% 8% !important;">
                    <p class="mo"><i class="fas fa-users-cog"></i></p>
                    Manage all Users</a>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 padzero home-menu text-center">
                <a href="<?php echo Yii::app()->createUrl('questionsadmin/admin'); ?>">
                    <p class="mo"><i class="fa fa-question-circle" aria-hidden="true"></i></p>
                    Manage Default Questions</a>
            </div>
        </div>
    </div>
</section>
<script>
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
</script>