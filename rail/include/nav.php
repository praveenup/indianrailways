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

    /*nav links*/
    a, a:hover {
        color: #000;
        text-decoration: none;
    }
/*
    li {
        display: inline-block;
        position: relative;
        padding-bottom: 3px;
        margin-right: 10px;
    }

*/
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
<nav class="navbar navbar-default navbar-fixed-top" >
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="../">Railway Adda</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../trainStatus/trainStatusMain.php">Running Status</a></li>
                <li><a href="../trainSchedule/trainScheduleMain.php">Schedule</a></li>
                <li><a href="../trainBetStn/trainBetStnMain.php">Train Between Station</a></li>
                <li><a href="../trainFare/trainFareMain.php">Fare Enquiry</a></li>
            </ul>
        </div>
    </div>
</nav>