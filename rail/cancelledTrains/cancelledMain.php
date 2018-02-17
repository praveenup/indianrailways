
<!DOCTYPE html>
<html>
<head>
    <title>Railway Adda</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../jqueryui/external/jquery/jquery.js"></script>
    <script src="../jqueryui/jquery-ui.js"></script>
    <link rel="stylesheet" href="../jqueryui/jquery-ui.css">
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#">Railway Adda</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="cancelledMain.php">Running Status</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Train Between Station</a></li>
                <li><a href="#">PNR Status</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1 class="text-center" style="margin-top: 0;">Check Cancelled Trains</h1>
<div class="well well-lg">
    <div class="container-fluid">

        <form class="form-horizontal"  action="cancelledMain.php" method="POST">
            <div class="col-sm-12 form-group">
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["txtTrainNo"])) {
                        echo "<div class='alert alert-danger text-center'>Please Enter The Train Number In Specified Field</div>";
                    }
                }
                ?>
                <label class="control-label col-sm-2 ">Train Number : </label>
                <div class="col-sm-3">
                    <input id="trainNo" name="txtTrainNo" class="form-control" style="border-radius: 0;" type="number" placeholder="Enter Train Number Here... " />
                </div>
                <label class="control-label col-sm-2 " for="sel1">Select Date of Journey:</label>
                <div class="col-sm-3">
                    <select name="trainDate" class="form-control" style="border-radius: 0;" id="sel1">
                        <?php
                        date_default_timezone_set("Asia/Kolkata");
                        $train_date = date('d-m-Y', strtotime(date() . ' -3 day'));
                        for($i = 0; $i < 5; $i++){
                            if($i == 3){
                                echo '<option selected>'.date('d-m-Y', strtotime($train_date . ' +'.$i.' day')).'</option>';
                            }else{
                                echo '<option>'.date('d-m-Y', strtotime($train_date . ' +'.$i.' day')).'</option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <input  name="btnGetStatus" class="form-control btn btn-success" type="submit" style="border-radius: 0;" value="Get Status" />
                </div>
            </div>
        </form>
    </div>
</div>


<?php
date_default_timezone_set("Asia/Kolkata");
if(!empty($_POST['txtTrainNo'])){
    include 'trainStatus.php';
}
?>


</body>
</html>