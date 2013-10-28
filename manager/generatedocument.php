<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/db.inc.php');

session_start();

if (!isset($_SESSION['username'])){
   header('Location: /login.php') ;
}

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="vendors/jquery-1.9.1.min.js"></script>

        <script>
            $(document).ready(function() {
            $('#gendocform').submit(function() {
                $("body").append("<iframe src='/gendoc.php?name=" + $("#name").val() + "&description=" +  $("description").val() +"' style='display: none;' ></iframe>");
                $("#name").val('');
                $("description").val(''); 
            });
            });

        </script>

    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Aldrovandi</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php print $_SESSION["username"]; ?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Documents<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="documents.php">View</a>
                                    </li>
                                    <li>
                                        <a href="generatedocument.php" class="active">Generate</a>
                                    </li>
                                </ul>

                            <li>
                                <a href="logs.php">Logs</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                
                <!--/span-->
                    
                    <div class="row-fluid">
                        <div class="span9">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Generate Bugged Document</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" id="gendocform" action="#">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label" for="name">Document Name</label>
                                          <div class="controls">
                                            <input class="input-medium focused" id="name" type="text">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="description">Document Description</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" id="description" type="text">
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Generate</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                </div>
            </div>
            <hr>
            <footer>
                <p>Aldrovandi &copy; Ben Jackson &amp; Mayhemic Labs 2013 - Admin Panel Interface &copy; Vincent Gabriel 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
    </body>

</html>
