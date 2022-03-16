<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$title?></title>
        <link type="text/css" href="/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="/resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="/resources/css/theme.css" rel="stylesheet">
        <link type="text/css" href="/resources/images/icons/css/font-awesome.css" rel="stylesheet">
        <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

<body>
    
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i></a><a class="brand" href="/"><img src="/resources/images/logo.png" class="logo-avatar"></a>
                <div class="nav-collapse collapse navbar-inverse-collapse">

                    <?php if (isset($log)) { ?>
                    <ul class="nav pull-right">

                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/resources/userimage/user-<?=$log->getId().'.'.$log->getExtension()?>" class="nav-avatar" />
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/manage/<?=$log->getId()?>">Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="/user/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?= $sidebar ?>
                <?= $output ?>
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2022 Youssoupha Faye - sen-forage.sn </b>Tous droits reservés.
        </div>
    </div>
    <script src="/resources/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="/resources/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="/resources/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/resources/scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="/resources/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="/resources/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/resources/scripts/common.js" type="text/javascript"></script>

</body>