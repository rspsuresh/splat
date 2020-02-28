<style>
    .active{
        background-color :red !important;
    }
    #resulttable_wrapper {
        margin-bottom:20px
    }
    .table thead {
        background-color: #03c6e3 !important;
    }
    table{
        border:2px solid #03c6e3 !important;
    }
    .table.dataTable thead th, table.dataTable thead td, table.dataTable.no-footer{
        border:2px solid #03c6e3 !important;
    }
    .div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
    .margintop{margin-top:30px}
</style>
<section id="wrapper" style="height:auto !important;margin-top:5px;">
    <div class="container">
        <div class="margintop row">
            <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2" style="padding-left:0 !important;">
                <a  class="btn btn-info" href="<?php echo Yii::app()->createUrl('users/cadmin',array('i'=>$_GET['i'],
                    'f'=>$_GET['f'], 'c'=>$_GET['c'])); ?>">Back </a>
            </div>
           <div class="col-lg-7 col-xs-7 col-sm-7 col-md-7">
               <h4 class="text-center">Assesment Report Download</h4>
           </div>
            <?=$html?>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#resulttable').DataTable( {
            "bPaginate": $('#resulttable tbody tr').length > 10,
            "iDisplayLength": 10,
            "searching": $('#resulttable tbody tr').length >= 10 ? true : false,
            "scrollX": true,
            "order": [[ 5, "asc" ]],
            language: {
                infoEmpty: "No questions found.",
                emptyTable: "No questions found.",
                zeroRecords: "No questions found.",
                "info": "Showing _START_ to _END_ of _TOTAL_ Reports",
            },
            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 5 ]
                    }
                },
                {
                    extend: 'colvis',
                    text: 'Select columns <i class="fa fa-info-circle" aria-hidden="true" title="Please select appropriate columns that you would like to have to be imported to the Brightspace"></i> ',
                    postfixButtons: [ 'colvisRestore' ]
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    },
                    text:'<i class="fa fa-download"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'excelHtml5',
                    text:'<i class="fa fa-download"></i> Excel',
                    exportOptions: {
                        columns: ':visible'
                    },
                    titleAttr: 'Excel'
                },
            ]
        } );
    } );
</script>
