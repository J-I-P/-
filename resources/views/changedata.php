<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <title>Transceiver Room of NUU</title>

    <!-- Fonts -->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Transceiver Room of NUU</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="adminadd"><i class="fa fa-user-plus fa-fw"></i> Enroll</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="adminlogout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


        <!-- /.sidebar-collapse -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="history"><i class="fa fa-history fa-fw"></i> History</a>
                    </li>
                    <li>
                        <a href="ad"><i class="fa fa-envelope-o fa-fw"></i> 待領郵件</a>
                    </li>
                    <li>
                        <a href="download"><i class="fa fa-download fa-fw"></i> 輸出Excel</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <a href="ad" class="btn btn-info" role="button"><i class="fa fa-angle-left fa-fw"></i> 返回</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <i class="fa fa-pencil-square-o fa-3x page-header"> <?php if($RECORD!=null) echo "修改";  else echo "新增"; ?></i>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Form
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" id="myForm" action="update">
                                    <div class="form-group">
                                        <label>名字</label>
                                        <input class="form-control" placeholder="名字" name="NAME" value="<?php if($RECORD!=null) echo $RECORD->NAME; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>類型</label>
                                        <input class="form-control" placeholder="類型" name="TYPE" value="<?php if($RECORD!=null) echo $RECORD->TYPE; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>收件時間</label>
                                        <input class="form-control" placeholder="收件時間" name="RECEIEVE_DATE"  id="date" type="text" value="<?php if($RECORD!=null) echo $RECORD->RECEIEVE_DATE; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>地點</label>
                                        <select name="sort" class="form-control">
                                            <option value="" <?php  if($RECORD==null) echo "selected=\"selected\""?>>請選擇</option>
                                            <option value="1" <?php  if($RECORD!=null){if($RECORD->PLACE=="二坪") echo "selected=\"selected\"";}?>>二坪</option>
                                            <option value="2" <?php  if($RECORD!=null){if($RECORD->PLACE=="八甲") echo "selected=\"selected\"";}?>>八甲</option>
                                        </select>
                                    </div>
                                    <div class="text-right">
                                        <input type="button" class="btn btn-danger" onclick="myFunction()" value="<?php if($RECORD!=null) echo "修改";  else echo "新增"; ?>">
                                        <input type="hidden" name="record_NO" value="<?php if($RECORD!=null) echo $RECORD->NO; ?>">
                                        <input type="hidden" name="<?php if($RECORD!=null) echo "update";  else echo "insert"; ?>">
                                    </div>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /.col-lg-4 (nested) -->
    <!-- /.col-lg-8 (nested) -->
</div>

    <script>
        function myFunction() {
            document.getElementById("myForm").submit();
        }
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.min.js"></script>

<script>
    $( function() {
        $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    } );
</script>
</body>
</html>