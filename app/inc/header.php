<?php
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo APP_NAME ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <!--jQuery library script-->
    <script src="/assets/js/jquery-1.11.2.min.js"></script>
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        
        <div id="navbar" class="collapse navbar-collapse">
          <!--<ul class="nav navbar-nav">
              <li><a href="/">
                      <img src="/assets/images/common/son-tours-logo-hi-res.png" alt="Son Tours Logo" class="img-responsive" />
                  </a>
              </li>
              <li>
                  <h3 class="pull-right">Have Questions? Call (800) 416-8212</h3>
              </li>
              <?php if(isset($_SESSION['USER_ID'])){
                echo '<li><a href="/logout" class="btn btn-danger pull-right">LOG OUT</a></li>';
            } ?>
          </ul>-->
          <div class="col-lg-3">
              <img style="margin:10px 0;" src="/assets/images/common/son-tours-logo-hi-res.png" alt="Son Tours Logo" class="img-responsive" />
          </div><div class="col-lg-6">
            <h3>Have Questions? Call (800) 416-8212</h3>
          </div><div class="col-lg-2">
                <?php if(isset($_SESSION['USER_ID'])){
                echo '<a href="/logout" class="btn btn-danger pull-right" style="margin-top:15px;">LOG OUT</a>';
            } ?>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container layout">