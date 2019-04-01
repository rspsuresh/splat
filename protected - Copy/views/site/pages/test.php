
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/splat/admin/images/apple-icon-72x72.png" type="image/x-icon">
    <link rel="shortcut icon" href="/splat/admin/images/apple-icon-72x72.png" type="image/x-icon">
    <script type="text/javascript" src="/splat/admin/assets/541583f4/jquery.js"></script>
    <title>SPLAT</title>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="/splat/admin/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/splat/admin/css/print.css" media="print">
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="/splat/admin/css/ie.css" media="screen, projection">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/splat/admin/css/form.css">
    <link rel="stylesheet" href="/splat/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/splat/admin/css/style.css">
    <!--<link rel="stylesheet" href="/css/chosen.css">-->
    <link rel="stylesheet" href="/splat/admin/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <script src="/splat/admin/js/bootstrap.min.js"></script>
    <!--<script src="/js/chosen.js"></script> -->

</head>
<style>
    table tbody
    {
        font-size:16px;
    }
    table th
    {
        font-size:17px !important;
    }
    td >select>option
    {
        font-size:21px;
    }
    ul.yiiPager a:link, ul.yiiPager a:visited
    {
        border:solid 1px #00B9D1 !important;
        color:#00B9D1 !important;
    }
    p a:hover
    {
        color:#00B9CF !important;
    }
    ul.yiiPager a:link, ul.yiiPager a:visited
    {
        border: solid 1px #9aafe5;
        font-weight: bold;
        color: #0e509e;
        padding: 5px 20px;
        text-decoration: none;
    }
    ul.yiiPager .selected a
    {
        background: #00B9D1;
        color: #FFFFFF !important;
    }

</style>
<body>
<header class="header">
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero header-top">
            <div class="col-lg-3 col-xs-12 col-sm-3 float-left padzero">
                <a href="/splat/admin/site/index">
                    <img  style="width:157px;height:50px;" src="/splat/admin/images/SPLAT logo new.png"></a>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-3 text-right padzero user">
                <a href="javascript:void(0);" class='dropdown-toggle' id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>Splat1x2we Admin</span>
                    <img src="/splat/admin/images/profile/Untitled.png" style="width:40px;height:40px;border-radius: 50%;">
                    <i class="fa fa-caret-down" aria-hidden="true" style="color:#fff"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width:100%;padding:2px;">
                    <a class="dropdown-item" href="/splat/admin/site/editprofile" style="width:100%;background:#00B9D1;color:#ffffff;padding:10px;display:block;border-bottom:2px solid;">Edit Profile</a>
                    <a class="dropdown-item" href="/splat/admin/site/logout" style="width:100%;background:#00B9D1;color:#ffffff;padding:10px;display:block;border-bottom:2px black;">Logout</a>
                </div>

            </div>
        </div>
    </div>
</header>

<div id="content">
    <style>
        .container-fluid.bg-color {
            background-color: #00c4ff;
            padding:40px 0px;
            margin-bottom:22px;
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
            border-top: 1px solid #000;
            padding: 15px 30px 20px !important;
            position: absolute;
            bottom: -50px;
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
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <section id="wrapper" style="height:auto;">
        <div class="container-fluid bg-color">
            <div class="container">
                <p class="text-center bg-text">Welcome  <span class="oppo-color">
                                             Splat1x2we Admin</span></p>
                <p class="text-center production">You have admin permissions. You can manage faculties, courses, projects, groups and all the users. </p>
            </div>
        </div>
        <div class="container">
            <div class="admin-home">
                <p>You are here: <a href="/splat/admin/site/index">Admin Home</a></p>
            </div>
            <div class="row padzero">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 padzero home-menu text-center">
                    <a href="/splat/admin/site/faculties?i=MQ==">
                        <p class="mo"><i class="fas fa-book"></i></p>
                        Manage Faculty / Courses</a>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-4 padzero home-menu text-center ">
                    <a href="/splat/admin/users/admin" style="padding: 16% 8% !important;">
                        <p class="mo"><i class="fas fa-users-cog"></i></p>
                        Manage all Users</a>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 padzero home-menu text-center">
                    <a href="/splat/admin/questionsadmin/admin">
                        <p class="mo"><i class="fa fa-question-circle" aria-hidden="true"></i></p>
                        Manage Default Questions</a>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="clear"></div>
<footer class="footer-sec col-xs-12 col-lg-12 col-sm-12">
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12 padzero">
            <div class="col-lg-7 col-xs-12 col-sm-7">
                <ul class="footer-menu" style="margin-right: 78px;">
                    <li><a target="_blank" href="https://www1.bournemouth.ac.uk/about/governance/digital-security/website-privacy-cookies-policy">Privacy</a></li>
                </ul>
                <p class="copyright">&copy;Copyright 2018 SPLAT</p>
            </div>
            <div class="col-lg-5 col-xs-12 col-sm-5 text-right footer-logo">
                <a href="#"><img src="/splat/admin/images/logo.png"></a>
            </div>
        </div>
    </div>
</footer>
<script src="/splat/admin/js/notify.js"></script>
<script>
    $(document).ready(function(){
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).parent().find('i').removeClass("fa fa-angle-right").addClass("fa fa-angle-down");
        }).on('hide.bs.collapse', function(){
            $(this).parent().find('i').removeClass("fa fa-angle-down").addClass("fa fa-angle-right");
        });
    });
</script>
</body>
</html>
