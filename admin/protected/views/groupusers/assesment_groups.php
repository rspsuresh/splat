<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php
$institution = Institutions::model()->find('id='.base64_decode($_GET['i']));
$faculty = Faculties::model()->find('id='.base64_decode($_GET['f']));
$course = Courses::model()->find('id='.base64_decode($_GET['c']));
?>
<?php $grp=ProjectGroups::model()->with('groups')->findAll('project_id='.$_GET['id'].' and groups.status="active"');
$project=Projects::model()->findByPk($_GET['id']);
?>
<style>
    #accordion .panel-heading { padding: 0;}
    #accordion .panel-title > a {
        display: block;
        padding: 0.4em 0.6em;
        outline: none;
        font-weight:bold;
        text-decoration: none;
    }

    #accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
        content:"\e113";
        float: left;
        font-family: 'Glyphicons Halflings';
        margin-right :1em;
    }
    #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
        content:"\e114";
    }
    .quick-btn {
        position: relative;
        display: inline-block;
        width: auto;
        height: 80px;
        padding-top: 16px;
        margin: 10px;
        color: #444444;
        text-align: center;
        text-decoration: none;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.6);
        -webkit-box-shadow: 0 0 0 1px #F8F8F8 inset, 0 0 0 1px #CCCCCC;
        box-shadow: 0 0 0 1px #F8F8F8 inset, 0 0 0 1px #CCCCCC;
        margin:4px;
        padding:10px;
    }
    .quick-btn .label {
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .btn-metis-4 {
        color: #ffffff;
        background-color: #a264e7;
        border-color: #62309a;
    }
    .save-btn
    {
        color: white;
        font-size: 20px;
    }
    .align{
        margin-top:13px;
        float:right;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h3><?=$project->name?> (Assessment-<?=$_GET['key']?>)</h3>
        </div>
       <!-- <div class="col-lg-1">
            <button class="btn btn-info align" onclick="goBack()">Download Report</button>
        </div>-->
        <div class="col-lg-1">
            <button class="btn btn-primary align" onclick="goBack()">Back</button>
        </div>
        <div class="col-lg-12" id="main">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach($grp as $val) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne<?=$val->id?>" style="background-color:#00B9D1;color:#fff; ">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseOne<?=$val->id?>"
                                   aria-expanded="false" aria-controls="collapseOne<?=$val->id?>">
                                    <?=$val->groups->name?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne<?=$val->id?>" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingOne<?=$val->id?>">
                            <div class="panel-body">
                                <?php $grpuser=GroupUsers::model()->with('user')->findAll('group_id='.$val->group_id.' and user.status="active"');
                                if($grpuser) {
                                    //$modelassesm=Multipleassesment::model()->with('assmentdate')->find("t.id=".$_GET['as']."  and assmentdate.asses_id=".$_GET['as']." and assmentdate.from_user=1");
                                   // print_r($modelassesm);
                                    foreach ($grpuser as $gval) { ?>
                                        <?php $modelassesm=Multipleassesment::model()->with('assmentdate')->find("t.id=".$_GET['as']."  and assmentdate.asses_id=".$_GET['as']." and assmentdate.from_user=".$gval->user->id); ?>
                                        <?php $action=Yii::app()->CreateUrl('site/responsepage',
                                            array('id'=>$project->id,
                                            'u'=>$gval->user->id,'c'=>$_GET['c'],'i'=>$_GET['i'],'f'=>$_GET['f'],
                                                'g'=>$val->group_id,
                                                'as'=>$_GET['as'],'p'=>$_GET['p']));?>
                                        <a class="quick-btn"  href="<?php echo $action?>">
                                            <br/>
                                            <span> <?=$gval->user->first_name." ".$gval->user->last_name?>
                                            </span>
                                            <span><?php if($modelassesm) { ?>
                                                    L
                                             <?php } ?>
                                            </span>
                                        </a>
                                    <?php }
                                }
                                else { ?>
                                    <a class="quick-btn" href="#">
                                        <br/>
                                        <span>No users</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
