<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    <li>
                        <a href="adminlogin"><i class="fa fa-sign-in fa-fw"></i> Login</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-envelope-o fa-lg"> </i> 待領郵件
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-envelope fa-fw"></i>  待領郵件
                    </div>
                                    <!-- /.panel-heading -->
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>名字</th>
                                                <th>系所</th>
                                                <th>類型</th>
                                                <th>收件時間</th>
                                                <th>地點</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($RECORD as $user) {?>
                                                <tr>
                                                    <td><?php echo $user->NAME; ?></td>
                                                    <td><?php echo $user->UNIT; ?></td>
                                                    <td><?php echo $user->TYPE; ?></td>
                                                    <td><?php echo $user->RECEIEVE_DATE; ?></td>
                                                    <td><?php echo $user->PLACE; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                        <!-- /.table-responsive -->
                                </div>
                                    <!-- /.panel-body -->
                            </div>
                                <!-- /.panel -->
                        </div>
                    </div>
                            <!-- /.col-lg-12 -->
            </div>
                <!--
                        <div class="pull-right ">
                            <form action="search">
                                <input type="text" name="searchbyname" placeholder="Search...">
                                <input type="submit" value="查詢">
                            </form>
                        </div>
                        -->
        </div>
                    <!-- /.panel-heading -->
                    <!--<div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>名字</th>
                                                <th>類型</th>
                                                <th>收件時間</th>
                                                <th>地點</th>
                                            </tr>

                                            <?php
                                            foreach ($RECORD as $user) {?>
                                                <tr>
                                                    <td><?php echo $user->NAME; ?></td>
                                                    <td><?php echo $user->TYPE; ?></td>
                                                    <td><?php echo $user->RECEIEVE_DATE; ?></td>
                                                    <td><?php echo $user->PLACE; ?></td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
    </div>
                            <!-- /.col-lg-4 (nested) -->
                            <!-- /.col-lg-8 (nested) -->
</div>
<!-- /.row -->

<!--
<footer class="footer">
    <div class="container">
        <span class="text-muted">Copyright © 2018 JYP All rights reserved</span>
    </div>
</footer>
-->

<script src="js/jquery.min.js"></script>

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
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>
