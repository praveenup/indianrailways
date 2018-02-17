<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width," intitial-scale="1" maximum-scale="1">
    <title>Railway Adda</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body{
            background: #B5F9E9;
            margin: 0;
            padding: 0;
        }
        .divImage:hover {
            opacity: 2;
            box-shadow: 0 30px 16px 10px deepskyblue;
        }
        .divImage{
            margin: 30px;
            padding: 0;
            height: 150px;
            width: auto;
            opacity: .7;
            box-shadow:  0 10px 10px 0 skyblue;
            /*filter: contrast(200%);*/
        }
        body{
            background: url("images/back.gif");
            background-size: cover;

        }


        /*nav links*/
        a, a:hover {
            color: #000;
            text-decoration: none;
        }

        li {
            display: inline-block;
            position: relative;
            padding-bottom: 3px;
            margin-right: 10px;
        }
        li:last-child {
            margin-right: 0;
        }

        li:after {
            content: '';
            display: block;
            margin: auto;
            height: 3px;
            width: 0;
            background: transparent;
            transition: width .5s ease, background-color .5s ease;
        }
        li:hover:after {
            width: 100%;
            background: white;
        }
    </style>
    <style>
        .navbar-default {
            background-color: #5bc0de;
        }
        /* change the brand and text color */
        .navbar-default .navbar-brand,
        .navbar-default .navbar-text {
            color: rgba(255,255,255,.8);
        }
        /* change the link color */
        .navbar-default .navbar-nav .nav-link {
            color: rgba(255,255,255,.5);
        }
        /* change the color of active or hovered links */
        .navbar-default .nav-item.active .nav-link,
        .navbar-default .nav-item:hover .nav-link {
            color: #ffffff;
        }
        .navbar-default .navbar-nav > li > a:hover, .nav > li > a:focus { text-decoration: none; background-color: #afd9ee; }
    </style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" >
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#">Railway Adda</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="trainStatus/trainStatusMain.php">Running Status</a></li>
                <li><a href="trainSchedule/trainScheduleMain.php">Schedule</a></li>
                <li><a href="trainBetStn/trainBetStnMain.php">Train Between Station</a></li>
                <li><a href="trainFare/trainFareMain.php">Fare Enquiry</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="margin-top: 50px;">
    <div class="col-md-12 text-center">
        <div class="form-group col-md-3 img-thumbnail divImage">
            <a href="trainStatus/trainStatusMain.php" style="text-decoration: none;color: black;"><img src="images/status.png"  class="img-rounded"/><h4>Train Running Status</h4></a>
        </div>

        <div class="form-group col-md-3 img-thumbnail divImage">
            <a href="trainSchedule/trainScheduleMain.php" style="text-decoration: none;color: black;"><img src="images/schedule.png" class="img-rounded"/><h4>Train Schedule</h4></a>
        </div>

        <div class="form-group col-md-3 img-thumbnail divImage">
            <a href="trainBetStn/trainBetStnMain.php" style="text-decoration: none;color: black;"><img src="images/trainBetStn.png" class="img-rounded"/><h4>Train Between Station</h4></a>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <div class="form-group col-md-3 img-thumbnail divImage">
            <a href="#" style="text-decoration: none;color: black;"><img src="images/pnr.png"  class="img-rounded"/><h4>PNR Status</h4></a>
        </div>

        <div class="form-group col-md-3 img-thumbnail divImage">
            <a href="#" style="text-decoration: none;color: black;"><img src="images/seat.png" class="img-rounded"/><h4>Seat Availability</h4></a>
        </div>

        <div class="form-group col-md-3 img-thumbnail divImage">
            <a href="trainFare/trainFareMain.php" style="text-decoration: none;color: black;"><img src="images/fare.png" class="img-rounded"/><h4>Fare Enquiry</h4></a>
        </div>
    </div>
	
</div>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
<?php
include 'include/footer.php';
?>
</html>